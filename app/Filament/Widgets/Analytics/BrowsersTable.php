<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class BrowsersTable extends BaseWidget
{
    protected static ?int $sort = 6;

    public ?string $filter = '7days';

    public function table(Table $table): Table
    {
        return $table
            ->heading('المتصفحات المستخدمة')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#'),
                Tables\Columns\TextColumn::make('browser')
                    ->label('المتصفح')
                    ->searchable(),
                Tables\Columns\TextColumn::make('users')
                    ->label('الزوار')
                    ->numeric(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('النسبة')
                    ->suffix('%')
                    ->color(fn ($state) => $state > 30 ? 'success' : ($state > 10 ? 'warning' : 'gray')),
            ]);
    }

    public function getTableRecords(): \Illuminate\Support\Collection
    {
        try {
            if (! config('analytics.property_id')) {
                return collect([]);
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.browsers.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.10";

            // Use cache-only access, fallback to empty array if cache miss
            $browsers = Cache::get($cacheKey, []);

            $totalUsers = array_sum(array_column($browsers, 'users'));

            return collect($browsers)->map(function ($browser, $index) use ($totalUsers) {
                $percentage = $totalUsers > 0 ? ($browser['users'] / $totalUsers) * 100 : 0;

                return [
                    'rank' => $index + 1,
                    'browser' => $browser['browser'],
                    'users' => $browser['users'],
                    'percentage' => round($percentage, 2),
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
