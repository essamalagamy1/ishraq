<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Filament\Widgets\ChartWidget;

class ContentStatsChart extends ChartWidget
{
    protected ?string $heading = 'إحصائيات المحتوى';
    protected int | string | array $columnSpan = 1;
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'عدد العناصر',
                    'data' => [
                        Service::count(),
                        Project::count(),
                        Testimonial::count(),
                        TeamMember::count(),
                    ],
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',  // Blue
                        'rgb(34, 197, 94)',   // Green
                        'rgb(251, 191, 36)',  // Yellow
                        'rgb(6, 182, 212)',   // Cyan
                    ],
                ],
            ],
            'labels' => ['الخدمات', 'المشاريع', 'التقييمات', 'الفريق'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
