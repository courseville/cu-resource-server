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

class SyncCheckins implements ShouldQueue
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
            // updated_since is not used yet.
            // For production synchronization, use updated_since instead of
            // since_id to avoid missing check-out updates for existing records.
            $checkins = $client->getCheckins();

            Log::info('FirstClass sync: checkins completed successfully', [
                'count' => count($checkins),
            ]);

            // TODO: Persist the retrieved data to the database.
            // Upsert records into the Checkin model using the source ID.
            // Also update firstclass_sync_state:
            // endpoint = 'checkins', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: checkins failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);
        }
    }
}