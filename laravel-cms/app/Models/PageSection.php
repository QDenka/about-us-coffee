<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'is_visible',
        'sort_order',
        'is_required',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'is_required' => 'boolean',
    ];

    public static function getVisibleSections()
    {
        return self::where('is_visible', true)
                  ->orderBy('sort_order')
                  ->pluck('section_key')
                  ->toArray();
    }

    public static function getSectionOrder($sectionKey)
    {
        $section = self::where('section_key', $sectionKey)->first();
        return $section ? $section->sort_order : 999;
    }

    public static function isSectionVisible($sectionKey)
    {
        $section = self::where('section_key', $sectionKey)->first();
        return $section ? $section->is_visible : true;
    }

    public function getSectionNameAttribute()
    {
        return match($this->section_key) {
            'hero' => 'Hero Section',
            'story' => 'Our Story',
            'menu' => 'Menu Section',
            'workspace' => 'Workspace',
            'journey' => 'Coffee Journey',
            'events' => 'Events',
            'team' => 'Team Members',
            'gallery' => 'Photo Gallery',
            'contact' => 'Contact Section',
            'footer' => 'Footer',
            default => ucfirst(str_replace('_', ' ', $this->section_key))
        };
    }

    public static function setNewOrder(array $order): void
    {
        foreach ($order as $index => $id) {
            self::where('id', $id)->update(['sort_order' => $index + 1]);
        }
    }
}