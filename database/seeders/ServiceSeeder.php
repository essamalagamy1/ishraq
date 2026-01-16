<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'تطوير الويب المُشرق',
                'short_description' => 'نُضيء عالمك الرقمي بمواقع ويب متألقة وتفاعلية مبنية بأحدث التقنيات (React, Next.js, Laravel) لتمنح مشروعك إشراقة استثنائية.',
                'description' => 'في إشراق، نُبدع مواقع ويب مُشرقة تجمع بين الجمال والأداء. نستخدم أحدث التقنيات مثل React، Next.js، وLaravel لنُنير طريقك الرقمي بحلول سريعة، آمنة، ومتوافقة مع جميع الأجهزة. كل موقع نُطوره يشع بالاحترافية والإبداع.',
                'icon' => 'fas fa-laptop-code',
            ],
            [
                'title' => 'تطبيقات الجوال الذكية',
                'short_description' => 'نُحول أفكارك إلى تطبيقات جوال مُشرقة تعمل بسلاسة على iOS و Android، تُضيء تجربة مستخدميك بالابتكار والسهولة.',
                'description' => 'تطبيقاتنا تشع بالذكاء والإبداع! نُطور تطبيقات جوال متألقة باستخدام React Native و Flutter، مع واجهات مستخدم جذابة وأداء سلس يُنير رحلة كل مستخدم. نُشرق على مشروعك بتطبيق يترك انطباعاً لا يُنسى.',
                'icon' => 'fas fa-mobile-screen-button',
            ],
            [
                'title' => 'تصميم UI/UX المُبدع',
                'short_description' => 'نُصمم واجهات مُشرقة وتجارب مستخدم ساحرة تُحول التعقيد إلى بساطة مُلهمة وتُضيء رحلة كل مستخدم.',
                'description' => 'تصاميمنا تُشرق بالإبداع! نُبدع واجهات مستخدم متألقة مبنية على أبحاث دقيقة وأفضل الممارسات. من Wireframes إلى Prototypes، نُنير كل خطوة بالابتكار لنمنح مستخدميك تجربة استثنائية تُضيء علامتك التجارية.',
                'icon' => 'fas fa-palette',
            ],
            [
                'title' => 'الاستضافة والحلول السحابية',
                'short_description' => 'نُنير بنيتك التحتية بحلول سحابية مُشرقة ومستقرة، لضمان تألق مشروعك دون انقطاع على مدار الساعة.',
                'description' => 'استضافة مُشرقة تُضيء مشروعك! نُوفر حلول DevOps متكاملة على AWS و Google Cloud، مع CI/CD، مراقبة ذكية، ونسخ احتياطي آلي. نضمن أمان عالي وأداء متألق يُنير طريق نجاحك الرقمي.',
                'icon' => 'fas fa-cloud',
            ],
            [
                'title' => 'أنظمة إدارة المحتوى المتقدمة',
                'short_description' => 'نُطور أنظمة CMS مُشرقة وسهلة لإدارة محتواك بكل يُسر، مع تحسين SEO ليُضيء موقعك في محركات البحث.',
                'description' => 'أنظمة إدارة محتوى تُشرق بالسهولة! نُطور CMS مخصصة أو نُخصص WordPress و Filament لتُنير عملية إدارة محتواك. نضمن سهولة الاستخدام، أداء عالي، وتوافق كامل مع SEO لإشراق موقعك في نتائج البحث.',
                'icon' => 'fas fa-file-lines',
            ],
            [
                'title' => 'التجارة الإلكترونية المُتألقة',
                'short_description' => 'نُشيّد متاجر إلكترونية مُشرقة ومتكاملة تُضيء طريق نجاحك التجاري مع بوابات دفع آمنة وإدارة ذكية للمخزون.',
                'description' => 'متاجر تُشرق بالنجاح! نبني متاجر إلكترونية متألقة باستخدام Shopify، WooCommerce، أو حلول مخصصة. نُنير تجربة التسوق بتكامل كامل مع بوابات الدفع، الشحن، وأدوات تسويق ذكية تُضيء مبيعاتك.',
                'icon' => 'fas fa-cart-shopping',
            ],
        ];

        foreach ($services as $service) {
            Service::create([
                'title' => $service['title'],
                'slug' => Str::slug($service['title']),
                'short_description' => $service['short_description'],
                'description' => $service['description'],
                'icon' => $service['icon'],
                'is_active' => true,
            ]);
        }
    }
}
