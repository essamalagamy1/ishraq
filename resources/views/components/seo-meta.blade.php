@props(['seo' => null, 'breadcrumbs' => [], 'schema' => null])

@php
    $seoService = app(\App\Services\SeoService::class);
    $currentPage = request()->route()?->getName() ?? 'home';
    
    // Get SEO data
    $seoData = $seo instanceof \App\Models\SeoSetting 
        ? $seoService->getPageSeo($seo->page) 
        : $seoService->getPageSeo($currentPage);
    
    // Get company settings
    $company = \App\Models\CompanySetting::first();
    $currentUrl = url()->current();
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
     2. GEO & SAUDI ARABIA REGIONAL TARGETING
     ================================================================ --}}
<meta name="geo.region" content="SA-01">
<meta name="geo.placename" content="Riyadh, Saudi Arabia">
<meta name="geo.position" content="24.7136;46.6753">
<meta name="ICBM" content="24.7136, 46.6753">
<meta name="country" content="SA">
<meta name="geo.country" content="Saudi Arabia">
<meta name="coverage" content="Saudi Arabia, GCC">
<meta name="target" content="all">
<meta name="audience" content="all">
<meta name="language" content="Arabic">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta http-equiv="content-language" content="ar-SA">

{{-- Language & Alternate Links --}}
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


