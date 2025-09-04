<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JourneyStep extends Model
{
    use HasTranslations;

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'icon',
        'image',
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
        return $query->orderBy('step_number');
    }
}
