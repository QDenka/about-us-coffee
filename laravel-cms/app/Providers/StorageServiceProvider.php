<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class StorageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix storage file serving for development
        if (app()->environment('local')) {
            $this->app['router']->get('/storage/{path}', function (Request $request, $path) {
                $fullPath = storage_path('app/public/' . $path);
                
                if (!file_exists($fullPath)) {
                    abort(404);
                }

                $file = file_get_contents($fullPath);
                $mimeType = mime_content_type($fullPath);

                return Response::make($file, 200, [
                    'Content-Type' => $mimeType,
                    'Content-Length' => filesize($fullPath),
                    'Cache-Control' => 'public, max-age=31536000',
                ]);
            })->where('path', '.*');
        }
    }
}