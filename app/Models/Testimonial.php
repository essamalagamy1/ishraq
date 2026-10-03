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
        'source',
        'review_url',
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

    /**
     * Get the correct avatar URL whether it's an external link or local storage path.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (empty($this->client_avatar)) {
            return null;
        }

        if (str_starts_with($this->client_avatar, 'http://') || str_starts_with($this->client_avatar, 'https://')) {
            return $this->client_avatar;
        }

        return \Illuminate\Support\Facades\Storage::url($this->client_avatar);
    }
}

