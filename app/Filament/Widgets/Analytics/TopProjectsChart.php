<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class TopProjectsChart extends ChartWidget
{
    protected ?string $heading = 'المشاريع الأكثر مشاهدة';

    protected static ?int $sort = 9;

    protected int|string|array $columnSpan = 'full';

    public ?string $filter = '30days';

    protected function getData(): array
    {
        try {
            if (! config('analytics.property_id')) {
                return $this->getEmptyData();
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.top_projects.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.10";

            // Use cache-only access, fallback to empty array if cache miss
            $projects = Cache::get($cacheKey, []);

            if (empty($projects)) {
                return $this->getNoProjectsData();
            }

            $labels = [];
            $views = [];
            $colors = [
                'rgba(59, 130, 246, 0.8)',   // Blue
                'rgba(16, 185, 129, 0.8)',   // Green
                'rgba(249, 115, 22, 0.8)',   // Orange
                'rgba(168, 85, 247, 0.8)',   // Purple
                'rgba(236, 72, 153, 0.8)',   // Pink
                'rgba(234, 179, 8, 0.8)',    // Yellow
                'rgba(6, 182, 212, 0.8)',    // Cyan
                'rgba(239, 68, 68, 0.8)',    // Red
                'rgba(34, 197, 94, 0.8)',    // Emerald
                'rgba(147, 51, 234, 0.8)',   // Violet
            ];

            foreach ($projects as $project) {
                // Truncate long project names
                $name = $project['project_name'];
                if (mb_strlen($name) > 30) {
                    $name = mb_substr($name, 0, 27).'...';
                }
                $labels[] = $name;
                $views[] = $project['views'];
            }

            return [
                'datasets' => [
                    [
                        'label' => 'المشاهدات',
                        'data' => $views,
                        'backgroundColor' => array_slice($colors, 0, count($views)),
                        'borderColor' => array_map(function ($color) {
                            return str_replace('0.8', '1', $color);
                        }, array_slice($colors, 0, count($views))),
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => $labels,
            ];

        } catch (\Exception $e) {
            return $this->getErrorData($e->getMessage());
        }
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            '7days' => 'آخر 7 أيام',
            '30days' => 'آخر 30 يوم',
            '90days' => 'آخر 90 يوم',
        ];
    }

    protected function getPeriod(): Period
    {
        return match ($this->filter) {
            '7days' => Period::days(7),
            '30days' => Period::days(30),
            '90days' => Period::days(90),
            default => Period::days(30),
        };
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y', // Horizontal bar chart
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }

    protected function getEmptyData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'لا توجد بيانات',
                    'data' => [0],
                    'backgroundColor' => ['rgba(156, 163, 175, 0.5)'],
                ],
            ],
            'labels' => ['يرجى إضافة معرف الخاصية الرقمي (Property ID)'],
        ];
    }

    protected function getNoProjectsData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'لا توجد بيانات',
                    'data' => [0],
                    'backgroundColor' => ['rgba(156, 163, 175, 0.5)'],
                ],
            ],
            'labels' => ['لا توجد مشاهدات للمشاريع في هذه الفترة'],
        ];
    }

    protected function getErrorData(string $message): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'خطأ',
                    'data' => [0],
                    'backgroundColor' => ['rgba(239, 68, 68, 0.5)'],
                ],
            ],
            'labels' => ['خطأ في جلب البيانات'],
        ];
    }
}
