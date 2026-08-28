@php
    $firstArticle = isset($articles) && $articles->count() ? $articles->first() : null;
    $otherArticles = isset($articles) && $articles->count() > 1 ? $articles->skip(1) : collect();
@endphp

<x-layouts.app>
    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-20 pb-12 md:pt-24 md:pb-16">

                <h1 class="type-display leading-[1.1]" data-reveal>
                    <span class="block">{{ __('رؤى ومقالات') }}</span>
                    <span class="block text-gradient mt-2">{{ __('في التصميم والتقنية وبناء المنتجات.') }}</span>
                </h1>

                <p class="type-body-lg mt-10 max-w-2xl leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ __('مقالات وأفكار تساعدك على فهم أحدث الممارسات الرقمية واتخاذ قرارات تقنية وتصميمية أفضل.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. ARTICLES GRID
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-canvas);">
        <div class="container-page">
            @if(isset($articles) && $articles->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @foreach($articles as $idx => $article)
                        <div class="tilt-card" data-reveal data-reveal-stagger="{{ ($idx % 3) * 120 }}">
                            <a href="{{ route('articles.show', $article) }}"
                               class="article-card group h-full flex flex-col justify-between"
                               wire:navigate>
                                <div>
                                    <div class="article-card__cover relative overflow-hidden rounded-2xl aspect-[16/10] bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] mb-6">
                                        @if($article->featured_image)
                                            <img src="{{ Storage::url($article->featured_image) }}"
                                                 alt="{{ $article->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                 loading="lazy" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-[color:var(--color-surface-inset)] text-[color:var(--color-ink-subtle)] font-serif italic text-xl">
                                                {{ __('إشراق') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="article-card__eyebrow flex items-center justify-between mb-3 text-xs font-mono text-[color:var(--color-ink-subtle)]">
                                        @if($article->published_at)
                                            <time datetime="{{ $article->published_at->toIso8601String() }}">
                                                {{ $article->published_at->translatedFormat('j F Y') }}
                                            </time>
                                        @endif
                                        @if($article->views_count)
                                            <span>{{ number_format($article->views_count) }} {{ __('قراءة') }}</span>
                                        @endif
                                    </div>

                                    <h2 class="article-card__title type-h3 leading-snug group-hover:text-[color:var(--color-accent)] transition-colors mb-3">
                                        {{ $article->title }}
                                    </h2>

                                    @if($article->excerpt)
                                        <p class="type-body text-[color:var(--color-ink-muted)] text-sm line-clamp-2 leading-relaxed">
                                            {{ $article->excerpt }}
                                        </p>
                                    @endif
                                </div>

                                <div class="pt-5 mt-6 border-t border-[color:var(--color-line)] flex items-center gap-2 text-xs font-mono text-[color:var(--color-ink-muted)] group-hover:text-[color:var(--color-accent)] transition-colors">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                        <path d="M10 6H2M4 3L1 6l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>{{ __('اقرأ المقال كاملاً') }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                @if($articles->hasPages())
                    <div class="mt-16 pt-8 border-t border-[color:var(--color-line)] flex justify-center">
                        {{ $articles->links() }}
                    </div>
                @endif
            @else
                <div class="surface-card p-16 text-center max-w-xl mx-auto rounded-3xl border border-[color:var(--color-line-strong)]">
                    <div class="w-12 h-12 rounded-full bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] flex items-center justify-center mx-auto mb-6 text-[color:var(--color-accent)] font-mono">
                        ✦
                    </div>
                    <h3 class="type-h3 mb-3">{{ __('لا توجد مقالات منشورة حالياً') }}</h3>
                    <p class="type-body text-[color:var(--color-ink-muted)]">{{ __('عد قريبًا لقراءة مقالات جديدة ورؤى متخصصة.') }}</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ================================================================
         3. CTA SECTION
         ================================================================ --}}
    <section class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <x-ui.eyebrow number="02">{{ __('تواصل معنا') }}</x-ui.eyebrow>
                <h2 class="cta-ed__heading mt-6">
                    {{ __('هل تحتاج استشارة') }} <em>{{ __('لمشروعك؟') }}</em>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('فريقنا مستعد لمناقشة أفكارك وتحدياتك الرقمية وتقديم رؤية تقنية وتصميمية واضحة.') }}
                </p>
                <div class="cta-ed__actions">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary" id="articles-cta-primary" wire:navigate>
                        <span>{{ __('ابدأ مشروعك') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn--ghost" id="articles-cta-secondary" wire:navigate>
                        {{ __('تواصل معنا') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

