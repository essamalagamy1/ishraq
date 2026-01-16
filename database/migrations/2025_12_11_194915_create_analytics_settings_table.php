<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('analytics_settings', function (Blueprint $table) {
            $table->id();
            
            // Google Analytics
            $table->boolean('ga_enabled')->default(false);
            $table->string('ga_measurement_id')->nullable()->comment('G-XXXXXXXXX for gtag.js tracking');
            $table->string('ga_property_id')->nullable()->comment('Numeric Property ID for Data API');

            // Google Tag Manager
            $table->boolean('gtm_enabled')->default(false);
            $table->string('gtm_container_id')->nullable();
            
            // Facebook Pixel
            $table->boolean('fb_pixel_enabled')->default(false);
            $table->string('fb_pixel_id')->nullable();
            
            // Cookie Consent Settings
            $table->boolean('cookie_consent_enabled')->default(true);
            $table->boolean('analytics_cookies_default')->default(false);
            $table->boolean('marketing_cookies_default')->default(false);
            $table->boolean('preferences_cookies_default')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_settings');
    }
};
