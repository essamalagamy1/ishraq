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
                return collect([]);
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.countries.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.10";

            // Use cache-only access, fallback to empty array if cache miss
            $countries = Cache::get($cacheKey, []);

            return collect($countries)->map(function ($country, $index) {
                return [
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
