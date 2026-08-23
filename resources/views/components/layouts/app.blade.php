@php
    $analyticsSettings = \App\Models\AnalyticsSetting::first();
    $companySettings = $companySettings ?? \App\Models\CompanySetting::first();
    $socialLinks = $socialLinks ?? \App\Models\SocialLink::where('is_active', true)->get();
    $whatsappClean = $companySettings ? preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') : '';
    $defaultMetaTitle = $companySettings->company_name ?? 'إشراق';
    $defaultMetaDescription = $companySettings->about_short ?? 'إشراق شريكك في التحول الرقمي. نُصمّم ونطوّر تجارب رقمية متينة وبمعايير عالية.';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0B0A08">

    <title>{{ $seo->meta_title ?? $defaultMetaTitle }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? $defaultMetaDescription }}">
    <meta name="keywords" content="تطوير مواقع, تطبيقات جوال, إشراق, حلول برمجية, تصميم منتجات">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->meta_title ?? $defaultMetaTitle }}">
    <meta property="og:description" content="{{ $seo->meta_description ?? $defaultMetaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">

    @if($companySettings && $companySettings->favicon_path)
        <link rel="icon" href="{{ Storage::url($companySettings->favicon_path) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @if($companySettings && $companySettings->logo_path)
        <link rel="preload" as="image" href="{{ Storage::url($companySettings->logo_path) }}" fetchpriority="high">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <noscript>
        <style>html:not(.is-ready) body { opacity: 1; }</style>
    </noscript>

    @if($analyticsSettings && $analyticsSettings->ga_enabled && $analyticsSettings->ga_measurement_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $analyticsSettings->ga_measurement_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $analyticsSettings->ga_measurement_id }}');
        </script>
    @endif

    @php
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $companySettings->company_name ?? 'إشراق',
            'url' => config('app.url', url('/')),
            'logo' => ($companySettings && $companySettings->logo_path) ? Storage::url($companySettings->logo_path) : asset('favicon.svg'),
            'description' => $seo->meta_description ?? $defaultMetaDescription,
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $companySettings->phone_primary ?? '',
                'contactType' => 'customer service',
                'availableLanguage' => ['Arabic', 'English'],
            ],
            'sameAs' => $socialLinks->pluck('url')->toArray(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
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

    @if($analyticsSettings && $analyticsSettings->gtm_enabled && $analyticsSettings->gtm_container_id)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $analyticsSettings->gtm_container_id }}');
        </script>
    @endif
</body>
</html>
