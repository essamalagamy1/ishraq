<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders
        $this->call([
            UserSeeder::class,
            CompanySettingSeeder::class,
            SeoSettingSeeder::class,
            SeoSettingsSeeder::class, // New comprehensive SEO seeder
            ServiceSeeder::class,
            ProjectSeeder::class,
            SocialLinkSeeder::class,
            HeroSectionSeeder::class,
            StatSeeder::class,
            FeatureSeeder::class,
            TestimonialSeeder::class,
            ServiceUpdateSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
