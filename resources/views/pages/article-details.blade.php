<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('المدونة') }}</x-ui.eyebrow>
                <h1 class="type-h1 mt-6">{{ $article->title }}</h1>
                @if($article->excerpt)
                    <p class="type-body-lg mt-6">{{ $article->excerpt }}</p>
                @endif
                <div class="mt-6 flex flex-wrap items-center gap-6 type-small text-[color:var(--color-ink-subtle)]">
                    @if($article->author)
                        <span>{{ $article->author }}</span>
                    @endif
                    @if($article->published_at)
                        <time datetime="{{ $article->published_at->toIso8601String() }}">
                            {{ $article->published_at->translatedFormat('j F Y') }}
                        </time>
                    @endif
                    <span>{{ number_format($article->views_count) }} {{ __('مشاهدة') }}</span>
                </div>
            </div>
        </div>
    </section>

    @if($article->featured_image)
        <section class="section-pad" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="surface-card overflow-hidden">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" />
                </div>
            </div>
        </section>
    @endif

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl">
                <div class="surface-card p-6 mb-10 flex flex-wrap items-center justify-between gap-4">
                    <div class="type-eyebrow">{{ __('شارك المقال') }}</div>
                    <div class="flex items-center gap-3">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article)) }}&text={{ urlencode($article->title) }}" target="_blank" class="chip">{{ __('تويتر') }}</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article)) }}" target="_blank" class="chip">{{ __('فيسبوك') }}</a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('articles.show', $article)) }}&title={{ urlencode($article->title) }}" target="_blank" class="chip">{{ __('لينكدإن') }}</a>
                    </div>
                </div>

                <article class="prose-article">
                    {!! $article->content !!}
                </article>
            </div>
        </div>
    </section>

    @if($relatedArticles && $relatedArticles->count())
        <section class="section-pad" style="background: var(--color-surface);">
            <div class="container-page">
                <div class="max-w-3xl mb-12" data-reveal>
                    <x-ui.eyebrow number="02">{{ __('مقالات ذات صلة') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('اقرأ المزيد') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related) }}" class="article-card" wire:navigate>
                            <div class="article-card__cover">
                                @if($related->featured_image)
                                    <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" loading="lazy" />
                                @endif
                            </div>
                            <div class="type-eyebrow mb-3">
                                {{ $related->published_at?->translatedFormat('j F Y') }}
                            </div>
                            <h3 class="article-card__title type-h3 leading-snug">{{ $related->title }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-pad" style="background: var(--color-surface-inset);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="03">{{ __('ابدأ') }}</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">{{ __('هل تحتاج مساعدة في مشروعك؟') }}</h2>
                <p class="type-body-lg mt-6">{{ __('فريقنا مستعد لمناقشة احتياجك ووضع خطة واضحة.') }}</p>
                <div class="mt-10">
                    <x-ui.button variant="primary" :href="route('request-design.create')" icon="arrow" wire:navigate>{{ __('ابدأ مشروعك') }}</x-ui.button>
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
