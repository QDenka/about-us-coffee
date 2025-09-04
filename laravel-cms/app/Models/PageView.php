<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PageView extends Model
{
    protected $fillable = [
        'url',
        'page_title',
        'ip_address',
        'user_agent',
        'referer',
        'session_id',
        'viewed_at',
        'metadata'
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
        'metadata' => 'array'
    ];

    public static function recordView(string $url, ?string $pageTitle = null): void
    {
        self::create([
            'url' => $url,
            'page_title' => $pageTitle,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->header('referer'),
            'session_id' => session()->getId(),
            'viewed_at' => now(),
            'metadata' => [
                'is_mobile' => request()->userAgent() ? (bool) preg_match('/Mobile|Android|iPhone/', request()->userAgent()) : false,
            ]
        ]);
    }

    public static function getTodayViews(): int
    {
        return self::whereDate('viewed_at', today())->count();
    }

    public static function getUniqueVisitorsToday(): int
    {
        return self::whereDate('viewed_at', today())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    public static function getPopularPages(int $limit = 5): array
    {
        return self::select('url', 'page_title')
            ->selectRaw('COUNT(*) as views')
            ->where('viewed_at', '>=', now()->subDays(7))
            ->groupBy('url', 'page_title')
            ->orderByDesc('views')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
