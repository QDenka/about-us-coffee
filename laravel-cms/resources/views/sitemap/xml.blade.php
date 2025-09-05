<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($urls as $url)
    <url>
        <loc>{{ $url['url'] }}</loc>
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        <changefreq>{{ $url['changefreq'] }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
        @if(str_contains($url['url'], '?lang='))
        <xhtml:link rel="alternate" hreflang="en" href="{{ str_replace(['?lang=vi', '?lang=en'], '?lang=en', $url['url']) }}"/>
        <xhtml:link rel="alternate" hreflang="vi" href="{{ str_replace(['?lang=vi', '?lang=en'], '?lang=vi', $url['url']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ str_replace(['?lang=vi', '?lang=en'], '', $url['url']) }}"/>
        @endif
    </url>
@endforeach
</urlset>