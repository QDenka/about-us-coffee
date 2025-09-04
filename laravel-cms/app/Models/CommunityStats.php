<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CommunityStats extends Model
{
    use HasTranslations;

    protected $fillable = [
        'stat_number',
        'stat_label',
        'order'
    ];

    public $translatable = [
        'stat_label'
    ];
}
