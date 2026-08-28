@props(['seo' => null, 'breadcrumbs' => []])

@php
    $analyticsSettings = \App\Models\AnalyticsSetting::first();
    $companySettings = $companySettings ?? \App\Models\CompanySetting::first();
    $socialLinks = $socialLinks ?? \App\Models\SocialLink::where('is_active', true)->get();
    $whatsappClean = $companySettings ? preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') : '';
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0B0A08">

    {{-- Comprehensive SEO, GEO & Schema.org JSON-LD --}}
    <x-seo-meta :seo="$seo ?? null" :breadcrumbs="$breadcrumbs ?? []" />

    @if($companySettings && $companySettings->favicon_path)
        <link rel="icon" href="{{ Storage::url($companySettings->favicon_path) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @endif

    {{-- Font loading: preconnect + non-render-blocking stylesheet --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=IBM+Plex+Serif:ital,wght@0,300;0,400;0,500;0,600;1,400&family=IBM+Plex+Mono:wght@400;500&display=swap"
          media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=IBM+Plex+Serif:ital,wght@0,300;0,400;0,500;0,600;1,400&family=IBM+Plex+Mono:wght@400;500&display=swap">
    </noscript>

    @if($companySettings && $companySettings->logo_path)
        <link rel="preload" as="image" href="{{ Storage::url($companySettings->logo_path) }}" fetchpriority="high">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <noscript>
        <style>html:not(.is-ready) body { opacity: 1; }</style>
    </noscript>

    {{-- GA4 & GTM deferred: load after first interaction or 3s idle --}}
    @php
        $gaId = ($analyticsSettings && $analyticsSettings->ga_enabled) ? $analyticsSettings->ga_measurement_id : null;
        $gtmId = ($analyticsSettings && $analyticsSettings->gtm_enabled) ? $analyticsSettings->gtm_container_id : null;
    @endphp
    @if($gaId || $gtmId)
        <script>
            (function(){
                var loaded = false;
                function loadAnalytics(){
                    if(loaded) return;
                    loaded = true;
                    @if($gaId)
                    var gs = document.createElement('script');
                    gs.src = 'https://www.googletagmanager.com/gtag/js?id={{ $gaId }}';
                    gs.async = true;
                    document.head.appendChild(gs);
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', '{{ $gaId }}');
                    @endif
                    @if($gtmId)
                    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                    })(window,document,'script','dataLayer','{{ $gtmId }}');
                    @endif
                }
                var events = ['mouseover','touchstart','scroll','keydown'];
                events.forEach(function(e){ document.addEventListener(e, loadAnalytics, {once:true, passive:true}); });
                if(typeof requestIdleCallback === 'function'){
                    requestIdleCallback(function(){ setTimeout(loadAnalytics, 3000); });
                } else {
                    setTimeout(loadAnalytics, 3500);
                }
            })();
        </script>
    @endif
</head>
<body>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:right-4 focus:z-[200] focus:btn focus:btn--primary">تخطي إلى المحتوى</a>

    <x-navbar :companySettings="$companySettings" />

    <main id="main">
        {{ $slot }}
    </main>

    <x-footer :companySettings="$companySettings" :socialLinks="$socialLinks" />

    @if($whatsappClean)
        <a href="https://wa.me/{{ $whatsappClean }}"
           target="_blank"
           rel="noopener noreferrer"
           class="fab-wa"
           aria-label="تواصل عبر واتساب">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor" aria-hidden="true">
                <path d="M17.5 14.4c-.3-.1-1.7-.8-2-1-.3-.1-.5-.2-.7.2s-.8 1-1 1.2c-.2.2-.4.2-.7.1-.3-.1-1.2-.5-2.3-1.4-.9-.7-1.5-1.7-1.6-2-.2-.3 0-.5.1-.6.1-.1.3-.4.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.1-.7-1.7-1-2.3-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 3 1.2 3.2c.1.2 2.1 3.2 5.1 4.4 1.8.8 2.5.8 3.4.7.5-.1 1.7-.7 1.9-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3M12 22c-1.7 0-3.3-.4-4.7-1.3L3 22l1.3-4.1A10 10 0 1 1 12 22m0-18a8 8 0 0 0-6.8 12.3l-1 3.2 3.3-.9A8 8 0 1 0 12 4"/>
            </svg>
        </a>
    @endif

    {{-- GTM/GA4 already deferred in <head>, no duplicate scripts here --}}
</body>
</html>
