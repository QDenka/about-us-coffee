<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Models\GalleryImage;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGalleryImages extends ListRecords
{
    protected static string $resource = GalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        $currentCount = GalleryImage::count();
        
        return [
            CreateAction::make()
                ->disabled($currentCount >= 6)
                ->tooltip($currentCount >= 6 ? 'Maximum 6 images allowed. Delete some images first.' : null),
        ];
    }
}
