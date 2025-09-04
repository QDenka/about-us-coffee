<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use App\Models\ContactSubmission;
use App\Models\Story;
use App\Models\Event;
use App\Models\TeamMember;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        $todayViews = PageView::getTodayViews();
        $todayVisitors = PageView::getUniqueVisitorsToday();
        $totalViews = PageView::count();
        $weeklyViews = PageView::where('viewed_at', '>=', now()->subDays(7))->count();
        $contactSubmissions = ContactSubmission::whereDate('created_at', today())->count();
        $totalContacts = ContactSubmission::count();

        return [
            Stat::make('Lượt xem hôm nay', $todayViews)
                ->description($weeklyViews . ' tuần này')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->getViewsChart())
                ->color('success'),

            Stat::make('Khách truy cập', $todayVisitors)
                ->description('Hôm nay')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Tổng lượt xem', number_format($totalViews))
                ->description('Tất cả thời gian')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Liên hệ', $contactSubmissions)
                ->description($totalContacts . ' tổng cộng')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),

            Stat::make('Nội dung', Story::count())
                ->description('Câu chuyện đã xuất bản')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('secondary'),

            Stat::make('Sự kiện', Event::where('date', '>=', today())->count())
                ->description('Sắp tới')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('danger'),
        ];
    }

    private function getViewsChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $data[] = PageView::whereDate('viewed_at', $date)->count();
        }
        return $data;
    }
}
