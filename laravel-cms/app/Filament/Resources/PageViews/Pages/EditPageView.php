<?php

namespace App\Filament\Resources\PageViews\Pages;

use App\Filament\Resources\PageViews\PageViewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPageView extends EditRecord
{
    protected static string $resource = PageViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
