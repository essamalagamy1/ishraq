<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Cache;
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
                return collect([]);
            }

            $period = $this->getPeriod();
            $cacheKey = "analytics.most_visited_pages.{$period->startDate->format('Y-m-d')}.{$period->endDate->format('Y-m-d')}.10";

            // Use cache-only access, fallback to empty array if cache miss
            $pages = Cache::get($cacheKey, []);

            return collect($pages)->map(function ($page, $index) {
                return [
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
