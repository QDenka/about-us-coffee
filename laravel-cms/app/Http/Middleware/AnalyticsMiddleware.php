<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnalyticsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && 
            $response->getStatusCode() === 200 && 
            !$request->ajax() && 
            !str_starts_with($request->path(), 'admin/') &&
            !str_starts_with($request->path(), 'livewire/')) {
            
            try {
                $content = $response instanceof \Illuminate\Http\Response 
                    ? $response->getContent() 
                    : (string) $response->getBody();
                    
                PageView::recordView(
                    $request->fullUrl(),
                    $this->extractPageTitle($content)
                );
            } catch (\Exception $e) {
                // Fail silently to not break the user experience
                \Log::error('Analytics tracking failed: ' . $e->getMessage());
            }
        }

        return $response;
    }

    private function extractPageTitle(?string $content): ?string
    {
        if (!$content) return null;
        
        if (preg_match('/<title[^>]*>(.*?)<\/title>/i', $content, $matches)) {
            return trim(strip_tags($matches[1]));
        }
        
        return null;
    }
}
