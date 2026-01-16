<x-layouts.app>
    {{-- Article Hero --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="container mx-auto px-6 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-3 text-sm text-gray-400 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">الرئيسية</a>
                <i class="fas fa-chevron-left text-xs"></i>
                <a href="{{ route('articles') }}" class="hover:text-white transition-colors">المدونة</a>
                <i class="fas fa-chevron-left text-xs"></i>
                <span style="color: {{ config('colors.primary_light') }};">{{ Str::limit($article->title, 30) }}</span>
            </nav>

            <div class="max-w-4xl">
                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-6 mb-6 text-sm">
                    @if($article->author)
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold" style="background: {{ config('colors.primary') }};">
                            {{ mb_substr($article->author, 0, 1) }}
                        </div>
                        <span class="text-gray-300">{{ $article->author }}</span>
                    </div>
                    @endif
                    <div class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-calendar" style="color: {{ config('colors.primary_light') }};"></i>
                        <span>{{ $article->published_at->format('d M, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-eye" style="color: {{ config('colors.primary_light') }};"></i>
                        <span>{{ number_format($article->views_count) }} مشاهدة</span>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">
                    {{ $article->title }}
                </h1>

                {{-- Excerpt --}}
                @if($article->excerpt)
                <p class="text-xl text-gray-400">{{ $article->excerpt }}</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Featured Image --}}
    @if($article->featured_image)
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ Storage::url($article->featured_image) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Article Content --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                {{-- Share Buttons --}}
                <div class="flex items-center justify-between mb-12 pb-8 border-b border-gray-200">
                    <span class="text-gray-600 font-bold">شارك المقال:</span>
                    <div class="flex items-center gap-2">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article)) }}&text={{ urlencode($article->title) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-lg bg-sky-500 flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articles.show', $article)) }}&title={{ urlencode($article->title) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-lg bg-blue-700 flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('articles.show', $article)) }}" 
                           target="_blank"
                           class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center text-white hover:opacity-90 transition-opacity">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button onclick="navigator.clipboard.writeText('{{ route('articles.show', $article) }}'); alert('تم نسخ الرابط!');" 
                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-300 transition-colors">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                {{-- Article Body --}}
                <article class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-headings:font-bold prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-teal-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-img:shadow-lg">
                    {!! $article->content !!}
                </article>

                {{-- Share Bottom --}}
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <p class="text-gray-900 font-bold">هل أعجبك هذا المقال؟</p>
                            <p class="text-gray-500 text-sm">شاركه مع أصدقائك!</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article)) }}&text={{ urlencode($article->title) }}" 
                               target="_blank"
                               class="inline-flex items-center gap-2 bg-sky-500 text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity">
                                <i class="fab fa-twitter"></i>
                                <span>تويتر</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}" 
                               target="_blank"
                               class="inline-flex items-center gap-2 bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition-opacity">
                                <i class="fab fa-facebook-f"></i>
                                <span>فيسبوك</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Articles --}}
    @if($relatedArticles && $relatedArticles->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-sm font-bold uppercase tracking-wider" style="color: {{ config('colors.primary') }};">مقالات ذات صلة</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mt-2">اقرأ المزيد</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach($relatedArticles as $related)
                <article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                    <div class="relative aspect-video overflow-hidden">
                        @if($related->featured_image)
                        <img src="{{ Storage::url($related->featured_image) }}" 
                             alt="{{ $related->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center" style="background: {{ config('colors.bg_dark') }};">
                            <i class="fas fa-file-alt text-white/30 text-4xl"></i>
                        </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2">
                            {{ $related->published_at->format('Y/m/d') }}
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-gray-600 transition-colors">
                            <a href="{{ route('articles.show', $related) }}">{{ $related->title }}</a>
                        </h3>
                        <a href="{{ route('articles.show', $related) }}" class="inline-flex items-center gap-2 text-sm font-semibold" style="color: {{ config('colors.primary') }};">
                            <span>اقرأ المزيد</span>
                            <i class="fas fa-arrow-left text-xs"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('articles') }}" class="inline-flex items-center gap-2 text-white font-bold py-4 px-8 rounded-xl hover:opacity-90 transition-all" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-newspaper"></i>
                    <span>جميع المقالات</span>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-20" style="background: {{ config('colors.bg_dark') }};">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-6">
                    هل تحتاج مساعدة في مشروعك؟
                </h2>
                <p class="text-xl text-gray-400 mb-8">
                    فريقنا من الخبراء جاهز لمساعدتك
                </p>
                <a href="{{ route('request-design.create') }}" class="inline-flex items-center gap-2 text-white font-bold py-4 px-8 rounded-xl hover:opacity-90 transition-all" style="background: {{ config('colors.primary') }};">
                    <i class="fas fa-rocket"></i>
                    <span>ابدأ مشروعك الآن</span>
                </a>
            </div>
        </div>
    </section>

    {{-- SEO Meta Tags --}}
    @push('meta')
    <meta property="og:title" content="{{ $article->meta_title ?? $article->title }}">
    <meta property="og:description" content="{{ $article->meta_description ?? $article->excerpt }}">
    @if($article->featured_image)
    <meta property="og:image" content="{{ Storage::url($article->featured_image) }}">
    @endif
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
    @if($article->author)
    <meta property="article:author" content="{{ $article->author }}">
    @endif
    @endpush
</x-layouts.app>
