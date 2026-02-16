<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/ishraq_tech', 'is_active' => true],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/ishraq-tech', 'is_active' => true],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/ishraq.tech', 'is_active' => true],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/ishraq.tech', 'is_active' => true],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }
}
