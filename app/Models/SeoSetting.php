<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_card',
        'twitter_site',
        'twitter_creator',
        'canonical_url',
        'robots',
        'structured_data',
        'ga4_measurement_id',
        'gsc_verification_code',
        'gtm_container_id',
        'is_active',
    ];

    protected $casts = [
        'structured_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get active SEO settings
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get SEO for specific page
     */
    public static function forPage(string $page)
    {
        return static::where('page', $page)->active()->first();
    }

    /**
     * Get meta keywords as array
     */
    public function getKeywordsArrayAttribute()
    {
        if (!$this->meta_keywords) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->meta_keywords));
    }
}
