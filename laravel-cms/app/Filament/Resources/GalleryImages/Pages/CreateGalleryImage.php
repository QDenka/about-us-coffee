<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Models\GalleryImage;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryImage extends CreateRecord
{
    protected static string $resource = GalleryImageResource::class;

    protected function beforeCreate(): void
    {
        $currentCount = GalleryImage::count();
        
        if ($currentCount >= 6) {
            Notification::make()
                ->title('Gallery Limit Exceeded')
                ->body('Maximum 6 images allowed in gallery. Please delete some images first.')
                ->danger()
                ->send();
                
            $this->halt();
        }
    }
}
