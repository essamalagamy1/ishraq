@php
    $heroTitle = $heroSection?->title_line1 ?? __('خدمات وحلول رقمية');
    $heroTitle2 = $heroSection?->title_line2 ?? __('مصممة لتصنع الفارق وتدوم.');
    $heroSubtitle = $heroSection?->subtitle ?? __('نعمل معك شريكًا استراتيجيًا خطوة بخطوة؛ نبتكر ونصمم ونبني منتجات متينة تقود النمو وتحقق عوائد ملموسة.');
@endphp

<x-layouts.app>
    {{-- ================================================================
         1. HERO — Editorial Typography
         ================================================================ --}}
    <section class="section-pad relative overflow-hidden" style="background: var(--color-canvas);">
        <div class="hero-blob hero-blob--1" aria-hidden="true"></div>
        <div class="hero-blob hero-blob--2" aria-hidden="true"></div>

        <div class="container-page relative z-10">
            <div class="max-w-4xl" data-reveal>
                <div class="flex items-center gap-3 mb-6">
                    <x-ui.eyebrow number="01">{{ __('مجالات الخبرة') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <span class="type-eyebrow text-[color:var(--color-accent)]">{{ __('الخدمات المتميزة') }}</span>
                </div>

                <h1 class="type-display mt-6 leading-tight">
                    <span>{{ $heroTitle }}</span>
                    @if($heroTitle2)
                        <span class="block text-[color:var(--color-accent)] italic font-serif">{{ $heroTitle2 }}</span>
                    @endif
                </h1>

                <p class="type-body-lg mt-8 max-w-2xl text-[color:var(--color-ink-muted)] leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. SERVICES LIST — High-End Editorial Cards
         ================================================================ --}}
    <section class="section-pad hairline-y" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="02">{{ __('ما نقدمه') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('حلول متكاملة تخدم غايتك.') }}</h2>
                </div>
                <p class="type-body max-w-md text-[color:var(--color-ink-muted)]">
                    {{ __('كل مسار خدمة يبدأ بفهم عميق لسياق عملك، وينتهي بمنتج ملموس وقابل للتطوير.') }}
                </p>
            </div>

            <div class="space-y-12">
                @foreach($services as $index => $service)
                    <article id="{{ $service->slug ?? 'service-' . $index }}"
                             class="surface-card p-8 md:p-14 rounded-3xl group hover:border-[color:var(--color-accent-ring)] transition-all duration-400 relative overflow-hidden"
                             data-reveal data-reveal-stagger="{{ $index * 100 }}">
                        
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">
                            {{-- Header Col --}}
                            <div class="lg:col-span-4 flex flex-col justify-between h-full">
                                <div>
                                    <div class="flex items-center gap-3 mb-6">
                                        <span class="font-mono text-xs font-semibold text-[color:var(--color-accent)] tracking-widest" dir="ltr">
                                            // {{ sprintf('%02d', $index + 1) }}
                                        </span>
                                        <span class="h-px w-8 bg-[color:var(--color-line-strong)]"></span>
                                    </div>
                                    <h3 class="type-h2 text-2xl lg:text-3xl text-[color:var(--color-ink)] group-hover:text-[color:var(--color-accent)] transition-colors leading-snug">
                                        {{ $service->title }}
                                    </h3>
                                </div>

                                <div class="hidden lg:block mt-12">
                                    <a href="{{ route('request-design.create', ['service' => $service->slug ?? $service->id]) }}"
                                       class="inline-flex items-center gap-3 text-xs font-mono tracking-wider uppercase text-[color:var(--color-ink)] hover:text-[color:var(--color-accent)] transition-colors"
                                       wire:navigate>
                                        <span>{{ __('طلب هذه الخدمة') }}</span>
                                        <svg class="btn-arrow" width="12" height="10" viewBox="0 0 16 10" fill="none">
                                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Content Col --}}
                            <div class="lg:col-span-8">
                                <p class="type-body-lg text-[color:var(--color-ink)] text-lg leading-relaxed">
                                    {{ $service->short_description ?? strip_tags($service->description) }}
                                </p>

                                @if($service->features && $service->features->count())
                                    <div class="mt-10 pt-8 border-t border-[color:var(--color-line)]">
                                        <div class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-widest mb-6">
                                            {{ __('ما يشمله النطاق // Deliverables') }}
                                        </div>
                                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                            @foreach($service->features as $feature)
                                                <li class="flex items-baseline gap-3.5 type-body text-[color:var(--color-ink-muted)] text-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] flex-shrink-0 translate-y-1.5"></span>
                                                    <span>{{ $feature->feature_text }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mt-8 pt-6 border-t border-[color:var(--color-line)] flex items-center justify-between lg:hidden">
                                    <a href="{{ route('request-design.create', ['service' => $service->slug ?? $service->id]) }}"
                                       class="btn btn--primary text-xs py-2.5 px-5"
                                       wire:navigate>
                                        <span>{{ __('طلب الخدمة') }}</span>
                                    </a>
                                    <a href="{{ route('contact') }}" class="type-small text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-accent)] transition-colors" wire:navigate>
                                        {{ __('استفسار سريع') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         3. STATS
         ================================================================ --}}
    @if($stats && $stats->count())
        <section class="section-pad" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="max-w-3xl mb-16" data-reveal>
                    <x-ui.eyebrow number="03">{{ __('الأثر والنتائج') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('أرقام تلخص التجربة.') }}</h2>
                </div>
                <div class="stats-grid">
                    @foreach($stats->take(4) as $idx => $stat)
                        @php
                            $raw = (string) ($stat->number ?? '');
                            preg_match('/(\d+(?:\.\d+)?)\s*(\D*)/u', $raw, $m);
                            $value = isset($m[1]) ? (float) $m[1] : 0;
                            $suffix = $m[2] ?? '';
                            $decimals = (strpos($raw, '.') !== false) ? 1 : 0;
                        @endphp
                        <div class="stats-grid__item stat-3d" data-reveal data-reveal-stagger="{{ $idx * 100 }}">
                            <div class="stats-grid__num"
                                 data-count="{{ $value }}"
                                 data-count-format="{{ $suffix }}"
                                 data-count-decimals="{{ $decimals }}"
                                 dir="ltr">
                                0{{ $suffix }}
                            </div>
                            <div class="stats-grid__label">{{ $stat->label }}</div>
                            @if($stat->description)
                                <p class="stats-grid__desc">{{ $stat->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         4. CTA SECTION
         ================================================================ --}}
    <section class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <x-ui.eyebrow number="04">{{ __('الخطوة التالية') }}</x-ui.eyebrow>
                <h2 class="cta-ed__heading mt-6">
                    {{ __('فلنبدأ خطة واضحة') }} <em>{{ __('لمشروعك') }}</em>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('أرسل متطلبات مشروعك وسنقترح المسار الأنسب مع تقدير دقيق للمراحل والتكلفة خلال يوم عمل واحد.') }}
                </p>
                <div class="cta-ed__actions">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary" id="services-cta-primary" wire:navigate>
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

