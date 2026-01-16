<x-layouts.app>
    {{-- Hero Section with Animations --}}
    <section class="relative min-h-[30vh] flex items-center overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-10 right-20 w-3 h-3 rounded-full animate-float opacity-40" style="background: {{ config('colors.primary_light') }};"></div>
        <div class="absolute bottom-10 left-10 w-4 h-4 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 1s;"></div>
        <div class="container mx-auto px-6 relative z-10 py-20">
            <div class="max-w-4xl">
                <div class="flex items-center gap-3 mb-8 text-gray-400 text-sm hero-animate animate-fade-in-up" style="animation-delay: 0.1s;">
                    <a href="{{ route('home') }}" class="hover:text-white transition">الرئيسية</a>
                    <i class="fas fa-chevron-left text-xs"></i>
                    <span style="color: {{ config('colors.primary_light') }};">خدماتنا</span>
                </div>
                @if($heroSection)
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                    {{ $heroSection->title_line1 }}
                    <span class="gradient-text-animated">{{ $heroSection->title_line2 }}</span>
                </h1>
                @if($heroSection->subtitle)
                <p class="text-xl text-gray-400 max-w-2xl leading-relaxed hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">{{ $heroSection->subtitle }}</p>
                @endif
                @else
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                    خدماتنا
                    <span class="block mt-2 gradient-text-animated">البرمجية</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl leading-relaxed hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">
                    حلول تقنية متكاملة لتحويل أفكارك إلى منتجات رقمية ناجحة
                </p>
                @endif
            </div>
        </div>
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-32 rounded-full animate-pulse" style="background: linear-gradient(to bottom, transparent, {{ config('colors.primary_light') }}, transparent);"></div>
    </section>

    {{-- Services Grid - Bento Style --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            {{-- Section Header --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16">
                <div>
                    <span class="text-sm font-bold tracking-wider uppercase" style="color: {{ config('colors.primary') }};">ما نقدمه</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">
                        خدمات متخصصة
                    </h2>
                </div>
                <p class="text-gray-600 max-w-md text-lg">
                    نقدم مجموعة شاملة من الحلول التقنية المصممة خصيصاً لتلبية احتياجات عملك
                </p>
            </div>

            {{-- Bento Grid Layout - Dynamic from $services --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $index => $service)
                {{-- Service Card - Dynamic from database --}}
                <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-transparent hover:shadow-2xl transition-all duration-500 ">
                    {{-- Top Accent Line --}}
                    <div class="absolute top-0 left-0 right-0 h-1 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500" style="background: linear-gradient(to right, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});"></div>
                    
                    <div class="p-8">
                        {{-- Icon --}}
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 transition-all duration-500 group-hover:scale-110" style="background: {{ config('colors.primary_10') }};">
                            {{-- Dynamic icon from database --}}
                            <i class="{{ $service->icon }} text-2xl" style="color: {{ config('colors.primary') }};"></i>
                        </div>

                        {{-- Dynamic title from database --}}
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-700 transition-colors">
                            {{ $service->title }}
                        </h3>

                        {{-- Dynamic description from database --}}
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {!! Str::limit(strip_tags($service->description), 120) !!}
                        </p>

                        {{-- Features - Dynamic from database --}}
                        @if($service->features->count() > 0)
                        <ul class="space-y-2 mb-8">
                            @foreach($service->features->take($index === 0 ? 5 : 3) as $feature)
                            <li class="flex items-center text-gray-700 text-sm">
                                <span class="w-1.5 h-1.5 rounded-full mr-3" style="background: {{ config('colors.primary') }};"></span>
                                {{ $feature->feature_text }}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        {{-- CTA --}}
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}" 
                           class="inline-flex items-center gap-2 font-bold transition-all group-hover:gap-4" style="color: {{ config('colors.primary') }};">
                            <span>{{ $service->cta_text ?? 'اطلب الآن' }}</span>
                            <i class="fas fa-arrow-left text-sm"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process Section - Timeline Style --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <span class="text-sm font-bold tracking-wider uppercase" style="color: {{ config('colors.primary') }};">كيف نعمل</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2">
                    خطوات بسيطة نحو النجاح
                </h2>
            </div>

            {{-- Horizontal Timeline --}}
            <div class="relative max-w-5xl mx-auto">
                {{-- Connecting Line --}}
                <div class="hidden md:block absolute top-16 left-0 right-0 h-0.5 bg-gray-200"></div>
                <div class="hidden md:block absolute top-16 left-0 h-0.5 transition-all duration-1000" style="background: {{ config('colors.primary') }}; width: 100%;"></div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {{-- Step 1 --}}
                    <div class="relative text-center">
                        <div class="w-12 h-12 rounded-full mx-auto mb-6 flex items-center justify-center text-white font-bold text-lg relative z-10" style="background: {{ config('colors.primary') }};">
                            1
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">التواصل</h3>
                        <p class="text-gray-600 text-sm">تواصل معنا واخبرنا عن مشروعك</p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="relative text-center">
                        <div class="w-12 h-12 rounded-full mx-auto mb-6 flex items-center justify-center text-white font-bold text-lg relative z-10" style="background: {{ config('colors.primary') }};">
                            2
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">الدراسة</h3>
                        <p class="text-gray-600 text-sm">ندرس احتياجاتك ونضع خطة عمل</p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="relative text-center">
                        <div class="w-12 h-12 rounded-full mx-auto mb-6 flex items-center justify-center text-white font-bold text-lg relative z-10" style="background: {{ config('colors.primary') }};">
                            3
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">التنفيذ</h3>
                        <p class="text-gray-600 text-sm">نبدأ العمل مع تحديثات مستمرة</p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="relative text-center">
                        <div class="w-12 h-12 rounded-full mx-auto mb-6 flex items-center justify-center text-white font-bold text-lg relative z-10" style="background: {{ config('colors.primary') }};">
                            4
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">التسليم</h3>
                        <p class="text-gray-600 text-sm">نسلمك المشروع جاهزاً مع الدعم</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section - Split Design --}}
    <section class="relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            {{-- Left Side - Content --}}
            <div class="p-12 lg:p-20 flex items-center" style="background: {{ config('colors.bg_dark') }};">
                <div class="max-w-lg">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                        جاهز لبدء مشروعك؟
                    </h2>
                    <p class="text-gray-400 text-lg mb-8">
                        تواصل معنا اليوم واحصل على استشارة مجانية لمناقشة احتياجاتك
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('request-design.create') }}" class="inline-flex items-center justify-center gap-2 text-white font-bold py-4 px-8 rounded-xl transition-all hover:opacity-90" style="background: {{ config('colors.primary') }};">
                            <i class="fas fa-rocket"></i>
                            <span>ابدأ الآن</span>
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 text-white font-bold py-4 px-8 rounded-xl border border-white/20 hover:bg-white/10 transition-all">
                            <i class="fas fa-phone"></i>
                            <span>تواصل معنا</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Side - Visual --}}
            <div class="p-12 lg:p-20 flex items-center justify-center min-h-[400px]" style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.primary_light') }});">
                <div class="text-center text-white">
                    <div class="text-8xl mb-6">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="text-2xl font-bold mb-2">حلول برمجية متكاملة</div>
                    <div class="text-white/80">نحول أفكارك إلى واقع</div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
