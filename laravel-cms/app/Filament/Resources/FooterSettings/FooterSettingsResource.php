<?php

namespace App\Filament\Resources\FooterSettings;

use App\Filament\Resources\FooterSettings\Pages\CreateFooterSettings;
use App\Filament\Resources\FooterSettings\Pages\EditFooterSettings;
use App\Filament\Resources\FooterSettings\Pages\ListFooterSettings;
use App\Filament\Resources\FooterSettings\Schemas\FooterSettingsForm;
use App\Filament\Resources\FooterSettings\Tables\FooterSettingsTable;
use App\Models\FooterSettings;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterSettingsResource extends Resource
{
    protected static ?string $model = FooterSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QueueList;

    public static function form(Schema $schema): Schema
    {
        return FooterSettingsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterSettingsTable::configure($table);
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
            'index' => EditFooterSettings::route('/'),
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
