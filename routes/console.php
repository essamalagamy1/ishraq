<?php

use App\Jobs\FetchAnalyticsData;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Schedule analytics data fetch every 30 minutes
Schedule::job(new FetchAnalyticsData)
    ->everyThirtyMinutes()
    ->withoutOverlapping()
    ->name('fetch-analytics-data')
    ->onOneServer();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Manual command to fetch analytics data
Artisan::command('analytics:fetch', function () {
    $this->info('Fetching analytics data...');
    FetchAnalyticsData::dispatch();
    $this->info('Analytics data fetch job dispatched!');
})->purpose('Manually fetch analytics data');
