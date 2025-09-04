<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use App\Models\ContactSubmission;
use App\Models\Story;
use App\Models\Event;
use App\Models\User;
use Filament\Widgets\Widget;

class SystemInfoWidget extends Widget
{
    protected string $view = 'filament.widgets.system-info-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function getSystemInfo(): array
    {
        $recentContacts = ContactSubmission::latest()->limit(5)->get();
        $recentViews = PageView::with([])
            ->select('url', 'page_title', 'viewed_at')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('url', 'page_title', 'viewed_at')
            ->orderByDesc('viewed_at')
            ->limit(10)
            ->get();

        return [
            'recent_contacts' => $recentContacts,
            'recent_views' => $recentViews,
            'database_size' => $this->getDatabaseSize(),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ];
    }

    private function getDatabaseSize(): string
    {
        try {
            $size = \DB::select("SELECT page_count * page_size as size FROM pragma_page_count(), pragma_page_size()");
            return number_format($size[0]->size / 1024 / 1024, 2) . ' MB';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }
}
