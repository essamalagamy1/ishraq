<x-layouts.app>
    <style>
        /* ============================================
           HERO SECTION - ULTRA SMOOTH ANIMATIONS
           ============================================ */

        /* Gradient Orbs - GPU Accelerated */
        .gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: float 20s ease-in-out infinite;
            will-change: transform;
        }

        .gradient-orb-1 {
            width: 500px;
            height: 500px;
            background: {{ config('colors.primary') }};
            top: -10%;
            right: -5%;
            animation-delay: 0s;
        }

        .gradient-orb-2 {
            width: 400px;
            height: 400px;
            background: {{ config('colors.accent_blue') }};
            bottom: -10%;
            left: -5%;
            animation-delay: 5s;
        }

        .gradient-orb-3 {
            width: 350px;
            height: 350px;
            background: {{ config('colors.primary_light') }};
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -30px) scale(1.1); }
            50% { transform: translate(-20px, -20px) scale(0.9); }
            75% { transform: translate(30px, 20px) scale(1.05); }
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: {{ config('colors.primary_light') }};
            opacity: 0.3;
            animation: float-gentle 8s ease-in-out infinite;
            will-change: transform;
        }

        @keyframes float-gentle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }

        /* Hero Badge Animation */
        .hero-badge {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .pulse-icon {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(13, 148, 136, 0.7); }
            50% { box-shadow: 0 0 0 10px rgba(13, 148, 136, 0); }
        }

        /* Hero Title Animation */
        .hero-title {
            animation: fadeInUp 0.8s ease-out 0.2s forwards;
            opacity: 0;
        }

        .gradient-text {
            animation: gradient-shift 3s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Hero Subtitle Animation */
        .hero-subtitle {
            animation: fadeInUp 0.8s ease-out 0.4s forwards;
            opacity: 0;
        }

        /* Hero CTA Animation */
        .hero-cta {
            animation: fadeInUp 0.8s ease-out 0.6s forwards;
            opacity: 0;
        }

        .cta-primary {
            background: linear-gradient(135deg, #0D9488, #10B981);
            box-shadow: 0 10px 30px -5px rgba(13, 148, 136, 0.4);
            position: relative;
            overflow: hidden;
        }

        .cta-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .cta-primary:hover::before {
            transform: translateX(100%);
        }

        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -5px rgba(13, 148, 136, 0.5);
        }

        /* Hero Visual Animations */
        .hero-visual {
            animation: fadeInRight 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        .main-card {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            transform-style: preserve-3d;
        }

        .main-card:hover {
            transform: translateY(-10px) rotateX(2deg) rotateY(-2deg);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.8);
        }

        .card-icon {
            animation: icon-bounce 2s ease-in-out infinite;
        }

        @keyframes icon-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .tech-icon {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Floating Cards - Smooth 3D Animation */
        .floating-card {
            animation: float-card 6s ease-in-out infinite;
            transition: all 0.3s ease;
            will-change: transform;
        }

        .floating-card:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        }

        .floating-card-1 {
            animation-delay: 0s;
        }

        .floating-card-2 {
            animation-delay: 2s;
        }

        .floating-card-3 {
            animation-delay: 4s;
        }

        @keyframes float-card {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            animation: fadeIn 1s ease-out 1s forwards;
            opacity: 0;
        }

        .scroll-dot {
            animation: scroll-down 2s ease-in-out infinite;
        }

        @keyframes scroll-down {
            0% { transform: translateY(0); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: translateY(16px); opacity: 0; }
        }

        /* ============================================
           REVEAL ON SCROLL - OPTIMIZED
           ============================================ */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: opacity, transform;
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Blob Animation for Backgrounds */
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(20px, -20px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(20px, 10px) scale(1.05); }
        }

        .animate-blob {
            animation: blob 20s infinite ease-in-out;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        /* ============================================
           KEYFRAME DEFINITIONS
           ============================================ */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ============================================
           SWIPER CUSTOMIZATION
           ============================================ */
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #cbd5e1;
            opacity: 1;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .swiper-pagination-bullet-active {
            background: {{ config('colors.primary') }};
            width: 32px;
            border-radius: 6px;
        }

        /* ============================================
           UTILITY CLASSES
           ============================================ */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Performance Optimization */
        .hero-section,
        .services-section,
        .main-card,
        .floating-card,
        .gradient-orb {
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* ============================================
           SERVICE CARDS - PREMIUM INTERACTIONS
           ============================================ */
        .service-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
        }

        .service-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            border-color: transparent;
        }

        .service-icon {
            position: relative;
            overflow: hidden;
        }

        .service-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .service-card:hover .service-icon::after {
            transform: translateX(100%);
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 10px 25px -5px rgba(255, 107, 53, 0.4);
        }

        /* ============================================
           PROJECT CARDS - ADVANCED HOVER EFFECTS
           ============================================ */
        .project-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .project-image {
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-image {
            transform: scale(1.15) rotate(2deg);
        }

        /* ============================================
           FEATURE CARDS - MAGNETIC EFFECT
           ============================================ */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15) rotate(-8deg);
            box-shadow: 0 8px 20px -4px rgba(255, 107, 53, 0.4);
        }

        .feature-icon {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================
           TESTIMONIAL CARDS - SMOOTH LIFT
           ============================================ */
        .testimonial-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.2);
        }

        /* ============================================
           CTA SECTION - PULSING EFFECT
           ============================================ */
        .cta-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cta-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
        }

        .cta-icon {
            animation: icon-pulse 2s ease-in-out infinite;
        }

        @keyframes icon-pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        /* ============================================
           ARTICLE CARDS - ELEGANT TRANSITIONS
           ============================================ */
        .article-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .article-image {
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-card:hover .article-image {
            transform: scale(1.1) rotate(1deg);
        }

        /* ============================================
           PARALLAX SCROLL EFFECT (LIGHTWEIGHT)
           ============================================ */
        @supports (transform: translateZ(0)) {
            .parallax-light {
                will-change: transform;
                transition: transform 0.3s ease-out;
            }
        }

        /* Reduce Motion for Accessibility */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    {{-- Hero Section - Ultra Professional Design --}}
    <section class="min-h-screen flex items-center relative overflow-hidden hero-section" style="background: linear-gradient(145deg, #0a0a1f 0%, #161637 50%, #1a1a3e 100%);">
        {{-- Animated Gradient Orbs - GPU Accelerated --}}
        <div class="absolute inset-0 opacity-20">
            <div class="gradient-orb gradient-orb-1"></div>
            <div class="gradient-orb gradient-orb-2"></div>
            <div class="gradient-orb gradient-orb-3"></div>
        </div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px); background-size: 60px 60px;"></div>

        {{-- Floating Elements - CSS Only Animation --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="floating-element" style="left: 15%; top: 20%;"></div>
            <div class="floating-element" style="left: 80%; top: 60%; animation-delay: 2s;"></div>
            <div class="floating-element" style="left: 60%; top: 80%; animation-delay: 4s;"></div>
        </div>
        
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Content Side --}}
                <div class="text-white order-2 lg:order-1">
{{--                    @if($heroSection && $heroSection->badge_text)--}}
{{--                    <div class="hero-badge inline-flex items-center gap-3 px-5 py-2.5 rounded-full mb-8" style="animation-delay: 0.1s;">--}}
{{--                        @if($heroSection->badge_icon)--}}
{{--                        <div class="w-8 h-8 rounded-full flex items-center justify-center pulse-icon" style="background: {{ config('colors.primary') }};">--}}
{{--                            <i class="{{ $heroSection->badge_icon }} text-white text-sm"></i>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                        <span class="text-sm font-bold tracking-wide" style="color: {{ config('colors.primary_lighter') }};">{{ $heroSection->badge_text }}</span>--}}
{{--                    </div>--}}
{{--                    @endif--}}

                    @if($heroSection)
                    <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black mb-8 leading-[1.1]" style="animation-delay: 0.2s;">
                        <span class="block text-white/95 mb-3">{{ $heroSection->title_line1 }}</span>
                        <span class="block gradient-text" style="background: linear-gradient(120deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }}, {{ config('colors.accent_yellow') }}); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $heroSection->title_line2 }}</span>
                    </h1>

                    @if($heroSection->subtitle)
                    <p class="hero-subtitle text-lg md:text-xl text-gray-300 mb-10 max-w-xl leading-relaxed" style="animation-delay: 0.3s;">{{ $heroSection->subtitle }}</p>
                    @endif

                    <div class="hero-cta flex flex-wrap gap-4 mb-14" style="animation-delay: 0.4s;">
                        @if($heroSection->cta_primary_text)
                        <a href="{{ $heroSection->cta_primary_link ?? route('request-design.create') }}"
                           class="cta-primary group relative inline-flex items-center gap-3 text-white font-bold py-4 px-8 rounded-2xl overflow-hidden transition-all duration-500">
                            <span class="relative z-10">{{ $heroSection->cta_primary_text }}</span>
                            <i class="fas fa-arrow-left relative z-10 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        </a>
                        @endif
                        @if($heroSection->cta_secondary_text)
                        <a href="{{ $heroSection->cta_secondary_link ?? route('portfolio') }}"
                           class="cta-secondary group inline-flex items-center gap-3 text-white font-bold py-4 px-8 rounded-2xl border-2 border-white/20 hover:border-white/40 backdrop-blur-sm transition-all duration-300 hover:bg-white/5">
                            <span>{{ $heroSection->cta_secondary_text }}</span>
                            <i class="fas fa-external-link-alt text-sm opacity-70 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                        @endif
                    </div>
                    @endif

                    {{-- Quick Stats Row --}}
                    {{-- @if(isset($stats) && count($stats) > 0)
                    <div class="flex flex-wrap gap-8 pt-8 border-t border-white/10 animate-fade-in-up" style="animation-delay: 0.5s;">
                        @foreach($stats->take(3) as $stat)
                        <div class="group">
                            <div class="text-3xl md:text-4xl font-black transition-transform duration-300 group-hover:scale-110" style="color: {{ config('colors.primary_light') }};">{{ $stat->number }}</div>
                            <div class="text-gray-400 text-sm mt-1">{{ $stat->label }}</div>
                        </div>
                        @endforeach
                    </div>
                    @endif --}}
                </div>

                {{-- Visual Side - 3D Floating Cards --}}
                <div class="hidden lg:block order-1 lg:order-2 hero-visual">
                    <div class="relative" style="animation-delay: 0.3s;">
                        {{-- Main Feature Card with 3D Effect --}}
                        <div class="main-card relative z-20 rounded-3xl p-10 backdrop-blur-xl border border-white/10" style="background: rgba(255, 255, 255, 0.05); box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.7);">
                            <div class="card-icon w-20 h-20 rounded-2xl flex items-center justify-center mb-6 mx-auto" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});">
                                <i class="fas fa-laptop-code text-4xl text-white"></i>
                            </div>
                            <p class="text-2xl font-black text-white text-center mb-3">حلول تقنية متكاملة</p>
                            <p class="text-gray-300 text-center leading-relaxed">نحول أفكارك إلى منتجات رقمية مبتكرة</p>

                            {{-- Tech Stack Icons --}}
                            <div class="flex justify-center gap-4 mt-8">
                                <div class="tech-icon w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300 cursor-pointer hover:-translate-y-1">
                                    <i class="fab fa-laravel text-xl text-red-400"></i>
                                </div>
                                <div class="tech-icon w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300 cursor-pointer hover:-translate-y-1" style="animation-delay: 0.1s;">
                                    <i class="fab fa-react text-xl text-cyan-400"></i>
                                </div>
                                <div class="tech-icon w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300 cursor-pointer hover:-translate-y-1" style="animation-delay: 0.2s;">
                                    <i class="fab fa-vuejs text-xl text-green-400"></i>
                                </div>
                                <div class="tech-icon w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all duration-300 cursor-pointer hover:-translate-y-1" style="animation-delay: 0.3s;">
                                    <i class="fab fa-figma text-xl text-purple-400"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Mini Cards with Smooth Animation --}}
                        <div class="floating-card floating-card-1 absolute -top-8 -right-8 w-32 h-32 rounded-2xl p-4 flex flex-col items-center justify-center z-30" style="background: rgba(255, 107, 53, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="fas fa-mobile-alt text-3xl mb-2" style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="text-white text-xs font-bold">تطبيقات</span>
                        </div>

                        <div class="floating-card floating-card-2 absolute -bottom-6 -left-6 w-36 h-28 rounded-2xl p-4 flex flex-col items-center justify-center z-30" style="background: rgba(255, 193, 7, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="fas fa-chart-line text-2xl mb-2" style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="text-white text-xs font-bold">نمو الأعمال</span>
                        </div>

                        <div class="floating-card floating-card-3 absolute top-1/3 -left-12 w-28 h-28 rounded-2xl p-4 flex flex-col items-center justify-center z-10" style="background: rgba(76, 175, 80, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="fas fa-shield-alt text-2xl mb-2" style="color: {{ config('colors.accent_green') }};"></i>
                            <span class="text-white text-xs font-bold">أمان</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Scroll Indicator with Animation --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 scroll-indicator">
            <div class="w-8 h-12 rounded-full border-2 border-white/30 flex items-start justify-center p-2">
                <div class="scroll-dot w-1.5 h-3 rounded-full bg-white/50"></div>
            </div>
        </div>
    </section>

    {{-- Services Section - Enhanced Bento Grid --}}
    @if(isset($services) && count($services) > 0)
    <section class="services-section py-28 relative overflow-hidden" style="background: linear-gradient(to bottom, #1a1a2e 0%, #16213e 100%);">
        {{-- Animated Background Decoration --}}
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-10 animate-blob" style="background: {{ config('colors.primary') }}; filter: blur(100px);"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full opacity-10 animate-blob animation-delay-2000" style="background: {{ config('colors.accent_blue') }}; filter: blur(100px);"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-20 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: rgba(255, 107, 53, 0.15);">
                    <div class="w-2 h-2 rounded-full" style="background: {{ config('colors.primary') }};"></div>
                    <span class="text-sm font-bold" style="color: {{ config('colors.primary') }};">خدماتنا المميزة</span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6">
                    حلول <span style="color: {{ config('colors.primary') }};">تقنية</span> متخصصة
                </h2>
                <p class="text-gray-300 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                    نقدم مجموعة شاملة من الخدمات التقنية لتحويل أفكارك إلى منتجات رقمية ناجحة
                </p>
            </div>

            {{-- Bento Grid with Enhanced Animations --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-on-scroll">
                @foreach($services as $index => $service)
                <div class="service-card group relative rounded-3xl p-8 border overflow-hidden {{ $index === 0 ? 'md:col-span-2 lg:col-span-1' : '' }}" style="background: rgba(255, 255, 255, 0.03); border-color: rgba(255, 255, 255, 0.08); animation-delay: {{ $index * 0.1 }}s;">
                    {{-- Animated Gradient Overlay --}}
                    <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700" style="background: linear-gradient(135deg, rgba(255, 107, 53, 0.08), rgba(255, 107, 53, 0.15));"></div>

                    {{-- Shine Effect --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </div>

                    <div class="relative z-10">
                        {{-- Icon with Pulse Effect --}}
                        <div class="service-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-all duration-500 group-hover:scale-110" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});">
                            <i class="{{ $service->icon }} text-2xl text-white"></i>
                        </div>

                        {{-- Content --}}
                        <h3 class="text-xl font-bold text-white mb-4 transition-colors duration-300">{{ $service->title }}</h3>
                        <p class="text-gray-300 mb-6 line-clamp-3 leading-relaxed">{!! Str::limit(strip_tags($service->description), 120) !!}</p>

                        {{-- CTA Link with Arrow Animation --}}
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}"
                           class="inline-flex items-center gap-2 font-bold transition-all duration-300 group-hover:gap-4" style="color: {{ config('colors.primary') }};">
                            <span>{{ $service->cta_text ?? 'اطلب الآن' }}</span>
                            <i class="fas fa-arrow-left text-sm transition-transform duration-300 group-hover:-translate-x-1"></i>
                        </a>
                    </div>

                    {{-- Corner Decoration with Scale Effect --}}
                    <div class="absolute top-4 left-4 w-24 h-24 rounded-full opacity-0 group-hover:opacity-10 transition-all duration-500 scale-0 group-hover:scale-100" style="background: {{ config('colors.primary') }};"></div>
                </div>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="text-center mt-16 reveal-on-scroll">
                <a href="{{ route('services') }}" class="group inline-flex items-center gap-3 font-bold py-4 px-10 rounded-2xl transition-all duration-500 hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_dark') }}); color: white;">
                    <span>استكشف جميع الخدمات</span>
                    <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-2"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Projects - Modern Showcase --}}
    @if(false)
    <section class="py-28 relative overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        {{-- Static Background --}}
        <div class="absolute inset-0">
            <div class="absolute top-20 right-20 w-72 h-72 rounded-full opacity-10" style="background: {{ config('colors.primary') }}; filter: blur(80px);"></div>
            <div class="absolute bottom-20 left-20 w-64 h-64 rounded-full opacity-10" style="background: {{ config('colors.accent_blue') }}; filter: blur(80px);"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-16 reveal-on-scroll">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: {{ config('colors.primary_20') }};">
                        <i class="fas fa-briefcase text-sm" style="color: {{ config('colors.primary_light') }};"></i>
                        <span class="text-sm font-bold" style="color: {{ config('colors.primary_light') }};">أعمالنا المميزة</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white">
                        مشاريع <span style="color: {{ config('colors.primary_light') }};">نفتخر</span> بها
                    </h2>
                </div>
                <a href="{{ route('portfolio') }}" class="group inline-flex items-center gap-3 text-white font-semibold py-3 px-6 rounded-xl border border-white/20 hover:bg-white/10 transition-all duration-300">
                    <span>عرض جميع المشاريع</span>
                    <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                </a>
            </div>

            {{-- Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal-on-scroll">
                @foreach($featuredProjects->take(6) as $index => $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="project-card group block rounded-3xl overflow-hidden {{ $index === 0 ? 'md:col-span-2 lg:col-span-1' : '' }}"
                   style="background: {{ config('colors.bg_dark_lighter') }};">
                    {{-- Image Container --}}
                    <div class="relative aspect-[4/3] overflow-hidden">
                        @if($project->main_image)
                            <img src="{{ Storage::url($project->main_image) }}"
                                 alt="{{ $project->title }}"
                                 class="project-image w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-white/5">
                                <i class="fas fa-image text-4xl text-white/10"></i>
                            </div>
                        @endif
                        
                        {{-- Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                        
                        {{-- Type Badge --}}
                        @if($project->types && $project->types->count() > 0)
                        <div class="absolute top-4 right-4 flex gap-2">
                            @foreach($project->types->take(1) as $type)
                            <span class="px-4 py-2 rounded-full text-xs font-bold text-white backdrop-blur-sm" style="background: {{ $type->color }}cc;">
                                {{ $type->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                        
                        {{-- View Icon --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center backdrop-blur-md" style="background: {{ config('colors.primary') }};">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-opacity-90 transition-colors">{{ $project->title }}</h3>
                        <p class="text-gray-400 text-sm line-clamp-2">{{ $project->short_description }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Why Choose Us - Horizontal Cards --}}
    <section class="py-28 relative overflow-hidden" style="background: #0f1419;">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient({{ config('colors.primary') }} 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-20 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: rgba(255, 107, 53, 0.15);">
                    <i class="fas fa-star text-sm" style="color: {{ config('colors.primary') }};"></i>
                    <span class="text-sm font-bold" style="color: {{ config('colors.primary') }};">لماذا نحن</span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6">
                    لماذا تختار <span style="color: {{ config('colors.primary') }};">{{ $companySettings->name ?? 'إشراق' }}</span>
                </h2>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto reveal-on-scroll">
                @foreach($features as $index => $feature)
                <div class="feature-card group flex items-start gap-6 p-8 rounded-3xl border hover:border-transparent" style="background: rgba(255, 255, 255, 0.03); border-color: rgba(255, 255, 255, 0.08); animation-delay: {{ $index * 0.1 }}s;">
                    {{-- Icon --}}
                    <div class="feature-icon flex-shrink-0 w-16 h-16 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});">
                        <i class="{{ $feature->icon }} text-2xl text-white"></i>
                    </div>

                    {{-- Content --}}
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $feature->title }}</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials - Modern Cards --}}
    @if(isset($testimonials) && count($testimonials) > 0)
    <section class="py-28 relative overflow-hidden" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
        <div class="container mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-20 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: rgba(255, 107, 53, 0.15);">
                    <i class="fas fa-quote-right text-sm" style="color: {{ config('colors.primary') }};"></i>
                    <span class="text-sm font-bold" style="color: {{ config('colors.primary') }};">آراء عملائنا</span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6">
                    ماذا يقول <span style="color: {{ config('colors.primary') }};">عملاؤنا</span>
                </h2>
            </div>

            {{-- Testimonials Slider --}}
            <div class="relative max-w-6xl mx-auto reveal-on-scroll">
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper pb-4">
                        @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card rounded-3xl p-8 border h-full shadow-lg" style="background: rgba(255, 255, 255, 0.03); border-color: rgba(255, 255, 255, 0.08);">
                                {{-- Quote Icon --}}
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background: rgba(255, 107, 53, 0.15);">
                                    <i class="fas fa-quote-right text-xl" style="color: {{ config('colors.primary') }};"></i>
                                </div>

                                {{-- Stars --}}
                                <div class="flex gap-1 mb-6">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-lg {{ $i <= $testimonial->rating ? '' : 'opacity-30' }}" style="color: {{ config('colors.accent_yellow') }};"></i>
                                    @endfor
                                </div>

                                {{-- Content --}}
                                <p class="text-gray-300 mb-8 leading-relaxed text-lg">{{ $testimonial->testimonial }}</p>

                                {{-- Author --}}
                                <div class="flex items-center gap-4 pt-6 border-t" style="border-color: rgba(255, 255, 255, 0.1);">
                                    <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-lg" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});">
                                        {{ mb_substr($testimonial->client_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white text-lg">{{ $testimonial->client_name }}</p>
                                        @if($testimonial->client_position)
                                        <p class="text-gray-400 text-sm">{{ $testimonial->client_position }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-10"></div>
                </div>
                
                {{-- Navigation --}}
                <button class="testimonials-prev absolute top-1/2 -translate-y-1/2 right-0 md:-right-6 z-10 w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
                <button class="testimonials-next absolute top-1/2 -translate-y-1/2 left-0 md:-left-6 z-10 w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
            </div>

            {{-- Add Review Button --}}
            <div class="text-center mt-16 reveal-on-scroll">
                <a href="{{ route('testimonial.create') }}" class="group inline-flex items-center gap-3 font-bold py-4 px-10 rounded-2xl border-2 transition-all duration-500 hover:scale-105" style="border-color: {{ config('colors.primary') }}; color: {{ config('colors.primary') }};">
                    <i class="fas fa-star"></i>
                    <span>أضف تقييمك</span>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Latest Articles - Magazine Style --}}
    @if(isset($latestArticles) && $latestArticles->count() > 0)
    <section class="py-28 relative overflow-hidden" style="background: #0f1419;">
        <div class="container mx-auto px-6 relative z-10">
            {{-- Section Header --}}
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-16 reveal-on-scroll">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: rgba(255, 107, 53, 0.15);">
                        <i class="fas fa-newspaper text-sm" style="color: {{ config('colors.primary') }};"></i>
                        <span class="text-sm font-bold" style="color: {{ config('colors.primary') }};">المدونة</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white">
                        أحدث <span style="color: {{ config('colors.primary') }};">المقالات</span>
                    </h2>
                </div>
                <a href="{{ route('articles') }}" class="group inline-flex items-center gap-3 font-semibold transition-all duration-300" style="color: {{ config('colors.primary') }};">
                    <span>جميع المقالات</span>
                    <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-2"></i>
                </a>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 reveal-on-scroll">
                @foreach($latestArticles as $index => $article)
                <article class="article-card group rounded-3xl overflow-hidden border {{ $index === 0 ? 'md:col-span-2 lg:col-span-1' : '' }}" style="background: rgba(255, 255, 255, 0.03); border-color: rgba(255, 255, 255, 0.08);">
                    {{-- Image --}}
                    <div class="aspect-video overflow-hidden relative">
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 class="article-image w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-white/5">
                                <i class="fas fa-file-alt text-4xl text-white/10"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-8">
                        <div class="flex items-center gap-3 text-sm text-gray-400 mb-4">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $article->published_at->format('Y/m/d') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-opacity-80 transition-colors">
                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        </h3>
                        <a href="{{ route('articles.show', $article) }}"
                           class="inline-flex items-center gap-2 font-semibold transition-all duration-300 group-hover:gap-4" style="color: {{ config('colors.primary') }};">
                            <span>اقرأ المزيد</span>
                            <i class="fas fa-arrow-left text-sm"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section - Premium Design --}}
    <section class="py-32 relative overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        {{-- Animated Background Elements --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-full h-full opacity-30" style="background: radial-gradient(circle at 80% 20%, {{ config('colors.primary') }}40, transparent 50%);"></div>
            <div class="absolute bottom-0 left-0 w-full h-full opacity-20" style="background: radial-gradient(circle at 20% 80%, {{ config('colors.accent_blue') }}40, transparent 50%);"></div>
        </div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 60px 60px;"></div>
        
        {{-- Static Particles --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            @for($i = 0; $i < 4; $i++)
            <div class="absolute w-3 h-3 rounded-full opacity-30" style="background: {{ config('colors.primary_light') }}; left: {{ rand(5, 95) }}%; top: {{ rand(5, 95) }}%;"></div>
            @endfor
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
                 <div class="max-w-4xl mx-auto text-center text-white reveal-on-scroll">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full mb-10 glass-light">
                    <i class="fas fa-rocket" style="color: {{ config('colors.primary_light') }};"></i>
                    <span class="text-sm font-semibold" style="color: {{ config('colors.primary_lighter') }};">ابدأ رحلتك الرقمية</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight">
                    جاهز لتحويل <span style="color: {{ config('colors.primary_light') }};">أفكارك</span><br>
                    إلى واقع رقمي؟
                </h2>
                <p class="text-xl md:text-2xl text-gray-300 mb-14 max-w-2xl mx-auto leading-relaxed">
                    تواصل معنا اليوم واحصل على استشارة مجانية لمشروعك
                </p>
                
                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-20">
                    <a href="{{ route('request-design.create') }}" 
                       class="group relative inline-flex items-center justify-center gap-3 text-white font-bold py-5 px-10 rounded-2xl overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl"
                       style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_dark') }});">
                        <i class="fas fa-rocket text-white"></i>
                        <span class="text-white">ابدأ مشروعك الآن</span>
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="group inline-flex items-center justify-center gap-3 text-white font-bold py-5 px-10 rounded-2xl border-2 border-white/20 hover:border-white/50 hover:bg-white/10 transition-all duration-300">
                        <i class="fas fa-comments text-white"></i>
                        <span>تواصل معنا</span>
                    </a>
                </div>

                {{-- Contact Cards --}}
                @if($companySettings)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                    @if($companySettings->main_email)
                    <div class="cta-card group p-8 rounded-3xl border border-white/10 hover:border-white/30 bg-white/5 backdrop-blur-sm">
                        <div class="cta-icon w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-6" style="background: {{ config('colors.primary_20') }};">
                            <i class="fas fa-envelope text-2xl" style="color: {{ config('colors.primary_light') }};"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-3">البريد الإلكتروني</h3>
                        <a href="mailto:{{ $companySettings->main_email }}" class="text-gray-400 text-sm hover:text-white transition-colors break-all">{{ $companySettings->main_email }}</a>
                    </div>
                    @endif
                    
                    @if($companySettings->whatsapp_number)
                    <div class="cta-card group p-8 rounded-3xl border border-white/10 hover:border-green-400/30 bg-white/5 backdrop-blur-sm">
                        <div class="cta-icon w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-6 bg-green-500/20">
                            <i class="fab fa-whatsapp text-2xl text-green-400"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-3">واتساب</h3>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}" class="text-gray-400 text-sm hover:text-green-400 transition-colors">تواصل مباشر</a>
                    </div>
                    @endif
                    
                    @if($companySettings->phone_primary)
                    <div class="cta-card group p-8 rounded-3xl border border-white/10 hover:border-white/30 bg-white/5 backdrop-blur-sm">
                        <div class="cta-icon w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-6" style="background: {{ config('colors.primary_20') }};">
                            <i class="fas fa-phone text-2xl" style="color: {{ config('colors.primary_light') }};"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-3">الهاتف</h3>
                        <a href="tel:{{ $companySettings->phone_primary }}" class="text-gray-400 text-sm hover:text-white transition-colors" dir="ltr">{{ $companySettings->phone_primary }}</a>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Swiper Initialization Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Testimonials Swiper
            new Swiper('.testimonials-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: document.querySelectorAll('.testimonials-swiper .swiper-slide').length > 3,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.testimonials-swiper .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.testimonials-next',
                    prevEl: '.testimonials-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });

            // Intersection Observer for Reveal Animations - Optimized
            const observerOptions = {
                threshold: 0.15,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        // Unobserve after revealing to save resources
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Use requestIdleCallback for non-critical initialization
            const initObserver = () => {
                document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                    observer.observe(el);
                });
            };

            if ('requestIdleCallback' in window) {
                requestIdleCallback(initObserver);
            } else {
                setTimeout(initObserver, 100);
            }
        });
    </script>

</x-layouts.app>
