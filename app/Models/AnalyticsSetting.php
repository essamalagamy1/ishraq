<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsSetting extends Model
{
    protected $fillable = [
        'ga_enabled',
        'ga_measurement_id',
        'ga_property_id',
        'gtm_enabled',
        'gtm_container_id',
        'fb_pixel_enabled',
        'fb_pixel_id',
        'cookie_consent_enabled',
        'analytics_cookies_default',
        'marketing_cookies_default',
        'preferences_cookies_default',
    ];

    protected $casts = [
        'ga_enabled' => 'boolean',
        'gtm_enabled' => 'boolean',
        'fb_pixel_enabled' => 'boolean',
        'cookie_consent_enabled' => 'boolean',
        'analytics_cookies_default' => 'boolean',
        'marketing_cookies_default' => 'boolean',
        'preferences_cookies_default' => 'boolean',
    ];
}
