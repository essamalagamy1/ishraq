<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\ChartWidget;
use Spatie\Analytics\Period;

class OperatingSystemsChart extends ChartWidget
{
    protected ?string $heading = 'أنظمة التشغيل (OS)';

    protected static ?int $sort = 7;

    public ?string $filter = '30days';

    protected function getData(): array
    {
        try {
            if (! config('analytics.property_id')) {
                $settingPropertyId = \App\Models\AnalyticsSetting::first()?->ga_property_id;
                if ($settingPropertyId) {
                    config(['analytics.property_id' => $settingPropertyId]);
                } else {
                    return $this->getEmptyData();
                }
            }

            $period = $this->getPeriod();
            $service = app(\App\Services\AnalyticsService::class);
            $osList = $service->getOperatingSystems($period);

            if (empty($osList)) {
                return $this->getEmptyData();
            }

            $labels = [];
            $data = [];
            $colors = [
                'iOS' => 'rgb(14, 165, 233)',
                'Android' => 'rgb(34, 197, 94)',
                'Windows' => 'rgb(59, 130, 246)',
                'Macintosh' => 'rgb(168, 85, 247)',
                'Linux' => 'rgb(249, 115, 22)',
            ];

            $bgColors = [];

            foreach ($osList as $item) {
                $osName = $item['operatingSystem'] ?? 'أخرى';
                $views = (int) ($item['screenPageViews'] ?? 0);
                $labels[] = $osName;
                $data[] = $views;
                $bgColors[] = $colors[$osName] ?? 'rgb(156, 163, 175)';
            }

            return [
                'datasets' => [
                    [
                        'label' => 'المشاهدات',
                        'data' => $data,
                        'backgroundColor' => $bgColors,
                    ],
                ],
                'labels' => $labels,
            ];

        } catch (\Exception $e) {
            return $this->getEmptyData();
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
            '365days' => 'آخر سنة',
        ];
    }

    protected function getPeriod(): Period
    {
        return match ($this->filter) {
            '7days' => Period::days(7),
            '30days' => Period::days(30),
            '90days' => Period::days(90),
            '365days' => Period::days(365),
            default => Period::days(30),
        };
    }

    protected function getEmptyData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'لا توجد بيانات',
                    'data' => [0],
                    'backgroundColor' => ['rgb(156, 163, 175)'],
                ],
            ],
            'labels' => ['لا توجد بيانات كافية'],
        ];
    }
}
