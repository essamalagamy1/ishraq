<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceFeature;
use Illuminate\Database\Seeder;

class ServiceUpdateSeeder extends Seeder
{
    public function run(): void
    {
        // Update existing services or create new ones
        $services = [
            [
                'title' => 'لوحات تحكم Excel الاحترافية',
                'slug' => 'excel-dashboards',
                'short_description' => 'تصميم لوحات تحكم تفاعلية متقدمة باستخدام Excel',
                'description' => 'تصميم لوحات تحكم تفاعلية متقدمة باستخدام Excel مع معادلات ديناميكية، جداول محورية، ورسوم بيانية احترافية',
                'icon' => 'fas fa-file-excel',
                'color_from' => 'green-500',
                'color_to' => 'emerald-500',
                'badge_icon' => 'fas fa-star',
                'badge_color' => 'yellow-400',
                'price_starting' => '320 ر.س',
                'price_label' => 'يبدأ من',
                'duration' => '3-5 أيام',
                'cta_text' => 'اطلب الآن',
                'cta_link' => '/request-a-design',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
                'features' => [
                    'تصميم احترافي وجذاب',
                    'معادلات متقدمة وديناميكية',
                    'جداول محورية تفاعلية',
                    'رسوم بيانية احترافية',
                    'سهولة في التحديث والاستخدام',
                ],
            ],
            [
                'title' => 'لوحات تحكم Power BI',
                'slug' => 'power-bi-dashboards',
                'short_description' => 'إنشاء تقارير تفاعلية متطورة مع تحديثات آلية فورية',
                'description' => 'إنشاء تقارير تفاعلية متطورة مع تحديثات آلية فورية، تصورات بيانية مذهلة، وإمكانية الوصول من أي مكان',
                'icon' => 'fas fa-chart-line',
                'color_from' => 'yellow-500',
                'color_to' => 'orange-500',
                'badge_icon' => 'fas fa-fire',
                'badge_color' => 'red-500',
                'price_starting' => '350 ر.س',
                'price_label' => 'يبدأ من',
                'duration' => '5-7 أيام',
                'cta_text' => 'اطلب الآن',
                'cta_link' => '/request-a-design',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
                'features' => [
                    'تحديثات تلقائية للبيانات',
                    'تفاعلية متقدمة جداً',
                    'وصول من أي جهاز',
                    'ربط بمصادر بيانات متعددة',
                    'مشاركة سهلة مع الفريق',
                ],
            ],
            [
                'title' => 'تحليل البيانات المتقدم',
                'slug' => 'data-analysis',
                'short_description' => 'تحليل شامل ومتعمق للبيانات لاستخراج رؤى قيمة',
                'description' => 'تحليل شامل ومتعمق للبيانات لاستخراج رؤى قيمة ومؤثرة تدعم قراراتك الاستراتيجية',
                'icon' => 'fas fa-database',
                'color_from' => 'blue-500',
                'color_to' => 'cyan-500',
                'badge_icon' => 'fas fa-bolt',
                'badge_color' => 'purple-500',
                'price_starting' => null,
                'price_label' => 'حسب المشروع',
                'duration' => 'حسب الحجم',
                'cta_text' => 'احصل على عرض سعر',
                'cta_link' => '/contact-us',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
                'features' => [
                    'تحليل إحصائي متقدم',
                    'استخراج رؤى قابلة للتنفيذ',
                    'تقارير تفصيلية شاملة',
                    'توصيات عملية',
                    'دراسة الاتجاهات والأنماط',
                ],
            ],
            [
                'title' => 'تتبع مؤشرات الأداء KPIs',
                'slug' => 'kpi-tracking',
                'short_description' => 'نظام متكامل وذكي لتتبع ومراقبة مؤشرات الأداء الرئيسية',
                'description' => 'نظام متكامل وذكي لتتبع ومراقبة مؤشرات الأداء الرئيسية بشكل لحظي ودقيق',
                'icon' => 'fas fa-tachometer-alt',
                'color_from' => 'purple-500',
                'color_to' => 'pink-500',
                'badge_icon' => 'fas fa-chart-bar',
                'badge_color' => 'blue-500',
                'price_starting' => null,
                'price_label' => 'حسب المشروع',
                'duration' => 'حسب الحجم',
                'cta_text' => 'احصل على عرض سعر',
                'cta_link' => '/contact-us',
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
                'features' => [
                    'مراقبة لحظية للأداء',
                    'تنبيهات ذكية تلقائية',
                    'تقارير دورية مفصلة',
                    'مقارنة بالأهداف',
                    'تحليل الأداء التاريخي',
                ],
            ],
            [
                'title' => 'ذكاء الأعمال BI',
                'slug' => 'business-intelligence',
                'short_description' => 'تحويل البيانات المعقدة إلى رؤى واضحة وقابلة للتنفيذ',
                'description' => 'تحويل البيانات المعقدة إلى رؤى واضحة وقابلة للتنفيذ لاتخاذ قرارات استراتيجية مبنية على الحقائق',
                'icon' => 'fas fa-lightbulb',
                'color_from' => 'orange-500',
                'color_to' => 'red-500',
                'badge_icon' => 'fas fa-brain',
                'badge_color' => 'yellow-400',
                'price_starting' => null,
                'price_label' => 'حسب المشروع',
                'duration' => 'حسب الحجم',
                'cta_text' => 'احصل على عرض سعر',
                'cta_link' => '/contact-us',
                'is_featured' => false,
                'is_active' => true,
                'order' => 5,
                'features' => [
                    'رؤى استراتيجية عميقة',
                    'تحليل تنبؤي متقدم',
                    'توصيات قابلة للتطبيق',
                    'تقارير تنفيذية',
                    'دعم اتخاذ القرار',
                ],
            ],
            [
                'title' => 'حلول مخصصة بالكامل',
                'slug' => 'custom-solutions',
                'short_description' => 'نصمم ونطور حلول مخصصة 100% لتلبية احتياجات عملك الفريدة',
                'description' => 'نصمم ونطور حلول مخصصة بنسبة 100% لتلبية احتياجات عملك الفريدة مهما كانت معقدة أو متطلبة',
                'icon' => 'fas fa-cogs',
                'color_from' => 'cyan-500',
                'color_to' => 'teal-500',
                'badge_icon' => 'fas fa-magic',
                'badge_color' => 'indigo-500',
                'price_starting' => null,
                'price_label' => 'حسب المشروع',
                'duration' => 'حسب الحجم',
                'cta_text' => 'احصل على عرض سعر',
                'cta_link' => '/contact-us',
                'is_featured' => false,
                'is_active' => true,
                'order' => 6,
                'features' => [
                    'تصميم حسب احتياجك',
                    'مرونة كاملة في التنفيذ',
                    'دعم فني مستمر',
                    'تدريب شامل',
                    'صيانة مجانية',
                ],
            ],
        ];

        foreach ($services as $serviceData) {
            $features = $serviceData['features'];
            unset($serviceData['features']);

            $service = Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );

            // Add features
            $service->features()->delete(); // Clear existing features
            foreach ($features as $index => $featureText) {
                ServiceFeature::create([
                    'service_id' => $service->id,
                    'feature_text' => $featureText,
                    'icon' => 'fas fa-check-circle',
                    'order' => $index + 1,
                ]);
            }
        }
    }
}
