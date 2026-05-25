<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('المدونة') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ __('كتابات') }} <span class="text-[color:var(--color-ink-muted)]">{{ __('إشراق') }}</span>
                </x-ui.split-heading>
                <p class="type-body-lg mt-6" data-reveal data-reveal-stagger="200">
                    {{ __('مقالات مختصرة تساعدك على اتخاذ قرارات رقمية أفضل.') }}
                </p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            @if(isset($articles) && $articles->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $idx => $article)
                        <a href="{{ route('articles.show', $article) }}" class="article-card" data-reveal data-reveal-stagger="{{ $idx * 120 }}" wire:navigate>
                            <div class="article-card__cover">
                                @if($article->featured_image)
                                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" />
                                @endif
                            </div>
                            <div class="type-eyebrow mb-4">
                                @if($article->published_at)
                                    <time datetime="{{ $article->published_at->toIso8601String() }}">
                                        {{ $article->published_at->translatedFormat('j F Y') }}
                                    </time>
                                @endif
                            </div>
                            <h2 class="article-card__title type-h3 leading-snug">{{ $article->title }}</h2>
                            @if($article->excerpt)
                                <p class="type-body mt-3 line-clamp-2">{{ $article->excerpt }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>

                @if($articles->hasPages())
                    <div class="mt-12">
                        {{ $articles->links() }}
                    </div>
                @endif
            @else
                <div class="surface-card p-12 text-center">
                    <h3 class="type-h3 mb-3">{{ __('لا توجد مقالات حالياً') }}</h3>
                    <p class="type-body">{{ __('عد قريبًا لقراءة مقالات جديدة.') }}</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
