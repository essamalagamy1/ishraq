<?php

namespace Database\Seeders;

use App\Models\AnalyticsSetting;
use Illuminate\Database\Seeder;

class AnalyticsSettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        AnalyticsSetting::updateOrCreate(
            ['id' => 1],
            [
                'ga_enabled' => true,
                'ga_measurement_id' => env('GA_MEASUREMENT_ID', 'G-9YQKJP5371'),
                'ga_property_id' => env('ANALYTICS_PROPERTY_ID'), // Numeric Property ID for API
                'gtm_enabled' => false,
                'gtm_container_id' => null,
                'fb_pixel_enabled' => false,
                'fb_pixel_id' => null,
                'cookie_consent_enabled' => true,
                'analytics_cookies_default' => false,
                'marketing_cookies_default' => false,
                'preferences_cookies_default' => false,
            ]
        );
    }
}

