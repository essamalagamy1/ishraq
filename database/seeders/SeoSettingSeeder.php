<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoSettings = [
            [
                'page' => 'home',
                'meta_title' => 'E-DATA 360 | شركة تطوير مواقع وتطبيقات احترافية',
                'meta_description' => 'E-DATA 360 شريكك في التحول الرقمي. نطور مواقع ويب، تطبيقات جوال، وحلول برمجية متكاملة باستخدام أحدث التقنيات. +200 مشروع منجز و99% رضا العملاء.',
            ],
            [
                'page' => 'about',
                'meta_title' => 'من نحن | E-DATA 360 - فريق تطوير محترف',
                'meta_description' => 'تعرف على فريق E-DATA 360 - مطورون ومصممون محترفون بخبرة +5 سنوات في تطوير الويب والتطبيقات. نحول أفكارك إلى منتجات رقمية ناجحة.',
            ],
            [
                'page' => 'services',
                'meta_title' => 'خدماتنا | تطوير مواقع وتطبيقات - E-DATA 360',
                'meta_description' => 'خدمات تطوير برمجية متكاملة: مواقع ويب، تطبيقات جوال iOS و Android، تصميم UI/UX، استضافة وDevOps، متاجر إلكترونية، وأنظمة إدارة محتوى.',
            ],
            [
                'page' => 'portfolio',
                'meta_title' => 'أعمالنا | معرض المشاريع - E-DATA 360',
                'meta_description' => 'استعرض معرض أعمالنا: متاجر إلكترونية، تطبيقات توصيل، أنظمة إدارة، منصات تعليمية، ومواقع شركات. +200 مشروع ناجح مع عملاء سعداء.',
            ],
            [
                'page' => 'contact',
                'meta_title' => 'تواصل معنا | E-DATA 360',
                'meta_description' => 'تواصل مع فريق E-DATA 360 لبدء مشروعك البرمجي. استشارة مجانية، عروض أسعار سريعة، ودعم فني متواصل. نحن هنا لتحويل فكرتك إلى واقع.',
            ],
            [
                'page' => 'request_design',
                'meta_title' => 'اطلب مشروعك | E-DATA 360',
                'meta_description' => 'أرسل طلبك الآن للحصول على عرض سعر مخصص لمشروعك البرمجي. موقع ويب، تطبيق جوال، أو نظام متكامل - نحن جاهزون لمساعدتك.',
            ],
        ];

        foreach ($seoSettings as $setting) {
            SeoSetting::create($setting);
        }
    }
}
