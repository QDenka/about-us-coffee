<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Workspace extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description_1',
        'description_2', 
        'description_3',
        'features',
        'ground_floor_title',
        'ground_floor_description',
        'ground_floor_image',
        'second_floor_title',
        'second_floor_description',
        'second_floor_image',
        'wifi_speed'
    ];

    public $translatable = [
        'title',
        'description_1',
        'description_2',
        'description_3',
        'features',
        'ground_floor_title',
        'ground_floor_description',
        'second_floor_title', 
        'second_floor_description'
    ];

    protected $casts = [
        'features' => 'array'
    ];
}
