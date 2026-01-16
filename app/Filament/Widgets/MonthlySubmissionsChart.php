<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\DesignRequest;
use App\Models\Testimonial;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class MonthlySubmissionsChart extends ChartWidget
{
    protected ?string $heading = 'الطلبات الشهرية';
    protected int | string | array $columnSpan = 1;
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(function ($monthsAgo) {
            return Carbon::now()->subMonths($monthsAgo);
        });

        $contactMessages = $months->map(function ($month) {
            return ContactMessage::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        $designRequests = $months->map(function ($month) {
            return DesignRequest::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        $testimonials = $months->map(function ($month) {
            return Testimonial::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'رسائل التواصل',
                    'data' => $contactMessages->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => 'طلبات التصميم',
                    'data' => $designRequests->toArray(),
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                ],
                [
                    'label' => 'التقييمات',
                    'data' => $testimonials->toArray(),
                    'borderColor' => 'rgb(251, 191, 36)',
                    'backgroundColor' => 'rgba(251, 191, 36, 0.1)',
                ],
            ],
            'labels' => $months->map(fn($month) => $month->locale('ar')->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
