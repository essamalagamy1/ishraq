<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class OverviewStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '15s';

    public ?string $filter = '7days';

    protected function getStats(): array
    {
        try {
            if (! config('analytics.property_id')) {
                $settingPropertyId = \App\Models\AnalyticsSetting::first()?->ga_property_id;
                if ($settingPropertyId) {
                    config(['analytics.property_id' => $settingPropertyId]);
                } else {
                    return $this->getWarningStats();
                }
            }

            $period = $this->getPeriod();
            $service = app(\App\Services\AnalyticsService::class);
            
            // Get stats, realtime users, and engagement
            $stats = $service->getOverviewStats($period);
            $realtimeUsers = $service->getRealtimeUsers();
            $engagement = $service->getEngagementMetrics($period);

            // Format duration
            $avgDurationSeconds = (int) ($engagement['avg_duration'] ?? 0);
            $durationFormatted = $avgDurationSeconds >= 60 
                ? floor($avgDurationSeconds / 60) . 'د ' . ($avgDurationSeconds % 60) . 'ث'
                : $avgDurationSeconds . ' ثانية';

            $engagementRate = round($engagement['engagement_rate'] ?? 0, 1);

            return [
                Stat::make('المستخدمون النشطون الآن', $realtimeUsers)
                    ->description('تحديث حي مباشر (آخر 30 دقيقة)')
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedSignal)
                    ->color($realtimeUsers > 0 ? 'success' : 'gray')
                    ->extraAttributes([
                        'class' => 'cursor-pointer ring-1 ring-emerald-500/20',
                    ]),

                Stat::make('إجمالي الزوار', number_format($stats['total_users'] ?? 0))
                    ->description($this->getPeriodDescription())
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedUsers)
                    ->color('primary')
                    ->chart($this->generateTrendChart($stats['total_users'] ?? 0)),

                Stat::make('مشاهدات الصفحات', number_format($stats['total_page_views'] ?? 0))
                    ->description($this->getPeriodDescription())
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedEye)
                    ->color('info')
                    ->chart($this->generateTrendChart($stats['total_page_views'] ?? 0)),

                Stat::make('متوسط مدة الجلسة', $durationFormatted)
                    ->description('تفاعل الزائر داخل الموقع')
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedClock)
                    ->color('warning'),

                Stat::make('معدل التفاعل', $engagementRate . '%')
                    ->description('نسبة الجلسات ذات التفاعل')
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedBolt)
                    ->color($engagementRate > 50 ? 'success' : 'warning'),

                Stat::make('الصفحات لكل جلسة', round($stats['pages_per_session'] ?? 0, 1))
                    ->description($this->getPeriodDescription())
                    ->descriptionIcon(\Filament\Support\Icons\Heroicon::OutlinedDocumentText)
                    ->color('secondary'),
            ];

        } catch (\Exception $e) {
            Log::error('OverviewStats widget error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return [
                Stat::make('خطأ', 'تعذر جلب البيانات')
                    ->description('الخطأ: '.$e->getMessage())
                    ->descriptionIcon('heroicon-o-exclamation-circle')
                    ->color('danger'),
            ];
        }
    }

    protected function getFilters(): ?array
    {
        return [
            '1day' => 'اليوم',
            '7days' => 'آخر 7 أيام',
            '30days' => 'آخر 30 يوم',
            '90days' => 'آخر 90 يوم',
            '365days' => 'آخر سنة',
        ];
    }

    protected function getPeriod(): Period
    {
        return match ($this->filter) {
            '1day' => Period::days(1),
            '7days' => Period::days(7),
            '30days' => Period::days(30),
            '90days' => Period::days(90),
            '365days' => Period::days(365),
            default => Period::days(7),
        };
    }

    protected function getPeriodDescription(): string
    {
        return match ($this->filter) {
            '1day' => 'اليوم',
            '7days' => 'آخر 7 أيام',
            '30days' => 'آخر 30 يوم',
            '90days' => 'آخر 90 يوم',
            '365days' => 'آخر سنة',
            default => 'آخر 7 أيام',
        };
    }

    protected function formatDuration(float $seconds): string
    {
        $minutes = floor($seconds / 60);
        $secs = $seconds % 60;

        if ($minutes > 0) {
            return sprintf('%d د %d ث', $minutes, $secs);
        }

        return sprintf('%d ث', $secs);
    }

    protected function generateTrendChart(int $value): array
    {
        // Generate a simple upward trend for visualization
        $base = max(1, $value * 0.7);

        return [
            $base,
            $base * 1.1,
            $base * 1.05,
            $base * 1.15,
            $base * 1.2,
            $base * 1.18,
            $value,
        ];
    }

    protected function getWarningStats(): array
    {
        return [
            Stat::make('تنبيه', 'يرجى إضافة معرف الخاصية الرقمي')
                ->description('احصل عليه من: Google Analytics > الإدارة > إعدادات الخاصية > Property ID')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning'),
        ];
    }
}
