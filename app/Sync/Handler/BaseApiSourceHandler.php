<?php

namespace App\Sync\Handler;

use App\Models\DataSource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

/**
 * Shared behavior for all API source handlers:
 *  - parsing `provider_name:endpoint?query:last_sync_param` source URLs
 *  - loading provider config
 *  - building the request (auth + headers + retry)
 *  - fetchSingle(), fetchAll() for page/per_page pagination
 *  - response type detection and data_path-based normalization
 */
abstract class BaseApiSourceHandler implements ApiSourceHandler
{
    protected const MAX_PAGES = 1000;

    protected const DEFAULT_PER_PAGE = 100;

    /** Set from the source URL in fetchData(); provider() reads it by default. */
    protected string $provider = '';

    /**
     * The provider key used for config lookup and error messages.
     * Defaults to whatever parseSourceUrl() found in the source URL.
     */
    protected function provider(): string
    {
        return $this->provider;
    }

    /**
     * Fetch this provider's data and shape it into rows.
     *
     * @return array<int, array<string, mixed>>
     */
    abstract protected function fetchRows(DataSource $source, array $sourceConfig): array;

    final public function fetchData(DataSource $source): array
    {
        $sourceConfig = $this->parseSourceUrl($source);
        $this->provider = $sourceConfig['provider'];

        try {
            $rows = $this->fetchRows($source, $sourceConfig);
        } catch (RuntimeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new RuntimeException(
                "API request failed for '{$this->provider()}'. " . $e->getMessage(),
                previous: $e
            );
        }

        return $this->normalizeRows($rows);
    }

    /**
     * Parse `provider_name:endpoint?query:last_sync_parameter` into parts,
     * and merge the source's last_synced_at into the query if applicable.
     */
    protected function parseSourceUrl(DataSource $source): array
    {
        $parts = explode(':', $source->url, 2);

        if (count($parts) !== 2) {
            throw new RuntimeException("Invalid API source format: {$source->url}");
        }

        [$provider, $endpointAndQuery] = $parts;

        $parts = explode('?', $endpointAndQuery, 2);
        $endpoint = $parts[0];
        $queryAndLastSync = $parts[1] ?? null;

        $query = [];
        $lastSyncParameter = null;

        if (! empty($queryAndLastSync)) {
            $parts = explode(':', $queryAndLastSync, 2);
            $queryString = $parts[0];
            $lastSyncParameter = $parts[1] ?? null;

            if ($queryString !== '') {
                parse_str($queryString, $query);
            }
        }

        if (! empty($lastSyncParameter) && $source->last_synced_at) {
            $query[$lastSyncParameter] = $source->last_synced_at->toIso8601String();
        }

        return [
            'provider' => $provider,
            'endpoint' => $endpoint,
            'query' => $query,
            'last_sync_parameter' => $lastSyncParameter,
        ];
    }

    /**
     * Load this provider's config. Default reads config("apisource.{provider}")
     */
    protected function providerConfig(): array
    {
        $config = config("apisource.{$this->provider()}");

        if (! $config) {
            throw new RuntimeException("API provider '{$this->provider()}' is not configured.");
        }

        if (empty($config['base_url'])) {
            throw new RuntimeException("Base URL is not configured for '{$this->provider()}'.");
        }

        return array_merge([
            'auth_type' => 'none',
            'timeout' => 30,
            'data_path' => 'data',
        ], $config);
    }

    protected function buildRequest(array $config): PendingRequest
    {
        $request = $this->applyRetry(Http::acceptJson());

        if (! empty($config['timeout'])) {
            $request = $request->timeout((int) $config['timeout']);
        }

        $apiKey = $config['api_key'] ?? null;
        $authType = $config['auth_type'] ?? 'none';

        switch ($authType) {
            case 'bearer':
                if ($apiKey) {
                    $request = $request->withToken($apiKey);
                }
                break;

            case 'header':
                if ($apiKey) {
                    $request = $request->withHeaders([
                        $config['auth_header'] ?? 'X-API-Key' => $apiKey,
                    ]);
                }
                break;

            case 'basic':
                $request = $request->withBasicAuth(
                    $config['username'] ?? '',
                    $config['password'] ?? ''
                );
                break;

            case 'none':
                break;

            default:
                throw new RuntimeException("Unsupported authentication type: {$authType}");
        }

        if (! empty($config['headers'])) {
            $request = $request->withHeaders($config['headers']);
        }

        return $request;
    }

