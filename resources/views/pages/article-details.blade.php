<x-layouts.app>
    {{-- ================================================================
         1. HERO — Article Header
         ================================================================ --}}
    <section class="section-pad relative overflow-hidden pb-8" style="background: var(--color-canvas);">
        <div class="hero-blob hero-blob--1" aria-hidden="true"></div>

        <div class="container-page relative z-10">
            <div class="max-w-4xl" data-reveal>
                <div class="flex items-center gap-3 mb-6">
                    <x-ui.eyebrow number="01">{{ __('المقال') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <a href="{{ route('articles') }}" class="type-eyebrow text-[color:var(--color-accent)] hover:underline" wire:navigate>
                        {{ __('المدونة والمعرفة') }}
                    </a>
                </div>

                <h1 class="type-h1 mt-4 text-3xl lg:text-5xl font-bold leading-tight text-[color:var(--color-ink)]">
                    {{ $article->title }}
                </h1>

                @if($article->excerpt)
                    <p class="type-body-lg mt-6 text-[color:var(--color-ink-muted)] text-lg lg:text-xl leading-relaxed max-w-3xl">
                        {{ $article->excerpt }}
                    </p>
                @endif

                <div class="mt-8 pt-6 border-t border-[color:var(--color-line)] flex flex-wrap items-center gap-6 text-xs font-mono text-[color:var(--color-ink-subtle)]">
                    @if($article->author)
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] flex items-center justify-center text-[color:var(--color-accent)] font-semibold">
                                ✍
                            </span>
                            <span class="text-[color:var(--color-ink)] font-medium">{{ $article->author }}</span>
                        </div>
                    @endif
                    @if($article->published_at)
                        <div class="flex items-center gap-2">
                            <span>📅</span>
                            <time datetime="{{ $article->published_at->toIso8601String() }}">
                                {{ $article->published_at->translatedFormat('j F Y') }}
                            </time>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <span>👁</span>
                        <span>{{ number_format($article->views_count) }} {{ __('مشاهدة') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. FEATURED IMAGE
         ================================================================ --}}
    @if($article->featured_image)
        <section class="py-6" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border border-[color:var(--color-line-strong)] bg-[color:var(--color-surface-inset)] shadow-2xl" data-reveal>
                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[550px]" />
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         3. ARTICLE CONTENT & SOCIAL SHARE
         ================================================================ --}}
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">
                {{-- Social Share Strip --}}
                <div class="surface-card p-5 rounded-2xl mb-12 flex flex-wrap items-center justify-between gap-4 border border-[color:var(--color-line-strong)]" data-reveal>
                    <span class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-wider">{{ __('شارك هذا المقال') }}</span>
                    <div class="flex items-center gap-2.5">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article)) }}&text={{ urlencode($article->title) }}"
                           target="_blank" class="chip hover:border-[color:var(--color-accent)] text-xs font-mono">{{ __('منصة X') }}</a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articles.show', $article)) }}&title={{ urlencode($article->title) }}"
                           target="_blank" class="chip hover:border-[color:var(--color-accent)] text-xs font-mono">{{ __('لينكدإن') }}</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}"
                           target="_blank" class="chip hover:border-[color:var(--color-accent)] text-xs font-mono">{{ __('فيسبوك') }}</a>
                    </div>
                </div>

                {{-- Prose Body --}}
                <article class="prose-article text-lg leading-relaxed space-y-6" data-reveal>
                    {!! $article->content !!}
                </article>
            </div>
        </div>
    </section>

    {{-- ================================================================
         4. RELATED ARTICLES
         ================================================================ --}}
    @if($relatedArticles && $relatedArticles->count())
        <section class="section-pad hairline-t" style="background: var(--color-surface);">
            <div class="container-page">
                <div class="max-w-3xl mb-12" data-reveal>
                    <x-ui.eyebrow number="02">{{ __('مقالات ذات صلة') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('تابع القراءة واستكشف المزيد.') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                        <div class="tilt-card" data-reveal>
                            <a href="{{ route('articles.show', $related) }}" class="article-card group h-full flex flex-col justify-between" wire:navigate>
                                <div>
                                    <div class="article-card__cover relative overflow-hidden rounded-2xl aspect-[16/10] bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] mb-4">
                                        @if($related->featured_image)
                                            <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                                        @endif
                                    </div>
                                    <div class="type-eyebrow mb-2 text-xs font-mono text-[color:var(--color-ink-subtle)]">
                                        {{ $related->published_at?->translatedFormat('j F Y') }}
                                    </div>
                                    <h3 class="article-card__title type-h3 text-lg leading-snug group-hover:text-[color:var(--color-accent)] transition-colors">
                                        {{ $related->title }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         5. CTA SECTION
         ================================================================ --}}
    <section class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <x-ui.eyebrow number="03">{{ __('الخطوة التالية') }}</x-ui.eyebrow>
                <h2 class="cta-ed__heading mt-6">
                    {{ __('هل تحتاج مساعدة في') }} <em>{{ __('مشروعك الرقمي؟') }}</em>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('فريقنا مستعد لمناقشة أفكارك وتطبيق الحلول الأنسب لنمو نشاطك التجاري.') }}
                </p>
                <div class="cta-ed__actions">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary" id="article-details-cta-primary" wire:navigate>
                        <span>{{ __('ابدأ مشروعك الآن') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
