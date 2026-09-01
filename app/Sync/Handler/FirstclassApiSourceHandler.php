<?php

namespace App\Sync\Handler;

use App\Models\DataSource;
use Illuminate\Http\Client\Response;
use RuntimeException;

/**
 * Source URL: firstclass:<endpoint>[?query][:last_sync_param]
 * Supported endpoints: summary, rooms, machines, checkins, classes, browser-log, processes
 */
class FirstclassApiSourceHandler extends BaseApiSourceHandler
{
    private const PAGE_PARAM = 'page';

    private const PER_PAGE_PARAM = 'per_page';

    private const PER_PAGE = 500;

    private const TOTAL_PAGES_PATH = 'meta.total_pages';

    protected function provider(): string
    {
        return 'firstclass';
    }

    /**
     * Every endpoint is handled here 
     */
    protected function fetchRows(DataSource $source, array $sourceConfig): array
    {
        $endpoint = $sourceConfig['endpoint'];
        $query = $sourceConfig['query'];

        return match ($endpoint) {
            'summary' => $this->fetchEndpointSingle('summary', $query),
            'rooms' => $this->fetchEndpointSingle('rooms', $this->normalizeRoomsQuery($query)),
            'machines' => $this->fetchEndpointPages('machines', $query),
            'checkins' => $this->fetchEndpointPages('checkins', $this->validateCheckinsQuery($query)),
            'classes' => $this->fetchEndpointPages('classes', $query),
            'browser-log' => $this->fetchEndpointPages('browser-log', $query),
            'processes' => $this->fetchEndpointPages('processes', $this->validateProcessesQuery($query)),
            default => throw new RuntimeException("Unsupported FirstClass endpoint: '{$endpoint}'."),
        };
    }

    protected function fetchEndpointSingle(string $endpoint, array $query): array
    {
        $config = $this->providerConfig();
        $request = $this->buildRequest($config);
        $url = $this->buildUrl($config['base_url'], $endpoint);

        return $this->fetchSingle($request, $url, $query, $config['data_path'] ?? null);
    }

    protected function fetchEndpointPages(string $endpoint, array $query): array
    {
        $config = $this->providerConfig();
        $request = $this->buildRequest($config);
        $url = $this->buildUrl($config['base_url'], $endpoint);

        return $this->fetchAll($request, $url, $query, self::TOTAL_PAGES_PATH, [
            'page_param' => self::PAGE_PARAM,
            'per_page_param' => self::PER_PAGE_PARAM,
            'per_page' => self::PER_PAGE,
            'data_path' => $config['data_path'] ?? null,
        ]);
    }

    protected function normalizeRoomsQuery(array $query): array
    {
        $query['active'] = filter_var($query['active'] ?? true, FILTER_VALIDATE_BOOL) ? 1 : 0;

        return $query;
    }

    protected function validateCheckinsQuery(array $query): array
    {
        if (isset($query['since_id']) && isset($query['updated_since'])) {
            throw new \InvalidArgumentException('Cannot use since_id and updated_since together.');
        }

        return $query;
    }

    protected function validateProcessesQuery(array $query): array
    {
        if (($query['latest'] ?? 1) == 1
            && (isset($query['from']) || isset($query['to']) || isset($query['since_id']))
        ) {
            throw new \InvalidArgumentException('Cannot use latest=1 with from, to, or since_id parameters.');
        }

        return $query;
    }

    protected function handleFailedResponse(Response $response): never
    {
        $decoded = $response->json() ?? [];

        $code = $decoded['code'] ?? 'unknown_error';
        $message = $decoded['message'] ?? "HTTP {$response->status()}";

        throw new RuntimeException(
            "FirstClass API error [{$code}] (HTTP {$response->status()}): {$message}"
        );
    }
}
