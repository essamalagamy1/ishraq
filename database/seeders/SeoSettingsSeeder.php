<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoSettings = [
            // Home Page
            [
                'page' => 'home',
                'meta_title' => 'إشراق | تطوير مواقع وتطبيقات احترافية - حلول برمجية متكاملة',
                'meta_description' => 'إشراق شريكك في التحول الرقمي. نطور مواقع ويب وتطبيقات جوال احترافية بأحدث التقنيات. أكثر من 200 مشروع منجز، حلول برمجية متكاملة، ودعم فني متواصل. ابدأ مشروعك الآن.',
                'meta_keywords' => 'تطوير مواقع,تطبيقات جوال,إشراق,شركة برمجة,حلول برمجية,تصميم مواقع,React,Laravel,Flutter,تطوير تطبيقات,السعودية,مصر',
                'og_title' => 'إشراق | حلول تطوير مواقع وتطبيقات احترافية',
                'og_description' => 'شريكك في التحول الرقمي - نطور مواقع ويب وتطبيقات جوال احترافية بأحدث التقنيات. ابدأ مشروعك الآن مع إشراق.',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'twitter_site' => '@ishraq_tech',
                'robots' => 'index,follow',
                'ga4_measurement_id' => env('GA_MEASUREMENT_ID'),
                'gsc_verification_code' => env('GSC_VERIFICATION_CODE'),
                'gtm_container_id' => env('GTM_CONTAINER_ID'),
                'is_active' => true,
            ],

            // About Page
            [
                'page' => 'about',
                'meta_title' => 'من نحن - إشراق | فريق تطوير مواقع وتطبيقات محترف',
                'meta_description' => 'تعرف على فريق إشراق - مطورون ومصممون محترفون بخبرة تزيد عن 5 سنوات في تطوير المواقع والتطبيقات. نحول أفكارك إلى حلول رقمية ناجحة بأحدث التقنيات والإبداع.',
                'meta_keywords' => 'فريق إشراق,شركة تطوير برمجيات,مطورون محترفون,خبرة تطوير,من نحن',
                'og_title' => 'من نحن - إشراق | فريق تطوير محترف',
                'og_description' => 'فريق شغوف من المبدعين والمطورين، نحول أفكارك إلى منتجات رقمية ناجحة',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Services Page
            [
                'page' => 'services',
                'meta_title' => 'خدماتنا - إشراق | تطوير مواقع وتطبيقات وحلول برمجية متكاملة',
                'meta_description' => 'خدمات تطوير برمجية متكاملة من إشراق: تطوير مواقع ويب، تطبيقات جوال iOS وAndroid، تصميم UI/UX، استضافة وDevOps، متاجر إلكترونية، وأنظمة إدارة محتوى. ابدأ مشروعك الآن.',
                'meta_keywords' => 'خدمات تطوير,مواقع ويب,تطبيقات جوال,تصميم UI/UX,متاجر إلكترونية,استضافة,DevOps,حلول برمجية',
                'og_title' => 'خدماتنا - حلول تطوير برمجية متكاملة من إشراق',
                'og_description' => 'من تطوير المواقع والتطبيقات إلى التصميم والاستضافة - حلول شاملة لاحتياجاتك التقنية',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Portfolio Page
            [
                'page' => 'portfolio',
                'meta_title' => 'أعمالنا - إشراق | معرض مشاريع تطوير مواقع وتطبيقات ناجحة',
                'meta_description' => 'استعرض معرض أعمال إشراق: متاجر إلكترونية، تطبيقات توصيل، أنظمة إدارة، منصات تعليمية، ومواقع شركات احترافية. أكثر من 200 مشروع ناجح مع عملاء سعداء.',
                'meta_keywords' => 'معرض أعمال,مشاريع ناجحة,تطوير متاجر,تطبيقات جوال,مواقع شركات,نماذج أعمال',
                'og_title' => 'أعمالنا - مشاريع تطوير ناجحة من إشراق',
                'og_description' => 'شاهد أمثلة حية من مشاريعنا الناجحة في تطوير المواقع والتطبيقات',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Contact Page
            [
                'page' => 'contact',
                'meta_title' => 'تواصل معنا - إشراق | استشارة مجانية لمشروعك البرمجي',
                'meta_description' => 'تواصل مع فريق إشراق للحصول على استشارة مجانية في تطوير المواقع والتطبيقات. نحن هنا لمساعدتك في تحويل فكرتك إلى مشروع رقمي ناجح. عروض أسعار سريعة ودعم فني متواصل.',
                'meta_keywords' => 'تواصل معنا,استشارة مجانية,طلب عرض سعر,خدمة العملاء,إشراق',
                'og_title' => 'تواصل معنا - إشراق',
                'og_description' => 'احصل على استشارة مجانية وابدأ مشروعك الرقمي مع إشراق',
                'og_type' => 'website',
                'twitter_card' => 'summary',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Request Design Page
            [
                'page' => 'request_design',
                'meta_title' => 'اطلب مشروعك الآن - إشراق | تطوير مواقع وتطبيقات احترافية',
                'meta_description' => 'أرسل طلبك الآن واحصل على عرض سعر مخصص لمشروعك البرمجي من إشراق. موقع ويب، تطبيق جوال، أو نظام متكامل - فريقنا جاهز لتحويل فكرتك إلى واقع رقمي مشرق.',
                'meta_keywords' => 'طلب تطوير,طلب مشروع,عرض سعر,تطوير موقع,تطوير تطبيق,إشراق',
                'og_title' => 'اطلب مشروعك الآن من إشراق',
                'og_description' => 'احصل على عرض سعر مخصص لمشروعك البرمجي - تسليم سريع وجودة عالية',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],
        ];

        foreach ($seoSettings as $setting) {
            SeoSetting::updateOrCreate(
                ['page' => $setting['page']],
                $setting
            );
        }

        $this->command->info('✅ تم تحديث إعدادات SEO لجميع الصفحات (6 صفحات)');
    }
}
