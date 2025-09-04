<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingsResource;
use App\Models\FooterSettings;
use Filament\Resources\Pages\EditRecord;

class EditFooterSettings extends EditRecord
{
    protected static string $resource = FooterSettingsResource::class;

    public function mount(string|int $record = null): void
    {
        $footerRecord = FooterSettings::first();
        
        if (!$footerRecord) {
            $footerRecord = FooterSettings::create([
                'contact_email' => 'info@about-us.vn',
                'contact_phone' => '+84 123 456 789',
                'address' => ['en' => '', 'vi' => ''],
                'opening_hours' => ['en' => '', 'vi' => ''],
                'copyright_text' => ['en' => '', 'vi' => ''],
            ]);
        }
        
        parent::mount($footerRecord->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
