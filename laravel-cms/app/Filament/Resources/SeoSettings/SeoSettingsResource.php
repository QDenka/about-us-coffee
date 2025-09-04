<?php

namespace App\Filament\Resources\SeoSettings;

use App\Filament\Resources\SeoSettings\Pages\CreateSeoSettings;
use App\Filament\Resources\SeoSettings\Pages\EditSeoSettings;
use App\Filament\Resources\SeoSettings\Pages\ListSeoSettings;
use App\Filament\Resources\SeoSettings\Schemas\SeoSettingsForm;
use App\Filament\Resources\SeoSettings\Tables\SeoSettingsTable;
use App\Models\SeoSettings;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoSettingsResource extends Resource
{
    protected static ?string $model = SeoSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::GlobeAlt;

    public static function form(Schema $schema): Schema
    {
        return SeoSettingsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoSettingsTable::configure($table);
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
            'index' => EditSeoSettings::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
