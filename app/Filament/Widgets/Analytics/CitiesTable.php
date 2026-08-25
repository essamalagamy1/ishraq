<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Spatie\Analytics\Period;

class CitiesTable extends BaseWidget
{
    protected static ?int $sort = 8;

    public ?string $filter = '30days';

    public function table(Table $table): Table
    {
        return $table
            ->heading('المدن والدول الأكثر زيارة')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#'),
                Tables\Columns\TextColumn::make('city')
                    ->label('المدينة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('الدولة')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('users')
                    ->label('الزوار')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('المشاهدات')
                    ->numeric()
                    ->sortable(),
            ]);
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
            $cities = $service->getCitiesWithCountry($period, 12);

            return collect($cities)->map(function ($item, $index) {
                return [
                    'id' => $index + 1,
                    'key' => (string) ($index + 1),
                    'rank' => $index + 1,
                    'city' => ($item['city'] ?? '') === '(not set)' ? 'غير محدد' : ($item['city'] ?? 'غير محدد'),
                    'country' => $item['country'] ?? 'غير محدد',
                    'users' => (int) ($item['activeUsers'] ?? 0),
                    'views' => (int) ($item['screenPageViews'] ?? 0),
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
}
