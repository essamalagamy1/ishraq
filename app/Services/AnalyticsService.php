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
            return Cache::remember($cacheKey, $this->cacheMinutes * 60, function () use ($period, $maxResults) {
                try {
                    // Get all pages (reduced from 100 to 30 for performance)
                    $pages = Analytics::fetchMostVisitedPages($period, 30);

                    if (app()->environment('local')) {
                        Log::info('TopProjects: Fetched pages', [
                            'total_pages' => $pages->count(),
                            'sample_data' => $pages->take(3)->toArray(),
                        ]);
                    }

                    // Filter only project pages (URLs that contain /projects/)
                    $projectPages = $pages->filter(function ($page) {
                        $url = $page['fullPageUrl'] ?? '';

                        // Match various patterns: /projects/, domain.com/projects/
                        return str_contains($url, '/projects/');
                    });

                    if (app()->environment('local')) {
                        Log::info('TopProjects: Filtered project pages', [
                            'project_pages_count' => $projectPages->count(),
                            'project_urls' => $projectPages->pluck('fullPageUrl')->toArray(),
                        ]);
                    }

                    // Extract project slugs and get project details
                    $projectData = [];
                    foreach ($projectPages as $page) {
                        $url = $page['fullPageUrl'] ?? '';

                        // Extract slug from various URL patterns
                        // Patterns: domain.com/projects/slug, domain.com/ar/projects/slug, etc.
                        preg_match('/\/projects\/([^\/? ]+)/', $url, $matches);

                        if (! empty($matches[1])) {
                            $slug = $matches[1];

                            if (app()->environment('local')) {
                                Log::info('TopProjects: Extracted slug', [
                                    'url' => $url,
                                    'slug' => $slug,
                                ]);
                            }

                            // Try to find the project
                            $project = Project::where('slug', $slug)->first();

                            if ($project) {
                                // Check if this project is already in the array
                                $existingIndex = array_search($project->id, array_column($projectData, 'project_id'));

                                if ($existingIndex !== false) {
                                    // Add views to existing project
                                    $projectData[$existingIndex]['views'] += $page['screenPageViews'] ?? 0;
                                } else {
                                    // Add new project
                                    $projectData[] = [
                                        'project_id' => $project->id,
                                        'project_name' => $project->title,
                                        'project_slug' => $project->slug,
                                        'views' => $page['screenPageViews'] ?? 0,
                                    ];
                                }

                                if (app()->environment('local')) {
                                    Log::info('TopProjects: Found project', [
                                        'project_id' => $project->id,
                                        'project_title' => $project->title,
                                        'views' => $page['screenPageViews'] ?? 0,
                                    ]);
                                }
                            } else {
                                Log::warning('TopProjects: Project not found in database', [
                                    'slug' => $slug,
                                    'url' => $url,
                                ]);
                            }
                        } else {
                            Log::warning('TopProjects: Could not extract slug from URL', [
                                'url' => $url,
                            ]);
                        }
                    }

                    if (app()->environment('local')) {
                        Log::info('TopProjects: Final project data', [
                            'count' => count($projectData),
                            'projects' => $projectData,
                        ]);
                    }

                    // Sort by views and take top results
                    usort($projectData, function ($a, $b) {
                        return $b['views'] - $a['views'];
                    });

                    return array_slice($projectData, 0, $maxResults);
                } catch (\Exception $e) {
                    Log::error('TopProjects: Error', [
                        'message' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);

                    return [];
                }
            });
        } catch (\Exception $e) {
            Log::error('Analytics cache error', ['cache_key' => $cacheKey, 'message' => $e->getMessage()]);

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
