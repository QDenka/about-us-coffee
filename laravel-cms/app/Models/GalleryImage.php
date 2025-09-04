<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalleryImage extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'alt_text',
        'image_path',
        'thumbnail_path',
        'order',
        'is_active',
    ];

    public $translatable = [
        'title',
        'alt_text',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
