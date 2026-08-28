@php
    $heroTitle = $heroSection?->title_line1 ?? __('أرشيف الأعمال');
    $heroTitle2 = $heroSection?->title_line2 ?? __('منتجات وحلول صنعت بعناية.');
    $heroSubtitle = $heroSection?->subtitle ?? __('مشاريع مختارة تعكس أسلوبنا ومنهجنا الدقيق في التصميم والهندسة وبناء القيمة.');
@endphp

<x-layouts.app>
    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 pt-20 pb-12 md:pt-24 md:pb-16">
                <div class="max-w-4xl" data-reveal>
                    <h1 class="type-display leading-[1.1]">
                        <span class="block">{{ $heroTitle }}</span>
                        @if($heroTitle2)
                            <span class="block text-gradient mt-2">{{ $heroTitle2 }}</span>
                        @endif
                    </h1>

                    <p class="type-body-lg mt-10 max-w-2xl leading-relaxed" data-reveal data-reveal-stagger="200">
                        {{ $heroSubtitle }}
                    </p>
                </div>

                @if($stats && $stats->count())
                    <div class="flex items-center gap-8 pt-4 lg:pt-0" data-reveal data-reveal-stagger="300">
                        @foreach($stats->take(2) as $stat)
                            <div class="border-r border-[color:var(--color-line)] pr-8 first:border-none first:pr-0">
                                <div class="type-numeral text-4xl text-[color:var(--color-ink)]" dir="ltr">{{ $stat->number }}</div>
                                <div class="type-eyebrow mt-1 text-[color:var(--color-ink-subtle)]">{{ $stat->label }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. STICKY CATEGORY FILTER BAR
         ================================================================ --}}
    @if(isset($projectTypes) && $projectTypes->count())
        <section class="py-5 sticky top-16 lg:top-18 z-40 backdrop-blur-xl border-y border-[color:var(--color-line)]"
                 style="background: rgba(11, 10, 8, 0.85);">
            <div class="container-page">
                <div class="flex items-center gap-2.5 overflow-x-auto py-1 scrollbar-none">
                    <a href="{{ route('portfolio') }}"
                       class="chip {{ !$selectedType ? 'is-active' : '' }} font-medium text-xs tracking-wide"
                       wire:navigate>
                        <span>{{ __('جميع الأعمال') }}</span>
                    </a>
                    @foreach($projectTypes as $type)
                        <a href="{{ route('portfolio', ['type' => $type->slug]) }}"
                           class="chip {{ $selectedType === $type->slug ? 'is-active' : '' }} font-medium text-xs tracking-wide"
                           wire:navigate>
                            <span>{{ $type->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         3. PROJECTS GRID — Responsive Showcase
         ================================================================ --}}
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            @if(isset($projects) && count($projects) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $idx => $project)
                        <div class="tilt-card" data-reveal data-reveal-stagger="{{ ($idx % 3) * 120 }}">
                            <a href="{{ route('projects.show', $project) }}"
                               class="featured-card featured-card--grid group h-full flex flex-col justify-between"
                               wire:navigate>
                                
                                {{-- Media Wrapper --}}
                                <div class="featured-card__media-wrapper">
                                    @if($project->main_image)
                                        <img src="{{ Storage::url($project->main_image) }}"
                                             alt="{{ $project->title }}"
                                             class="featured-card__img"
                                             loading="lazy" />
                                    @else
                                        <div class="featured-card__fallback">
                                            <div class="featured-card__fallback-title">{{ $project->title }}</div>
                                        </div>
                                    @endif

                                    <span class="featured-card__num-pill" dir="ltr">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    @if($project->types && $project->types->count())
                                        <span class="featured-card__glass-pill">
                                            {{ $project->types->first()->name_ar ?? $project->types->first()->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Card Body --}}
                                <div class="featured-card__body p-6 lg:p-8 flex flex-col justify-between flex-grow">
                                    <div>
                                        <h3 class="featured-card__title text-xl mb-3 group-hover:text-[color:var(--color-accent)] transition-colors">
                                            {{ $project->title }}
                                        </h3>
                                        @if($project->short_description)
                                            <p class="type-body text-[color:var(--color-ink-muted)] text-sm line-clamp-2 leading-relaxed">
                                                {{ $project->short_description }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mt-6 pt-5 border-t border-[color:var(--color-line)] flex items-center justify-between">
                                        <span class="type-small font-medium text-[color:var(--color-ink-muted)] group-hover:text-[color:var(--color-ink)] transition-colors">
                                            {{ __('استكشف المشروع') }}
                                        </span>
                                        <div class="featured-card__arrow-btn">
                                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                                <path d="M12 4L4 12M12 4H5M12 4V11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($projects->hasPages())
                    <div class="mt-16 pt-8 border-t border-[color:var(--color-line)] flex justify-center">
                        {{ $projects->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="surface-card p-16 text-center max-w-xl mx-auto rounded-3xl border border-[color:var(--color-line-strong)]">
                    <div class="w-12 h-12 rounded-full bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] flex items-center justify-center mx-auto mb-6 text-[color:var(--color-accent)] font-mono">
                        ✦
                    </div>
                    <h3 class="type-h3 mb-3">{{ __('لا توجد مشاريع في هذا التصنيف حالياً') }}</h3>
                    <p class="type-body text-[color:var(--color-ink-muted)] mb-8">{{ __('يمكنك تصفح باقي التصنيفات أو التواصل معنا لطلب مشروع مخصص.') }}</p>
                    <a href="{{ route('portfolio') }}" class="btn btn--ghost" wire:navigate>{{ __('عرض جميع المشاريع') }}</a>
                </div>
            @endif
        </div>
    </section>

    {{-- ================================================================
         4. CTA SECTION
         ================================================================ --}}
    <section class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <x-ui.eyebrow number="02">{{ __('مشروعك التالي') }}</x-ui.eyebrow>
                <h2 class="cta-ed__heading mt-6">
                    {{ __('هل لديك فكرة تريد') }} <em>{{ __('إطلاقها؟') }}</em>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('نساعدك في تحويل الفكرة إلى منتج رقمي متكامل يحقق أهدافك ويترك انطباعًا لا يُنسى.') }}
                </p>
                <div class="cta-ed__actions">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary" id="portfolio-cta-primary" wire:navigate>
                        <span>{{ __('ابدأ مشروعك الآن') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn--ghost" id="portfolio-cta-secondary" wire:navigate>
                        {{ __('تواصل معنا') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

