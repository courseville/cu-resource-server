<?php

namespace App\Sync\FirstClass;

use App\Services\FirstClass\FirstClassClient;
use App\Services\FirstClass\FirstClassClientException;
use Illuminate\Support\Facades\Log;

class RoomsSynchronizer
{
    public function sync(): void
    {
        $client = new FirstClassClient(
            baseUrl: config('firstclass.base_url'),
            apiKey: config('firstclass.api_key'),
            timeout: config('firstclass.timeout'),
        );

        try {
            $rooms = $client->getRooms();

            Log::info('FirstClass rooms synced successfully.', [
                'rooms' => $rooms,
            ]);

            // TODO:
            // Persist rooms data.
            // Update the last sync timestamp.

        } catch (FirstClassClientException $e) {
            Log::error('Failed to sync FirstClass rooms.', [
                'code' => $e->code_str,
                'http_status' => $e->httpStatus,
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}