@props(['seo' => null, 'breadcrumbs' => [], 'schema' => null])

@php
    $seoService = app(\App\Services\SeoService::class);
    $currentPage = request()->route()?->getName() ?? 'home';
    
    // Get company settings
    $company = \App\Models\CompanySetting::first();
    $currentUrl = url()->current();

    // Get SEO data
    if ($seo instanceof \App\Models\SeoSetting) {
        $seoData = $seoService->getPageSeo($seo->page);
    } elseif ($seo instanceof \App\Models\Project) {
        $defaultSeo = $seoService->getPageSeo('portfolio');
        $seoData = [
            'meta_title' => $seo->title . ' | إشراق تك (Ishraq Tech)',
            'meta_description' => $seo->short_description ?: \Illuminate\Support\Str::limit(strip_tags($seo->description), 160),
            'meta_keywords' => 'مشروع ' . $seo->title . ', إشراق تك, أعمال إشراق, شركة إشراق, تطوير برمجيات',
            'og_title' => $seo->title . ' | إشراق تك',
            'og_description' => $seo->short_description ?: \Illuminate\Support\Str::limit(strip_tags($seo->description), 160),
            'og_type' => 'article',
            'og_image' => $seo->main_image ? asset('storage/'.$seo->main_image) : ($defaultSeo['og_image'] ?? null),
            'twitter_card' => 'summary_large_image',
            'canonical_url' => route('projects.show', $seo->slug),
            'robots' => 'index,follow',
            'ga4_measurement_id' => $defaultSeo['ga4_measurement_id'] ?? null,
            'gtm_container_id' => $defaultSeo['gtm_container_id'] ?? null,
            'structured_data' => null,
        ];
    } elseif ($seo instanceof \App\Models\Article) {
        $defaultSeo = $seoService->getPageSeo('articles');
        $seoData = [
            'meta_title' => ($seo->meta_title ?: $seo->title) . ' | مدونة إشراق تك',
            'meta_description' => $seo->meta_description ?: ($seo->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($seo->content), 160)),
            'meta_keywords' => 'مقال ' . $seo->title . ', إشراق تك, Ishraq Tech, مدونة إشراق, شركة إشراق',
            'og_title' => $seo->title . ' | مدونة إشراق تك',
            'og_description' => $seo->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($seo->content), 160),
            'og_type' => 'article',
            'og_image' => $seo->featured_image ? asset('storage/'.$seo->featured_image) : ($defaultSeo['og_image'] ?? null),
            'twitter_card' => 'summary_large_image',
            'canonical_url' => route('articles.show', $seo->slug),
            'robots' => 'index,follow',
            'ga4_measurement_id' => $defaultSeo['ga4_measurement_id'] ?? null,
            'gtm_container_id' => $defaultSeo['gtm_container_id'] ?? null,
            'structured_data' => null,
        ];
    } else {
        $seoData = $seoService->getPageSeo($currentPage);
    }
@endphp

{{-- ================================================================
     1. BASIC SEO META TAGS
     ================================================================ --}}
<title>{{ $seoData['meta_title'] }}</title>
<meta name="description" content="{{ $seoData['meta_description'] }}">
@if(!empty($seoData['meta_keywords']))
<meta name="keywords" content="{{ is_array($seoData['meta_keywords']) ? implode(', ', $seoData['meta_keywords']) : $seoData['meta_keywords'] }}">
@endif
<meta name="author" content="{{ config('app.name', 'إشراق') }}">
<meta name="robots" content="{{ $seoData['robots'] }}">
<link rel="canonical" href="{{ $seoData['canonical_url'] ?? $currentUrl }}">

{{-- ================================================================
     2. GEO & MULTI-REGIONAL TARGETING (دمياط الجديدة، مصر & السعودية)
     ================================================================ --}}
