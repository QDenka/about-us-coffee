<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSettings extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle', 
        'background_image'
    ];

    public $translatable = [
        'title',
        'subtitle'
    ];
}
