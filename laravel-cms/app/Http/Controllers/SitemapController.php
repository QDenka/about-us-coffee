<?php

namespace App\Http\Controllers;

use App\Models\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];
        
        // Main pages with their SEO settings
        $seoPages = SeoSettings::all();
        
        foreach ($seoPages as $seoPage) {
            $urls[] = [
                'url' => url('/' . ($seoPage->page === 'home' ? '' : $seoPage->page)),
                'lastmod' => $seoPage->updated_at->format('Y-m-d'),
                'changefreq' => $this->getChangeFreq($seoPage->page),
                'priority' => $this->getPriority($seoPage->page)
            ];
        }
        
        // Add language versions
        foreach ($seoPages as $seoPage) {
            $urls[] = [
                'url' => url('/') . '?lang=en' . ($seoPage->page === 'home' ? '' : '#' . $seoPage->page),
                'lastmod' => $seoPage->updated_at->format('Y-m-d'),
                'changefreq' => $this->getChangeFreq($seoPage->page),
                'priority' => $this->getPriority($seoPage->page)
            ];
            
            $urls[] = [
                'url' => url('/') . '?lang=vi' . ($seoPage->page === 'home' ? '' : '#' . $seoPage->page),
                'lastmod' => $seoPage->updated_at->format('Y-m-d'),
                'changefreq' => $this->getChangeFreq($seoPage->page),
                'priority' => $this->getPriority($seoPage->page)
            ];
        }
        
        // If no SEO pages exist, add default main page
        if ($seoPages->isEmpty()) {
            $urls[] = [
                'url' => url('/'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ];
            
            $urls[] = [
                'url' => url('/') . '?lang=en',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly', 
                'priority' => '1.0'
            ];
            
            $urls[] = [
                'url' => url('/') . '?lang=vi',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ];
        }
        
        return response()->view('sitemap.xml', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }
    
    private function getChangeFreq($page)
    {
        $frequencies = [
            'home' => 'daily',
            'menu' => 'weekly',
            'story' => 'monthly',
            'workspace' => 'monthly',
            'journey' => 'monthly',
            'gallery' => 'weekly',
            'contact' => 'monthly',
            'events' => 'weekly',
            'team' => 'monthly'
        ];
        
        return $frequencies[$page] ?? 'monthly';
    }
    
    private function getPriority($page)
    {
        $priorities = [
            'home' => '1.0',
            'menu' => '0.9',
            'contact' => '0.8',
            'story' => '0.7',
            'workspace' => '0.7',
            'journey' => '0.6',
            'gallery' => '0.6',
            'events' => '0.6',
            'team' => '0.5'
        ];
        
        return $priorities[$page] ?? '0.5';
    }
}