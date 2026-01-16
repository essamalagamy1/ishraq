<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\DesignRequest;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الخدمات', Service::where('is_active', true)->count())
                ->description('الخدمات النشطة')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('info')
                ->chart([7, 12, 15, 18, 20, 22]),
            
            Stat::make('المشاريع المنشورة', Project::where('status', 'published')->count())
                ->description('مشاريع في المعرض')
                ->descriptionIcon('heroicon-o-folder')
                ->color('success')
                ->chart([5, 8, 12, 15, 18, 20]),
            
            Stat::make('التقييمات النشطة', Testimonial::where('is_active', true)->count())
                ->description('تقييمات العملاء')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning')
                ->chart([3, 5, 8, 12, 15, 18]),
            
            Stat::make('رسائل التواصل', ContactMessage::whereDate('created_at', today())->count())
                ->description('رسائل اليوم')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('danger')
                ->chart([2, 4, 3, 5, 6, 8]),
            
            Stat::make('طلبات التصميم', DesignRequest::where('status', 'pending')->count())
                ->description('طلبات قيد المراجعة')
                ->descriptionIcon('heroicon-o-paint-brush')
                ->color('purple')
                ->chart([1, 3, 2, 4, 5, 6]),
            
            Stat::make('أعضاء الفريق', TeamMember::where('is_active', true)->count())
                ->description('الأعضاء النشطون')
                ->descriptionIcon('heroicon-o-users')
                ->color('cyan')
                ->chart([4, 5, 6, 7, 8, 8]),
        ];
    }
}
