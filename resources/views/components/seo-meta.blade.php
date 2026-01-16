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
@endphp

{{-- Basic Meta Tags --}}
<title>{{ $seoData['meta_title'] }}</title>
<meta name="description" content="{{ $seoData['meta_description'] }}">
@if(!empty($seoData['meta_keywords']))
<meta name="keywords" content="{{ is_array($seoData['meta_keywords']) ? implode(', ', $seoData['meta_keywords']) : $seoData['meta_keywords'] }}">
@endif
<meta name="author" content="{{ config('app.name') }}">
<meta name="robots" content="{{ $seoData['robots'] }}">
<link rel="canonical" href="{{ $seoData['canonical_url'] }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
<meta property="og:type" content="{{ $seoData['og_type'] }}">
<meta property="og:url" content="{{ url()->current() }}">
@if(!empty($seoData['og_image']))
<meta property="og:image" content="{{ $seoData['og_image'] }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="ar_SA">

{{-- Twitter Card Meta Tags --}}
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

{{-- Google Search Console Verification --}}
@if(!empty($seoData['gsc_verification_code']))
<meta name="google-site-verification" content="{{ $seoData['gsc_verification_code'] }}">
@endif

{{-- Structured Data (JSON-LD) --}}
<script type="application/ld+json">
{!! json_encode($seoService->getOrganizationSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode($seoService->getWebSiteSchema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>

@if(!empty($breadcrumbs))
<script type="application/ld+json">
{!! json_encode($seoService->getBreadcrumbSchema($breadcrumbs), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif

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

{{-- Google Analytics 4 --}}
@if(!empty($seoData['ga4_measurement_id']))
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoData['ga4_measurement_id'] }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $seoData['ga4_measurement_id'] }}');
</script>
@endif

{{-- Google Tag Manager --}}
@if(!empty($seoData['gtm_container_id']))
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $seoData['gtm_container_id'] }}');</script>
@endif
