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
            'meta_title' => config('app.name', 'إشراق').' | تصميم وتطوير المنتجات والحلول الرقمية في السعودية',
            'meta_description' => 'شريكك الرائد في التحول الرقمي وتطوير المنتجات الرقمية في المملكة العربية السعودية. تصميم مواقع ويب، تطبيقات جوال iOS وAndroid، واجهات مستخدم UI/UX، ومتاجر إلكترونية متطورة.',
            'meta_keywords' => 'تصميم مواقع السعودية, برمجة تطبيقات الرياض, شركة برمجة السعودية, تصميم واجهات UI UX الرياض, تطوير متاجر إلكترونية سلة زد, استوديو حلول رقمية, التحول الرقمي السعودية, أفضل شركة تصميم مواقع في الرياض جدة, برمجة حلول SaaS السعودية',
            'og_title' => config('app.name', 'إشراق').' | حلول رقمية مبتكرة تصنع الفارق بالسعودية',
            'og_description' => 'شريكك التقني الموثوق لبناء وتطوير المنتجات الرقمية الحديثة بالمملكة العربية السعودية.',
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
     * Generate Organization & LocalBusiness Schema for Saudi Arabia
     */
    public function getOrganizationSchema(): array
    {
        $company = CompanySetting::first();
        $name = $company->company_name ?? config('app.name', 'إشراق');

        return [
            '@context' => 'https://schema.org',
            '@type' => ['Organization', 'ProfessionalService', 'LocalBusiness'],
            '@id' => url('/#organization'),
            'name' => $name,
            'alternateName' => ['Ishraq Digital Studio', 'إشراق للحلول الرقمية', 'إشراق استوديو تقني'],
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $company?->logo_path ? asset('storage/'.$company->logo_path) : url('/favicon.ico'),
                'width' => 512,
                'height' => 512,
            ],
            'image' => $company?->logo_path ? asset('storage/'.$company->logo_path) : null,
            'description' => $company?->about_short ?? 'استوديو سعودي متخصص في تصميم وتطوير المنتجات الرقمية الحديثة، المواقع الإلكترونية، وتطبيقات الجوال وحلول التحول الرقمي.',
            'priceRange' => '$$$',
            'currenciesAccepted' => 'SAR',
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
                'telephone' => $company?->phone_primary ?? '+966500000000',
                'contactType' => 'customer support and sales',
                'email' => $company?->main_email ?? 'info@ishraq.tech',
                'areaServed' => 'SA',
                'availableLanguage' => ['Arabic', 'English'],
            ],
            'knowsAbout' => [
                'تصميم المواقع الإلكترونية',
                'تطوير تطبيقات الجوال iOS و Android',
                'تصميم تجربة وواجهة المستخدم UI/UX Design',
                'بناء المتاجر الإلكترونية وحلول التجارة الرقمية',
                'الأنظمة الإدارية والسحابية SaaS',
                'التحول الرقمي للشركات السعودية',
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
     * Generate WebSite Schema
     */
    public function getWebSiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => url('/#website'),
            'name' => config('app.name', 'إشراق'),
            'alternateName' => 'إشراق للحلول الرقمية بالسعودية',
            'url' => url('/'),
            'inLanguage' => 'ar-SA',
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
