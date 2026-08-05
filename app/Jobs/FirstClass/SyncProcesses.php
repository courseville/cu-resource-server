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

/**
 * SyncProcesses
 *
 * Note: The /processes endpoint contains sensitive data and is disabled by
 * default on the FirstClass server. An administrator must enable the
 * processes scope in FirstClass Settings before it can be accessed.
 *
 * If the scope is not enabled, the API may return the error code
 * 'fcwm_scope_denied' (HTTP 403). This is expected behavior, not a bug.
 */
class SyncProcesses implements ShouldQueue
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
            // No query parameters are provided.
            // FirstClass defaults to latest=1, which retrieves only the
            // most recent process snapshot for each machine.
            // This avoids downloading historical process data unless needed.
            $processes = $client->getProcesses();

            Log::info('FirstClass sync: processes completed successfully', [
                'count' => count($processes),
            ]);

            // TODO: Persist the retrieved data to the database.
            // This requires a new migration and model for process snapshots.
            // Each snapshot contains a nested array of running processes
            // for a specific machine.
            // Also update firstclass_sync_state:
            // endpoint = 'processes', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: processes failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
                'note' => $e->code_str === 'fcwm_scope_denied'
                    ? 'The processes scope must be enabled by a FirstClass administrator in the Settings page.'
                    : null,
            ]);
        }
    }
}