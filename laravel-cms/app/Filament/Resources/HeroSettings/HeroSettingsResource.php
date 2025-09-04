<?php

namespace App\Filament\Resources\HeroSettings;

use App\Filament\Resources\HeroSettings\Pages\CreateHeroSettings;
use App\Filament\Resources\HeroSettings\Pages\EditHeroSettings;
use App\Filament\Resources\HeroSettings\Pages\ListHeroSettings;
use App\Filament\Resources\HeroSettings\Schemas\HeroSettingsForm;
use App\Filament\Resources\HeroSettings\Tables\HeroSettingsTable;
use App\Models\HeroSettings;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HeroSettingsResource extends Resource
{
    protected static ?string $model = HeroSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Home;

    public static function form(Schema $schema): Schema
    {
        return HeroSettingsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeroSettingsTable::configure($table);
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
            'index' => EditHeroSettings::route('/'),
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
