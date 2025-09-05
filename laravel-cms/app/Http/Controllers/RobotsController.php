<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function index()
    {
        $content = "User-agent: *
Disallow: /admin/
Disallow: /filament/
Disallow: /storage/logs/
Allow: /storage/
Allow: /

# Sitemap location
Sitemap: " . url('/sitemap.xml') . "

# Common crawl optimization  
Crawl-delay: 1";
        
        return response($content)->header('Content-Type', 'text/plain');
    }
}