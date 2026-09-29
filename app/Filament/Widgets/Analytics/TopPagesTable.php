<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Analytics\Period;

class TopPagesTable extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public ?string $filter = '7days';

    public function table(Table $table): Table
    {
        return $table
            ->heading('الصفحات الأكثر زيارة')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان الصفحة')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('path')
                    ->label('المسار')
                    ->searchable()
                    ->limit(40)
                    ->copyable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('المشاهدات')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('views', 'desc');
    }

    public function getTableRecords(): \Illuminate\Support\Collection
    {
        try {
            if (! config('analytics.property_id')) {
                $settingPropertyId = \App\Models\AnalyticsSetting::first()?->ga_property_id;
                if ($settingPropertyId) {
                    config(['analytics.property_id' => $settingPropertyId]);
                } else {
                    return collect([]);
                }
            }

            $period = $this->getPeriod();
            $service = app(\App\Services\AnalyticsService::class);
            $pages = $service->getMostVisitedPages($period, 10);

            return collect($pages)->map(function ($page, $index) {
                return [
                    'id' => $index + 1,
                    'key' => (string) ($index + 1),
                    'rank' => $index + 1,
                    'title' => $page['pageTitle'] ?? 'بدون عنوان',
                    'path' => $page['fullPageUrl'] ?? $page['pagePath'] ?? '/',
                    'views' => $page['screenPageViews'] ?? 0,
                ];
            });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getTableRecordKey($record): string
    {
        return (string) ($record['key'] ?? $record['id'] ?? $record['rank'] ?? uniqid());
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
}
