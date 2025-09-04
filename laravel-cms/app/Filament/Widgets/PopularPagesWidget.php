<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PopularPagesWidget extends TableWidget
{
    protected static ?string $heading = 'Trang phổ biến (7 ngày)';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageView::query()
                    ->select('url', 'page_title', DB::raw('ROW_NUMBER() OVER (ORDER BY COUNT(*) DESC) as row_id'))
                    ->selectRaw('COUNT(*) as views')
                    ->selectRaw('COUNT(DISTINCT ip_address) as unique_visitors')
                    ->where('viewed_at', '>=', now()->subDays(7))
                    ->groupBy('url', 'page_title')
                    ->orderByDesc('views')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('page_title')
                    ->label('Trang')
                    ->formatStateUsing(fn ($state, $record) => $state ?: parse_url($record->url, PHP_URL_PATH))
                    ->wrap(),
                    
                TextColumn::make('url')
                    ->label('URL')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->url),
                    
                TextColumn::make('views')
                    ->label('Lượt xem')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                    
                TextColumn::make('unique_visitors')
                    ->label('Khách duy nhất')
                    ->numeric()
                    ->alignCenter(),
            ])
            ->defaultSort('views', 'desc')
            ->paginated(false);
    }

    public function getTableRecordKey($record): string
    {
        return $record->url ?? 'unknown';
    }
}
