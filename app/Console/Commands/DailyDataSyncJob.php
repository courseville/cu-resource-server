<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class DailyDataSyncJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:data-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run data sync scheduled job at 1 AM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Daily job ran at 1 AM');
        return 0;
    }
}
