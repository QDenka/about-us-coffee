<?php

namespace App\Filament\Resources\PageSections;

use App\Filament\Resources\PageSections\Pages\CreatePageSection;
use App\Filament\Resources\PageSections\Pages\EditPageSection;
use App\Filament\Resources\PageSections\Pages\ListPageSections;
use App\Filament\Resources\PageSections\Schemas\PageSectionForm;
use App\Filament\Resources\PageSections\Tables\PageSectionTable;
use App\Models\PageSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageSectionResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Squares2x2;

    protected static ?string $navigationLabel = 'Page Sections';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PageSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageSectionTable::configure($table);
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
            'index' => ListPageSections::route('/'),
        ];
    }

    public static function canDelete($record): bool
    {
        return !$record->is_required;
    }
}