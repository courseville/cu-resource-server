<?php

namespace App\Sync\Handler;

use App\Models\DataSource;

/**
 * Default handler for any API provider fully describable via
 * config/apisource.php: base_url, api_key, timeout, data_path (optional),
 */
class GenericApiSourceHandler extends BaseApiSourceHandler
{
    protected function fetchRows(DataSource $source, array $sourceConfig): array
    {
        $config = $this->providerConfig();
        $request = $this->buildRequest($config);
        $url = $this->buildUrl($config['base_url'], $sourceConfig['endpoint']);

        return $this->fetchSingle($request, $url, $sourceConfig['query'], $config['data_path'] ?? null);
    }
}
