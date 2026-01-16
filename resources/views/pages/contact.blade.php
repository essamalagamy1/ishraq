<x-layouts.app>
    {{-- Hero with Animations --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-10 right-10 w-3 h-3 rounded-full animate-float opacity-40" style="background: {{ config('colors.primary_light') }};"></div>
        <div class="absolute bottom-10 left-20 w-4 h-4 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 1s;"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-6 text-gray-400 text-sm hero-animate animate-fade-in-up" style="animation-delay: 0.1s;">
                    <a href="{{ route('home') }}" class="hover:text-white transition">الرئيسية</a>
                    <i class="fas fa-chevron-left text-xs"></i>
                    <span style="color: {{ config('colors.primary_light') }};">تواصل معنا</span>
                </div>
                @if($heroSection)
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4 hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                    {{ $heroSection->title_line1 }}
                    <span class="gradient-text-animated">{{ $heroSection->title_line2 }}</span>
                </h1>
                @if($heroSection->subtitle)
                <p class="text-gray-400 text-lg hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">{{ $heroSection->subtitle }}</p>
                @endif
                @else
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4 hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                    تواصل <span class="gradient-text-animated">معنا</span>
                </h1>
                <p class="text-gray-400 text-lg hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">نسعد بتواصلك معنا وسنرد عليك في أقرب وقت</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Main Contact Section --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 max-w-6xl mx-auto">
                
                {{-- Contact Info - Sidebar --}}
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <span class="text-sm font-bold tracking-wider uppercase" style="color: {{ config('colors.primary') }};">معلومات التواصل</span>
                        <h2 class="text-3xl font-black text-gray-900 mt-2">كيف يمكننا مساعدتك؟</h2>
                    </div>

                    {{-- Contact Cards - Dynamic from $companySettings --}}
                    <div class="space-y-4">
                        @if($companySettings && $companySettings->main_email)
                        <div class="bg-white rounded-xl p-5 border border-gray-100 hover:border-gray-200 hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background: {{ config('colors.primary_10') }};">
                                    <i class="fas fa-envelope" style="color: {{ config('colors.primary') }};"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">البريد الإلكتروني</h3>
                                    {{-- Dynamic email from database --}}
                                    <a href="mailto:{{ $companySettings->main_email }}" class="text-gray-600 hover:underline">
                                        {{ $companySettings->main_email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($companySettings && $companySettings->whatsapp_number)
                        <div class="bg-white rounded-xl p-5 border border-gray-100 hover:border-gray-200 hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(34, 197, 94, 0.1);">
                                    <i class="fab fa-whatsapp text-green-500"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">واتساب</h3>
                                    {{-- Dynamic WhatsApp from database --}}
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}" class="text-gray-600 hover:underline">
                                        <span dir="ltr">{{ $companySettings->whatsapp_number }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($companySettings && $companySettings->location_text)
                        <div class="bg-white rounded-xl p-5 border border-gray-100 hover:border-gray-200 hover:shadow-md transition-all">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(239, 68, 68, 0.1);">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">الموقع</h3>
                                    {{-- Dynamic location from database --}}
                                    <p class="text-gray-600">{{ $companySettings->location_text }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Social Links - Dynamic from $socialLinks --}}
                    @if($socialLinks && $socialLinks->count() > 0)
                    <div class="pt-6">
                        <h3 class="font-bold text-gray-900 mb-4">تابعنا</h3>
                        <div class="flex gap-3">
                            @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-all">
                                @if(str_contains(strtolower($link->platform), 'twitter') || str_contains(strtolower($link->platform), 'x'))
                                    <i class="fab fa-x-twitter text-gray-600"></i>
                                @elseif(str_contains(strtolower($link->platform), 'facebook'))
                                    <i class="fab fa-facebook-f text-gray-600"></i>
                                @elseif(str_contains(strtolower($link->platform), 'instagram'))
                                    <i class="fab fa-instagram text-gray-600"></i>
                                @elseif(str_contains(strtolower($link->platform), 'linkedin'))
                                    <i class="fab fa-linkedin-in text-gray-600"></i>
                                @else
                                    <i class="fas fa-link text-gray-600"></i>
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Contact Form --}}
                <div class="lg:col-span-3">
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-green-800">تم الإرسال بنجاح!</h4>
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        @csrf
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">أرسل رسالتك</h3>
                        
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">الاسم الكامل</label>
                                    <input type="text" name="name" id="name" required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="اسمك الكامل">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني</label>
                                    <input type="email" name="email" id="email" required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="example@email.com">
                                </div>
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">رقم الجوال <span class="text-gray-400 font-normal">(اختياري)</span></label>
                                <input type="tel" name="phone" id="phone"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                       placeholder="+966 XX XXX XXXX">
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">الرسالة</label>
                                <textarea name="message" id="message" rows="5" required
                                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all resize-none"
                                          placeholder="اكتب رسالتك هنا..."></textarea>
                            </div>

                            <button type="submit" class="w-full text-white font-bold py-4 px-6 rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2 cursor-pointer"
                            style="background: {{ config('colors.primary') }};">
                                <i class="fas fa-paper-plane"></i>
                                <span>إرسال الرسالة</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
