<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/edata360', 'is_active' => true],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/edata360', 'is_active' => true],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/edata360', 'is_active' => true],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/edata360', 'is_active' => true],
        ];

        foreach ($links as $link) {
            SocialLink::create($link);
        }
    }
}
