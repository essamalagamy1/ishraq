<?php

namespace Database\Seeders;

use App\Models\AnalyticsSetting;
use Illuminate\Database\Seeder;

class AnalyticsSettingsSeeder extends Seeder
{
    public function run(): void
    {
        AnalyticsSetting::create([
            'ga_enabled' => false,
            'ga_measurement_id' => null,
            'gtm_enabled' => false,
            'gtm_container_id' => null,
            'fb_pixel_enabled' => false,
            'fb_pixel_id' => null,
            'cookie_consent_enabled' => true,
            'analytics_cookies_default' => false,
            'marketing_cookies_default' => false,
            'preferences_cookies_default' => false,
        ]);
    }
}
