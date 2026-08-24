<?php

namespace App\Sync\Handler;

use App\Models\DataSource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ApiSourceHandler
{
    public function fetchData(DataSource $source): ?array
    {
        $config = $this->parseSourceUrl($source);

        $provider = $config['provider'];
        $endpoint = $config['endpoint'];
        $query = $config['query'];
        $lastSyncParameter = $config['last_sync_parameter'];

        $apiConfig = config("apisource.{$provider}");

        if (! $apiConfig) {
            throw new RuntimeException(
                "API provider '{$provider}' is not configured."
            );
        }

        $baseUrl = $apiConfig['base_url'] ?? null;

        if (! $baseUrl) {
            throw new RuntimeException(
                "Base URL is not configured for '{$provider}'."
            );
        }

        /*
         * Add DataSource last_synced_at.
         *
         * a:user?id=1:update
         *
         * becomes:
         *
         * ?id=1&update={last_synced_at}
         */
        if (
            $lastSyncParameter &&
            $source->last_synced_at
        ) {
            parse_str("{$lastSyncParameter}={$source->last_synced_at}", $lastSyncQuery);
            $query = array_merge($query, $lastSyncQuery);
        }


        $url = $this->buildUrl(
            $baseUrl,
            $endpoint
        );

        $request = $this->buildRequest(
            $apiConfig,
        );

        $response = $this->sendRequest(
            $request,
            $url,
            $query,
        );

        if ($response->failed()) {
            throw new RuntimeException(
                "API request failed for '{$provider}'. " .
                    "Status: {$response->status()}: {$response->body()}"
            );
        }
        $type = $this->getResponseType($response);

        return $this->processResponse(
            $response->body(),
            $type
        );
    }

    protected function parseSourceUrl(DataSource $source): array
    {
        // provider:endpoint
        $parts = explode(':', $source->url, 2);

        if (count($parts) !== 2) {
            throw new RuntimeException(
                "Invalid API source format: {$source->url}. " .
                    "Expected: provider:endpoint?parameters[:last_sync_parameter]"
            );
        }

        $provider = $parts[0];
        $endpointAndQuery = $parts[1];

        // endpoint?parameters
        $parts = explode('?', $endpointAndQuery, 2);

        $endpoint = $parts[0];
        $queryAndLastSync = $parts[1] ?? null;

        $query = [];
        $lastSyncParameter = null;

        if ($queryAndLastSync !== null) {
            // id=1&u=2:update
            $parts = explode(':', $queryAndLastSync, 2);

            $queryString = $parts[0];
            $lastSyncParameter = $parts[1] ?? null;

            if ($queryString !== '') {
                parse_str($queryString, $query);
                
            }
        }

        return [
            'provider' => $provider,
            'endpoint' => $endpoint,
            'query' => $query,
            'last_sync_parameter' => $lastSyncParameter,
        ];
    }

    protected function buildUrl(
        string $baseUrl,
        string $endpoint
    ): string {
        return rtrim($baseUrl, '/') .
            '/' .
            ltrim($endpoint, '/');
    }

    protected function buildRequest(
        array $config,
    ): PendingRequest {
        $request = Http::acceptJson();

        $apiKey = $config['api_key'] ?? null;
        $authType = $config['auth_type'] ?? 'bearer';

        switch ($authType) {
            case 'bearer':
                if ($apiKey) {
                    $request = $request->withToken($apiKey);
                }

                break;

            case 'header':
                if ($apiKey) {
                    $headerName = $config['auth_header'] ?? 'X-API-Key';

                    $request = $request->withHeaders([
                        $headerName => $apiKey,
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

    protected function sendRequest(
        PendingRequest $request,
        string $url,
        array $query,
    ): Response {
        return $request->get($url, $query);
    }

    protected function processResponse(
        string $body,
        string $type,
    ): array {
        return [
            'data' => $body,
            'type' => $type,
        ];
    }

    protected function getResponseType(Response $response): string
    {
        $contentType = strtolower(
            $response->header('Content-Type') ?? ''
        );

        switch (true) {
            case str_contains($contentType, 'json'):
                return 'json';

            case str_contains($contentType, 'csv'):
                return 'csv';

            // case str_contains($contentType, 'xml'):
            //     return 'xml';
        }

        // Fallback: detect JSON from response body
        $body = trim($response->body());


        if ($body !== '') {
            json_decode($body);

            if (json_last_error() === JSON_ERROR_NONE) {
                return 'json';
            }
        }

        return 'unknown';
    }
}
