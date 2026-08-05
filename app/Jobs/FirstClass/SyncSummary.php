<?php

namespace App\Jobs\FirstClass;

use App\Sync\FirstClass\SummarySynchronizer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncSummary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        try {
            app(SummarySynchronizer::class)->sync();
        } catch (\Throwable $e) {
            Log::error('FirstClass sync: summary failed', [
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}