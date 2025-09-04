<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class AnalyticsChart extends ChartWidget
{
    protected ?string $heading = 'Thống kê truy cập (30 ngày)';

    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d.m');
            $data[] = PageView::whereDate('viewed_at', $date->toDateString())->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Lượt xem',
                    'data' => $data,
                    'borderColor' => '#1CA39D',
                    'backgroundColor' => 'rgba(28, 163, 157, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
