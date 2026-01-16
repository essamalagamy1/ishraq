<?php

namespace App\Jobs;

use App\Services\AnalyticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Spatie\Analytics\Period;

class FetchAnalyticsData implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(AnalyticsService $service): void
    {
        try {
            Log::info('FetchAnalyticsData: Starting analytics data fetch');

            // Define periods for different widgets
            $periods = [
                7 => Period::days(7),
                30 => Period::days(30),
                90 => Period::days(90),
            ];

            // Fetch data for each period
            foreach ($periods as $days => $period) {
                Log::info("FetchAnalyticsData: Fetching data for {$days} days");

                $service->getOverviewStats($period);
                $service->getVisitorsByDate($period);
                $service->getTrafficSources($period);
                $service->getDeviceCategories($period);
                $service->getBrowsers($period);
                $service->getCountries($period);
                $service->getCities($period);
                $service->getEvents($period);
                $service->getTopProjects($period);
                $service->getMostVisitedPages($period);
                $service->getTopReferrers($period);
            }

            Log::info('FetchAnalyticsData: Successfully fetched all analytics data');
        } catch (\Exception $e) {
            Log::error('FetchAnalyticsData: Error fetching analytics data', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
