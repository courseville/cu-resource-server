<?php

namespace App\Sync\FirstClass;

use App\Services\FirstClass\FirstClassClient;
use App\Services\FirstClass\FirstClassClientException;
use Illuminate\Support\Facades\Log;

class ProcessesSynchronizer
{
    public function sync(): void
    {
        $client = new FirstClassClient(
            baseUrl: config('firstclass.base_url'),
            apiKey: config('firstclass.api_key'),
            timeout: config('firstclass.timeout'),
        );

        try {
            $processes = $client->getProcesses();

            Log::info('FirstClass processes synced successfully.', [
                'processes' => $processes,
            ]);

            // TODO:
            // Persist processes data.
            // Update the last sync timestamp.

        } catch (FirstClassClientException $e) {
            Log::error('Failed to sync FirstClass processes.', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}