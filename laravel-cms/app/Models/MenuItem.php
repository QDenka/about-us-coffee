<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'ingredients',
        'allergens',
        'is_available',
        'order',
    ];

    public $translatable = [
        'name',
        'description',
        'ingredients',
        'allergens',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'ingredients' => 'array',
        'allergens' => 'array',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