<meta name="geo.region" content="EG-DT, SA-01">
<meta name="geo.placename" content="New Damietta, Damietta, Riyadh, Egypt, Saudi Arabia">
<meta name="geo.position" content="31.4397;31.6644">
<meta name="ICBM" content="31.4397, 31.6644">
<meta name="country" content="EG, SA">
<meta name="geo.country" content="Egypt, Saudi Arabia">
<meta name="coverage" content="Egypt, New Damietta, Saudi Arabia, Riyadh, Jeddah, GCC">
<meta name="target" content="all">
<meta name="audience" content="all">
<meta name="language" content="Arabic">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta http-equiv="content-language" content="ar-EG, ar-SA, ar">

{{-- Language & Alternate Links --}}
<link rel="alternate" hreflang="ar-EG" href="{{ $currentUrl }}">
<link rel="alternate" hreflang="ar-SA" href="{{ $currentUrl }}">
<link rel="alternate" hreflang="ar" href="{{ $currentUrl }}">
<link rel="alternate" hreflang="x-default" href="{{ $currentUrl }}">

{{-- ================================================================
     3. OPEN GRAPH META TAGS (Facebook, LinkedIn, WhatsApp)
     ================================================================ --}}
<meta property="og:site_name" content="{{ config('app.name', 'إشراق') }}">
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
<meta property="og:type" content="{{ $seoData['og_type'] }}">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:locale" content="ar_SA">
<meta property="og:locale:alternate" content="ar_EG">
<meta property="og:locale:alternate" content="ar_AE">
@if(!empty($seoData['og_image']))
<meta property="og:image" content="{{ $seoData['og_image'] }}">
<meta property="og:image:secure_url" content="{{ $seoData['og_image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $seoData['og_title'] }}">
@endif

{{-- ================================================================
     4. TWITTER CARD META TAGS
     ================================================================ --}}
<meta name="twitter:card" content="{{ $seoData['twitter_card'] }}">
<meta name="twitter:title" content="{{ $seoData['og_title'] }}">
<meta name="twitter:description" content="{{ $seoData['og_description'] }}">
@if(!empty($seoData['og_image']))
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">
@endif
@if(!empty($seoData['twitter_site']))
<meta name="twitter:site" content="{{ $seoData['twitter_site'] }}">
@endif
@if(!empty($seoData['twitter_creator']))
<meta name="twitter:creator" content="{{ $seoData['twitter_creator'] }}">
@endif

{{-- ================================================================
     5. VERIFICATION TAGS
     ================================================================ --}}
@if(!empty($seoData['gsc_verification_code']))
<meta name="google-site-verification" content="{{ $seoData['gsc_verification_code'] }}">
@endif

{{-- ================================================================
     6. STRUCTURED DATA (JSON-LD)
     ================================================================ --}}
{{-- Organization & LocalBusiness Schema --}}
<script type="application/ld+json">
{!! json_encode($seoService->getOrganizationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

{{-- WebSite Schema --}}
<script type="application/ld+json">
{!! json_encode($seoService->getWebSiteSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

{{-- Site Navigation Schema (Google Sitelinks) --}}
<script type="application/ld+json">
{!! json_encode($seoService->getSiteNavigationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

{{-- FAQ Schema (Google Rich Snippets) --}}
@if($currentPage === 'home' || $currentPage === 'services' || str_contains($currentUrl, 'contact') || str_contains($currentUrl, 'about'))
<script type="application/ld+json">
{!! json_encode($seoService->getFaqSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- Breadcrumbs Schema --}}
@if(!empty($breadcrumbs))
<script type="application/ld+json">
{!! json_encode($seoService->getBreadcrumbSchema($breadcrumbs), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

{{-- Custom Page / Service / Article Schema --}}
@if(!empty($schema))
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if(!empty($seoData['structured_data']))
<script type="application/ld+json">
{!! is_array($seoData['structured_data']) ? json_encode($seoData['structured_data'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : $seoData['structured_data'] !!}
</script>
@endif

{{-- Analytics & Tag Managers are loaded via components/layouts/app.blade.php with deferred/idle strategy --}}


