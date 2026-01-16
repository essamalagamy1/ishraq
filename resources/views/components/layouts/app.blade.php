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
    <title>{{ $seo->meta_title ?? 'E-DATA 360 | شركة تطوير مواقع وتطبيقات احترافية' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'E-DATA 360 شريكك في التحول الرقمي. نطور مواقع ويب، تطبيقات جوال، وحلول برمجية متكاملة باستخدام أحدث التقنيات. +200 مشروع منجز.' }}">
    <meta name="keywords" content="تطوير مواقع, تطبيقات جوال, برمجة, Laravel, React, تصميم UI UX, شركة برمجة, السعودية, E-DATA 360">
    <meta name="author" content="E-DATA 360">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $seo->meta_title ?? 'E-DATA 360 | شركة تطوير مواقع وتطبيقات' }}">
    <meta property="og:description" content="{{ $seo->meta_description ?? 'شريكك في التحول الرقمي - تطوير مواقع وتطبيقات احترافية' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <!-- Favicon -->
    @if(isset($companySettings) && $companySettings->favicon_path)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($companySettings->favicon_path) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($companySettings->favicon_path) }}">
        <link rel="apple-touch-icon" href="{{ Storage::url($companySettings->favicon_path) }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css" />

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

    {{-- {!! CookieConsent::styles() !!} --}}
</head>
<body class="font-sans antialiased" dir="rtl">
    <div class="min-h-screen bg-gray-50">
        <x-navbar />

        <!-- Page Content -->
        <main class="mt-12">
            {{ $slot }}
        </main>

        <x-footer />
    </div>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100,
            delay: 50,
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
        
        // Enhanced Reveal on Scroll
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
            
            // Reveal on scroll elements
            const scrollReveals = document.querySelectorAll('.reveal-on-scroll, .reveal-scale');
            scrollReveals.forEach((element, index) => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 100;
                
                if (elementTop < windowHeight - elementVisible) {
                    // Add staggered delay based on index within visible viewport
                    setTimeout(() => {
                        element.classList.add('revealed');
                    }, (index % 4) * 100);
                }
            });
        }
        
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check
        
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
