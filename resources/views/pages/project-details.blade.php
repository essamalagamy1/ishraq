<x-layouts.app :seo="$project">
    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
                        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="container mx-auto px-6 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="mb-6 flex items-center gap-3 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">الرئيسية</a>
                <i class="fas fa-chevron-left text-xs"></i>
                <a href="{{ route('portfolio') }}" class="hover:text-white transition-colors">أعمالنا</a>
                <i class="fas fa-chevron-left text-xs"></i>
                <span style="color: {{ config('colors.primary_light') }};">{{ $project->title }}</span>
            </nav>

            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4">
                    {{ $project->title }}
                </h1>

                @if($project->short_description)
                <p class="text-xl text-gray-400 mb-6">{{ $project->short_description }}</p>
                @endif

                {{-- Project Types --}}
                @if($project->types && $project->types->count() > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($project->types as $type)
                    <a href="{{ route('portfolio', ['type' => $type->slug]) }}" 
                       class="px-4 py-2 rounded-full text-sm font-semibold text-white hover:opacity-90 transition-opacity"
                       style="background: {{ $type->color }};">
                        @if($type->icon)<i class="{{ $type->icon }} ml-1"></i>@endif
                        {{ $type->name }}
                    </a>
                    @endforeach
                </div>
                @endif

                {{-- Quick Info --}}
                <div class="flex flex-wrap items-center gap-6 text-gray-400 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt" style="color: {{ config('colors.primary_light') }};"></i>
                        <span>{{ $project->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span>مكتمل</span>
                    </div>
                    @if($project->projectImages && $project->projectImages->count() > 0)
                    <div class="flex items-center gap-2">
                        <i class="fas fa-images" style="color: {{ config('colors.primary_light') }};"></i>
                        <span>{{ $project->projectImages->count() }} صورة</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Main Image --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto">
                <a href="{{ Storage::url($project->main_image) }}" 
                   data-fancybox="project-gallery" 
                   data-caption="{{ $project->title }}"
                   class="block rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow cursor-pointer">
                    <img src="{{ Storage::url($project->main_image) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-auto object-cover">
                </a>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-12">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-12">
                        {{-- Description --}}
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-1 h-8 rounded-full" style="background: {{ config('colors.primary') }};"></div>
                                تفاصيل المشروع
                            </h2>
                            <div class="prose prose-lg max-w-none bg-gray-50 rounded-2xl p-8 border border-gray-100">
                                {!! $project->description !!}
                            </div>
                        </div>

                        {{-- Image Gallery --}}
                        @if($project->projectImages && $project->projectImages->count() > 0)
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-1 h-8 rounded-full" style="background: {{ config('colors.primary') }};"></div>
                                معرض الصور
                            </h2>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($project->projectImages as $image)
                                <a href="{{ Storage::url($image->image_path) }}" 
                                   data-fancybox="project-gallery" 
                                   data-caption="{{ $image->caption ?? $project->title }}"
                                   class="group relative rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all aspect-square cursor-pointer">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                         alt="{{ $image->caption }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-2xl"></i>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Video Section --}}
                        @if($project->video_url)
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <div class="w-1 h-8 rounded-full" style="background: {{ config('colors.primary') }};"></div>
                                فيديو المشروع
                            </h2>
                            <div class="rounded-2xl overflow-hidden shadow-xl">
                                <div class="aspect-video">
                                    <video controls class="w-full h-full">
                                        <source src="{{ Storage::url($project->video_url) }}" type="video/mp4">
                                        متصفحك لا يدعم تشغيل الفيديو.
                                    </video>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Sidebar --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 space-y-6">
                            {{-- Purchase Card --}}
                            @if($project->is_available_for_purchase && $companySettings && $companySettings->whatsapp_number)
                            <div class="bg-green-50 rounded-2xl p-6 border border-green-200">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">متاح للشراء</h3>
                                        <p class="text-sm text-gray-600">يمكنك شراء هذا المشروع</p>
                                    </div>
                                </div>

                                @if($project->price)
                                <div class="bg-white rounded-xl p-4 mb-4 border border-green-200 text-center">
                                    <span class="text-3xl font-black text-green-600">{{ number_format($project->price, 2) }}</span>
                                    <span class="text-gray-600 font-semibold">ر.س</span>
                                </div>
                                @endif

                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}?text={{ urlencode('مرحباً، أنا مهتم بشراء المشروع: ' . $project->title . "\n" . 'رابط المشروع: ' . request()->url()) }}"
                                   target="_blank"
                                   class="flex items-center justify-center gap-2 w-full bg-green-500 text-white font-bold py-3 px-6 rounded-xl hover:bg-green-600 transition-colors">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                    <span>اشتري عبر واتساب</span>
                                </a>
                            </div>
                            @endif

                            {{-- Request Similar --}}
                            <div class="rounded-2xl p-6 border border-gray-100" style="background: {{ config('colors.primary_05') }};">
                                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-rocket" style="color: {{ config('colors.primary') }};"></i>
                                    هل أعجبك المشروع؟
                                </h3>
                                <p class="text-gray-600 mb-6 text-sm">
                                    يمكننا مساعدتك في إنشاء مشروع مشابه
                                </p>
                                <div class="space-y-3">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}?text={{ urlencode('مرحباً، أنا مهتم بطلب تصميم مشابه لمشروع: ' . $project->title) }}"
                                       class="flex items-center justify-center gap-2 w-full text-white font-bold py-3 px-6 rounded-xl hover:opacity-90 transition-all"
                                       style="background: {{ config('colors.primary') }};">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>اطلب تصميم مشابه</span>
                                    </a>
                                    <a href="{{ route('portfolio') }}"
                                       class="flex items-center justify-center gap-2 w-full bg-white text-gray-700 font-semibold py-3 px-6 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors">
                                        <i class="fas fa-th-large"></i>
                                        <span>عودة للمعرض</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Share --}}
                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-share-alt" style="color: {{ config('colors.primary') }};"></i>
                                    شارك المشروع
                                </h3>
                                <div class="flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       target="_blank"
                                       class="flex-1 flex items-center justify-center bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" 
                                       target="_blank"
                                       class="flex-1 flex items-center justify-center bg-sky-500 text-white py-2.5 rounded-lg hover:bg-sky-600 transition-colors">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" 
                                       target="_blank"
                                       class="flex-1 flex items-center justify-center bg-blue-700 text-white py-2.5 rounded-lg hover:bg-blue-800 transition-colors">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <button onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('تم نسخ الرابط!');"
                                            class="flex-1 flex items-center justify-center bg-gray-600 text-white py-2.5 rounded-lg hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Fancybox Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="project-gallery"]', {
                    l10n: {
                        CLOSE: 'إغلاق',
                        NEXT: 'التالي',
                        PREV: 'السابق',
                    },
                    Carousel: { infinite: true },
                });
            }
        });
    </script>
</x-layouts.app>
