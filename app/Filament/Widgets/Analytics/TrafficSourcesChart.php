<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class TrafficSourcesChart extends ChartWidget
{
    protected ?string $heading = 'مصادر الزيارات';

    protected static ?int $sort = 4;

    public ?string $filter = '7days';

    protected function getData(): array
    {
        try {
            if (! config('analytics.property_id')) {
                return $this->getEmptyData();
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.traffic_sources.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

            // Use cache-only access, fallback to empty array if cache miss
            $sources = Cache::get($cacheKey, []);

            $labels = [];
            $data = [];
            $colors = [
                'Organic Search' => 'rgb(34, 197, 94)',
                'Direct' => 'rgb(59, 130, 246)',
                'Social' => 'rgb(168, 85, 247)',
                'Referral' => 'rgb(249, 115, 22)',
                'Email' => 'rgb(236, 72, 153)',
                'Paid Search' => 'rgb(234, 179, 8)',
            ];

            $backgroundColors = [];

            foreach ($sources as $source) {
                $sourceName = $this->translateSource($source['source']);
                $labels[] = $sourceName;
                $data[] = $source['users'];
                $backgroundColors[] = $colors[$source['source']] ?? 'rgb(156, 163, 175)';
            }

            return [
                'datasets' => [
                    [
                        'label' => 'الزوار',
                        'data' => $data,
                        'backgroundColor' => $backgroundColors,
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
        return 'doughnut';
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
            default => Period::days(7),
        };
    }

    protected function translateSource(string $source): string
    {
        return match ($source) {
            'Organic Search' => 'بحث عضوي',
            'Direct' => 'مباشر',
            'Social' => 'وسائل التواصل',
            'Referral' => 'إحالة',
            'Email' => 'بريد إلكتروني',
            'Paid Search' => 'بحث مدفوع',
            'Display' => 'إعلانات',
            default => $source,
        };
    }

    protected function getEmptyData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'لا توجد بيانات',
                    'data' => [1],
                    'backgroundColor' => ['rgb(156, 163, 175)'],
                ],
            ],
            'labels' => ['لا توجد بيانات'],
        ];
    }

    protected function getErrorData(string $message): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'خطأ',
                    'data' => [1],
                    'backgroundColor' => ['rgb(239, 68, 68)'],
                ],
            ],
            'labels' => ['خطأ في جلب البيانات'],
        ];
    }
}
