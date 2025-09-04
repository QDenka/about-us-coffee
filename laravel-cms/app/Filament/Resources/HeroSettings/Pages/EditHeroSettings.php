<?php

namespace App\Filament\Resources\HeroSettings\Pages;

use App\Filament\Resources\HeroSettings\HeroSettingsResource;
use App\Models\HeroSettings;
use Filament\Resources\Pages\EditRecord;

class EditHeroSettings extends EditRecord
{
    protected static string $resource = HeroSettingsResource::class;

    public function mount(string|int $record = null): void
    {
        $heroRecord = HeroSettings::first();
        
        if (!$heroRecord) {
            $heroRecord = HeroSettings::create([
                'title' => ['en' => '', 'vi' => ''],
                'subtitle' => '',
                'background_image' => null,
            ]);
        }
        
        parent::mount($heroRecord->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
