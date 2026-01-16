<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'منصة تجارة إلكترونية متكاملة',
                'short_description' => 'متجر إلكتروني متكامل مع بوابات دفع وإدارة مخزون وتطبيق جوال مرافق.',
                'description' => 'تم تطوير منصة تجارة إلكترونية شاملة تتضمن واجهة مستخدم عصرية، لوحة تحكم متقدمة للإدارة، تكامل مع بوابات الدفع المحلية (مدى، Apple Pay)، نظام إدارة مخزون ذكي، وتطبيق جوال للعملاء بنظامي iOS و Android.',
                'main_image' => 'seeders/project1.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'تطبيق توصيل طلبات',
                'short_description' => 'تطبيق جوال لتوصيل الطلبات مع تتبع مباشر ونظام إدارة للسائقين.',
                'description' => 'تطبيق توصيل متكامل يشمل تطبيق العملاء، تطبيق السائقين، ولوحة تحكم للإدارة. يتميز بتتبع الطلبات في الوقت الفعلي، نظام تقييم، إشعارات فورية، وتكامل مع خرائط Google للتوجيه الذكي.',
                'main_image' => 'seeders/project2.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'نظام إدارة عيادات طبية',
                'short_description' => 'نظام متكامل لإدارة العيادات مع حجز مواعيد وسجلات المرضى الإلكترونية.',
                'description' => 'نظام ويب شامل لإدارة العيادات الطبية يتضمن نظام حجز مواعيد أونلاين، سجلات طبية إلكترونية، إدارة المخزون الطبي، نظام فوترة، وتقارير إحصائية. مع واجهة سهلة للمرضى لحجز المواعيد ومتابعة ملفاتهم.',
                'main_image' => 'seeders/project3.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'موقع شركة خدمات مالية',
                'short_description' => 'موقع احترافي لشركة خدمات مالية مع حاسبات تفاعلية وتقديم طلبات أونلاين.',
                'description' => 'تصميم وتطوير موقع إلكتروني احترافي لشركة خدمات مالية يتضمن حاسبات تمويل تفاعلية، نموذج تقديم طلبات متقدم، مدونة، وتحسين SEO. الموقع متوافق 100% مع الجوال ويحقق أعلى معايير الأداء.',
                'main_image' => 'seeders/project4.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'منصة تعليمية إلكترونية',
                'short_description' => 'منصة LMS متكاملة للتعليم عن بعد مع دورات فيديو واختبارات تفاعلية.',
                'description' => 'منصة تعليمية شاملة تتضمن نظام إدارة الدورات، بث فيديو مباشر ومسجل، اختبارات تفاعلية، شهادات آلية، نظام دفع متكامل، وتطبيق جوال للطلاب. مع لوحة تحكم للمدربين لإدارة محتواهم.',
                'main_image' => 'seeders/project5.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'تطبيق إدارة المهام للفرق',
                'short_description' => 'تطبيق ويب لإدارة المشاريع والمهام للفرق مع تعاون في الوقت الفعلي.',
                'description' => 'تطبيق SaaS لإدارة المشاريع والمهام يتضمن لوحات Kanban، تتبع الوقت، مشاركة الملفات، دردشة الفريق، تقارير الإنتاجية، وتكامل مع Slack و Google Calendar. مصمم لتحسين كفاءة الفرق والتعاون.',
                'main_image' => 'seeders/project6.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::create([
                'title' => $project['title'],
                'slug' => Str::slug($project['title']),
                'short_description' => $project['short_description'],
                'description' => $project['description'],
                'main_image' => $project['main_image'],
                'is_featured' => $project['is_featured'],
                'status' => 'published',
            ]);
        }
    }
}
