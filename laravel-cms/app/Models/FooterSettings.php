<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterSettings extends Model
{
    use HasTranslations;

    protected $fillable = [
        'contact_email',
        'contact_phone',
        'address',
        'opening_hours',
        'social_facebook',
        'social_instagram',
        'social_youtube',
        'copyright_text',
    ];

    public $translatable = [
        'address',
        'opening_hours',
        'copyright_text',
    ];
}
