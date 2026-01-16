<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'لوحة التحكم';
    
    protected static ?string $title = 'لوحة التحكم';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverviewWidget::class,
            \App\Filament\Widgets\LatestEntriesWidget::class,
            \App\Filament\Widgets\ContentStatsChart::class,
            \App\Filament\Widgets\MonthlySubmissionsChart::class,
        ];
    }
}
