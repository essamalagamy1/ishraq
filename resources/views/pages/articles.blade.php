<x-layouts.app>
    {{-- Hero with Animations --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-10 right-10 w-3 h-3 rounded-full animate-float opacity-40" style="background: {{ config('colors.primary_light') }};"></div>
        <div class="absolute bottom-10 left-20 w-4 h-4 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 1s;"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-4 text-gray-400 text-sm hero-animate animate-fade-in-up" style="animation-delay: 0.1s;">
                        <a href="{{ route('home') }}" class="hover:text-white transition">الرئيسية</a>
                        <i class="fas fa-chevron-left text-xs"></i>
                        <span style="color: {{ config('colors.primary_light') }};">المدونة</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-white hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                        مدونة <span class="gradient-text-animated">E-DATA 360</span>
                    </h1>
                    <p class="text-gray-400 mt-2 hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">مقالات ونصائح في عالم التقنية والتطوير</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles Grid with Animations --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if(isset($articles) && $articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <article class="reveal-scale group bg-white rounded-2xl overflow-hidden card-hover border border-gray-100">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        @if($article->featured_image)
                        <img src="{{ Storage::url($article->featured_image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, {{ config('colors.bg_dark') }}, #1E3A5F);">
                            <i class="fas fa-file-alt text-4xl text-white/30"></i>
                        </div>
                        @endif
                        
                        {{-- Date Badge --}}
                        <div class="absolute top-4 right-4 bg-white rounded-lg px-3 py-2 text-center shadow">
                            <span class="block text-xl font-black" style="color: {{ config('colors.primary') }};">{{ $article->published_at->format('d') }}</span>
                            <span class="block text-xs text-gray-600">{{ $article->published_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Meta --}}
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            @if($article->author)
                            <span class="flex items-center gap-1">
                                <i class="fas fa-user text-xs"></i>
                                {{ $article->author }}
                            </span>
                            @endif
                            <span class="flex items-center gap-1">
                                <i class="fas fa-eye text-xs"></i>
                                {{ number_format($article->views_count) }}
                            </span>
                        </div>

                        {{-- Dynamic title from database --}}
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-gray-700 transition-colors">
                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        </h2>

                        {{-- Dynamic excerpt from database --}}
                        @if($article->excerpt)
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $article->excerpt }}</p>
                        @endif

                        <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center gap-2 font-semibold text-sm transition-all group-hover:gap-3" style="color: {{ config('colors.primary') }};">
                            <span>اقرأ المزيد</span>
                            <i class="fas fa-arrow-left text-xs"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
            @endif
            @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4" style="background: {{ config('colors.primary_10') }};">
                    <i class="fas fa-newspaper text-3xl" style="color: {{ config('colors.primary') }};"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">لا توجد مقالات حالياً</h3>
                <p class="text-gray-600">عد قريباً لقراءة مقالات جديدة</p>
            </div>
            @endif
        </div>
    </section>
</x-layouts.app>
