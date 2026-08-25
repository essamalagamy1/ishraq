<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AnalyticsService
{
    protected int $cacheMinutes = 120; // Cache for 2 hours

    protected int $timeout = 10; // Timeout in seconds for API calls

    /**
     * Get overview statistics
     */
    public function getOverviewStats(Period $period): array
    {
        $cacheKey = "analytics.overview.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                try {
                    if (app()->environment('local')) {
                        Log::info('Fetching analytics overview stats', [
                            'start_date' => $period->startDate->format('Y-m-d'),
                            'end_date' => $period->endDate->format('Y-m-d'),
                            'property_id' => config('analytics.property_id'),
                        ]);
                    }

                    // Use the simple methods that work with GA4
                    $visitorsData = Analytics::fetchTotalVisitorsAndPageViews($period);

                    if (app()->environment('local')) {
                        Log::info('Analytics data received', [
                            'count' => $visitorsData->count(),
                            'data' => $visitorsData->toArray(),
                        ]);
                    }

                    // GA4 uses activeUsers and screenPageViews
                    $totalVisitors = $visitorsData->sum('activeUsers');
                    $totalPageViews = $visitorsData->sum('screenPageViews');

                    // Calculate average pages per session
                    $avgPagesPerSession = $totalVisitors > 0 ? round($totalPageViews / $totalVisitors, 2) : 0;

                    if (app()->environment('local')) {
                        Log::info('Analytics stats calculated', [
                            'total_visitors' => $totalVisitors,
                            'total_page_views' => $totalPageViews,
                            'avg_pages_per_session' => $avgPagesPerSession,
                        ]);
                    }

                    return [
                        'total_users' => $totalVisitors,
                        'total_page_views' => $totalPageViews,
                        'total_sessions' => $totalVisitors, // GA4 uses activeUsers instead of sessions
                        'bounce_rate' => 0, // Not easily available in GA4
                        'avg_session_duration' => 0, // Not easily available in GA4
                        'pages_per_session' => $avgPagesPerSession,
                    ];
                } catch (\Exception $e) {
                    Log::error('Analytics getOverviewStats error', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);

                    return $this->getEmptyOverviewStats();
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', [
                'cache_key' => $cacheKey,
                'message' => $e->getMessage(),
            ]);

            return $this->getEmptyOverviewStats();
        }
    }

    /**
     * Get visitors and page views by date
     */
    public function getVisitorsByDate(Period $period): array
    {
        $cacheKey = "analytics.visitors_by_date.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                try {
                    return Analytics::fetchVisitorsAndPageViewsByDate($period)->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getVisitorsByDate error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get most visited pages
     */
    public function getMostVisitedPages(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.most_visited_pages.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    return Analytics::fetchMostVisitedPages($period, $maxResults)->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getMostVisitedPages error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get top referrers
     */
    public function getTopReferrers(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.top_referrers.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    return Analytics::fetchTopReferrers($period, $maxResults)->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getTopReferrers error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get traffic sources
     */
    public function getTrafficSources(Period $period): array
    {
        $cacheKey = "analytics.traffic_sources.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                try {
                    $result = Analytics::get(
                        $period,
                        ['activeUsers'],
                        ['sessionDefaultChannelGroup']
                    );

                    return $result->map(function ($item) {
                        return [
                            'source' => $item['sessionDefaultChannelGroup'] ?? 'Unknown',
                            'users' => $item['activeUsers'] ?? 0,
                        ];
                    })->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getTrafficSources error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get device categories
     */
    public function getDeviceCategories(Period $period): array
    {
        $cacheKey = "analytics.device_categories.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                try {
                    set_time_limit($this->timeout);
                    $result = Analytics::get(
                        $period,
                        ['activeUsers'],
                        ['deviceCategory']
                    );

                    return $result->map(function ($item) {
                        return [
                            'device' => $item['deviceCategory'] ?? 'Unknown',
                            'users' => $item['activeUsers'] ?? 0,
                        ];
                    })->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getDeviceCategories error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get browsers
     */
    public function getBrowsers(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.browsers.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    set_time_limit($this->timeout);
                    $result = Analytics::get(
                        $period,
                        ['activeUsers'],
                        ['browser']
                    );

                    return $result->sortByDesc('activeUsers')
                        ->take($maxResults)
                        ->map(function ($item) {
                            return [
                                'browser' => $item['browser'] ?? 'Unknown',
                                'users' => $item['activeUsers'] ?? 0,
                            ];
                        })->values()->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getBrowsers error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get countries
     */
    public function getCountries(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.countries.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    set_time_limit($this->timeout);
                    $result = Analytics::get(
                        $period,
                        ['activeUsers'],
                        ['country']
                    );

                    return $result->sortByDesc('activeUsers')
                        ->take($maxResults)
                        ->map(function ($item) {
                            return [
                                'country' => $item['country'] ?? 'Unknown',
                                'users' => $item['activeUsers'] ?? 0,
                            ];
                        })->values()->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getCountries error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get cities
     */
    public function getCities(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.cities.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    set_time_limit($this->timeout);
                    $result = Analytics::get(
                        $period,
                        ['activeUsers'],
                        ['city']
                    );

                    return $result->sortByDesc('activeUsers')
                        ->take($maxResults)
                        ->map(function ($item) {
                            return [
                                'city' => $item['city'] ?? 'Unknown',
                                'users' => $item['activeUsers'] ?? 0,
                            ];
                        })->values()->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getCities error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get events
     */
    public function getEvents(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.events.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    set_time_limit($this->timeout);
                    $result = Analytics::get(
                        $period,
                        ['eventCount'],
                        ['eventName']
                    );

                    return $result->sortByDesc('eventCount')
                        ->take($maxResults)
                        ->map(function ($item) {
                            return [
                                'event_name' => $item['eventName'] ?? 'Unknown',
                                'count' => $item['eventCount'] ?? 0,
                            ];
                        })->values()->toArray();
                } catch (\Exception $e) {
                    Log::error('Analytics getEvents error', ['message' => $e->getMessage()]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Get top viewed projects
     */
    public function getTopProjects(Period $period, int $maxResults = 10): array
    {
        $cacheKey = "analytics.top_projects.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$maxResults}";

        try {
            return Cache::remember($cacheKey, 60 * 15, function () use ($period, $maxResults) {
                try {
                    $pages = Analytics::fetchMostVisitedPages($period, 100);
                    $allProjects = Project::where('status', 'published')->get();
                    $projectData = [];

                    foreach ($allProjects as $project) {
                        $views = 0;

                        foreach ($pages as $page) {
                            $url = $page['fullPageUrl'] ?? '';
                            $title = $page['pageTitle'] ?? '';
                            if (str_contains($url, $project->slug) || str_contains($url, '/projects/') || str_contains($title, $project->title)) {
                                if (str_contains($url, $project->slug) || str_contains($title, $project->title)) {
                                    $views += (int) ($page['screenPageViews'] ?? 0);
                                }
                            }
                        }

                        $projectData[] = [
                            'project_id' => $project->id,
                            'project_name' => $project->title,
                            'project_slug' => $project->slug,
                            'views' => $views,
                        ];
                    }

                    usort($projectData, function ($a, $b) {
                        return $b['views'] <=> $a['views'];
                    });

                    return array_slice($projectData, 0, $maxResults);
                } catch (\Exception $e) {
                    Log::error('TopProjects: Error', [
                        'message' => $e->getMessage(),
                    ]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get real-time active users right now (last 30 minutes)
     */
    public function getRealtimeUsers(): int
    {
        try {
            $propertyId = config('analytics.property_id') ?: \App\Models\AnalyticsSetting::first()?->ga_property_id;
            if (! $propertyId) {
                return 0;
            }

            return Cache::remember('analytics.realtime_users', 10, function () use ($propertyId) {
                try {
                    $analyticsRoot = Analytics::getFacadeRoot();
                    $clientProperty = (new \ReflectionClass($analyticsRoot))->getProperty('client');
                    $clientProperty->setAccessible(true);
                    $client = $clientProperty->getValue($analyticsRoot);

                    $minuteRange = new \Google\Analytics\Data\V1beta\MinuteRange([
                        'start_minutes_ago' => 29,
                        'end_minutes_ago' => 0,
                    ]);

                    $metric = new \Google\Analytics\Data\V1beta\Metric(['name' => 'activeUsers']);

                    $response = $client->runRealtimeReport([
                        'property' => "properties/{$propertyId}",
                        'minute_ranges' => [$minuteRange],
                        'metrics' => [$metric],
                    ]);

                    $total = 0;
                    foreach ($response->getRows() as $row) {
                        $total += (int) $row->getMetricValues()[0]->getValue();
                    }

                    return $total;
                } catch (\Throwable $e) {
                    Log::warning('Analytics getRealtimeUsers runRealtimeReport: ' . $e->getMessage());
                    return 0;
                }
            });
        } catch (\Throwable $e) {
            Log::warning('Analytics getRealtimeUsers: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get user types (New vs Returning visitors)
     */
    public function getUserTypes(Period $period): array
    {
        $cacheKey = "analytics.user_types.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                $data = Analytics::fetchUserTypes($period);
                $result = ['new' => 0, 'returning' => 0];
                foreach ($data as $row) {
                    $type = strtolower($row['newVsReturning'] ?? '');
                    if ($type === 'new') {
                        $result['new'] += (int) ($row['activeUsers'] ?? 0);
                    } elseif ($type === 'returning') {
                        $result['returning'] += (int) ($row['activeUsers'] ?? 0);
                    }
                }
                return $result;
            });
        } catch (\Throwable $e) {
            return ['new' => 0, 'returning' => 0];
        }
    }

    /**
     * Get engagement metrics (average duration and engagement rate)
     */
    public function getEngagementMetrics(Period $period): array
    {
        $cacheKey = "analytics.engagement.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                $data = Analytics::get($period, ['averageSessionDuration', 'engagementRate', 'screenPageViewsPerSession'], [], 1);
                if ($data instanceof \Illuminate\Support\Collection && $data->isNotEmpty()) {
                    $first = $data->first();
                    return [
                        'avg_duration' => (float) ($first['averageSessionDuration'] ?? 0),
                        'engagement_rate' => (float) ($first['engagementRate'] ?? 0) * 100,
                        'views_per_session' => (float) ($first['screenPageViewsPerSession'] ?? 0),
                    ];
                }
                return ['avg_duration' => 0, 'engagement_rate' => 0, 'views_per_session' => 0];
            });
        } catch (\Throwable $e) {
            return ['avg_duration' => 0, 'engagement_rate' => 0, 'views_per_session' => 0];
        }
    }

    /**
     * Get operating systems distribution
     */
    public function getOperatingSystems(Period $period): array
    {
        $cacheKey = "analytics.os.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period) {
                return Analytics::fetchTopOperatingSystems($period)->toArray();
            });
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Get cities with country breakdown
     */
    public function getCitiesWithCountry(Period $period, int $max = 10): array
    {
        $cacheKey = "analytics.cities_detailed.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.{$max}";

        try {
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $max) {
                $data = Analytics::get($period, ['activeUsers', 'screenPageViews'], ['country', 'city'], $max);
                return $data->toArray();
            });
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Get empty overview stats (fallback)
     */
    protected function getEmptyOverviewStats(): array
    {
        return [
            'total_users' => 0,
            'total_page_views' => 0,
            'total_sessions' => 0,
            'bounce_rate' => 0,
            'avg_session_duration' => 0,
            'pages_per_session' => 0,
        ];
    }

    /**
     * Clear all analytics cache
     */
    public function clearCache(): void
    {
        Cache::flush();
    }
}
