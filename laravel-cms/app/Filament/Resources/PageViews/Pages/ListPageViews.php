<?php

namespace App\Filament\Resources\PageViews\Pages;

use App\Filament\Resources\PageViews\PageViewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPageViews extends ListRecords
{
    protected static string $resource = PageViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
