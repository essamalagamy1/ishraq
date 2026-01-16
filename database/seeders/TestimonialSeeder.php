<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'أحمد الغامدي',
                'client_position' => 'مؤسس ومدير تنفيذي',
                'client_company' => 'متجر إلكتروني',
                'rating' => 5,
                'testimonial' => 'فريق محترف بكل ما تعنيه الكلمة! طوروا لنا متجراً إلكترونياً متكاملاً في وقت قياسي. الجودة والاهتمام بالتفاصيل فاق توقعاتنا. زادت مبيعاتنا 150% خلال 6 أشهر!',
                'badge_text' => 'عميل VIP',
                'badge_color_from' => 'blue-600',
                'badge_color_to' => 'cyan-500',
                'is_verified' => true,
                'is_featured' => true,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'نورة السبيعي',
                'client_position' => 'مديرة التقنية',
                'client_company' => 'شركة ناشئة',
                'rating' => 5,
                'testimonial' => 'تعاملنا معهم في تطوير تطبيق الجوال الخاص بنا. الكود نظيف، التوثيق ممتاز، والدعم الفني سريع جداً. أفضل قرار اتخذناه هو التعاقد معهم!',
                'badge_text' => 'شريك نجاح',
                'badge_color_from' => 'purple-600',
                'badge_color_to' => 'pink-500',
                'is_verified' => true,
                'is_featured' => true,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'عبدالله الحربي',
                'client_position' => 'صاحب عيادة',
                'client_company' => 'عيادة طبية',
                'rating' => 5,
                'testimonial' => 'نظام إدارة العيادة الذي طوروه لنا غير طريقة عملنا بالكامل. المرضى سعيدون بسهولة الحجز، والفريق الطبي أصبح أكثر كفاءة. استثمار ممتاز!',
                'badge_text' => 'عميل مميز',
                'badge_color_from' => 'green-600',
                'badge_color_to' => 'emerald-500',
                'is_verified' => true,
                'is_featured' => true,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'client_name' => 'سلمان العتيبي',
                'client_position' => 'مدير المنتج',
                'client_company' => 'شركة SaaS',
                'rating' => 5,
                'testimonial' => 'عملنا معهم على منصة تعليمية كبيرة. التزامهم بالمواعيد وجودة التنفيذ مذهلة. يفهمون متطلبات العمل بسرعة ويقدمون حلول إبداعية.',
                'badge_text' => 'عميل دائم',
                'badge_color_from' => 'orange-600',
                'badge_color_to' => 'red-500',
                'is_verified' => true,
                'is_featured' => false,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'client_name' => 'لمى الشمري',
                'client_position' => 'مديرة التسويق',
                'client_company' => 'وكالة تسويق',
                'rating' => 5,
                'testimonial' => 'موقعنا الجديد رفع معدل التحويل 3 أضعاف! التصميم عصري واحترافي، والسرعة فائقة. شكراً لفريق E-DATA 360 على الإبداع.',
                'badge_text' => 'عميلة راضية',
                'badge_color_from' => 'indigo-600',
                'badge_color_to' => 'blue-500',
                'is_verified' => true,
                'is_featured' => false,
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
