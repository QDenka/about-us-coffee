<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SeoSettings extends Model
{
    use HasTranslations;

    protected $fillable = [
        'page',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'schema_markup',
    ];

    public $translatable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'schema_markup',
    ];

    protected $casts = [
        'schema_markup' => 'array',
    ];
}
