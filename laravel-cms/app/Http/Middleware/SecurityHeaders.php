<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // SEO and Security Headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');
        
        // Content Security Policy (relaxed for development)
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://cdn.jsdelivr.net; " .
               "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; " .
               "font-src 'self' https://fonts.gstatic.com; " .
               "img-src 'self' data: https: http:; " .
               "connect-src 'self' https://www.google-analytics.com; " .
               "frame-src 'self' https://www.google.com;";
        
        $response->headers->set('Content-Security-Policy', $csp);
        
        // Preload key resources for performance
        if ($request->is('/')) {
            $response->headers->set('Link', [
                '</favicon-32x32.png>; rel=preload; as=image',
                '<https://fonts.googleapis.com>; rel=preconnect',
                '<https://www.googletagmanager.com>; rel=dns-prefetch'
            ]);
        }
        
        return $response;
    }
}