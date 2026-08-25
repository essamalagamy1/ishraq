<?php

namespace App\Filament\Widgets\Analytics;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Period;

class EventsTable extends BaseWidget
{
    protected static ?int $sort = 8;

    public ?string $filter = '7days';

    public function table(Table $table): Table
    {
        return $table
            ->heading('الأحداث (Events)')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_name')
                    ->label('اسم الحدث')
                    ->searchable(),
                Tables\Columns\TextColumn::make('count')
                    ->label('عدد المرات')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('count', 'desc');
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
            $events = $service->getEvents($period, 15);

            return collect($events)->map(function ($event, $index) {
                return [
                    'id' => $index + 1,
                    'key' => (string) ($index + 1),
                    'rank' => $index + 1,
                    'event_name' => $this->translateEventName($event['event_name']),
                    'count' => $event['count'],
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

    protected function translateEventName(string $eventName): string
    {
        return match ($eventName) {
            'page_view' => 'مشاهدة صفحة',
            'click' => 'نقرة',
            'scroll' => 'تمرير',
            'session_start' => 'بداية جلسة',
            'first_visit' => 'زيارة أولى',
            'user_engagement' => 'تفاعل المستخدم',
            'form_submit' => 'إرسال نموذج',
            default => $eventName,
        };
    }

    public function getTableRecordKey($record): string
    {
        return (string) $record['rank'];
    }
}
