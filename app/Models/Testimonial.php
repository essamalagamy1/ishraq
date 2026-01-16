<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'client_position',
        'client_company',
        'client_avatar',
        'rating',
        'testimonial',
        'badge_text',
        'badge_color_from',
        'badge_color_to',
        'is_verified',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
