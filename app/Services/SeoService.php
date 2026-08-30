<?php

namespace App\Services;

use App\Models\CompanySetting;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\URL;

class SeoService
{
    /**
     * Get SEO data for a specific page
     */
    public function getPageSeo(string $page, array $overrides = []): array
    {
        $seo = SeoSetting::forPage($page);
        $company = CompanySetting::first();
        $analytics = \App\Models\AnalyticsSetting::first();

        $defaults = [
            'meta_title' => 'إشراق تك | شركة تصميم وتطوير الحلول البرمجية والمنتجات الرقمية',
            'meta_description' => 'إشراق تك (Ishraq Tech) - شريكك الرائد في التحول الرقمي وتطوير الحلول البرمجية. تصميم مواقع ويب، تطبيقات جوال iOS وAndroid، واجهات UI/UX، ومتاجر إلكترونية وحلول SaaS متطورة.',
            'meta_keywords' => 'إشراق, إشراق تك, Ishraq Tech, ishraq.tech, شركة إشراق, شركة برمجة السعودية, تصميم مواقع السعودية, برمجة تطبيقات الرياض, تصميم واجهات UI UX الرياض, تطوير متاجر إلكترونية سلة زد, شركة حلول رقمية, التحول الرقمي السعودية, أفضل شركة تصميم مواقع في الرياض جدة, برمجة حلول SaaS السعودية',
            'og_title' => 'إشراق تك | حلول رقمية وبرمجية مبتكرة تصنع الفارق',
            'og_description' => 'إشراق تك - شريكك التقني الموثوق لبناء وتطوير المنتجات الرقمية الحديثة والتطبيقات الذكية بالمملكة العربية السعودية والخليج.',
            'og_type' => 'website',
            'og_image' => $company?->logo_path ? asset('storage/'.$company->logo_path) : null,
            'twitter_card' => 'summary_large_image',
            'canonical_url' => URL::current(),
            'robots' => 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1',
            'ga4_measurement_id' => $analytics?->ga_measurement_id ?? 'G-JPMFLC695E',
            'gtm_container_id' => $analytics?->gtm_container_id ?? 'GTM-T59355DS',
        ];

        if ($seo) {
            return array_merge($defaults, array_filter([
                'meta_title' => $seo->meta_title,
                'meta_description' => $seo->meta_description,
                'meta_keywords' => $seo->meta_keywords,
                'og_title' => $seo->og_title ?? $seo->meta_title,
                'og_description' => $seo->og_description ?? $seo->meta_description,
                'og_type' => $seo->og_type ?? 'website',
                'og_image' => $seo->og_image ? asset('storage/'.$seo->og_image) : $defaults['og_image'],
                'twitter_card' => $seo->twitter_card ?? 'summary_large_image',
                'twitter_site' => $seo->twitter_site,
                'twitter_creator' => $seo->twitter_creator,
                'canonical_url' => $seo->canonical_url ?? URL::current(),
                'robots' => $seo->robots ?? $defaults['robots'],
                'structured_data' => $seo->structured_data,
                'ga4_measurement_id' => $seo->ga4_measurement_id ?: ($analytics?->ga_measurement_id ?? 'G-JPMFLC695E'),
                'gsc_verification_code' => $seo->gsc_verification_code,
                'gtm_container_id' => $seo->gtm_container_id ?: ($analytics?->gtm_container_id ?? 'GTM-T59355DS'),
            ]), $overrides);
        }

        return array_merge($defaults, $overrides);
    }

