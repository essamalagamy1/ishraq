<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            // Why Choose Us Features (Home Page)
            [
                'section' => 'why_choose_us',
                'icon' => 'fas fa-sparkles',
                'title' => 'كود مُشرق ونظيف',
                'description' => 'نكتب كوداً يُشرق بالجودة والوضوح، قابل للقراءة والصيانة، مع توثيق شامل يُنير الطريق لفريقك المستقبلي',
                'color_from' => 'cyan-500',
                'color_to' => 'blue-600',
                'badge_text' => 'معايير عالمية',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section' => 'why_choose_us',
                'icon' => 'fas fa-bolt',
                'title' => 'تقنيات متألقة',
                'description' => 'نستخدم أحدث التقنيات المُشرقة مثل React، Next.js، Laravel، Flutter لنُضيء مشروعك بأداء استثنائي ومتميز',
                'color_from' => 'purple-500',
                'color_to' => 'pink-600',
                'badge_text' => 'تقنيات 2025',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'why_choose_us',
                'icon' => 'fas fa-hands-helping',
                'title' => 'دعم مُستمر ومُشرق',
                'description' => 'نُنير طريقك بدعم فني متواصل بعد التسليم، مع صيانة دورية وتحديثات أمنية لضمان إشراق مشروعك المستمر',
                'color_from' => 'green-500',
                'color_to' => 'emerald-600',
                'badge_text' => 'دعم 24/7',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'why_choose_us',
                'icon' => 'fas fa-shield-check',
                'title' => 'أمان ساطع',
                'description' => 'نُشرق على مشروعك بأعلى معايير الأمان وأفضل الممارسات لحماية بياناتك وبيانات عملائك بدرع مُتألق',
                'color_from' => 'orange-500',
                'color_to' => 'red-600',
                'badge_text' => 'حماية كاملة',
                'order' => 4,
                'is_active' => true,
            ],
            // Core Values (About Page)
            [
                'section' => 'core_values',
                'icon' => 'fas fa-gem',
                'title' => 'الاحترافية المُشرقة',
                'description' => 'نُشرق بأعلى معايير الجودة والاحترافية في كل سطر كود نكتبه وكل تصميم نُبدعه، لنُضيء مشاريعك بالتميز.',
                'color_from' => 'blue-500',
                'color_to' => 'cyan-500',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section' => 'core_values',
                'icon' => 'fas fa-brain',
                'title' => 'الابتكار المُتألق',
                'description' => 'نُنير طريق التطور بأحدث التقنيات والأساليب المُبتكرة، لتقديم حلول مُشرقة ومتطورة تُضيء المستقبل.',
                'color_from' => 'purple-500',
                'color_to' => 'pink-500',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'core_values',
                'icon' => 'fas fa-hands-holding-heart',
                'title' => 'شراكة مُضيئة',
                'description' => 'نعمل كشركاء حقيقيين مع عملائنا، نُشرق معاً في رحلة النجاح ونحرص على تحقيق أهدافهم المُتألقة.',
                'color_from' => 'green-500',
                'color_to' => 'emerald-500',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'core_values',
                'icon' => 'fas fa-hourglass-start',
                'title' => 'الالتزام المُشرق',
                'description' => 'نحترم وقتك ونُنير طريقك بالالتزام الكامل بتسليم المشاريع في المواعيد المحددة دون تأخير.',
                'color_from' => 'orange-500',
                'color_to' => 'red-500',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'core_values',
                'icon' => 'fas fa-chart-line',
                'title' => 'التطوير المُستمر',
                'description' => 'نواكب أحدث التطورات التقنية المُشرقة ونُطور مهاراتنا باستمرار لنُنير عالمك بأفضل الحلول.',
                'color_from' => 'cyan-500',
                'color_to' => 'teal-500',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'core_values',
                'icon' => 'fas fa-user-check',
                'title' => 'التركيز المُتألق على العميل',
                'description' => 'نضع احتياجات عملائنا في بؤرة الإشراق ونعمل بشغف على تحقيق رؤيتهم وإضاءة طريق نجاحهم.',
                'color_from' => 'indigo-500',
                'color_to' => 'purple-500',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
