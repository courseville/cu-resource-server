<?php

namespace App\Jobs\FirstClass;

use App\Services\FirstClass\FirstClassClient;
use App\Services\FirstClass\FirstClassClientException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMachines implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $client = new FirstClassClient(
            baseUrl: config('firstclass.base_url'),
            apiKey: config('firstclass.api_key'),
            timeout: config('firstclass.timeout'),
        );

        try {
            // include=status retrieves the latest resource usage information,
            // such as CPU, RAM, and disk utilization.
            // updated_since is not used yet because the synchronization
            // cursor has not been implemented.
            $machines = $client->getMachines(['include' => 'status']);

            Log::info('FirstClass sync: machines completed successfully', [
                'count' => count($machines),
            ]);

            // TODO: Persist the retrieved data to the database.
            // Upsert records into the Machine model using the source ID
            // (or machine_guid if preferred).
            // Also update firstclass_sync_state:
            // endpoint = 'machines', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: machines failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);
        }
    }
}