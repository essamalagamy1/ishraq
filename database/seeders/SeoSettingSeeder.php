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
                'meta_title' => 'إشراق | شركة تطوير مواقع وتطبيقات احترافية',
                'meta_description' => 'إشراق شريكك في التحول الرقمي. نطور مواقع ويب، تطبيقات جوال، وحلول برمجية متكاملة باستخدام أحدث التقنيات. +200 مشروع منجز و99% رضا العملاء.',
            ],
            [
                'page' => 'about',
                'meta_title' => 'من نحن | إشراق - فريق تطوير محترف',
                'meta_description' => 'تعرف على فريق إشراق - مطورون ومصممون محترفون بخبرة +5 سنوات في تطوير الويب والتطبيقات. نحول أفكارك إلى منتجات رقمية ناجحة.',
            ],
            [
                'page' => 'services',
                'meta_title' => 'خدماتنا | تطوير مواقع وتطبيقات - إشراق',
                'meta_description' => 'خدمات تطوير برمجية متكاملة: مواقع ويب، تطبيقات جوال iOS و Android، تصميم UI/UX، استضافة وDevOps، متاجر إلكترونية، وأنظمة إدارة محتوى.',
            ],
            [
                'page' => 'portfolio',
                'meta_title' => 'أعمالنا | معرض المشاريع - إشراق',
                'meta_description' => 'استعرض معرض أعمالنا: متاجر إلكترونية، تطبيقات توصيل، أنظمة إدارة، منصات تعليمية، ومواقع شركات. +200 مشروع ناجح مع عملاء سعداء.',
            ],
            [
                'page' => 'contact',
                'meta_title' => 'تواصل معنا | إشراق',
                'meta_description' => 'تواصل مع فريق إشراق لبدء مشروعك البرمجي. استشارة مجانية، عروض أسعار سريعة، ودعم فني متواصل. نحن هنا لتحويل فكرتك إلى واقع.',
            ],
            [
                'page' => 'request_design',
                'meta_title' => 'اطلب مشروعك | إشراق',
                'meta_description' => 'أرسل طلبك الآن للحصول على عرض سعر مخصص لمشروعك البرمجي. موقع ويب، تطبيق جوال، أو نظام متكامل - نحن جاهزون لمساعدتك.',
            ],
        ];

        foreach ($seoSettings as $setting) {
            SeoSetting::create($setting);
        }
    }
}
