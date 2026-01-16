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
                'meta_title' => 'EDATA 360 - تحليل البيانات الاحترافي | لوحات تحكم Excel و Power BI',
                'meta_description' => 'شركة EDATA 360 متخصصة في تحليل البيانات وإنشاء لوحات التحكم الاحترافية باستخدام Excel و Power BI. أكثر من 150 عميل راضٍ و 200 لوحة تحكم تم تسليمها بنجاح.',
                'meta_keywords' => 'تحليل البيانات,لوحات تحكم,Excel,Power BI,KPI,تقارير تفاعلية,Business Intelligence,داشبورد,السعودية,EDATA 360',
                'og_title' => 'EDATA 360 - خبراء تحليل البيانات ولوحات التحكم',
                'og_description' => 'نحول بياناتك إلى رؤى قابلة للتنفيذ من خلال لوحات تحكم احترافية ومخصصة',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'twitter_site' => '@edata360',
                'robots' => 'index,follow',
                'ga4_measurement_id' => 'G-XXXXXXXXXX', // Replace with actual ID
                'gsc_verification_code' => 'google-site-verification-code-here', // Replace with actual code
                'gtm_container_id' => 'GTM-XXXXXXX', // Replace with actual ID
                'is_active' => true,
            ],

            // About Page
            [
                'page' => 'about',
                'meta_title' => 'من نحن - EDATA 360 | خبراء تحليل البيانات في السعودية',
                'meta_description' => 'تعرف على EDATA 360، فريق من الخبراء المتخصصين في تحليل البيانات وإنشاء لوحات التحكم الاحترافية. نساعد الشركات على اتخاذ قرارات مبنية على البيانات.',
                'meta_keywords' => 'عن EDATA 360,فريق تحليل البيانات,خبراء Power BI,محللي بيانات,السعودية,من نحن',
                'og_title' => 'من نحن - EDATA 360',
                'og_description' => 'فريق متخصص في تحويل البيانات المعقدة إلى رؤى واضحة وقابلة للتنفيذ',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Services Page
            [
                'page' => 'services',
                'meta_title' => 'خدماتنا - EDATA 360 | تحليل البيانات ولوحات التحكم الاحترافية',
                'meta_description' => 'نقدم خدمات متكاملة في تحليل البيانات، إنشاء لوحات تحكم Power BI و Excel، تصميم KPIs، تقارير تفاعلية، واستشارات Business Intelligence للشركات والمؤسسات.',
                'meta_keywords' => 'خدمات تحليل البيانات,لوحات تحكم Power BI,تقارير Excel,KPI Dashboard,Business Intelligence,استشارات البيانات,تحليل الأعمال',
                'og_title' => 'خدماتنا - حلول تحليل البيانات المتكاملة',
                'og_description' => 'من تحليل البيانات إلى لوحات التحكم التفاعلية - نوفر حلول شاملة لاحتياجاتك',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Portfolio Page
            [
                'page' => 'portfolio',
                'meta_title' => 'معرض الأعمال - EDATA 360 | لوحات تحكم ومشاريع سابقة',
                'meta_description' => 'استعرض معرض أعمالنا من لوحات التحكم الاحترافية والمشاريع المنجزة. أكثر من 200 مشروع ناجح في تحليل البيانات و Power BI و Excel لعملاء في مختلف القطاعات.',
                'meta_keywords' => 'معرض الأعمال,مشاريع سابقة,لوحات تحكم سابقة,Power BI projects,Excel dashboards,أمثلة لوحات تحكم,نماذج أعمال',
                'og_title' => 'معرض أعمالنا - مشاريع ناجحة في تحليل البيانات',
                'og_description' => 'شاهد أمثلة حية من مشاريعنا الناجحة ولوحات التحكم الاحترافية',
                'og_type' => 'website',
                'twitter_card' => 'summary_large_image',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Contact Page
            [
                'page' => 'contact',
                'meta_title' => 'تواصل معنا - EDATA 360 | احصل على استشارة مجانية',
                'meta_description' => 'تواصل مع فريق EDATA 360 للحصول على استشارة مجانية في تحليل البيانات ولوحات التحكم. نحن هنا لمساعدتك في تحويل بياناتك إلى قرارات ذكية.',
                'meta_keywords' => 'تواصل معنا,اتصل بنا,استشارة مجانية,خدمة العملاء,EDATA 360 السعودية,طلب عرض سعر',
                'og_title' => 'تواصل معنا - EDATA 360',
                'og_description' => 'احصل على استشارة مجانية وابدأ رحلتك في تحليل البيانات معنا',
                'og_type' => 'website',
                'twitter_card' => 'summary',
                'robots' => 'index,follow',
                'is_active' => true,
            ],

            // Request Design Page
            [
                'page' => 'request_design',
                'meta_title' => 'اطلب تصميم لوحة تحكم - EDATA 360 | خدمة سريعة واحترافية',
                'meta_description' => 'اطلب تصميم لوحة تحكم مخصصة لعملك. نوفر حلول Power BI و Excel احترافية مصممة خصيصاً لاحتياجاتك. تسليم سريع وجودة عالية مضمونة.',
                'meta_keywords' => 'طلب تصميم,تصميم لوحة تحكم,طلب داشبورد,Power BI مخصص,Excel dashboard,تصميم KPI,طلب عرض سعر',
                'og_title' => 'اطلب تصميم لوحة تحكم مخصصة',
                'og_description' => 'احصل على لوحة تحكم احترافية مصممة خصيصاً لاحتياجات عملك',
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

        $this->command->info('✅ تم إنشاء إعدادات SEO لجميع الصفحات (6 صفحات)');
    }
}
