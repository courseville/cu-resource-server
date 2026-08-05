<?php

namespace App\Services\FirstClass;

/**
 * Exception thrown when a FirstClass API request fails.
 */
class FirstClassClientException extends \Exception
{
    public function __construct(
        string $message,
        public readonly string $code_str,
        public readonly int $httpStatus,
        public readonly array $rawResponse = [],
    ) {
        parent::__construct($message);
    }
}

/**
 * HTTP client for the FirstClass Central API.
 *
 * This client provides read-only access to the FirstClass REST API
 * using a Bearer API key.
 *
 * Features:
 * - Automatic pagination
 * - Retry with exponential backoff for server errors
 * - Consistent exception handling
 * - Configurable request timeout
 *
 * Call {@see ping()} before requesting other endpoints to verify
 * that the API is available.
 */
class FirstClassClient
{
    private const DEFAULT_PER_PAGE = 500;

    private const MAX_PER_PAGE = 500;

    private const DEFAULT_TIMEOUT = 30; // seconds

    private const MAX_RETRIES = 3;

    /**
     * API error code mapping.
     */
    private const ERROR_CODES = [
        'fcwm_central_disabled' => 503,
        'fcwm_ip_denied' => 403,
        'fcwm_no_key' => 401,
        'fcwm_bad_key' => 401,
        'fcwm_scope_denied' => 403,
        'rest_invalid_param' => 400,
        'fcwm_invalid_param' => 400,
        'fcwm_conflicting_params' => 400,
        'rest_no_route' => 404,
    ];

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
        private readonly int $timeout = self::DEFAULT_TIMEOUT,
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');

        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException(
                'FirstClass API key is required.'
            );
        }

        if (empty($this->baseUrl)) {
            throw new \InvalidArgumentException(
                'FirstClass base URL is required.'
            );
        }
    }

    /**
     * Check API connectivity.
     */
    public function ping(): array
    {
        return $this->request('GET', '/ping');
    }

    /**
     * Get the system summary.
     */
    public function getSummary(): array
    {
        return $this->request('GET', '/central/summary')['data'];
    }

    /**
     * Get all rooms.
     */
    public function getRooms(bool $activeOnly = true): array
    {
        return $this->fetchAll('central/rooms', [
            'active' => $activeOnly ? 1 : 0,
        ]);
    }
  /**
     * Get all machines.
     *
     * @param array{room_id?:int, status?:string, updated_since?:string, include?:string} $params
     */
    public function getMachines(array $params = []): array
    {
        return $this->fetchAll('central/machines', $params);
    }

    /**
     * Get student check-ins.
     *
     * @param array{from?:string, to?:string, room_id?:int, student_id?:string, active?:int, since_id?:int, updated_since?:string} $params
     */
    public function getCheckins(array $params = []): array
    {
        if (isset($params['since_id']) && isset($params['updated_since'])) {
            throw new \InvalidArgumentException(
                'Cannot use since_id and updated_since together.'
            );
        }
        return $this->fetchAll('central/checkins', $params);
    }

    /**
     * Get classes and exams.
     *
     * @param array{from?:string, to?:string, room_id?:int, type?:string} $params
     */
    public function getClasses(array $params = []): array
    {
        return $this->fetchAll('central/classes', $params);
    }

    /**
     * Get browser history logs.
     */
    public function getBrowserLog(array $params = []): array
    {
        return $this->fetchAll('central/browser-log', $params);
    }

    /**
     * Get running processes on machines.
     */
    public function getProcesses(array $params = []): array
    {
        if (($params['latest'] ?? 1) == 1 &&
            (isset($params['from']) || isset($params['to']) || isset($params['since_id']))) {
            throw new \InvalidArgumentException(
                'Cannot use latest=1 with from, to, or since_id parameters.'
            );
        }
        return $this->fetchAll('central/processes', $params);
    }

    /**
     * Fetch all pages automatically.
     */
    public function fetchAll(string $endpoint, array $params = []): array
    {
        $page = 1;
        $out = [];
        $params['per_page'] = min($params['per_page'] ?? self::DEFAULT_PER_PAGE, self::MAX_PER_PAGE);

        do {
            $params['page'] = $page;
            $body = $this->request('GET', '/' . ltrim($endpoint, '/'), $params);
            $out = array_merge($out, $body['data']);
            $totalPages = $body['meta']['total_pages'] ?? 1;
            $page++;
        } while ($page <= $totalPages);

        return $out;
    }

    /**
     * Send HTTP request with exponential backoff for 5xx errors.
     */
    private function request(string $method, string $path, array $query = []): array
    {
        $url = $this->baseUrl . $path;
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $attempt = 0;
        $lastException = null;

        while ($attempt < self::MAX_RETRIES) {
            $attempt++;

            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $this->timeout,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $this->apiKey,
                    'Accept: application/json',
                ],
            ]);

            $responseBody = curl_exec($ch);
            $curlError = curl_error($ch);
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($responseBody === false) {
                $lastException = new FirstClassClientException(
                    "cURL error: {$curlError}",
                    'curl_error',
                    0
                );
                $this->backoffSleep($attempt);
                continue;
            }

            $decoded = json_decode($responseBody, true);

            if ($httpStatus >= 500) {
                $lastException = new FirstClassClientException(
                    $decoded['message'] ?? "Server error (HTTP {$httpStatus})",
                    $decoded['code'] ?? 'unknown_5xx',
                    $httpStatus,
                    $decoded ?? []
                );
                $this->backoffSleep($attempt);
                continue;
            }

            if ($httpStatus === 404 && ($decoded['code'] ?? null) === 'rest_no_route') {
                throw new FirstClassClientException(
                    "Endpoint '{$path}' not found on server.",
                    'rest_no_route',
                    404,
                    $decoded ?? []
                );
            }

            if ($httpStatus >= 400) {
                throw new FirstClassClientException(
                    $decoded['message'] ?? "Client error (HTTP {$httpStatus})",
                    $decoded['code'] ?? 'unknown_4xx',
                    $httpStatus,
                    $decoded ?? []
                );
            }

            return $decoded;
        }

        throw $lastException ?? new FirstClassClientException(
            'Request failed after ' . self::MAX_RETRIES . ' attempts',
            'max_retries_exceeded',
            0
        );
    }

    /**
     * Sleep using exponential backoff.
     */
    private function backoffSleep(int $attempt): void
    {
        usleep((int) (pow(2, $attempt - 1) * 1_000_000));
    }
}