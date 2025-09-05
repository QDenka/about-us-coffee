<?php

namespace App\Filament\Components;

use Filament\Forms\Components\FileUpload;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class OptimizedFileUpload extends FileUpload
{
    protected ?int $imageMaxWidth = 1920;
    protected ?int $imageMaxHeight = 1080;
    protected int $imageQuality = 85;
    
    public function maxDimensions(int $width, int $height): static
    {
        $this->imageMaxWidth = $width;
        $this->imageMaxHeight = $height;
        
        return $this;
    }
    
    public function quality(int $quality): static
    {
        $this->imageQuality = min(100, max(1, $quality));
        
        return $this;
    }
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->afterStateUpdated(function ($state, $component) {
            if ($state) {
                if (is_string($state)) {
                    // Single file upload
                    $this->optimizeUploadedImage($state);
                } elseif (is_array($state)) {
                    // Multiple file upload
                    foreach ($state as $filename) {
                        if (is_string($filename)) {
                            $this->optimizeUploadedImage($filename);
                        }
                    }
                }
            }
        });
    }
    
    protected function optimizeUploadedImage(string $filename): void
    {
        try {
            $diskName = $this->getDiskName();
            $directory = $this->getDirectory();
            $path = $directory ? $directory . '/' . $filename : $filename;
            
            if (!Storage::disk($diskName)->exists($path)) {
                return;
            }
            
            // Check if it's an image
            $mimeType = Storage::disk($diskName)->mimeType($path);
            if (!$mimeType || !str_starts_with($mimeType, 'image/')) {
                return;
            }
            
            $fullPath = Storage::disk($diskName)->path($path);
            
            // Create ImageManager with GD driver
            $manager = new ImageManager(new Driver());
            
            // Resize if needed using Intervention Image v3
            if ($this->imageMaxWidth || $this->imageMaxHeight) {
                $image = $manager->read($fullPath);
                
                // Get original dimensions
                $originalWidth = $image->width();
                $originalHeight = $image->height();
                
                // Calculate new dimensions while maintaining aspect ratio
                $newWidth = $originalWidth;
                $newHeight = $originalHeight;
                
                if ($this->imageMaxWidth && $originalWidth > $this->imageMaxWidth) {
                    $ratio = $this->imageMaxWidth / $originalWidth;
                    $newWidth = $this->imageMaxWidth;
                    $newHeight = (int) ($originalHeight * $ratio);
                }
                
                if ($this->imageMaxHeight && $newHeight > $this->imageMaxHeight) {
                    $ratio = $this->imageMaxHeight / $newHeight;
                    $newHeight = $this->imageMaxHeight;
                    $newWidth = (int) ($newWidth * $ratio);
                }
                
                // Resize only if dimensions changed
                if ($newWidth !== $originalWidth || $newHeight !== $originalHeight) {
                    $image = $image->resize($newWidth, $newHeight);
                }
                
                // Save with quality setting
                $image->save($fullPath, $this->imageQuality);
            }
            
            // Optimize with spatie/laravel-image-optimizer
            ImageOptimizer::optimize($fullPath);
            
        } catch (\Exception $e) {
            // Log error but don't break the upload process
            logger()->error('Image optimization failed: ' . $e->getMessage(), [
                'filename' => $filename,
                'error' => $e->getTraceAsString()
            ]);
        }
    }
}