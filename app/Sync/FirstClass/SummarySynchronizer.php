<?php

namespace App\Sync\FirstClass;

use App\Services\FirstClass\FirstClassClient;
use App\Services\FirstClass\FirstClassClientException;
use Illuminate\Support\Facades\Log;

class SummarySynchronizer
{
    public function sync(): void
    {
        $client = new FirstClassClient(
            baseUrl: config('firstclass.base_url'),
            apiKey: config('firstclass.api_key'),
            timeout: config('firstclass.timeout'),
        );

        try {
            $summary = $client->getSummary();

            Log::info('FirstClass summary synced successfully.', [
                'summary' => $summary,
            ]);

            // TODO:
            // Persist summary data.
            // Update the last sync timestamp.

        } catch (FirstClassClientException $e) {
            Log::error('Failed to sync FirstClass summary.', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}