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

class SyncRooms implements ShouldQueue
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
            // Retrieve only active rooms.
            $rooms = $client->getRooms(activeOnly: true);

            Log::info('FirstClass sync: rooms completed successfully', [
                'count' => count($rooms),
            ]);

            // TODO: Persist the retrieved data to the database.
            // Upsert records into the Room model using the source ID.
            // Also update firstclass_sync_state:
            // endpoint = 'rooms', last_synced_at = now()
        } catch (FirstClassClientException $e) {
            Log::error('FirstClass sync: rooms failed', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);
        }
    }
}