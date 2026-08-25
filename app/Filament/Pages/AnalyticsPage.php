<?php

namespace App\Filament\Pages;

use App\Models\AnalyticsSetting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class AnalyticsPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.pages.analytics-page';

    protected static ?string $navigationLabel = 'تحليلات Google & GTM';

    protected static ?string $title = 'لوحة تحليلات Google Analytics و Google Tag Manager';

    protected static string|\UnitEnum|null $navigationGroup = 'الإعدادات';

    protected static ?int $navigationSort = 3;

    protected ?string $pollingInterval = '30s';

    public function mount(): void
    {
        // Ensure property ID is set
        if (! config('analytics.property_id')) {
            $setting = AnalyticsSetting::first();
            if ($setting?->ga_property_id) {
                config(['analytics.property_id' => $setting->ga_property_id]);
            }
        }

        // Live real-time check and auto pre-warm on entry
        try {
            $service = app(\App\Services\AnalyticsService::class);
            $service->getRealtimeUsers();
        } catch (\Throwable $e) {
            // Silently ignore if API error on mount
        }
    }

    public function getViewData(): array
    {
        $setting = AnalyticsSetting::first();
        
        return [
            'setting' => $setting,
            'gaPropertyId' => config('analytics.property_id') ?: $setting?->ga_property_id,
            'gaMeasurementId' => $setting?->ga_measurement_id ?? 'G-JPMFLC695E',
            'gtmContainerId' => $setting?->gtm_container_id ?? 'GTM-T59355DS',
            'gtmEnabled' => $setting?->gtm_enabled ?? true,
            'gaEnabled' => $setting?->ga_enabled ?? true,
        ];
    }

    protected function getHeaderActions(): array
    {
        $setting = AnalyticsSetting::first();
        $gtmId = $setting?->gtm_container_id ?? 'GTM-T59355DS';

        return [
            Action::make('openGtm')
                ->label('فتح Google Tag Manager')
                ->icon(Heroicon::OutlinedTag)
                ->color('warning')
                ->url("https://tagmanager.google.com/#/container/accounts", shouldOpenInNewTab: true),

            Action::make('openGa')
                ->label('فتح Google Analytics')
                ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                ->color('info')
                ->url("https://analytics.google.com/analytics/web/", shouldOpenInNewTab: true),

            Action::make('checkConnection')
                ->label('فحص الاتصال')
                ->icon(Heroicon::OutlinedSignal)
                ->color('success')
                ->action(function () {
                    try {
                        if (! config('analytics.property_id')) {
                            $setting = AnalyticsSetting::first();
                            if ($setting?->ga_property_id) {
                                config(['analytics.property_id' => $setting->ga_property_id]);
                            }
                        }

                        $period = Period::days(1);
                        $result = Analytics::fetchTotalVisitorsAndPageViews($period);

                        Notification::make()
                            ->title('✅ الاتصال ناجح ومستقر!')
                            ->body('تم الاتصال بنجاح مع Google Analytics (GA4) وجلب البيانات الحية.')
                            ->success()
                            ->duration(5000)
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('❌ فشل الاتصال')
                            ->body('خطأ أثناء الاتصال: ' . $e->getMessage())
                            ->danger()
                            ->duration(10000)
                            ->send();
                    }
                }),

            Action::make('refresh')
                ->label('تحديث البيانات والكاش')
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('تحديث بيانات التحليلات')
                ->modalDescription('سيتم مسح الذاكرة المؤقتة وجلب أحدث البيانات الحية من Google Analytics.')
                ->modalSubmitActionLabel('تحديث فوري')
                ->action(function () {
                    try {
                        // Clear analytics cache tags/keys
                        Cache::flush();

                        // Fetch data
                        app(\App\Services\AnalyticsService::class)->getOverviewStats(Period::days(7));
                        app(\App\Services\AnalyticsService::class)->getVisitorsByDate(Period::days(7));

                        Notification::make()
                            ->title('✅ تم تحديث البيانات بنجاح')
                            ->body('تم جلب وتحديث كافة مقاييس التحليلات بنجاح.')
                            ->success()
                            ->duration(6000)
                            ->send();

                        redirect(request()->header('Referer') ?? request()->url());
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('❌ فشل التحديث')
                            ->body('خطأ: ' . $e->getMessage())
                            ->danger()
                            ->duration(8000)
                            ->send();
                    }
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\Analytics\OverviewStats::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Row 1: Core Charts
            \App\Filament\Widgets\Analytics\VisitorsTimeChart::class,
            \App\Filament\Widgets\Analytics\TrafficSourcesChart::class,
            \App\Filament\Widgets\Analytics\DevicesChart::class,

            // Row 2: User Types & OS
            \App\Filament\Widgets\Analytics\UserTypesChart::class,
            \App\Filament\Widgets\Analytics\OperatingSystemsChart::class,
            \App\Filament\Widgets\Analytics\TopProjectsChart::class,

            // Row 3: Geo & Tables
            \App\Filament\Widgets\Analytics\CitiesTable::class,
            \App\Filament\Widgets\Analytics\TopPagesTable::class,
            \App\Filament\Widgets\Analytics\BrowsersTable::class,
            \App\Filament\Widgets\Analytics\LocationsTable::class,
            \App\Filament\Widgets\Analytics\EventsTable::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    public function getFooterWidgetsColumns(): int|array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'xl' => 3,
        ];
    }
}


