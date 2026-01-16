<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class DevicesChart extends ChartWidget
{
    protected ?string $heading = 'الأجهزة المستخدمة';

    protected static ?int $sort = 5;

    public ?string $filter = '7days';

    protected function getData(): array
    {
        try {
            if (! config('analytics.property_id')) {
                return $this->getEmptyData();
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.device_categories.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}";

            // Use cache-only access, fallback to empty array if cache miss
            $devices = Cache::get($cacheKey, []);

            $labels = [];
            $data = [];
            $colors = [
                'desktop' => 'rgb(59, 130, 246)',
                'mobile' => 'rgb(16, 185, 129)',
                'tablet' => 'rgb(249, 115, 22)',
            ];

            $backgroundColors = [];

            foreach ($devices as $device) {
                $deviceName = $this->translateDevice($device['device']);
                $labels[] = $deviceName;
                $data[] = $device['users'];
                $backgroundColors[] = $colors[strtolower($device['device'])] ?? 'rgb(156, 163, 175)';
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
        return 'pie';
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

    protected function translateDevice(string $device): string
    {
        return match (strtolower($device)) {
            'desktop' => 'كمبيوتر',
            'mobile' => 'جوال',
            'tablet' => 'تابلت',
            default => $device,
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
