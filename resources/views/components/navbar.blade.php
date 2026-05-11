@props(['companySettings', 'socialLinks'])

<!-- Navbar المُشرق الجديد -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-700" id="navbar-ishraq">
    <!-- Background with Dark Gradient -->
    <div class="absolute inset-0 transition-all duration-700" id="navbar-bg"
         style="background: linear-gradient(135deg, rgba(10, 13, 20, 0.95) 0%, rgba(15, 20, 30, 0.92) 50%, rgba(20, 25, 35, 0.90) 100%); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 107, 53, 0.2);">
    </div>

    <!-- Glowing line at bottom -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-orange-500 to-transparent opacity-0 transition-opacity duration-500" id="navbar-glow"></div>

    <div class="container mx-auto px-4 py-4 relative z-10 sm:px-6 sm:py-2">
        <div class="flex items-center justify-between">
            {{-- Logo المُشرق --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group relative">
                    @if(isset($companySettings) && $companySettings->logo_path)
                        {{-- Dynamic logo from database --}}
                        <img class="h-15 transition-all duration-500 group-hover:scale-110 group-hover:drop-shadow-[0_0_15px_rgba(255,211,61,0.8)] filter brightness-110"
                             src="{{ Storage::url($companySettings->logo_path) }}"
                             alt="{{ $companySettings->company_name ?? 'إشراق' }}"
                             width="140" height="60">
                    @else
                        {{-- Fallback logo مُشرق --}}
                        <div class="flex items-center gap-3 group-hover:gap-4 transition-all duration-500">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-gradient-to-br from-yellow-300 to-orange-400 shadow-xl group-hover:shadow-[0_0_30px_rgba(255,211,61,0.8)] transition-all duration-500 group-hover:rotate-12">
                                <i class="fas fa-sun text-white text-xl group-hover:text-2xl transition-all duration-500"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-3xl font-black text-white drop-shadow-lg">إشراق</span>
                            </div>
                        </div>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation مع تأثيرات مُشرقة --}}
            <div class="hidden lg:flex lg:items-center lg:gap-2">
                <a href="{{ route('home') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('home') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('home') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        الرئيسية
                    </span>
                    @if(!request()->routeIs('home'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('about') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('about') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        من نحن
                    </span>
                    @if(!request()->routeIs('about'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a>

                <a href="{{ route('services') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('services') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('services') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        خدماتنا
                    </span>
                    @if(!request()->routeIs('services'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a>

                {{-- <a href="{{ route('portfolio') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('portfolio') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('portfolio') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        أعمالنا
                    </span>
                    @if(!request()->routeIs('portfolio'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a> --}}

                <a href="{{ route('articles') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('articles*') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('articles*') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        المدونة
                    </span>
                    @if(!request()->routeIs('articles*'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a>

                <a href="{{ route('contact') }}"
                   class="nav-link-glowing relative font-bold transition-all duration-500 px-5 py-2.5 rounded-xl group overflow-hidden
                          {{ request()->routeIs('contact') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('contact') ? 'background: rgba(255, 107, 53, 0.2); border: 1px solid rgba(255, 107, 53, 0.3);' : '' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        تواصل معنا
                    </span>
                    @if(!request()->routeIs('contact'))
                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out" style="background: rgba(255, 107, 53, 0.1);"></div>
                    @endif
                </a>

             {{-- CTA Button مُشرق مع تأثير خاص --}}
                <a href="{{ route('request-design.create') }}"
                   class="mr-4 relative text-white font-black py-3 px-8 rounded-2xl hover:scale-110 transition-all duration-500 flex items-center gap-3 group overflow-hidden shadow-2xl"
                   style="background: linear-gradient(135deg, #FF6B35, #ff8c5a); box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-400 via-orange-300 to-orange-400 opacity-0 group-hover:opacity-30 transition-opacity duration-500"></div>
                    <i class="fas fa-rocket text-lg relative z-10 group-hover:translate-x-2 transition-transform duration-500 text-white"></i>
                    <span class="relative z-10 text-white">ابدأ مشروعك</span>
                </a>
            </div>

            {{-- Mobile Menu Button مُشرق --}}
            <button id="mobile-menu-button" aria-label="فتح القائمة" class="lg:hidden text-white hover:text-yellow-200 p-3 rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-bars text-2xl group-hover:rotate-180 transition-transform duration-500"></i>
            </button>
        </div>

        {{-- Mobile Navigation مُشرق --}}
        <div id="mobile-menu" class="hidden lg:hidden mt-6 pb-4">
            <div class="flex flex-col gap-2 backdrop-blur-xl rounded-2xl p-5 border shadow-2xl" style="background: rgba(15, 20, 30, 0.95); border-color: rgba(255, 107, 53, 0.2);">
                <a href="{{ route('home') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('home') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('home') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <span>الرئيسية</span>
                </a>
                <a href="{{ route('about') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('about') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('about') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <span>من نحن</span>
                </a>
                <a href="{{ route('services') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('services') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('services') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>خدماتنا</span>
                </a>
                {{-- <a href="{{ route('portfolio') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('portfolio') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('portfolio') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <span>أعمالنا</span>
                </a> --}}
                <a href="{{ route('articles') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('articles*') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('articles*') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <span>المدونة</span>
                </a>
                <a href="{{ route('contact') }}"
                   class="font-bold py-3.5 px-5 rounded-xl transition-all duration-300 flex items-center gap-3 {{ request()->routeIs('contact') ? 'text-white shadow-lg' : 'text-gray-300 hover:text-white' }}"
                   style="{{ request()->routeIs('contact') ? 'background: rgba(255, 107, 53, 0.2);' : '' }}">
                    <span>تواصل معنا</span>
                </a>
                <div class="h-px my-2" style="background: rgba(255, 107, 53, 0.2);"></div>
                <a href="{{ route('request-design.create') }}"
                   class="text-white font-black py-4 px-5 rounded-xl text-center hover:scale-105 transition-all duration-300 shadow-xl flex items-center justify-center gap-3"
                   style="background: linear-gradient(135deg, #0D9488, #10B981);">
                    <span>ابدأ مشروعك الآن</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Scroll Effect */
    #navbar-ishraq.scrolled #navbar-bg {
        background: linear-gradient(135deg, rgba(10, 13, 20, 0.98) 0%, rgba(15, 20, 30, 0.95) 50%, rgba(20, 25, 35, 0.92) 100%);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        border-bottom: 1px solid rgba(255, 107, 53, 0.4);
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
        background: linear-gradient(45deg, transparent, rgba(255, 107, 53, 0.5), transparent);
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
