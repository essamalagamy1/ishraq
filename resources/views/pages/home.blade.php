<x-layouts.app>
    {{-- Hero Section - Clean Split Layout with Animations --}}
    <section class="min-h-[85vh] flex items-center relative overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        {{-- Animated Background Pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
        {{-- Floating Decorative Elements --}}
        <div class="absolute top-20 right-10 w-3 h-3 rounded-full animate-float opacity-40" style="background: {{ config('colors.primary_light') }}; animation-delay: 0s;"></div>
        <div class="absolute top-40 right-1/4 w-2 h-2 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 1s;"></div>
        <div class="absolute bottom-32 right-20 w-4 h-4 rounded-full animate-float opacity-25" style="background: {{ config('colors.primary') }}; animation-delay: 0.5s;"></div>
        <div class="absolute top-1/3 left-10 w-2 h-2 rounded-full animate-float opacity-35" style="background: {{ config('colors.primary_light') }}; animation-delay: 1.5s;"></div>
        <div class="absolute bottom-20 left-1/4 w-3 h-3 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 2s;"></div>
        
        <div class="container mx-auto px-6 py-10 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Content Side --}}
                <div class="text-white">
                    {{-- Badge - Dynamic from $heroSection --}}
                    @if($heroSection && $heroSection->badge_text)
                    <div class="hero-animate inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6 border border-white/20 animate-fade-in-up" style="background: {{ config('colors.primary_15') }}; animation-delay: 0.1s;">
                        @if($heroSection->badge_icon)
                        <i class="{{ $heroSection->badge_icon }} animate-pulse" style="color: {{ config('colors.primary_light') }};"></i>
                        @endif
                        <span class="text-sm" style="color: {{ config('colors.primary_lighter') }};">{{ $heroSection->badge_text }}</span>
                    </div>
                    @endif

                    @if($heroSection)
                    {{-- Dynamic title from database --}}
                    <h1 class="hero-animate text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                        {{ $heroSection->title_line1 }}
                        <span class="block gradient-text-animated">{{ $heroSection->title_line2 }}</span>
                    </h1>

                    @if($heroSection->subtitle)
                    <p class="hero-animate text-xl text-gray-400 mb-8 max-w-lg animate-fade-in-up" style="animation-delay: 0.3s;">{{ $heroSection->subtitle }}</p>
                    @endif

                    {{-- CTA Buttons - Dynamic from $heroSection --}}
                    <div class="hero-animate flex flex-wrap gap-4 mb-12 animate-fade-in-up" style="animation-delay: 0.4s;">
                        @if($heroSection->cta_primary_text)
                        <a href="{{ $heroSection->cta_primary_link ?? route('request-design.create') }}"
                           class="btn-shine text-white font-bold py-4 px-8 rounded-xl hover:opacity-90 hover:scale-105 transition-all duration-300 flex items-center gap-2"
                           style="background: {{ config('colors.primary') }};">
                            <span>{{ $heroSection->cta_primary_text }}</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        @endif
                        @if($heroSection->cta_secondary_text)
                        <a href="{{ $heroSection->cta_secondary_link ?? route('portfolio') }}"
                           class="text-white font-bold py-4 px-8 rounded-xl border border-white/30 hover:bg-white/10 hover:scale-105 transition-all duration-300 flex items-center gap-2">
                            <span>{{ $heroSection->cta_secondary_text }}</span>
                        </a>
                        @endif
                    </div>
                    @endif

                    {{-- Stats - Dynamic from $stats with Counter Animation --}}
                    <div class="hero-animate flex flex-wrap gap-8 animate-fade-in-up" style="animation-delay: 0.5s;">
                        @foreach($stats as $index => $stat)
                        <div class="group">
                            <div class="text-3xl font-black counter-number transition-transform duration-300 group-hover:scale-110" style="color: {{ config('colors.primary_light') }};">{{ $stat->number }}</div>
                            <div class="text-gray-500 text-sm">{{ $stat->label }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Visual Side with Animations --}}
                <div class="hidden lg:block">
                    <div class="relative hero-animate animate-slide-in-right" style="animation-delay: 0.3s;">
                        <div class="rounded-2xl p-12 text-center animate-pulse-glow" style="background: {{ config('colors.primary_10') }}; border: 1px solid {{ config('colors.primary_30') }};">
                            <i class="fas fa-laptop-code text-8xl mb-4 animate-bounce" style="color: {{ config('colors.primary_light') }};"></i>
                            <h3 class="text-2xl font-bold text-white">حلول تقنية متكاملة</h3>
                            <p class="text-gray-400 mt-2">نحول أفكارك إلى منتجات رقمية</p>
                        </div>
                        <div class="absolute -top-4 -right-4 w-24 h-24 rounded-lg opacity-50 animate-float" style="background: {{ config('colors.primary') }}; animation-delay: 0.5s;"></div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full opacity-30 animate-float" style="background: {{ config('colors.primary_light') }}; animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section - Swiper Carousel with Animations --}}
    @if(isset($services) && count($services) > 0)
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 reveal-on-scroll">
                <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary') }};">خدماتنا</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">حلول تقنية متخصصة</h2>
                <p class="text-gray-600 text-lg mt-4 max-w-2xl mx-auto">
                    نقدم مجموعة شاملة من الخدمات التقنية لتحويل أفكارك إلى منتجات رقمية ناجحة
                </p>
            </div>

            {{-- Swiper Services --}}
            <div class="relative reveal-on-scroll">
                <div class="swiper services-swiper">
                    <div class="swiper-wrapper pb-4">
                        @foreach($services as $service)
                        <div class="swiper-slide h-auto">
                            <div class="group bg-white rounded-2xl p-8 border border-gray-100 hover:border-transparent card-hover h-full flex flex-col icon-hover">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300" style="background: {{ config('colors.primary_10') }};">
                                    <i class="{{ $service->icon }} text-2xl" style="color: {{ config('colors.primary') }};"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                                <p class="text-gray-600 mb-6 line-clamp-3 flex-1">{!! Str::limit(strip_tags($service->description), 100) !!}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}" 
                                   class="inline-flex items-center gap-2 font-semibold transition-all hover:gap-3" style="color: {{ config('colors.primary') }};">
                                    <span>{{ $service->cta_text ?? 'اطلب الآن' }}</span>
                                    <i class="fas fa-arrow-left text-sm"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                
                {{-- Navigation Buttons --}}
                <button class="services-prev absolute top-1/2 -translate-y-1/2 right-0 md:-right-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
                <button class="services-next absolute top-1/2 -translate-y-1/2 left-0 md:-left-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
            </div>

            <div class="text-center mt-12 reveal-on-scroll">
                <a href="{{ route('services') }}" class="btn-shine inline-flex items-center gap-2 text-white font-bold py-4 px-8 rounded-xl hover:scale-105 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <span>جميع الخدمات</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Projects - Swiper Carousel with Animations --}}
    @if(isset($featuredProjects) && count($featuredProjects) > 0)
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 reveal-on-scroll">
                <div>
                    <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary') }};">أعمالنا</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">مشاريع مميزة</h2>
                </div>
                <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 font-semibold transition-all hover:gap-3" style="color: {{ config('colors.primary') }};">
                    <span>عرض الكل</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            {{-- Swiper Projects --}}
            <div class="relative reveal-on-scroll">
                <div class="swiper projects-swiper">
                    <div class="swiper-wrapper pb-4">
                        @foreach($featuredProjects as $project)
                        <div class="swiper-slide">
                            <a href="{{ route('projects.show', $project) }}" class="group block rounded-2xl overflow-hidden bg-gray-100 card-hover">
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    <img src="{{ Storage::url($project->main_image) }}" 
                                         alt="{{ $project->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @if($project->types && $project->types->count() > 0)
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        @foreach($project->types->take(1) as $type)
                                        <span class="px-3 py-1 rounded-full text-xs font-bold text-white" style="background: {{ $type->color }};">
                                            {{ $type->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                    @endif
                                    {{-- Overlay on hover --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                        <span class="text-white font-semibold flex items-center gap-2">
                                            <i class="fas fa-eye"></i>
                                            عرض المشروع
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 bg-white">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-teal-600 transition-colors duration-300">{{ $project->title }}</h3>
                                    <p class="text-gray-500 text-sm line-clamp-2">{{ $project->short_description }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                
                {{-- Navigation Buttons --}}
                <button class="projects-prev absolute top-1/2 -translate-y-1/2 right-0 md:-right-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
                <button class="projects-next absolute top-1/2 -translate-y-1/2 left-0 md:-left-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
            </div>
        </div>
    </section>
    @endif

    {{-- Why Choose Us with Animations --}}
    <section class="py-24 relative overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        {{-- Floating Background Elements --}}
        <div class="absolute top-10 left-10 w-20 h-20 rounded-full opacity-10 animate-float" style="background: {{ config('colors.primary_light') }}; animation-delay: 0s;"></div>
        <div class="absolute bottom-20 right-20 w-32 h-32 rounded-full opacity-5 animate-float" style="background: {{ config('colors.primary') }}; animation-delay: 1.5s;"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16 reveal-on-scroll">
                <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary_light') }};">لماذا نحن</span>
                <h2 class="text-4xl md:text-5xl font-black text-white mt-2">
                    لماذا تختار {{ $companySettings->name ?? 'E-DATA 360' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($features as $index => $feature)
                <div class="reveal-scale text-center p-8 rounded-2xl border border-white/10 hover:border-white/30 card-hover icon-hover" style="background: rgba(255,255,255,0.05); transition-delay: {{ $index * 0.1 }}s;">
                    <div class="w-16 h-16 mx-auto rounded-xl flex items-center justify-center mb-6 group-hover:animate-bounce" style="background: {{ config('colors.primary_20') }};">
                        <i class="{{ $feature->icon }} text-3xl transition-transform duration-300" style="color: {{ config('colors.primary_light') }};"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">{{ $feature->title }}</h3>
                    <p class="text-gray-400">{{ $feature->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials - Swiper Carousel with Animations --}}
    @if(isset($testimonials) && count($testimonials) > 0)
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 reveal-on-scroll">
                <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary') }};">آراء العملاء</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">ماذا يقول عملاؤنا</h2>
            </div>

            {{-- Swiper Testimonials --}}
            <div class="relative max-w-5xl mx-auto reveal-on-scroll">
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper pb-4">
                        @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-2xl p-8 border border-gray-100 h-full card-hover">
                                <div class="flex gap-1 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} transition-transform hover:scale-125"></i>
                                    @endfor
                                </div>
                                <p class="text-gray-600 mb-6 leading-relaxed">{{ $testimonial->testimonial }}</p>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $testimonial->client_name }}</h4>
                                    @if($testimonial->client_position)
                                    <p class="text-gray-500 text-sm">{{ $testimonial->client_position }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                
                {{-- Navigation Buttons --}}
                <button class="testimonials-prev absolute top-1/2 -translate-y-1/2 right-0 md:-right-14 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
                <button class="testimonials-next absolute top-1/2 -translate-y-1/2 left-0 md:-left-14 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
            </div>

            <div class="text-center mt-12 reveal-on-scroll">
                <a href="{{ route('testimonial.create') }}" class="btn-shine inline-flex items-center gap-2 text-white font-bold py-4 px-8 rounded-xl hover:scale-105 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-star"></i>
                    <span>أضف تقييمك</span>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Latest Articles - Swiper Carousel with Animations --}}
    @if(isset($latestArticles) && $latestArticles->count() > 0)
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 reveal-on-scroll">
                <div>
                    <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary') }};">المدونة</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">أحدث المقالات</h2>
                </div>
                <a href="{{ route('articles') }}" class="inline-flex items-center gap-2 font-semibold transition-all hover:gap-3" style="color: {{ config('colors.primary') }};">
                    <span>جميع المقالات</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            {{-- Swiper Articles --}}
            <div class="relative reveal-on-scroll">
                <div class="swiper articles-swiper">
                    <div class="swiper-wrapper pb-4">
                        @foreach($latestArticles as $article)
                        <div class="swiper-slide">
                            <article class="group bg-gray-50 rounded-2xl overflow-hidden card-hover h-full">
                                <div class="aspect-video overflow-hidden relative">
                                    @if($article->featured_image)
                                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center" style="background: {{ config('colors.bg_dark') }};">
                                        <i class="fas fa-file-alt text-4xl text-white/30"></i>
                                    </div>
                                    @endif
                                    {{-- Overlay on hover --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="p-6">
                                    <div class="text-sm text-gray-500 mb-2">{{ $article->published_at->format('Y/m/d') }}</div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-teal-600 transition-colors duration-300">
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h3>
                                    <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center gap-2 text-sm font-semibold transition-all hover:gap-3" style="color: {{ config('colors.primary') }};">
                                        <span>اقرأ المزيد</span>
                                        <i class="fas fa-arrow-left text-xs"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                
                {{-- Navigation Buttons --}}
                <button class="articles-prev absolute top-1/2 -translate-y-1/2 right-0 md:-right-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
                <button class="articles-next absolute top-1/2 -translate-y-1/2 left-0 md:-left-5 z-10 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-125 transition-all duration-300" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section with Animations --}}
    <section class="py-24 relative overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        {{-- Floating Background Elements --}}
        <div class="absolute top-10 right-10 w-24 h-24 rounded-full opacity-5 animate-float" style="background: {{ config('colors.primary_light') }}; animation-delay: 0s;"></div>
        <div class="absolute bottom-20 left-20 w-32 h-32 rounded-full opacity-5 animate-float" style="background: {{ config('colors.primary') }}; animation-delay: 1.5s;"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 rounded-full opacity-5 animate-float" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 2s;"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center text-white reveal-on-scroll">
                <h2 class="text-4xl md:text-5xl font-black mb-6">جاهز لبدء مشروعك؟</h2>
                <p class="text-xl text-gray-400 mb-10">تواصل معنا اليوم واحصل على استشارة مجانية</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('request-design.create') }}" class="btn-shine text-white font-bold py-4 px-8 rounded-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2" style="background: {{ config('colors.primary') }};">
                        <i class="fas fa-rocket"></i>
                        <span>ابدأ الآن</span>
                    </a>
                    <a href="{{ route('contact') }}" class="text-white font-bold py-4 px-8 rounded-xl border border-white/30 hover:bg-white/10 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-phone"></i>
                        <span>تواصل معنا</span>
                    </a>
                </div>

                @if($companySettings)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-16">
                    @if($companySettings->main_email)
                    <div class="reveal-scale p-6 rounded-xl border border-white/10 card-hover icon-hover" style="background: rgba(255,255,255,0.05);">
                        <i class="fas fa-envelope text-2xl mb-3 transition-transform" style="color: {{ config('colors.primary_light') }};"></i>
                        <h4 class="font-bold mb-1">البريد الإلكتروني</h4>
                        <a href="mailto:{{ $companySettings->main_email }}" class="text-gray-400 text-sm hover:text-white transition-colors">{{ $companySettings->main_email }}</a>
                    </div>
                    @endif
                    @if($companySettings->whatsapp_number)
                    <div class="reveal-scale p-6 rounded-xl border border-white/10 card-hover icon-hover" style="background: rgba(255,255,255,0.05); transition-delay: 0.1s;">
                        <i class="fab fa-whatsapp text-2xl mb-3 text-green-400 transition-transform"></i>
                        <h4 class="font-bold mb-1">واتساب</h4>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}" class="text-gray-400 text-sm hover:text-white transition-colors">تواصل مباشر</a>
                    </div>
                    @endif
                    @if($companySettings->phone_primary)
                    <div class="reveal-scale p-6 rounded-xl border border-white/10 card-hover icon-hover" style="background: rgba(255,255,255,0.05); transition-delay: 0.2s;">
                        <i class="fas fa-phone text-2xl mb-3 transition-transform" style="color: {{ config('colors.primary_light') }};"></i>
                        <h4 class="font-bold mb-1">الهاتف</h4>
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
            // Services Swiper
            new Swiper('.services-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                autoHeight: false,
                pagination: {
                    el: '.services-swiper .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.services-next',
                    prevEl: '.services-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });

            // Projects Swiper
            new Swiper('.projects-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                pagination: {
                    el: '.projects-swiper .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.projects-next',
                    prevEl: '.projects-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });

            // Testimonials Swiper
            new Swiper('.testimonials-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
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

            // Articles Swiper
            new Swiper('.articles-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                pagination: {
                    el: '.articles-swiper .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.articles-next',
                    prevEl: '.articles-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });
        });
    </script>
</x-layouts.app>
