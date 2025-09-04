<?php

namespace App\Filament\Resources\SeoSettings\Pages;

use App\Filament\Resources\SeoSettings\SeoSettingsResource;
use App\Models\SeoSettings;
use Filament\Resources\Pages\EditRecord;

class EditSeoSettings extends EditRecord
{
    protected static string $resource = SeoSettingsResource::class;

    public function mount(string|int $record = null): void
    {
        $seoRecord = SeoSettings::first();
        
        if (!$seoRecord) {
            $seoRecord = SeoSettings::create([
                'page' => 'home',
                'meta_title' => ['en' => '', 'vi' => ''],
                'meta_description' => ['en' => '', 'vi' => ''],
                'meta_keywords' => ['en' => '', 'vi' => ''],
                'og_title' => ['en' => '', 'vi' => ''],
                'og_description' => ['en' => '', 'vi' => ''],
                'schema_markup' => ['en' => '', 'vi' => ''],
            ]);
        }
        
        parent::mount($seoRecord->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
