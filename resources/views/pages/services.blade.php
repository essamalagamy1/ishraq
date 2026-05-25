@php
    $heroTitle = $heroSection?->title_line1 ?? __('خدمات رقمية');
    $heroSubtitle = $heroSection?->subtitle ?? __('نعمل معك خطوة بخطوة لبناء منتجات متينة وقابلة للنمو.');
@endphp

<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-4xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('الخدمات') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ $heroTitle }}
                    @if($heroSection?->title_line2)
                        <span class="text-[color:var(--color-ink-muted)]">{{ $heroSection->title_line2 }}</span>
                    @endif
                </x-ui.split-heading>
                <p class="type-body-lg mt-8 max-w-2xl" data-reveal data-reveal-stagger="200">{{ $heroSubtitle }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="02">{{ __('ما نقدمه') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('خدمات مصممة بحسب احتياجك.') }}</h2>
                </div>
                <p class="type-body max-w-md">{{ __('كل خدمة تبدأ بسؤال واضح، وتنتهي بحل ملموس وقابل للقياس.') }}</p>
            </div>

            <div class="space-y-16">
                @foreach($services as $index => $service)
                    <article id="{{ $service->slug ?? 'service-' . $index }}" class="surface-card p-8 md:p-12" data-reveal>
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                            <div class="lg:col-span-4">
                                <div class="type-eyebrow mb-4">{{ sprintf('%02d', $index + 1) }}</div>
                                <h3 class="type-h2">{{ $service->title }}</h3>
                            </div>
                            <div class="lg:col-span-8">
                                <p class="type-body-lg text-[color:var(--color-ink)]">
                                    {{ $service->short_description ?? strip_tags($service->description) }}
                                </p>
                                @if($service->features->count())
                                    <ul class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                        @foreach($service->features as $feature)
                                            <li class="flex items-baseline gap-3 type-body text-[color:var(--color-ink-muted)]">
                                                <span class="w-1 h-1 rounded-full bg-[color:var(--color-accent)] flex-shrink-0 translate-y-2"></span>
                                                <span>{{ $feature->feature_text }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="mt-10">
                                    <x-ui.button variant="link" :href="route('contact')" icon="arrow" wire:navigate>
                                        {{ $service->cta_text ?? __('تواصل للاستشارة') }}
                                    </x-ui.button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if($stats && $stats->count())
        <section class="section-pad hairline-y" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="max-w-3xl mb-16" data-reveal>
                    <x-ui.eyebrow number="03">{{ __('الأثر') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('أرقام تلخص التجربة.') }}</h2>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8">
                    @foreach($stats->take(4) as $idx => $stat)
                        @php
                            $raw = (string) ($stat->number ?? '');
                            preg_match('/(\d+(?:\.\d+)?)\s*(\D*)/u', $raw, $m);
                            $value = isset($m[1]) ? (float) $m[1] : 0;
                            $suffix = $m[2] ?? '';
                            $decimals = (strpos($raw, '.') !== false) ? 1 : 0;
                        @endphp
                        <div data-reveal data-reveal-stagger="{{ $idx * 100 }}">
                            <div class="type-numeral text-[clamp(2.5rem,5vw,4.5rem)] leading-none text-[color:var(--color-ink)]"
                                 data-count="{{ $value }}"
                                 data-count-format="{{ $suffix }}"
                                 data-count-decimals="{{ $decimals }}"
                                 dir="ltr">
                                0{{ $suffix }}
                            </div>
                            <div class="type-eyebrow mt-4 text-[color:var(--color-ink-muted)]">{{ $stat->label }}</div>
                            @if($stat->description)
                                <p class="type-small mt-3 max-w-[16rem]">{{ $stat->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-pad" style="background: var(--color-surface-inset);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="04">{{ __('الخطوة التالية') }}</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">{{ __('فلنبدأ خطة واضحة لمشروعك.') }}</h2>
                <p class="type-body-lg mt-6">{{ __('أرسل تفاصيلك وسنقترح المسار الأنسب خلال يوم عمل واحد.') }}</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <x-ui.button variant="primary" :href="route('request-design.create')" icon="arrow" wire:navigate>{{ __('ابدأ مشروعك') }}</x-ui.button>
                    <x-ui.button variant="ghost" :href="route('contact')" wire:navigate>{{ __('تواصل معنا') }}</x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
