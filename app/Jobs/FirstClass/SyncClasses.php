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

class SyncClasses implements ShouldQueue
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
            // from and to are not used yet.
            // For production synchronization, specify the from and to
            // parameters to retrieve only the required date range.
            // Without them, the API will use its default behavior.
            $classes = $client->getClasses();

            Log::info('FirstClass sync: classes completed successfully', [
                'count' => count($classes),
            ]);

            // TODO: Persist the retrieved data to the database.
            // Upsert records into the ClassSession model using the source ID.
            // Also update firstclass_sync_state:
            // endpoint = 'classes', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: classes failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);
        }
    }
}