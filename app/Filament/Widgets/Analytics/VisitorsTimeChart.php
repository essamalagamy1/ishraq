<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class VisitorsTimeChart extends ChartWidget
{
    protected ?string $heading = 'الزوار ومشاهدات الصفحات';

    protected static ?int $sort = 2;

    public ?string $filter = '7days';

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
            $data = $service->getVisitorsByDate($period);

            $labels = [];
            $visitors = [];
            $pageViews = [];

            foreach ($data as $item) {
                $labels[] = isset($item['date']) ? date('d/m', strtotime($item['date'])) : '';
                $visitors[] = $item['activeUsers'] ?? 0;
                $pageViews[] = $item['screenPageViews'] ?? 0;
            }

            return [
                'datasets' => [
                    [
                        'label' => 'الزوار',
                        'data' => $visitors,
                        'borderColor' => 'rgb(59, 130, 246)',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'fill' => true,
                    ],
                    [
                        'label' => 'مشاهدات الصفحات',
                        'data' => $pageViews,
                        'borderColor' => 'rgb(16, 185, 129)',
                        'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                        'fill' => true,
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
        return 'line';
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

    protected function getEmptyData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'لا توجد بيانات',
                    'data' => [0],
                ],
            ],
            'labels' => ['يرجى إضافة معرف الخاصية الرقمي (Property ID)'],
        ];
    }

    protected function getErrorData(string $message): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'خطأ: '.$message,
                    'data' => [0],
                ],
            ],
            'labels' => ['تحقق من إعدادات Google Analytics'],
        ];
    }
}
