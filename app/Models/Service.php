<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'color_from',
        'color_to',
        'badge_icon',
        'badge_color',
        'price_starting',
        'price_label',
        'duration',
        'cta_text',
        'cta_link',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    public function features()
    {
        return $this->hasMany(ServiceFeature::class)->orderBy('order');
    }
}
