@php
    $heroTitle = $heroSection?->title_line1 ?? __('خدمات وحلول رقمية');
    $heroTitle2 = $heroSection?->title_line2 ?? __('مصممة لتصنع الفارق وتدوم.');
    $heroSubtitle = $heroSection?->subtitle ?? __('نعمل معك شريكًا استراتيجيًا خطوة بخطوة؛ نبتكر ونصمم ونبني منتجات متينة تقود النمو وتحقق عوائد ملموسة.');
@endphp

<x-layouts.app>
    {{-- ================================================================
         1. HERO — Immersive Editorial
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        {{-- Ambient glow --}}
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-20 pb-12 md:pt-24 md:pb-16">

                {{-- Title --}}
                <h1 class="type-display leading-[1.1]" data-reveal data-reveal-stagger="100">
                    <span class="block">{{ $heroTitle }}</span>
                    @if($heroTitle2)
                        <span class="block text-gradient mt-2">{{ $heroTitle2 }}</span>
                    @endif
                </h1>

                {{-- Subtitle --}}
                <p class="type-body-lg mt-10 max-w-2xl leading-relaxed" data-reveal data-reveal-stagger="300">
                    {{ $heroSubtitle }}
                </p>

                {{-- Service count chip --}}
                <div class="mt-10 flex items-center gap-4" data-reveal data-reveal-stagger="500">
                    <span class="svc-hero__chip">
                        <span class="svc-hero__chip-number" dir="ltr">{{ $services->count() }}</span>
                        <span>{{ __('خدمة متخصصة') }}</span>
                    </span>
                    <a href="#services-list" class="btn btn--ghost text-sm" data-lenis-href>
                        {{ __('استكشف الخدمات') }}
                        <svg class="btn-arrow" width="12" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. SERVICES LIST — Editorial Bento Cards
         ================================================================ --}}
    <section id="services-list" class="section-pad" style="background: var(--color-surface);" data-section>
        <div class="container-page">
            {{-- Section header --}}
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-20" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="01">{{ __('ما نقدّمه') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('حلول متكاملة تخدم غايتك.') }}</h2>
                </div>
                <p class="type-body max-w-md text-[color:var(--color-ink-muted)]">
                    {{ __('كل مسار خدمة يبدأ بفهم عميق لسياق عملك، وينتهي بمنتج ملموس وقابل للتطوير.') }}
                </p>
            </div>

            {{-- Services grid --}}
            <div class="svc-grid">
                @foreach($services as $index => $service)
                    <article id="{{ $service->slug ?? 'service-' . $index }}"
                             class="svc-card group"
                             data-reveal data-reveal-stagger="{{ $index * 80 }}">

                        {{-- Card top accent line --}}
                        <div class="svc-card__accent" aria-hidden="true"></div>

                        {{-- Number --}}
                        <div class="svc-card__number" dir="ltr" aria-hidden="true">
                            {{ sprintf('%02d', $index + 1) }}
                        </div>

                        {{-- Icon --}}
                        @if($service->icon)
                            <div class="svc-card__icon">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        @endif

                        {{-- Title --}}
                        <h3 class="svc-card__title">{{ $service->title }}</h3>

                        {{-- Description --}}
                        <p class="svc-card__desc">
                            {{ $service->short_description ?? strip_tags($service->description) }}
                        </p>

                        {{-- Features --}}
                        @if($service->features && $service->features->count())
                            <ul class="svc-card__features">
                                @foreach($service->features->take(4) as $feature)
                                    <li>
                                        <span class="svc-card__features-dot" aria-hidden="true"></span>
                                        <span>{{ $feature->feature_text }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        {{-- CTA --}}
                        <div class="svc-card__footer">
                            <a href="{{ route('request-design.create', ['service' => $service->slug ?? $service->id]) }}"
                               class="svc-card__cta"
                               wire:navigate>
                                <span>{{ __('طلب الخدمة') }}</span>
                                <svg width="14" height="10" viewBox="0 0 16 10" fill="none" class="svc-card__cta-arrow" aria-hidden="true">
                                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         3. WHY US — Trust indicators
         ================================================================ --}}
    <section class="section-pad" style="background: var(--color-canvas);" data-section>
        <div class="container-page">
            <div class="max-w-3xl mb-16" data-reveal>
                <x-ui.eyebrow number="02">{{ __('لماذا إشراق') }}</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">{{ __('ما يميزنا عن البقية.') }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $whyUs = [
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', 'title' => 'جودة بلا تنازل', 'desc' => 'كل سطر كود ومكوّن تصميم يمر بمراجعة صارمة قبل التسليم.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>', 'title' => 'التزام بالموعد', 'desc' => 'جداول واقعية ومحدّثة أولاً بأول — نسلّم في الوقت أو قبله.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>', 'title' => 'شراكة حقيقية', 'desc' => 'لسنا مزوّد خدمة فحسب — نصبح جزءاً من فريقك.'],
                    ];
                @endphp

                @foreach($whyUs as $idx => $item)
                    <div class="svc-why-card" data-reveal data-reveal-stagger="{{ $idx * 120 }}">
                        <div class="svc-why-card__icon">
                            {!! $item['icon'] !!}
                        </div>
                        <h3 class="type-h3 mt-5">{{ __($item['title']) }}</h3>
                        <p class="type-body mt-3">{{ __($item['desc']) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         4. STATS
         ================================================================ --}}
    @if($stats && $stats->count())
        <section class="section-pad relative overflow-hidden" style="background: var(--color-surface);" data-section>
            <div class="stats-bg-glow" aria-hidden="true"></div>
            <div class="container-page relative z-10">
                <div class="max-w-3xl mb-16" data-reveal>
                    <x-ui.eyebrow number="03">{{ __('الأثر والنتائج') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('أرقام تلخص التجربة.') }}</h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-16 gap-x-8">
                    @foreach($stats->take(4) as $idx => $stat)
                        @php
                            $raw = (string) ($stat->number ?? '');
                            preg_match('/(\d+(?:\.\d+)?)\s*(\D*)/u', $raw, $m);
                            $value = isset($m[1]) ? (float) $m[1] : 0;
                            $suffix = $m[2] ?? '';
                            $decimals = (strpos($raw, '.') !== false) ? 1 : 0;
                        @endphp
                        <div class="stat-3d" data-reveal data-reveal-stagger="{{ $idx * 100 }}">
                            <div class="stat-3d__number">
                                <div class="type-numeral text-[clamp(3rem,7vw,5rem)] leading-none text-[color:var(--color-ink)]"
                                     data-count="{{ $value }}"
                                     data-count-format="{{ $suffix }}"
                                     data-count-decimals="{{ $decimals }}"
                                     dir="ltr">
                                    0{{ $suffix }}
                                </div>
                                <div class="stat-3d__glow" aria-hidden="true"></div>
                            </div>
                            <div class="type-eyebrow mt-5 text-[color:var(--color-ink-muted)]">{{ $stat->label }}</div>
                            @if($stat->description)
                                <p class="type-small mt-3 max-w-[16rem]">{{ $stat->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         5. CTA — Immersive
         ================================================================ --}}
    <section class="svc-cta relative overflow-hidden" data-section>
        <div class="svc-cta__glow" aria-hidden="true"></div>
        <div class="container-page relative z-10">
            <div class="svc-cta__inner" data-reveal>
                <x-ui.eyebrow number="04">{{ __('الخطوة التالية') }}</x-ui.eyebrow>
                <h2 class="type-display mt-8" style="font-size: clamp(2.5rem, 5.5vw, 5rem);">
                    {{ __('فلنبدأ خطة واضحة') }}
                    <em class="type-display-serif text-gradient" style="font-size: inherit;">{{ __('لمشروعك') }}</em>
                </h2>
                <p class="type-body-lg mt-8 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('أرسل متطلبات مشروعك وسنقترح المسار الأنسب مع تقدير دقيق للمراحل والتكلفة خلال يوم عمل واحد.') }}
                </p>
                <div class="mt-12 flex flex-wrap items-center gap-5">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary btn-glow" id="services-cta-primary" wire:navigate>
                        <span>{{ __('ابدأ مشروعك الآن') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn--ghost" id="services-cta-secondary" wire:navigate>
                        {{ __('تواصل للاستشارة') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
