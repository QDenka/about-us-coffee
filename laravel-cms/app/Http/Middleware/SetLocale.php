<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = ['vi', 'en'];
        
        // Priority: 1. URL parameter, 2. Session, 3. Browser preference, 4. Default
        $locale = $request->get('lang');
        
        if (!$locale) {
            $locale = Session::get('locale');
            
            if (!$locale) {
                // Detect from browser's Accept-Language header
                $locale = $this->detectBrowserLanguage($request, $availableLocales);
            }
        }
        
        // Fallback to default if still no locale
        if (!$locale) {
            $locale = config('app.locale', 'en');
        }
        
        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        
        return $next($request);
    }
    
    /**
     * Detect browser language from Accept-Language header
     */
    private function detectBrowserLanguage(Request $request, array $availableLocales): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');
        
        if (!$acceptLanguage) {
            return null;
        }
        
        // Parse Accept-Language header
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';', $lang);
            $language = strtolower(trim($parts[0]));
            $quality = 1.0;
            
            if (isset($parts[1])) {
                $qParts = explode('=', $parts[1]);
                if (count($qParts) === 2 && $qParts[0] === 'q') {
                    $quality = (float) $qParts[1];
                }
            }
            
            // Extract primary language code (before '-')
            $primaryLang = explode('-', $language)[0];
            
            // Check for Vietnamese locales (vi, vi-VN)
            if (($primaryLang === 'vi' || strpos($language, 'vi-') === 0) && in_array('vi', $availableLocales)) {
                $languages['vi'] = $quality;
            }
            // Default to English for all other languages
            elseif (in_array('en', $availableLocales) && !isset($languages['en'])) {
                $languages['en'] = $quality * 0.9; // Slightly lower priority for fallback
            }
        }
        
        // Sort by quality (highest first)
        arsort($languages);
        
        // Return the highest quality available language
        foreach ($languages as $lang => $quality) {
            if (in_array($lang, $availableLocales)) {
                return $lang;
            }
        }
        
        return null;
    }
}
