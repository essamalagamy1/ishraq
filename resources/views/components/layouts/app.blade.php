<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <!-- Google tag (gtag.js) -->
    @php
        $analyticsSettings = \App\Models\AnalyticsSetting::first();
    @endphp
    @if($analyticsSettings && $analyticsSettings->ga_enabled && $analyticsSettings->ga_measurement_id)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $analyticsSettings->ga_measurement_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $analyticsSettings->ga_measurement_id }}');
    </script>
    @endif


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title>{{ $seo->meta_title ?? 'إشراق | تطوير مواقع وتطبيقات احترافية - حلول برمجية متكاملة' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'إشراق شريكك في التحول الرقمي. نطور مواقع ويب وتطبيقات جوال احترافية بأحدث التقنيات.' }}">
    <meta name="keywords" content="تطوير مواقع, تطبيقات جوال, إشراق, حلول برمجية">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    @if(isset($companySettings) && $companySettings->favicon_path)
        <link rel="icon" href="{{ Storage::url($companySettings->favicon_path) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @endif

    <!-- Preconnect to critical origins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Preload LCP Image (Logo) -->
    @if(isset($companySettings) && $companySettings->logo_path)
        <link rel="preload" as="image" href="{{ Storage::url($companySettings->logo_path) }}" fetchpriority="high">
    @endif

    <!-- Vite Assets (CSS & JS) - Critical for eliminating FOUC -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Critical Inline Styles for Loader & Layout Shift Prevention -->
    <style>
        :root {
            --color-primary: {{ config('colors.primary') }};
            --color-primary-light: {{ config('colors.primary_light') }};
            --color-bg-dark: #0a0d14;
        }
        body { 
            background-color: #0a0d14; 
            color: white; 
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        .min-h-screen { min-height: 100vh; }
        #page-loader { background: #0a0d14; position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; transition: opacity 0.6s ease-out; }
        .spinner { width: 50px; height: 50px; border: 4px solid rgba(255,255,255,0.05); border-top: 4px solid #FF6B35; border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        #app-content { opacity: 0; transition: opacity 0.8s ease-in-out; }
        .navbar-modern { min-height: 80px; }
    </style>

    <!-- Post-load External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Deferred External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" media="print" onload="this.media='all'">

    <style>
        :root {
            /* Primary Colors - Deep Blue */
            --color-primary: {{ config('colors.primary') }};
            --color-primary-light: {{ config('colors.primary_light') }};
            --color-primary-lighter: {{ config('colors.primary_lighter') }};
            --color-primary-dark: {{ config('colors.primary_dark') }};

            /* Background Colors */
            --color-bg-dark: {{ config('colors.bg_dark') }};
            --color-bg-dark-lighter: {{ config('colors.bg_dark_lighter') }};

            /* Accent Colors */
            --color-accent-green: {{ config('colors.accent_green') }};
            --color-accent-red: {{ config('colors.accent_red') }};
            --color-accent-yellow: {{ config('colors.accent_yellow') }};
            --color-accent-blue: {{ config('colors.accent_blue') }};

            /* Gradient */
            --gradient-primary: linear-gradient(to right, var(--color-primary), var(--color-primary-light));
            --gradient-dark: linear-gradient(135deg, var(--color-bg-dark), var(--color-bg-dark-lighter));

            /* Shadows */
            --shadow-primary: 0 0 20px {{ config('colors.primary_30') }};
            --shadow-primary-strong: 0 0 40px rgba(13, 27, 42, 0.5);

            /* Transparency variations */
            --color-primary-10: {{ config('colors.primary_10') }};
            --color-primary-15: {{ config('colors.primary_15') }};
            --color-primary-20: {{ config('colors.primary_20') }};
            --color-primary-30: {{ config('colors.primary_30') }};
        }
    </style>

    <!-- JSON-LD Structured Data -->
    @php
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => isset($companySettings) ? $companySettings->company_name : 'إشراق',
            'url' => config('app.url', 'https://ishraq.tech'),
            'logo' => isset($companySettings) && $companySettings->logo_path ? Storage::url($companySettings->logo_path) : asset('favicon.svg'),
            'description' => $seo->meta_description ?? 'إشراق شريكك في التحول الرقمي. نطور مواقع ويب وتطبيقات جوال احترافية بأحدث التقنيات.',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => isset($companySettings) ? $companySettings->phone_primary : '',
                'contactType' => 'customer service',
                'availableLanguage' => ['Arabic', 'English'],
            ],
            'sameAs' => isset($socialLinks) ? $socialLinks->pluck('url')->toArray() : [],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>

    @if(app()->environment('local'))
    <script>
        window.ANALYTICS_SITE_KEY = 'CGfufSmMiGkvcXEAQyUiwpJMoSGTMZCO';
        window.ANALYTICS_API_URL = 'https://analytics.test/api/analytics/track';
    </script>
    <script async src="https://analytics.test/js/analytics.js"></script>
    @endif
</head>
<body class="font-sans antialiased text-white" dir="rtl" style="font-family: 'Tajawal', sans-serif; background: #0a0d14; overflow: hidden;">
    <!-- Premium Loader -->
    <div id="page-loader">
        <div class="page-loader-content" style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
            <div class="spinner"></div>
            <div class="page-loader-text" style="color: #FF6B35; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; animation: pulse 1.5s ease-in-out infinite;">جاري التحميل...</div>
        </div>
    </div>
    <style>@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }</style>

    <!-- Main Content Wrapper -->
    <div id="app-content">
        <div class="min-h-screen" style="background: #0a0d14;">
            <x-navbar />

            <!-- Page Content -->
            <main class="mt-12">
                {{ $slot }}
            </main>

            <x-footer />
        </div>
    </div>

        {{-- Floating WhatsApp Button --}}
        @php
            $companySettings = \App\Models\CompanySetting::first();
            $whatsappNumber = $companySettings->whatsapp_number ?? '';
            $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
        @endphp
        @if($cleanNumber)
        <a href="https://wa.me/{{ $cleanNumber }}" 
           target="_blank"
           rel="noopener noreferrer"
           class="whatsapp-float group"
           aria-label="تواصل معنا عبر واتساب">
            {{-- Pulse Animation Ring --}}
            <span class="whatsapp-pulse"></span>
            <span class="whatsapp-pulse" style="animation-delay: 0.5s;"></span>
            
            {{-- Icon Container --}}
            <span class="whatsapp-icon">
                <i class="fab fa-whatsapp"></i>
            </span>
            
            {{-- Tooltip --}}
            <span class="whatsapp-tooltip">
                تواصل معنا
            </span>
        </a>       
        @endif
    
    <!-- External Scripts - All Deferred -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

    <!-- Initialize AOS and other scripts -->
    <script>
        // Use a more robust and faster way to hide the loader
        function hideLoader() {
            const loader = document.getElementById('page-loader');
            const content = document.getElementById('app-content');
            
            if (loader && loader.style.display !== 'none') {
                loader.style.opacity = '0';
                if (content) content.style.opacity = '1';
                
                setTimeout(() => {
                    loader.style.display = 'none';
                    document.body.style.overflow = 'auto';
                    
                    // Refresh AOS after content becomes visible to ensure elements are revealed correctly
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                }, 600);
            }
        }

        // Hide when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', hideLoader);
        } else {
            hideLoader();
        }

        // Final fallback
        window.addEventListener('load', hideLoader);
        setTimeout(hideLoader, 3000);

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });
        
        // Initialize AOS
        window.addEventListener('load', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50,
                    delay: 0,
                });
            }
        });
    </script>
    
    {{-- Google Analytics & Marketing Scripts --}}
    <script>
        @php
            $analyticsSettings = \App\Models\AnalyticsSetting::first();
        @endphp
        
        // Load Facebook Pixel when user consents
        function loadFacebookPixel() {
            @if($analyticsSettings && $analyticsSettings->fb_pixel_enabled && $analyticsSettings->fb_pixel_id)
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $analyticsSettings->fb_pixel_id }}');
            fbq('track', 'PageView');
            @endif
        }
        
        @if($analyticsSettings && $analyticsSettings->gtm_enabled && $analyticsSettings->gtm_container_id)
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $analyticsSettings->gtm_container_id }}');
        @endif
    </script>
</body>
</html>
