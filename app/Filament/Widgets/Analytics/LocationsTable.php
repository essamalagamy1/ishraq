<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class LocationsTable extends BaseWidget
{
    protected static ?int $sort = 7;

    public ?string $filter = '7days';

    public function table(Table $table): Table
    {
        return $table
            ->heading('الدول الأكثر زيارة')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country')
                    ->label('الدولة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('users')
                    ->label('الزوار')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('users', 'desc');
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
            $countries = $service->getCountries($period, 10);

            return collect($countries)->map(function ($country, $index) {
                return [
                    'id' => $index + 1,
                    'key' => (string) ($index + 1),
                    'rank' => $index + 1,
                    'country' => $country['country'],
                    'users' => $country['users'],
                ];
            });
        } catch (\Exception $e) {
            return collect([]);
        }
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

    public function getTableRecordKey($record): string
    {
        return (string) $record['rank'];
    }
}
