<?php

namespace App\Sync\FirstClass;

use App\Services\FirstClass\FirstClassClient;
use App\Services\FirstClass\FirstClassClientException;
use Illuminate\Support\Facades\Log;

class MachinesSynchronizer
{
    public function sync(): void
    {
        $client = new FirstClassClient(
            baseUrl: config('firstclass.base_url'),
            apiKey: config('firstclass.api_key'),
            timeout: config('firstclass.timeout'),
        );

        try {
            $machines = $client->getMachines();

            Log::info('FirstClass machines synced successfully.', [
                'machines' => $machines,
            ]);

            // TODO:
            // Persist machines data.
            // Update the last sync timestamp.

        } catch (FirstClassClientException $e) {
            Log::error('Failed to sync FirstClass machines.', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}