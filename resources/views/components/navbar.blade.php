@props(['companySettings', 'socialLinks'])

<!-- Navbar المُشرق الجديد -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-700" id="navbar-ishraq">
    <!-- Background with Gradient -->
    <div class="absolute inset-0 transition-all duration-700" id="navbar-bg"
         style="background: linear-gradient(135deg, rgba(255, 107, 53, 0.98) 0%, rgba(255, 140, 97, 0.95) 50%, rgba(255, 179, 148, 0.92) 100%); backdrop-filter: blur(20px);">
    </div>

    <!-- Glowing line at bottom -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-yellow-300 to-transparent opacity-0 transition-opacity duration-500" id="navbar-glow"></div>

    <div class="container mx-auto px-6 py-4 relative z-10">
        <div class="flex items-center justify-between">
            {{-- Logo المُشرق --}}
            <div class="flex items-center" data-aos="fade-left">
                <a href="{{ route('home') }}" class="flex items-center group relative">
                    @if(isset($companySettings) && $companySettings->logo_path)
                        {{-- Dynamic logo from database --}}
                        <img class="h-12 transition-all duration-500 group-hover:scale-110 group-hover:drop-shadow-[0_0_15px_rgba(255,211,61,0.8)] filter brightness-110"
                             src="{{ Storage::url($companySettings->logo_path) }}"
                             alt="{{ $companySettings->company_name ?? 'إشراق' }}">
                    @else
                        {{-- Fallback logo مُشرق --}}
                        <div class="flex items-center gap-3 group-hover:gap-4 transition-all duration-500">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-gradient-to-br from-yellow-300 to-orange-400 shadow-xl group-hover:shadow-[0_0_30px_rgba(255,211,61,0.8)] transition-all duration-500 group-hover:rotate-12">
                                <i class="fas fa-sun text-white text-xl group-hover:text-2xl transition-all duration-500 animate-pulse"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-3xl font-black text-white drop-shadow-lg">إشراق</span>
                                <span class="text-xs text-yellow-100 font-semibold tracking-wider">ISHRAQ</span>
                            </div>
                        </div>
                    @endif

                    <!-- Sparkle effect on hover -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-ping"></div>
                </a>
            </div>

            {{-- Desktop Navigation مع تأثيرات مُشرقة --}}
            <div class="hidden lg:flex lg:items-center lg:gap-2" data-aos="fade-down" data-aos-delay="100">
                <a href="{{ route('home') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('home') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-home text-sm group-hover:rotate-12 transition-transform duration-300"></i>
                        الرئيسية
                    </span>
                    @if(!request()->routeIs('home'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('about') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-sm group-hover:scale-125 transition-transform duration-300"></i>
                        من نحن
                    </span>
                    @if(!request()->routeIs('about'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                <a href="{{ route('services') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('services') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-star text-sm group-hover:rotate-180 transition-transform duration-500"></i>
                        خدماتنا
                    </span>
                    @if(!request()->routeIs('services'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                <a href="{{ route('portfolio') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('portfolio') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-trophy text-sm group-hover:scale-125 transition-transform duration-300"></i>
                        أعمالنا
                    </span>
                    @if(!request()->routeIs('portfolio'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                <a href="{{ route('articles') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('articles*') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-newspaper text-sm group-hover:scale-110 transition-transform duration-300"></i>
                        المدونة
                    </span>
                    @if(!request()->routeIs('articles*'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                <a href="{{ route('contact') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('contact') ? 'text-orange-600 bg-white/95 shadow-lg' : 'text-white hover:text-yellow-200' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-comments text-sm group-hover:rotate-12 transition-transform duration-300"></i>
                        تواصل معنا
                    </span>
                    @if(!request()->routeIs('contact'))
                    <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                    @endif
                </a>

                {{-- CTA Button مُشرق مع تأثير خاص --}}
                <a href="{{ route('request-design.create') }}"
                   class="mr-4 relative text-orange-600 font-black py-3 px-8 rounded-2xl hover:scale-110 transition-all duration-500 flex items-center gap-3 group overflow-hidden bg-white shadow-2xl hover:shadow-[0_0_40px_rgba(255,211,61,0.8)]">
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-300 via-orange-300 to-yellow-300 opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                    <i class="fas fa-rocket text-lg relative z-10 group-hover:translate-x-2 transition-transform duration-500"></i>
                    <span class="relative z-10">ابدأ مشروعك</span>
                    <div class="absolute top-1 right-1 w-2 h-2 bg-yellow-400 rounded-full animate-ping"></div>
                </a>
            </div>

            {{-- Mobile Menu Button مُشرق --}}
            <button id="mobile-menu-button" class="lg:hidden text-white hover:text-yellow-200 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group" data-aos="fade-right">
                <i class="fas fa-bars text-2xl group-hover:rotate-180 transition-transform duration-500"></i>
            </button>
        </div>

        {{-- Mobile Navigation مُشرق --}}
        <div id="mobile-menu" class="hidden lg:hidden mt-6 pb-4">
            <div class="flex flex-col gap-2 bg-white/10 backdrop-blur-xl rounded-2xl p-5 border border-white/20 shadow-2xl">
                <a href="{{ route('home') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('home') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                </a>
                <a href="{{ route('about') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('about') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-lightbulb"></i>
                    <span>من نحن</span>
                </a>
                <a href="{{ route('services') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('services') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-star"></i>
                    <span>خدماتنا</span>
                </a>
                <a href="{{ route('portfolio') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('portfolio') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-trophy"></i>
                    <span>أعمالنا</span>
                </a>
                <a href="{{ route('articles') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('articles*') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>المدونة</span>
                </a>
                <a href="{{ route('contact') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('contact') ? 'bg-white text-orange-600 shadow-lg' : 'text-white hover:bg-white/10' }}">
                    <i class="fas fa-comments"></i>
                    <span>تواصل معنا</span>
                </a>
                <div class="h-px bg-white/20 my-2"></div>
                <a href="{{ route('request-design.create') }}"
                   class="bg-white text-orange-600 font-black py-4 px-5 rounded-xl text-center hover:scale-105 transition-all duration-300 shadow-xl flex items-center justify-center gap-3">
                    <i class="fas fa-rocket text-lg"></i>
                    <span>ابدأ مشروعك الآن</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Scroll Effect */
    #navbar-ishraq.scrolled #navbar-bg {
        background: linear-gradient(135deg, rgba(255, 107, 53, 1) 0%, rgba(255, 140, 97, 0.98) 50%, rgba(255, 179, 148, 0.95) 100%);
        box-shadow: 0 10px 40px rgba(255, 107, 53, 0.3);
    }

    #navbar-ishraq.scrolled #navbar-glow {
        opacity: 1;
    }

    /* Glowing effect on nav links */
    .nav-link-glowing {
        position: relative;
    }

    .nav-link-glowing::before {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 12px;
        padding: 2px;
        background: linear-gradient(45deg, transparent, rgba(255, 211, 61, 0.5), transparent);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .nav-link-glowing:hover::before {
        opacity: 1;
    }
</style>

<script>
    // Mobile menu toggle with animation
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');

        if (!menu.classList.contains('hidden')) {
            menu.style.animation = 'slideDown 0.5s ease-out forwards';
        }
    });

    // Navbar scroll effect
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar-ishraq');
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });

    // Add slideDown animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
</script>
