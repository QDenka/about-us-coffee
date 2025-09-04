<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use App\Models\ContactSubmission;
use Filament\Widgets\Widget;

class RealtimeActivityWidget extends Widget
{
    protected string $view = 'filament.widgets.realtime-activity-widget';

    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 3;

    public function getRealtimeData(): array
    {
        $lastHour = now()->subHour();

        return [
            'recent_views' => PageView::where('viewed_at', '>=', $lastHour)
                ->orderByDesc('viewed_at')
                ->limit(8)
                ->get(['page_title', 'url', 'viewed_at']),

            'hourly_stats' => [
                'views' => PageView::where('viewed_at', '>=', $lastHour)->count(),
                'unique_visitors' => PageView::where('viewed_at', '>=', $lastHour)
                    ->distinct('ip_address')->count(),
                'new_contacts' => ContactSubmission::where('created_at', '>=', $lastHour)->count(),
            ],
        ];
    }
}
