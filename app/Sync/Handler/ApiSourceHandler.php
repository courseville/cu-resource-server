<?php

namespace App\Sync\Handler;

use App\Models\DataSource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ApiSourceHandler
{
    private const MAX_PAGES = 1000;

    public function fetchData(DataSource $source): ?array
    {
        $sourceConfig = $this->parseSourceUrl($source);

        $provider = $sourceConfig['provider'];
        $endpoint = $sourceConfig['endpoint'];
        $query = $sourceConfig['query'];
        $lastSyncParameter = $sourceConfig['last_sync_parameter'];

        $apiConfig = $this->getApiConfig($provider);

        if (
            ! empty($lastSyncParameter) &&
            $source->last_synced_at
        ) {
            $query[$lastSyncParameter] = $source->last_synced_at->toIso8601String();
        }

        $url = rtrim($apiConfig['base_url'], '/')
            . '/'
            . ltrim($endpoint, '/');

        $request = $this->buildRequest(
            $apiConfig
        );

        if ($apiConfig['pagination']['enabled']) {
            return [
                'data' => json_encode($this->fetchPaginatedData(
                    $request,
                    $url,
                    $query,
                    $apiConfig['pagination']
                ), JSON_THROW_ON_ERROR),
                'type' => 'json',
            ];
        }

        $response = $request->get(
            $url,
            $query
        );

        if ($response->failed()) {
            throw new RuntimeException(
                "API request failed for '{$provider}'. " .
                    "Status: {$response->status()}: {$response->body()}"
            );
        }

        return [
            'data' => $response->body(),
            'type' => $this->getResponseType($response),
        ];
    }

    protected function getApiConfig(
        string $provider
    ): array {
        $config = config(
            "apisource.{$provider}"
        );

        if (! $config) {
            throw new RuntimeException(
                "API provider '{$provider}' is not configured."
            );
        }

        if (empty($config['base_url'])) {
            throw new RuntimeException(
                "Base URL is not configured for '{$provider}'."
            );
        }

        $defaultPagination = [
            'enabled' => false,
            'type' => 'page',

            // request params
            'page_param' => 'page',
            'per_page_param' => 'per_page',

            'offset_param' => 'offset',
            'limit_param' => 'limit',

            'cursor_param' => 'cursor',

            // response paths
            'data_path' => 'data',
            'total_pages_path' => null,
            'total_path' => null,
            'next_cursor_path' => 'meta.next_cursor',
            'next_url_path' => 'links.next',

            // page sizes
            'per_page' => 100,
            'limit' => 100,
        ];

        $config['pagination'] = array_merge(
            $defaultPagination,
            $config['pagination'] ?? []
        );

        return $config;
    }

    protected function fetchResponseData(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $response = $request->get(
            $url,
            $query
        );

        $response->throw();

        $json = $response->json();

        return [
            'json' => $json,
            'data' => $this->normalizeData(
                data_get(
                    $json,
                    $pagination['data_path']
                )
            ),
        ];
    }

    protected function fetchPaginatedData(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $handlers = [
            'page' => 'fetchPagePagination',
            'offset' => 'fetchOffsetPagination',
            'cursor' => 'fetchCursorPagination',
            'link' => 'fetchLinkPagination',
        ];

        $method = $handlers[$pagination['type']] ?? null;

        if (! $method) {
            throw new RuntimeException(
                "Unsupported pagination type: {$pagination['type']}"
            );
        }

        return $this->{$method}(
            $request,
            $url,
            $query,
            $pagination
        );
    }

    protected function fetchPagePagination(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $allData = [];

        $page = 1;
        $per_page = max(1, (int) ($pagination['per_page'] ?? 100));

        while ($page <= self::MAX_PAGES) {
            $result = $this->fetchResponseData(
                $request,
                $url,
                array_merge(
                    $query,
                    [
                        $pagination['page_param'] => $page,
                        $pagination['per_page_param'] => $per_page,
                    ]
                ),
                $pagination
            );

            $json = $result['json'];
            $data = $result['data'];

            $allData = array_merge(
                $allData,
                $data
            );

            if ($pagination['total_pages_path']) {
                $totalPages = (int) data_get(
                    $json,
                    $pagination['total_pages_path']
                );

                if ($page >= $totalPages) {
                    break;
                }
            } elseif (
                count($data) < $pagination['per_page']
            ) {
                break;
            }

            $page++;
        }

        return $allData;
    }

    protected function fetchOffsetPagination(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $allData = [];

        $offset = 0;
        $limit = max(1, (int) ($pagination['limit'] ?? 0));

        for ($page = 0; $page < self::MAX_PAGES; $page++) {
            $result = $this->fetchResponseData(
                $request,
                $url,
                array_merge(
                    $query,
                    [
                        $pagination['offset_param'] => $offset,
                        $pagination['limit_param'] => $limit,
                    ]
                ),
                $pagination
            );

            $json = $result['json'];
            $data = $result['data'];

            $allData = array_merge(
                $allData,
                $data
            );

            $total = $pagination['total_path']
                ? data_get(
                    $json,
                    $pagination['total_path']
                )
                : null;

            if (
                ! empty($total) &&
                ($offset + count($data)) >= (int) $total
            ) {
                break;
            }

            if (count($data) < $limit) {
                break;
            }

            $offset += $limit;
        }

        return $allData;
    }

    protected function fetchCursorPagination(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $allData = [];

        $cursor = null;

        for ($i = 0; $i < self::MAX_PAGES; $i++) {
            $requestQuery = $query;

            if (! empty($cursor)) {
                $requestQuery[$pagination['cursor_param']] = $cursor;
            }

            $result = $this->fetchResponseData(
                $request,
                $url,
                $requestQuery,
                $pagination
            );

            $json = $result['json'];
            $data = $result['data'];

            $allData = array_merge(
                $allData,
                $data
            );

            $nextCursor = data_get(
                $json,
                $pagination['next_cursor_path']
            );

            if ($nextCursor === $cursor || empty($nextCursor)) {
                break;
            }

            $cursor = $nextCursor;
        }

        return $allData;
    }

    protected function fetchLinkPagination(
        PendingRequest $request,
        string $url,
        array $query,
        array $pagination
    ): array {
        $allData = [];

        $linkUrl = $url;

        for ($i = 0; $i < self::MAX_PAGES; $i++) {
            $result = $this->fetchResponseData(
                $request,
                $linkUrl,
                $query,
                $pagination
            );

            $json = $result['json'];
            $data = $result['data'];

            $allData = array_merge(
                $allData,
                $data
            );

            $nextUrl = data_get(
                $json,
                $pagination['next_url_path']
            );

            if ($linkUrl === $nextUrl || empty($nextUrl)) {
                break;
            }

            $linkUrl = $nextUrl;
            $query = [];
        }

        return $allData;
    }

    protected function parseSourceUrl(
        DataSource $source
    ): array {
        $parts = explode(
            ':',
            $source->url,
            2
        );

        if (count($parts) !== 2) {
            throw new RuntimeException(
                "Invalid API source format: {$source->url}"
            );
        }

        $provider = $parts[0];
        $endpointAndQuery = $parts[1];

        $parts = explode(
            '?',
            $endpointAndQuery,
            2
        );

        $endpoint = $parts[0];
        $queryAndLastSync = $parts[1] ?? null;

        $query = [];
        $lastSyncParameter = null;

        if (! empty($queryAndLastSync)) {
            $parts = explode(
                ':',
                $queryAndLastSync,
                2
            );

            $queryString = $parts[0];
            $lastSyncParameter = $parts[1] ?? null;

            if ($queryString !== '') {
                parse_str(
                    $queryString,
                    $query
                );
            }
        }

        return [
            'provider' => $provider,
            'endpoint' => $endpoint,
            'query' => $query,
            'last_sync_parameter' => $lastSyncParameter,
        ];
    }

    protected function buildRequest(
        array $config
    ): PendingRequest {
        $request = Http::acceptJson()
            ->retry(2, 500);

        if (! empty($config['timeout'])) {
            $request = $request->timeout((int) $config['timeout']);
        }

        $apiKey = $config['api_key'] ?? null;
        $authType = $config['auth_type'] ?? 'bearer';

        switch ($authType) {
            case 'bearer':
                if ($apiKey) {
                    $request = $request->withToken(
                        $apiKey
                    );
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
                throw new RuntimeException(
                    "Unsupported authentication type: {$authType}"
                );
        }

        if (! empty($config['headers'])) {
            $request = $request->withHeaders(
                $config['headers']
            );
        }

        return $request;
    }

    protected function getResponseType(
        Response $response
    ): string {
        $contentType = strtolower(
            $response->header('Content-Type') ?? ''
        );

        if (str_contains($contentType, 'json')) {
            return 'json';
        }

        if (str_contains($contentType, 'csv')) {
            return 'csv';
        }

        $body = trim(
            $response->body()
        );

        if ($body !== '') {
            try {
                json_decode(
                    $body,
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );

                return 'json';
            } catch (\JsonException) {
                // Not JSON
            }
        }

        return 'unknown';
    }

    protected function normalizeData(
        mixed $data
    ): array {
        if (empty($data)) {
            return [];
        }

        if (! is_array($data)) {
            return [$data];
        }

        return $data;
    }
}
