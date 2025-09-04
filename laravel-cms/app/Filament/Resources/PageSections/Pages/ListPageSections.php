<?php

namespace App\Filament\Resources\PageSections\Pages;

use App\Filament\Resources\PageSections\PageSectionResource;
use App\Models\PageSection;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageSections extends ListRecords
{
    protected static string $resource = PageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function reorderTable(array $order, string|int|null $draggedRecordKey = null): void
    {
        PageSection::setNewOrder($order);
    }
}