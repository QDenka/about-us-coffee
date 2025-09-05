<?php

namespace App\Http\Controllers;

use App\Models\SeoSettings;
use App\Models\HeroSettings;
use App\Models\Story;
use App\Models\MenuItem;
use App\Models\JourneyStep;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\GalleryImage;
use App\Models\Workspace;
use App\Models\FooterSettings;
use App\Models\PageSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $visibleSections = PageSection::getVisibleSections();
        $orderedSections = PageSection::where('is_visible', true)
            ->orderBy('sort_order')
            ->pluck('section_key')
            ->toArray();
        
        $data = [
            'seo' => SeoSettings::where('page', 'home')->first(),
            'visibleSections' => $visibleSections,
            'orderedSections' => $orderedSections,
            'sectionOrder' => PageSection::orderBy('sort_order')->pluck('sort_order', 'section_key')->toArray(),
        ];

        // Load data only for visible sections
        if (in_array('hero', $visibleSections)) {
            $data['heroSettings'] = HeroSettings::first();
        }
        
        if (in_array('story', $visibleSections)) {
            $data['stories'] = Story::active()->ordered()->get();
        }
        
        if (in_array('menu', $visibleSections)) {
            $data['coffeeMenu'] = MenuItem::available()->byCategory('coffee')->ordered()->get();
            $data['vietnameseMenu'] = MenuItem::available()->byCategory('vietnamese')->ordered()->get();
            $data['handbrewMenu'] = MenuItem::available()->byCategory('handbrew')->ordered()->get();
            $data['foodMenu'] = MenuItem::available()->byCategory('food')->ordered()->get();
            $data['nonCoffeeMenu'] = MenuItem::available()->byCategory('noncoffee')->ordered()->get();
        }
        
        if (in_array('workspace', $visibleSections)) {
            $data['workspace'] = Workspace::first();
        }
        
        if (in_array('journey', $visibleSections)) {
            $data['journeySteps'] = JourneyStep::active()->ordered()->get();
        }
        
        if (in_array('events', $visibleSections)) {
            $data['events'] = Event::active()->upcoming()->get();
            $data['featuredEvents'] = Event::active()->featured()->get();
        }
        
        if (in_array('team', $visibleSections)) {
            $data['teamMembers'] = TeamMember::active()->ordered()->get();
        }
        
        if (in_array('gallery', $visibleSections)) {
            $data['galleryImages'] = GalleryImage::active()->ordered()->get();
        }
        
        if (in_array('footer', $visibleSections)) {
            $data['footer'] = FooterSettings::first();
        }

        return view('home', $data);
    }
}
