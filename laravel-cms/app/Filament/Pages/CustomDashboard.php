<?php

namespace App\Filament\Pages;

use App\Models\PageView;
use App\Models\ContactSubmission;
use Filament\Pages\Dashboard;

class CustomDashboard extends Dashboard
{
    protected static ?string $title = 'Bảng điều khiển';


    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\AnalyticsChart::class,
            \App\Filament\Widgets\RealtimeActivityWidget::class,
//            \App\Filament\Widgets\PopularPagesWidget::class,
//            \App\Filament\Widgets\SystemInfoWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
        ];
    }
}
