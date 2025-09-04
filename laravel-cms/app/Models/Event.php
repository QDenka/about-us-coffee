<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
        'date',
        'time',
        'location',
        'is_featured',
        'is_active',
    ];

    public $translatable = [
        'title',
        'description',
        'location',
    ];

    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString());
    }
}
