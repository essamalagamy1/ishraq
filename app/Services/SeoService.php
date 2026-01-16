<?php

namespace App\Services;

use App\Models\SeoSetting;
use App\Models\CompanySetting;
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
        
        $defaults = [
            'meta_title' => config('app.name') . ' - تحليل البيانات الاحترافي',
            'meta_description' => 'شركة متخصصة في تحليل البيانات وإنشاء لوحات التحكم الاحترافية',
            'meta_keywords' => 'تحليل البيانات, لوحات تحكم, Excel, Power BI, KPI',
            'og_title' => config('app.name'),
            'og_description' => 'شركة متخصصة في تحليل البيانات',
            'og_type' => 'website',
            'og_image' => $company?->logo_path ? asset('storage/' . $company->logo_path) : null,
            'twitter_card' => 'summary_large_image',
            'canonical_url' => URL::current(),
            'robots' => 'index,follow',
        ];

        if ($seo) {
            return array_merge($defaults, array_filter([
                'meta_title' => $seo->meta_title,
                'meta_description' => $seo->meta_description,
                'meta_keywords' => $seo->meta_keywords,
                'og_title' => $seo->og_title ?? $seo->meta_title,
                'og_description' => $seo->og_description ?? $seo->meta_description,
                'og_type' => $seo->og_type,
                'og_image' => $seo->og_image ? asset('storage/' . $seo->og_image) : $defaults['og_image'],
                'twitter_card' => $seo->twitter_card,
                'twitter_site' => $seo->twitter_site,
                'twitter_creator' => $seo->twitter_creator,
                'canonical_url' => $seo->canonical_url ?? URL::current(),
                'robots' => $seo->robots,
                'structured_data' => $seo->structured_data,
                'ga4_measurement_id' => $seo->ga4_measurement_id,
                'gsc_verification_code' => $seo->gsc_verification_code,
                'gtm_container_id' => $seo->gtm_container_id,
            ]), $overrides);
        }

        return array_merge($defaults, $overrides);
    }

    /**
     * Generate Organization Schema
     */
    public function getOrganizationSchema(): array
    {
        $company = CompanySetting::first();
        
        if (!$company) {
            return [];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $company->company_name_ar ?? config('app.name'),
            'url' => url('/'),
            'logo' => $company->logo_path ? asset('storage/' . $company->logo_path) : null,
            'description' => $company->description ?? 'شركة متخصصة في تحليل البيانات',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'SA',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $company->phone,
                'contactType' => 'customer service',
                'email' => $company->email,
            ],
            'sameAs' => array_filter([
                $company->facebook_url,
                $company->twitter_url,
                $company->linkedin_url,
                $company->instagram_url,
            ]),
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
            'name' => config('app.name'),
            'url' => url('/'),
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
        $listItems = [];
        
        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
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
            'description' => $service->description,
            'provider' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Saudi Arabia',
            ],
        ];
    }

    /**
     * Generate Article Schema for Projects
     */
    public function getArticleSchema($project): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $project->title,
            'description' => $project->short_description,
            'image' => $project->main_image ? asset('storage/' . $project->main_image) : null,
            'datePublished' => $project->created_at->toIso8601String(),
            'dateModified' => $project->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
            ],
        ];
    }
}
