<?php

namespace App\Filament\Resources\PageViews;

use App\Filament\Resources\PageViews\Pages\CreatePageView;
use App\Filament\Resources\PageViews\Pages\EditPageView;
use App\Filament\Resources\PageViews\Pages\ListPageViews;
use App\Filament\Resources\PageViews\Schemas\PageViewForm;
use App\Filament\Resources\PageViews\Tables\PageViewsTable;
use App\Models\PageView;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageViewResource extends Resource
{
    protected static ?string $model = PageView::class;

    protected static ?string $navigationLabel = 'Phân tích';
    
    protected static ?string $modelLabel = 'Lượt xem trang';
    
    protected static ?string $pluralModelLabel = 'Lượt xem các trang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    public static function form(Schema $schema): Schema
    {
        return PageViewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageViewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageViews::route('/'),
        ];
    }
}
