@props(['companySettings', 'socialLinks'])

{{-- Radiant Footer with Glowing Effects --}}
<footer class="relative overflow-hidden text-white" style="background: {{ config('colors.bg_dark') }};">
    {{-- Animated Background Glow --}}
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full blur-3xl animate-pulse"
             style="background: radial-gradient(circle, {{ config('colors.primary_30') }}, transparent);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full blur-3xl animate-pulse"
             style="background: radial-gradient(circle, {{ config('colors.accent_yellow') }}33, transparent); animation-delay: 1s;"></div>
    </div>

    {{-- Top Border with Gradient Glow --}}
    <div class="h-1 relative">
        <div class="absolute inset-0 animate-gradient-x"
             style="background: linear-gradient(90deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }}, {{ config('colors.primary') }});
                    background-size: 200% 100%;"></div>
        <div class="absolute inset-0 blur-sm"
             style="background: linear-gradient(90deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }}, {{ config('colors.primary') }});
                    background-size: 200% 100%;"></div>
    </div>

    <div class="container mx-auto px-6 py-16 relative z-10" data-aos="fade-up" data-aos-delay="300">
        {{-- Main Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            {{-- Company Info - Dynamic --}}
            <div data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center mb-6 group">
                    @if(isset($companySettings) && $companySettings->logo_2_path)
                        <img class="h-12 transition-all duration-500 group-hover:scale-110 group-hover:drop-shadow-[0_0_15px_rgba(255,107,53,0.5)]"
                             src="{{ Storage::url($companySettings->logo_2_path) }}"
                             alt="{{ $companySettings->company_name ?? 'إشراق' }}">
                    @elseif(isset($companySettings) && $companySettings->logo_path)
                        <img class="h-12 transition-all duration-500 group-hover:scale-110 group-hover:drop-shadow-[0_0_15px_rgba(255,107,53,0.5)]"
                             src="{{ Storage::url($companySettings->logo_path) }}"
                             alt="{{ $companySettings->company_name ?? 'إشراق' }}">
                    @else
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center relative overflow-hidden group"
                                 style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }});">
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                <i class="fas fa-code text-white text-lg relative z-10 group-hover:rotate-12 transition-transform duration-500"></i>
                            </div>
                            <span class="text-2xl font-black text-white">
                                {{ $companySettings->company_name ?? 'إشراق' }}
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Dynamic about text --}}
                <p class="text-gray-400 leading-relaxed mb-6 text-sm">
                    {{ $companySettings->about_short ?? 'شريكك الموثوق في تطوير الحلول البرمجية والمنتجات الرقمية.' }}
                </p>

            </div>

            {{-- Quick Links with Animated Icons --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 rounded-full animate-pulse" style="background: linear-gradient(180deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }});"></span>
                    روابط سريعة
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">الرئيسية</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">من نحن</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">خدماتنا</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">أعمالنا</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">تواصل معنا</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">المدونة</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('careers') }}" class="group flex items-center gap-2 text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fas fa-chevron-left text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                               style="color: {{ config('colors.accent_yellow') }};"></i>
                            <span class="group-hover:translate-x-1 transition-transform duration-300">الوظائف</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Services - Dynamic --}}
            <div data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 rounded-full animate-pulse" style="background: linear-gradient(180deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }}); animation-delay: 0.5s;"></span>
                    خدماتنا
                </h3>
                <ul class="space-y-3">
                    @if(isset($footerServices) && $footerServices->count() > 0)
                        @foreach($footerServices as $service)
                        <li class="flex items-center gap-2 text-gray-400 group">
                            <i class="fas fa-sparkles text-xs transition-all duration-300 group-hover:text-yellow-400 group-hover:animate-pulse"
                               style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="group-hover:text-white transition-colors duration-300">{{ $service->title }}</span>
                        </li>
                        @endforeach
                    @else
                        <li class="flex items-center gap-2 text-gray-400 group">
                            <i class="fas fa-sparkles text-xs transition-all duration-300 group-hover:text-yellow-400 group-hover:animate-pulse"
                               style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="group-hover:text-white transition-colors duration-300">تطوير الويب</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-400 group">
                            <i class="fas fa-sparkles text-xs transition-all duration-300 group-hover:text-yellow-400 group-hover:animate-pulse"
                               style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="group-hover:text-white transition-colors duration-300">تطبيقات الجوال</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-400 group">
                            <i class="fas fa-sparkles text-xs transition-all duration-300 group-hover:text-yellow-400 group-hover:animate-pulse"
                               style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="group-hover:text-white transition-colors duration-300">تصميم UI/UX</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-400 group">
                            <i class="fas fa-sparkles text-xs transition-all duration-300 group-hover:text-yellow-400 group-hover:animate-pulse"
                               style="color: {{ config('colors.primary_light') }};"></i>
                            <span class="group-hover:text-white transition-colors duration-300">الاستضافة والسيرفرات</span>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Contact Info - Dynamic --}}
            <div data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 rounded-full animate-pulse" style="background: linear-gradient(180deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }}); animation-delay: 1s;"></span>
                    تواصل معنا
                </h3>
                <ul class="space-y-4">
                    @if(isset($companySettings) && $companySettings->main_email)
                    <li>
                        <a href="mailto:{{ $companySettings->main_email }}"
                           class="group flex items-center gap-3 text-gray-400 hover:text-white transition-all duration-300">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                                 style="background: {{ config('colors.primary_10') }};">
                                <i class="fas fa-envelope transition-all duration-300 group-hover:rotate-12"
                                   style="color: {{ config('colors.primary') }};"></i>
                            </div>
                            <span class="text-sm break-all">{{ $companySettings->main_email }}</span>
                        </a>
                    </li>
                    @endif
                    @if(isset($companySettings) && $companySettings->whatsapp_number)
                    <li>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}"
                           class="group flex items-center gap-3 text-gray-400 hover:text-white transition-all duration-300">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                                 style="background: rgba(16, 185, 129, 0.1);">
                                <i class="fab fa-whatsapp text-green-500 transition-all duration-300 group-hover:rotate-12"></i>
                            </div>
                            <span dir="ltr" class="text-sm">{{ $companySettings->whatsapp_number }}</span>
                        </a>
                    </li>
                    @endif
                </ul>

                {{-- Social Links - Dynamic with Glow Effects --}}
                @if(isset($socialLinks) && count($socialLinks) > 0)
                <div class="mt-6">
                    <h4 class="text-sm font-semibold text-white mb-3 flex items-center gap-2">
                        <i class="fas fa-heart animate-pulse" style="color: {{ config('colors.accent_yellow') }};"></i>
                        تابعنا
                    </h4>
                    <div class="flex gap-3 flex-wrap">
                        @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank"
                           class="group w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-500 relative overflow-hidden hover:scale-110 hover:-rotate-6"
                           style="background: {{ config('colors.white_10') }};">
                            {{-- Glow Effect on Hover --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-md"
                                 style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }});"></div>

                            {{-- Icon --}}
                            <div class="relative z-10">
                                @if(str_contains(strtolower($link->platform), 'twitter') || str_contains(strtolower($link->platform), 'x'))
                                    <i class="fab fa-x-twitter text-white text-sm group-hover:scale-125 transition-transform duration-300"></i>
                                @elseif(str_contains(strtolower($link->platform), 'facebook'))
                                    <i class="fab fa-facebook-f text-white text-sm group-hover:scale-125 transition-transform duration-300"></i>
                                @elseif(str_contains(strtolower($link->platform), 'instagram'))
                                    <i class="fab fa-instagram text-white text-sm group-hover:scale-125 transition-transform duration-300"></i>
                                @elseif(str_contains(strtolower($link->platform), 'linkedin'))
                                    <i class="fab fa-linkedin-in text-white text-sm group-hover:scale-125 transition-transform duration-300"></i>
                                @else
                                    <i class="fas fa-link text-white text-sm group-hover:scale-125 transition-transform duration-300"></i>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- CTA Section with Radiant Glow --}}

        {{-- Bottom Bar with Gradient --}}
        <div class="pt-8 mt-8 border-t relative" style="border-color: rgba(255, 255, 255, 0.2);" >
            {{-- Gradient Line Above --}}
            <div class="absolute top-0 left-0 right-0 h-px"
                 style="background: linear-gradient(90deg, transparent, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }}, {{ config('colors.primary') }}, transparent);"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-300 text-sm flex items-center gap-2">
                    <i class="far fa-copyright" style="color: {{ config('colors.primary_light') }};"></i>
                    <span>{{ date('Y') }}</span>
                    <span class="font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">
                        {{ $companySettings->company_name ?? 'إشراق' }}
                    </span>
                    <span>- جميع الحقوق محفوظة</span>
                </p>
                <div class="flex items-center gap-4 text-gray-300 text-sm">
                    <a href="{{ route('privacy') }}"
                       class="hover:text-white transition-all duration-300 relative group/link">
                        <span>سياسة الخصوصية</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover/link:w-full transition-all duration-300"
                              style="background: {{ config('colors.primary') }};"></span>
                    </a>
                    <span class="opacity-50">|</span>
                    <a href="{{ route('terms') }}"
                       class="hover:text-white transition-all duration-300 relative group/link">
                        <span>الشروط والأحكام</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 group-hover/link:w-full transition-all duration-300"
                              style="background: {{ config('colors.primary') }};"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 left-8 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-500 hover:scale-110 z-50 group shadow-2xl"
            style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }});">
        <i class="fas fa-arrow-up text-white group-hover:animate-bounce"></i>
        <div class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-lg"
             style="background: linear-gradient(135deg, {{ config('colors.primary') }}, {{ config('colors.accent_yellow') }});"></div>
    </button>
</footer>

{{-- Custom Animations --}}
<style>
@keyframes gradient-x {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient-x {
    animation: gradient-x 3s ease infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>