    protected function applyRetry(PendingRequest $request): PendingRequest
    {
        return $request->retry(2, 500);
    }

    protected function buildUrl(string $baseUrl, string $endpoint): string
    {
        return rtrim($baseUrl, '/') . '/' . ltrim($endpoint, '/');
    }

    protected function send(PendingRequest $request, string $url, array $query): Response
    {
        return $request->get($url, $query);
    }

    /**
     * GET — no pagination. Use for any endpoint
     */
    protected function fetchSingle(PendingRequest $request, string $url, array $query, ?string $dataPath = null): array
    {
        $response = $this->send($request, $url, $query);

        if ($response->failed()) {
            $this->handleFailedResponse($response);
        }

        return $this->responseToRows($response, $dataPath);
    }

    /**
     * Page/per_page pagination
     *
     * $totalPagesPath is a data_get() path into the JSON response.
     *
     * $options:
     *  - page_param (default 'page')
     *  - per_page_param (default 'per_page')
     *  - per_page (default DEFAULT_PER_PAGE)
     *  - data_path
     */
    protected function fetchAll(PendingRequest $request, string $url, array $query, string $totalPagesPath, array $options = []): array
    {
        $pageParam = $options['page_param'] ?? 'page';
        $perPageParam = $options['per_page_param'] ?? 'per_page';
        $perPage = max(1, (int) ($options['per_page'] ?? static::DEFAULT_PER_PAGE));
        $dataPath = $options['data_path'] ?? 'data';

        $allRows = [];
        $page = 1;

        do {
            $pageQuery = array_merge($query, [
                $pageParam => $page,
                $perPageParam => $perPage,
            ]);

            $response = $this->send($request, $url, $pageQuery);

            if ($response->failed()) {
                $this->handleFailedResponse($response);
            }

            $allRows = array_merge($allRows, $this->responseToRows($response, $dataPath));

            $totalPages = (int) (data_get($response->json(), $totalPagesPath) ?? 1);
            $hasMore = $page < $totalPages;

            $page++;
        } while ($hasMore && $page <= static::MAX_PAGES);

        return $allRows;
    }

    protected function handleFailedResponse(Response $response): never
    {
        throw new RuntimeException(
            "Status: {$response->status()}: {$response->body()}"
        );
    }

    protected function responseToRows(Response $response, ?string $dataPath): array
    {
        return match ($this->getResponseType($response)) {
            'json' => $this->normalizeRows(data_get($response->json(), $dataPath)),
            'csv' => $this->csvToRows($response->body()),
            default => throw new RuntimeException(
                'Unrecognized response type; expected JSON or CSV.'
            ),
        };
    }

    protected function getResponseType(Response $response): string
    {
        $contentType = strtolower($response->header('Content-Type') ?? '');

        if (str_contains($contentType, 'json')) {
            return 'json';
        }

        if (str_contains($contentType, 'csv')) {
            return 'csv';
        }

        $body = trim($response->body());

        if ($body !== '') {
            try {
                json_decode($body, true, 512, JSON_THROW_ON_ERROR);

                return 'json';
            } catch (\JsonException) {
                // Not JSON
            }
        }

        return 'unknown';
    }

    /**
     * Ensure the result is a plain list of associative-array rows.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function normalizeRows(mixed $rows): array
    {
        if (empty($rows)) {
            return [];
        }

        if (! is_array($rows)) {
            return [['value' => $rows]];
        }

        // Single associative row (not a list of rows) -> wrap it.
        if (array_is_list($rows) === false && ! isset($rows[0])) {
            return [$rows];
        }

        return array_map(
            fn($row) => is_array($row) ? $row : ['value' => $row],
            array_values($rows)
        );
    }

    /**
     * Parse a CSV string body into an array of associative rows, using the
     * first line as column headers.
     * 
     * @return array<int, array<string, mixed>>
     */
    protected function csvToRows(string $csv): array
    {
        $lines = preg_split('/\r\n|\r|\n/', trim($csv));

        if (empty($lines) || $lines === ['']) {
            return [];
        }

        $header = str_getcsv(array_shift($lines));
        $rows = [];

        foreach ($lines as $line) {
            if ($line === '') {
                continue;
            }

            $fields = str_getcsv($line);
            $rows[] = array_combine(
                $header,
                array_pad($fields, count($header), null)
            );
        }

        return $rows;
    }
}
