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
 * SyncBrowserLog
 *
 * Note: The /browser-log endpoint contains sensitive data and is disabled by
 * default on the FirstClass server. An administrator must enable the
 * browser-log scope in FirstClass Settings before it can be accessed.
 *
 * If the scope is not enabled, the API may return the error code
 * 'fcwm_scope_denied' (HTTP 403). This is expected behavior, not a bug.
 */
class SyncBrowserLog implements ShouldQueue
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
            // Do not provide from, to, or since_id.
            // FirstClass defaults to retrieving data from the last 7 days,
            // preventing accidental retrieval of the entire dataset.
            $browserLogs = $client->getBrowserLog();

            Log::info('FirstClass sync: browser-log completed successfully', [
                'count' => count($browserLogs),
            ]);

            // TODO: Persist the retrieved data to the database.
            // This requires a new migration and model for browser log records.
            // Also update firstclass_sync_state:
            // endpoint = 'browser-log', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: browser-log failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
                'note' => $e->code_str === 'fcwm_scope_denied'
                    ? 'The browser-log scope must be enabled by a FirstClass administrator in the Settings page.'
                    : null,
            ]);
        }
    }
}