    /**
     * Generate Organization & LocalBusiness Schema for Saudi Arabia & International
     */
    public function getOrganizationSchema(): array
    {
        $company = CompanySetting::first();
        $name = $company->company_name ?? config('app.name', 'إشراق');

        return [
            '@context' => 'https://schema.org',
            '@type' => ['Organization', 'Corporation', 'ProfessionalService', 'LocalBusiness'],
            '@id' => url('/#organization'),
            'name' => 'إشراق تك | Ishraq Tech',
            'legalName' => 'شركة إشراق للحلول الرقمية والبرمجية',
            'alternateName' => [
                'إشراق تك',
                'Ishraq Tech',
                'إشراق',
                'ishraq.tech',
                'شركة إشراق',
                'شركة إشراق للتقنية',
                'إشراق للحلول الرقمية',
                'Ishraq Digital Company',
                'Ishraq Software Solutions',
            ],
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $company?->logo_path ? asset('storage/'.$company->logo_path) : url('/favicon.ico'),
                'width' => 512,
                'height' => 512,
            ],
            'image' => $company?->logo_path ? asset('storage/'.$company->logo_path) : null,
            'description' => $company?->about_short ?? 'إشراق تك - شركة متخصصة في تطوير البرمجيات، تصميم وتطوير المواقع الإلكترونية، تطبيقات الجوال iOS وAndroid، وحلول التحول الرقمي الحديثة.',
            'priceRange' => '$$$',
            'currenciesAccepted' => 'SAR, USD, AED, EGP',
            'paymentAccepted' => 'Mada, Apple Pay, Visa, Mastercard, Bank Transfer',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'طريق الملك فهد',
                'addressLocality' => 'الرياض',
                'addressRegion' => 'منطقة الرياض',
                'postalCode' => '12211',
                'addressCountry' => 'SA',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 24.7136,
                'longitude' => 46.6753,
            ],
            'areaServed' => [
                [
                    '@type' => 'Country',
                    'name' => 'المملكة العربية السعودية',
                    'alternateName' => 'Saudi Arabia',
                ],
                [
                    '@type' => 'City',
                    'name' => 'الرياض',
                    'alternateName' => 'Riyadh',
                ],
                [
                    '@type' => 'City',
                    'name' => 'جدة',
                    'alternateName' => 'Jeddah',
                ],
                [
                    '@type' => 'City',
                    'name' => 'الدمام',
                    'alternateName' => 'Dammam',
                ],
                [
                    '@type' => 'City',
                    'name' => 'الخبر',
                    'alternateName' => 'Khobar',
                ],
                [
                    '@type' => 'City',
                    'name' => 'مكة المكرمة',
                    'alternateName' => 'Makkah',
                ],
                [
                    '@type' => 'City',
                    'name' => 'المدينة المنورة',
                    'alternateName' => 'Madinah',
                ],
                [
                    '@type' => 'AdministrativeArea',
                    'name' => 'دول مجلس التعاون الخليجي',
                    'alternateName' => 'GCC Countries',
                ],
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $company?->phone_primary ?? '+201554468657',
                'contactType' => 'customer support and sales',
                'email' => $company?->main_email ?? 'info@ishraq.tech',
                'areaServed' => ['SA', 'EG', 'AE', 'GCC'],
                'availableLanguage' => ['Arabic', 'English'],
            ],
            'knowsAbout' => [
                'تصميم المواقع الإلكترونية',
                'تطوير تطبيقات الجوال iOS و Android',
                'تصميم تجربة وواجهة المستخدم UI/UX Design',
                'بناء المتاجر الإلكترونية وحلول التجارة الرقمية',
                'الأنظمة الإدارية والسحابية SaaS',
                'التحول الرقمي للشركات',
                'رؤية السعودية 2030 للتحول الرقمي',
            ],
            'sameAs' => array_values(array_filter([
                'https://twitter.com/ishraq_tech',
                'https://www.linkedin.com/company/ishraq',
                'https://www.instagram.com/ishraq',
            ])),
        ];
    }

    /**
     * Generate WebSite Schema with Sitelinks Searchbox
     */
    public function getWebSiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/#website'),
            'name' => 'إشراق تك | Ishraq Tech',
            'alternateName' => ['إشراق', 'إشراق تك', 'Ishraq Tech', 'شركة إشراق للحلول البرمجية'],
            'url' => url('/'),
            'inLanguage' => 'ar-SA',
            'publisher' => [
                '@id' => url('/#organization'),
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/portfolio?search={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate SiteNavigationElement Schema for Google Sitelinks
     */
    public function getSiteNavigationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => [
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 1,
                    'name' => 'من نحن',
                    'description' => 'تعرف على شركة إشراق تك وفريق العمل ورؤيتنا في الحلول البرمجية وتطوير المنتجات الرقمية',
                    'url' => route('about'),
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 2,
                    'name' => 'خدماتنا',
                    'description' => 'خدمات تطوير مواقع الويب، تطبيقات الجوال iOS وAndroid، تصميم UI/UX والمتاجر الإلكترونية',
                    'url' => route('services'),
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 3,
                    'name' => 'معرض الأعمال',
                    'description' => 'استعرض محفظة المشاريع والمنتجات الرقمية والتطبيقات التي تم تطويرها بواسطة إشراق',
                    'url' => route('portfolio'),
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 4,
                    'name' => 'المقالات والمدونة',
                    'description' => 'أحدث المقالات التقنية والمعرفية حول هندسة البرمجيات وتصميم الواجهات والتحول الرقمي',
                    'url' => route('articles'),
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 5,
                    'name' => 'تواصل معنا',
                    'description' => 'تواصل مع فريق إشراق تك للحصول على استشارة تقنية ودراسة لمشروعك',
                    'url' => route('contact'),
                ],
                [
                    '@type' => 'SiteNavigationElement',
                    'position' => 6,
                    'name' => 'اطلب مشروعك',
                    'description' => 'ابدأ مشروعك الرقمي وقدم مواصفات فكرتك للحصول على عرض سعر فني ومالي',
                    'url' => route('request-design.create'),
                ],
            ],
        ];
    }

    /**
     * Generate FAQPage Schema for Google Rich Snippets
     */
    public function getFaqSchema(array $faqs = []): array
    {
        if (empty($faqs)) {
            $faqs = [
                [
                    'q' => 'ما هي الخدمات التي تقدمها شركة إشراق تك (Ishraq Tech)؟',
                    'a' => 'تقدم شركة إشراق تك حلولاً رقمية وبرمجية متكاملة تشمل: تطوير مواقع الويب والمنصات السحابية SaaS، تصميم وبرمجة تطبيقات الجوال لأنظمة iOS وAndroid، تصميم واجهات وتجربة المستخدم UI/UX، وبناء المتاجر الإلكترونية وحلول التحول الرقمي.',
                ],
                [
                    'q' => 'كيف أبدأ مشروعي الرقمي مع إشراق تك؟',
                    'a' => 'يمكنك بدء مشروعك عبر تعبئة استمارة "اطلب مشروعك" أو التواصل معنا مباشرة عبر صفحة اتصل بنا أو الواتساب، وسيقوم فريقنا التقني بدراسة المتطلبات وتقديم مقترح فني وعرض سعر مدروس خلال 24 ساعة.',
                ],
                [
                    'q' => 'ما هي التقنيات المستخدمة في تطوير المواقع والتطبيقات؟',
                    'a' => 'نستخدم أحدث التقنيات البرمجية وأكثرها استقراراً مثل Laravel، PHP، React، Next.js، Vue.js، Flutter لتطبيقات الجوال، وTailwind CSS مع بنية تحتية سحابية آمنة تضمن أداءً فائقاً.',
                ],
                [
                    'q' => 'هل تقدم إشراق خدمات الدعم الفني والصيانة بعد تسليم المشروع؟',
                    'a' => 'نعم، نوفر خطط دعم فني متواصلة، صيانة دورية، تحديثات أمنية، ومتابعة لأداء الموقع والتطبيق لضمان استمرارية وكفاءة عمل مشروعك الرقمي.',
                ],
            ];
        }

        $items = [];
        foreach ($faqs as $faq) {
            $items[] = [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $items,
        ];
    }

    /**
     * Generate Breadcrumb Schema
     */
    public function getBreadcrumbSchema(array $items): array
    {
        $listItems = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'الرئيسية',
                'item' => url('/'),
            ],
        ];

        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 2,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }

    /**
     * Generate Service Schema
     */
    public function getServiceSchema($service): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service->title,
            'description' => $service->short_description ?? strip_tags($service->description),
            'provider' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'إشراق'),
                'url' => url('/'),
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Saudi Arabia',
                'alternateName' => 'المملكة العربية السعودية',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'خدمات التطوير والتصميم الرقمي في السعودية',
            ],
        ];
    }

    /**
     * Generate Article Schema for Projects or Blog
     */
    public function getArticleSchema($item): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $item->title,
            'description' => $item->short_description ?? $item->excerpt ?? '',
            'image' => $item->main_image ? asset('storage/'.$item->main_image) : ($item->featured_image ? asset('storage/'.$item->featured_image) : null),
            'datePublished' => $item->created_at ? $item->created_at->toIso8601String() : now()->toIso8601String(),
            'dateModified' => $item->updated_at ? $item->updated_at->toIso8601String() : now()->toIso8601String(),
            'inLanguage' => 'ar-SA',
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'إشراق'),
                'url' => url('/'),
            ],
            'author' => [
                '@type' => 'Organization',
                'name' => $item->author ?? config('app.name', 'إشراق'),
            ],
        ];
    }
}
