<?php

namespace App\Filament\Resources\HeroSettings\Pages;

use App\Filament\Resources\HeroSettings\HeroSettingsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHeroSettings extends ListRecords
{
    protected static string $resource = HeroSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
