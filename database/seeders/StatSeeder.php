<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            // Home Page Stats
            [
                'page' => 'home',
                'icon' => 'fas fa-project-diagram',
                'number' => '+200',
                'label' => 'مشروع منجز',
                'description' => 'ويب وتطبيقات',
                'color_from' => 'cyan-400',
                'color_to' => 'blue-400',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'icon' => 'fas fa-mobile-alt',
                'number' => '+80',
                'label' => 'تطبيق جوال',
                'description' => 'iOS و Android',
                'color_from' => 'purple-400',
                'color_to' => 'pink-400',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'icon' => 'fas fa-trophy',
                'number' => '5+',
                'label' => 'سنوات خبرة',
                'description' => 'في التطوير البرمجي',
                'color_from' => 'blue-400',
                'color_to' => 'indigo-400',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'page' => 'home',
                'icon' => 'fas fa-smile',
                'number' => '99%',
                'label' => 'رضا العملاء',
                'description' => 'تقييم 5 نجوم',
                'color_from' => 'green-400',
                'color_to' => 'emerald-400',
                'order' => 4,
                'is_active' => true,
            ],
            // About Page Stats
            [
                'page' => 'about',
                'icon' => 'fas fa-users',
                'number' => '+150',
                'label' => 'عميل سعيد',
                'color_from' => 'cyan-400',
                'color_to' => 'blue-400',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'icon' => 'fas fa-code',
                'number' => '+200',
                'label' => 'مشروع برمجي',
                'color_from' => 'purple-400',
                'color_to' => 'pink-400',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'icon' => 'fas fa-trophy',
                'number' => '5+',
                'label' => 'سنوات خبرة',
                'color_from' => 'green-400',
                'color_to' => 'emerald-400',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'icon' => 'fas fa-smile',
                'number' => '99%',
                'label' => 'رضا العملاء',
                'color_from' => 'orange-400',
                'color_to' => 'red-400',
                'order' => 4,
                'is_active' => true,
            ],
            // Services Page Stats
            [
                'page' => 'services',
                'icon' => 'fas fa-briefcase',
                'number' => '6+',
                'label' => 'خدمات تقنية',
                'color_from' => 'cyan-400',
                'color_to' => 'blue-400',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'page' => 'services',
                'icon' => 'fas fa-laptop-code',
                'number' => '200+',
                'label' => 'مشروع منجز',
                'color_from' => 'purple-400',
                'color_to' => 'pink-400',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'page' => 'services',
                'icon' => 'fas fa-star',
                'number' => '99%',
                'label' => 'رضا العملاء',
                'color_from' => 'green-400',
                'color_to' => 'emerald-400',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            Stat::create($stat);
        }
    }
}
