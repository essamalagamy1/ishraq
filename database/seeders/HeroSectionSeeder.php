<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        $heroSections = [
            [
                'page' => 'home',
                'badge_icon' => 'fas fa-sun',
                'badge_text' => 'نُضيء طريق نجاحك الرقمي',
                'title_line1' => 'مع إشراق، أفكارك',
                'title_line2' => 'تتحول إلى واقع مُشرق',
                'subtitle' => 'نُبدع حلولاً رقمية مُشرقة ومُبتكرة. من مواقع الويب المتألقة إلى التطبيقات الذكية، نُنير رحلتك الرقمية بأحدث التقنيات والإبداع اللامحدود.',
                'cta_primary_text' => 'ابدأ مشروعك',
                'cta_primary_link' => '/request-a-design',
                'cta_secondary_text' => 'استكشف أعمالنا',
                'cta_secondary_link' => '/portfolio',
                'is_active' => true,
            ],
            [
                'page' => 'about',
                'badge_icon' => 'fas fa-lightbulb',
                'badge_text' => 'تعرف على إشراق',
                'title_line1' => 'نحن فريق',
                'title_line2' => 'إشراق المُبدع',
                'subtitle' => 'فريق شغوف من المبدعين والمطورين، نُشرق على مشاريعك بالابتكار والاحترافية لنُحولها إلى تحف رقمية تُضيء سماء النجاح',
                'is_active' => true,
            ],
            [
                'page' => 'services',
                'badge_icon' => 'fas fa-star',
                'badge_text' => 'حلول مُشرقة ومُبتكرة',
                'title_line1' => 'خدماتنا',
                'title_line2' => 'المُتألقة',
                'subtitle' => 'مجموعة متكاملة من الخدمات الرقمية المُشرقة، من تطوير الويب الحديث والتطبيقات الذكية إلى التصميم الإبداعي والحلول السحابية',
                'is_active' => true,
            ],
            [
                'page' => 'contact',
                'badge_icon' => 'fas fa-comments',
                'badge_text' => 'دعنا نُشرق معاً',
                'title_line1' => 'تواصل معنا',
                'title_line2' => 'وابدأ رحلتك',
                'subtitle' => 'لديك فكرة مُشرقة؟ شاركنا رؤيتك ودعنا نُحولها إلى واقع رقمي مُتألق يُضيء طريق نجاحك',
                'is_active' => true,
            ],
            [
                'page' => 'portfolio',
                'badge_icon' => 'fas fa-trophy',
                'badge_text' => 'مشاريعنا المُشرقة',
                'title_line1' => 'معرض',
                'title_line2' => 'إبداعاتنا',
                'subtitle' => 'اكتشف مجموعة من أروع المشاريع الرقمية التي أشرقنا عليها بلمساتنا الإبداعية وحولناها إلى قصص نجاح',
                'is_active' => true,
            ],
        ];

        foreach ($heroSections as $section) {
            HeroSection::create($section);
        }
    }
}
