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


    <!-- Preconnect to critical origins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Preload LCP Image (Logo) -->
    @if(isset($companySettings) && $companySettings->logo_path)
        <link rel="preload" as="image" href="{{ Storage::url($companySettings->logo_path) }}" fetchpriority="high">
    @endif

    <!-- Google Fonts with display=swap -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    
    <!-- Critical CSS (Inlined for speed) -->
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
        /* Inline critical dark mode styles */
        body input, body textarea, body select { background-color: rgba(255,255,255,0.05) !important; color: white !important; }
    </style>

    <!-- Post-load CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" media="print" onload="this.media='all'">
    
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-mode-override.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light-animations.css') }}">

    <!-- Non-blocking Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4" defer></script>

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
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark-mode-override.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light-animations.css') }}">

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
    {{-- {!! CookieConsent::styles() !!} --}}
</head>
<body class="font-sans antialiased text-white" dir="rtl" style="font-family: 'Tajawal', sans-serif; background: #0a0d14;">
    <div class="min-h-screen" style="background: #0a0d14;">
        <x-navbar />

        <!-- Page Content -->
        <main class="mt-12">
            {{ $slot }}
        </main>

        <x-footer />

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
    </div>
    
    <!-- External Scripts - All Deferred -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

    <!-- Initialize AOS with Optimized Settings -->
    <script>
        AOS.init({
            duration: 400, // Very fast for performance
            easing: 'ease-out',
            once: true,
            offset: 50,
            // Instead of fully disabling, we just make it instant on mobile
            duration: window.innerWidth < 768 ? 0 : 400, 
        });
    </script>
    
    <!-- Scroll Reveal & Animation Script -->
    <script>
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
        
        // Universal Light Reveal using Intersection Observer
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed', 'active', 'aos-animate');
                    revealObserver.unobserve(entry.target); 
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        // Watch all animation classes and AOS elements
        const selectors = '.reveal, .reveal-on-scroll, .reveal-scale, .reveal-light, [data-aos]';
        document.querySelectorAll(selectors).forEach(el => revealObserver.observe(el));
        
        // Counter Animation for Statistics
        function animateCounters() {
            const counters = document.querySelectorAll('.counter-number');
            const speed = 200;
            
            counters.forEach(counter => {
                if (counter.dataset.animated === 'true') return;
                
                const rect = counter.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
                
                if (isVisible) {
                    counter.dataset.animated = 'true';
                    const target = counter.innerText;
                    const numericPart = parseFloat(target.replace(/[^0-9.]/g, ''));
                    const suffix = target.replace(/[0-9.]/g, '');
                    
                    if (isNaN(numericPart)) return;
                    
                    const duration = 2000;
                    const startTime = performance.now();
                    
                    function updateCounter(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        
                        // Easing function for smooth animation
                        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                        const currentValue = Math.floor(numericPart * easeOutQuart);
                        
                        counter.innerText = currentValue + suffix;
                        
                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.innerText = target;
                        }
                    }
                    
                    requestAnimationFrame(updateCounter);
                }
            });
        }
        
        window.addEventListener('scroll', animateCounters);
        
        // Initialize animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to hero elements
            const heroElements = document.querySelectorAll('.hero-animate');
            heroElements.forEach((el, index) => {
                el.style.opacity = '0';
                setTimeout(() => {
                    el.style.animation = `fadeInUp 0.8s ease-out forwards`;
                    el.style.animationDelay = `${index * 0.15}s`;
                }, 100);
            });
            
            // Initialize counter animation
            setTimeout(animateCounters, 500);
        });
        
        // Initialize Swiper for Testimonials
        window.addEventListener('load', function() {
            setTimeout(function() {
                if (document.querySelector('.testimonials-swiper')) {
                    // Count number of slides
                    const slidesCount = document.querySelectorAll('.testimonials-swiper .swiper-slide').length;
                    
                    const swiper = new Swiper('.testimonials-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: slidesCount > 3, // Only enable loop if we have more than 3 slides
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.testimonials-swiper-button-next',
                            prevEl: '.testimonials-swiper-button-prev',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            1024: {
                                slidesPerView: 3,
                                spaceBetween: 30,
                            },
                        },
                        // RTL support
                        rtl: true,
                        dir: 'rtl',
                        // Observer to update on DOM changes
                        observer: true,
                        observeParents: true,
                        observeSlideChildren: true,
                    });
                    
                    // Manual event listeners for navigation buttons
                    const nextButton = document.querySelector('.testimonials-swiper-button-next');
                    const prevButton = document.querySelector('.testimonials-swiper-button-prev');
                    
                    if (nextButton) {
                        nextButton.addEventListener('click', function(e) {
                            e.preventDefault();
                            swiper.slideNext();
                        });
                    }
                    
                    if (prevButton) {
                        prevButton.addEventListener('click', function(e) {
                            e.preventDefault();
                            swiper.slidePrev();
                        });
                    }
                    
                    // Force update after initialization
                    setTimeout(() => {
                        swiper.update();
                    }, 100);
                }
                
                // Initialize Swiper for Projects
                if (document.querySelector('.projects-swiper')) {
                    // Count number of slides
                    const projectSlidesCount = document.querySelectorAll('.projects-swiper .swiper-slide').length;
                    
                    const projectsSwiper = new Swiper('.projects-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: projectSlidesCount > 3, // Only enable loop if we have more than 3 slides
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.projects-swiper .swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.projects-swiper-button-next',
                            prevEl: '.projects-swiper-button-prev',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 30,
                            },
                        },
                        // RTL support
                        rtl: true,
                        dir: 'rtl',
                        // Observer to update on DOM changes
                        observer: true,
                        observeParents: true,
                        observeSlideChildren: true,
                    });
                    
                    // Manual event listeners for navigation buttons
                    const projectNextButton = document.querySelector('.projects-swiper-button-next');
                    const projectPrevButton = document.querySelector('.projects-swiper-button-prev');
                    
                    if (projectNextButton) {
                        projectNextButton.addEventListener('click', function(e) {
                            e.preventDefault();
                            projectsSwiper.slideNext();
                        });
                    }
                    
                    if (projectPrevButton) {
                        projectPrevButton.addEventListener('click', function(e) {
                            e.preventDefault();
                            projectsSwiper.slidePrev();
                        });
                    }
                    
                    // Force update after initialization
                    setTimeout(() => {
                        projectsSwiper.update();
                    }, 100);
                }
            }, 100);
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
            
            console.log('Facebook Pixel loaded');
            @endif
        }
        
        // Load Google Tag Manager when user consents
        @if($analyticsSettings && $analyticsSettings->gtm_enabled && $analyticsSettings->gtm_container_id)
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{{ $analyticsSettings->gtm_container_id }}');
        @endif
    </script>
    
    {{-- {!! CookieConsent::scripts() !!} --}}
</body>
</html>
