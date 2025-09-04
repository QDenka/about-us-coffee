<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Story extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'is_active',
    ];

    public $translatable = [
        'title',
        'description',
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
