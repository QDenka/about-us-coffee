<?php

namespace App\Filament\Components;

use Filament\Forms\Components\FileUpload;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class OptimizedFileUpload extends FileUpload
{
    protected ?int $maxWidth = 1920;
    protected ?int $maxHeight = 1080;
    protected int $quality = 85;
    
    public function maxDimensions(int $width, int $height): static
    {
        $this->maxWidth = $width;
        $this->maxHeight = $height;
        
        return $this;
    }
    
    public function quality(int $quality): static
    {
        $this->quality = min(100, max(1, $quality));
        
        return $this;
    }
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->afterStateUpdated(function ($state, $component) {
            if ($state && is_string($state)) {
                $this->optimizeUploadedImage($state);
            }
        });
    }
    
    protected function optimizeUploadedImage(string $filename): void
    {
        $disk = $this->getDisk();
        $path = $this->getDirectory() . '/' . $filename;
        $fullPath = Storage::disk($disk)->path($path);
        
        if (!Storage::disk($disk)->exists($path)) {
            return;
        }
        
        // Check if it's an image
        $mimeType = Storage::disk($disk)->mimeType($path);
        if (!str_starts_with($mimeType, 'image/')) {
            return;
        }
        
        try {
            // Create ImageManager with GD driver
            $manager = new ImageManager(new Driver());
            
            // Resize if needed using Intervention Image v3
            if ($this->maxWidth || $this->maxHeight) {
                $image = $manager->read($fullPath);
                
                // Get original dimensions
                $originalWidth = $image->width();
                $originalHeight = $image->height();
                
                // Calculate new dimensions while maintaining aspect ratio
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
                
                if ($this->maxWidth && $originalWidth > $this->maxWidth) {
                    $ratio = $this->maxWidth / $originalWidth;
                    $newWidth = $this->maxWidth;
                    $newHeight = (int) ($originalHeight * $ratio);
                }
                
                if ($this->maxHeight && $newHeight > $this->maxHeight) {
                    $ratio = $this->maxHeight / $newHeight;
                    $newHeight = $this->maxHeight;
                    $newWidth = (int) ($newWidth * $ratio);
                }
                
                // Resize only if dimensions changed
                if ($newWidth !== $originalWidth || $newHeight !== $originalHeight) {
                    $image = $image->resize($newWidth, $newHeight);
                }
                
                // Save with quality setting
                $image->save($fullPath, $this->quality);
            }
            
            // Optimize with spatie/laravel-image-optimizer
            ImageOptimizer::optimize($fullPath);
            
        } catch (\Exception $e) {
            // Log error but don't break the upload process
            logger()->error('Image optimization failed: ' . $e->getMessage());
        }
    }
}