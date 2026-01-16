<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'page',
        'badge_icon',
        'badge_text',
        'title_line1',
        'title_line2',
        'subtitle',
        'cta_primary_text',
        'cta_primary_link',
        'cta_secondary_text',
        'cta_secondary_link',
        'background_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
