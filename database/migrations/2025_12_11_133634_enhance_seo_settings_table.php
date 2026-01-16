<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            // Meta Tags
            $table->text('meta_keywords')->nullable()->after('meta_description');
            
            // Open Graph
            $table->string('og_title')->nullable()->after('meta_keywords');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('og_type')->default('website')->after('og_image');
            
            // Twitter Cards
            $table->string('twitter_card')->default('summary_large_image')->after('og_type');
            $table->string('twitter_site')->nullable()->after('twitter_card');
            $table->string('twitter_creator')->nullable()->after('twitter_site');
            
            // Technical SEO
            $table->string('canonical_url')->nullable()->after('twitter_creator');
            $table->string('robots')->default('index,follow')->after('canonical_url');
            
            // Structured Data
            $table->json('structured_data')->nullable()->after('robots');
            
            // Analytics
            $table->string('ga4_measurement_id')->nullable()->after('structured_data');
            $table->string('gsc_verification_code')->nullable()->after('ga4_measurement_id');
            $table->string('gtm_container_id')->nullable()->after('gsc_verification_code');
            
            // Status
            $table->boolean('is_active')->default(true)->after('gtm_container_id');
        });
    }

    public function down(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
};
