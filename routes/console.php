<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Jobs\FirstClass\SyncSummary;
use App\Jobs\FirstClass\SyncRooms;
use App\Jobs\FirstClass\SyncMachines;
use App\Jobs\FirstClass\SyncCheckins;
use App\Jobs\FirstClass\SyncClasses;
use App\Jobs\FirstClass\SyncBrowserLog;
use App\Jobs\FirstClass\SyncProcesses;

use App\Jobs\TestScheduleJob;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduled Jobs
|--------------------------------------------------------------------------
*/

// Schedule::job(new TestScheduleJob())
//     ->everyMinute()
//     ->timezone('Asia/Bangkok')
//     ->name('test-schedule-job')
//     ->withoutOverlapping();

Schedule::job(new SyncSummary())
    ->everyTwoMinutes()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-summary')
    ->withoutOverlapping();

Schedule::job(new SyncRooms())
    ->daily()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-rooms')
    ->withoutOverlapping();

Schedule::job(new SyncMachines())
    ->everyThirtyMinutes()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-machines')
    ->withoutOverlapping();

Schedule::job(new SyncCheckins())
    ->everyTenMinutes()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-checkins')
    ->withoutOverlapping();

Schedule::job(new SyncClasses())
    ->dailyAt('01:00')
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-classes')
    ->withoutOverlapping();

Schedule::job(new SyncBrowserLog())
    ->everyThirtyMinutes()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-browser-log')
    ->withoutOverlapping();

Schedule::job(new SyncProcesses())
    ->everyThirtyMinutes()
    ->timezone('Asia/Bangkok')
    ->name('firstclass-sync-processes')
    ->withoutOverlapping();