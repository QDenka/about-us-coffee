<?php

namespace App\Filament\Resources\PageSections\Pages;

use App\Filament\Resources\PageSections\PageSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageSection extends EditRecord
{
    protected static string $resource = PageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn ($record) => !$record->is_required),
        ];
    }
}