@php
    $hero = $heroSection ?? null;
    $heroTitleLine1 = $hero->title_line1 ?? 'نصنع منتجات';
    $heroTitleLine2 = $hero->title_line2 ?? 'رقمية متينة.';
    $heroSubtitle = $hero->subtitle ?? 'استوديو متخصص في تصميم وتطوير المنتجات الرقمية — للشركات التي تطمح إلى تجارب رقمية ناضجة وقابلة للقياس.';
    $heroCtaPrimaryText = $hero->cta_primary_text ?? 'ابدأ مشروعك';
    $heroCtaPrimaryLink = $hero->cta_primary_link ?? route('request-design.create');
    $heroCtaSecondaryText = $hero->cta_secondary_text ?? 'تعرّف على عملنا';
    $heroCtaSecondaryLink = $hero->cta_secondary_link ?? route('portfolio');
    $heroBadge = $hero->badge_text ?? 'استوديو منتجات رقمية';
@endphp

<x-layouts.app>

    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section id="hero" class="relative overflow-hidden" data-hero data-hero-pin data-section style="min-height: clamp(640px, 92vh, 920px);">
        <div class="hero-halo" aria-hidden="true"></div>

        <div class="container-page relative z-10 flex flex-col justify-center" style="min-height: clamp(640px, 92vh, 920px);">

            <div class="pt-32 pb-12 md:pt-40 md:pb-20">

                <div class="type-eyebrow flex items-center gap-3" data-reveal>
                    <span class="w-2 h-2 rounded-full bg-[color:var(--color-accent)]"></span>
                    <span>{{ $heroBadge }}</span>
                </div>

                <h1 class="type-display mt-8 max-w-5xl" data-hero-title>
                    <span data-split-lines class="block">{{ $heroTitleLine1 }}</span>
                    <span data-split-lines class="block text-[color:var(--color-ink-muted)]">{{ $heroTitleLine2 }}</span>
                </h1>

                <p class="type-body-lg mt-10 max-w-2xl" data-reveal data-reveal-stagger="400">
                    {{ $heroSubtitle }}
                </p>

                <div class="mt-12 flex flex-wrap items-center gap-5" data-reveal data-reveal-stagger="600">
                    <a href="{{ $heroCtaPrimaryLink }}" class="btn btn--primary">
                        <span>{{ $heroCtaPrimaryText }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ $heroCtaSecondaryLink }}" class="btn btn--link">
                        {{ $heroCtaSecondaryText }}
                    </a>
                </div>

            </div>

            {{-- Hero meta strip --}}
{{--            <div class="mt-auto pb-12 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 hairline-t pt-10">--}}
{{--                <div data-reveal data-reveal-stagger="0">--}}
{{--                    <div class="type-eyebrow mb-2">السنة</div>--}}
{{--                    <div class="type-h3" dir="ltr">{{ now()->year }}</div>--}}
{{--                </div>--}}
{{--                <div data-reveal data-reveal-stagger="100">--}}
{{--                    <div class="type-eyebrow mb-2">المنطقة</div>--}}
{{--                    <div class="type-h3">{{ $companySettings->location_text ?? 'الشرق الأوسط' }}</div>--}}
{{--                </div>--}}
{{--                <div data-reveal data-reveal-stagger="200">--}}
{{--                    <div class="type-eyebrow mb-2">التخصص</div>--}}
{{--                    <div class="type-h3">منتجات رقمية</div>--}}
{{--                </div>--}}
{{--                <div data-reveal data-reveal-stagger="300">--}}
{{--                    <div class="type-eyebrow mb-2">المنهج</div>--}}
{{--                    <div class="type-h3">تصميم ↔ هندسة</div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

    {{-- ================================================================
         2. TRUST RIBBON
         ================================================================ --}}
    <section class="hairline-y py-10" style="background: var(--color-canvas);">
        @php
            $ribbon = ['تصميم منتجات', 'تطوير ويب', 'تطبيقات جوال', 'هندسة برمجية', 'إستراتيجية رقمية', 'تجربة مستخدم', 'هويات بصرية', 'بنية تحتية', 'تجارة إلكترونية', 'تكاملات API'];
        @endphp
        <x-ui.marquee :items="$ribbon" />
    </section>

    {{-- ================================================================
         3. SERVICES SCROLLYTELLING
         ================================================================ --}}
    @if($services && $services->count())
    <section id="services" class="section-pad relative" data-services-scroller data-section style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl mb-20" data-reveal>
                <x-ui.eyebrow number="01">ما نقدّمه</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">
                    خدمات مُصمَّمة بدقّة <span class="text-[color:var(--color-ink-muted)]">— لا منتجات قوالبية.</span>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl">
                    كل خدمة هي نتاج تعاون بين مصممين ومهندسين، ومسؤولية مشتركة عن النتيجة.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

                {{-- Left: numbered list of services --}}
                <div class="lg:col-span-5 lg:sticky lg:top-32">
                    <ol class="space-y-1">
                        @foreach($services as $idx => $service)
                            <li class="svc-row group cursor-pointer py-5 hairline-b last:border-b-0"
                                aria-selected="{{ $idx === 0 ? 'true' : 'false' }}"
                                data-svc-index="{{ $idx }}">
                                <div class="flex items-baseline gap-6">
                                    <span class="type-numeral text-[color:var(--color-ink-subtle)] text-2xl">
                                        {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <h3 class="type-h2 leading-tight">{{ $service->title }}</h3>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>

                {{-- Right: panels (swap on scroll) --}}
                <div class="lg:col-span-7 relative">
                    <div class="relative min-h-[420px]">
                        @foreach($services as $idx => $service)
                            <div class="svc-panel {{ $idx === 0 ? 'is-active' : '' }} {{ $idx === 0 ? '' : 'absolute inset-0' }}">
                                <div class="hairline-y py-12">
                                    <div class="type-eyebrow mb-6">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }} — خدمة</div>

                                    <p class="type-body-lg text-[color:var(--color-ink)] max-w-xl">
                                        {{ $service->short_description ?? $service->description }}
                                    </p>

                                    @if($service->features && $service->features->count())
                                        <ul class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                                            @foreach($service->features as $feature)
                                                <li class="flex items-baseline gap-3 type-body text-[color:var(--color-ink-muted)]">
                                                    <span class="w-1 h-1 rounded-full bg-[color:var(--color-accent)] flex-shrink-0 translate-y-2"></span>
                                                    <span>{{ $feature->feature_text }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="mt-10">
                                        <a href="{{ route('services') }}#{{ $service->slug ?? '' }}" class="btn btn--link">
                                            استكشف الخدمة
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         4. FEATURED WORK
         ================================================================ --}}
    @if($featuredProjects && $featuredProjects->count())
{{--    <section id="work" class="section-pad" data-section style="background: var(--color-canvas);">--}}
{{--        <div class="container-page">--}}
{{--            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16" data-reveal>--}}
{{--                <div class="max-w-2xl">--}}
{{--                    <x-ui.eyebrow number="02">مختارات من أعمالنا</x-ui.eyebrow>--}}
{{--                    <h2 class="type-h1 mt-6">--}}
{{--                        ما صنعناه مؤخرًا.--}}
{{--                    </h2>--}}
{{--                </div>--}}
{{--                <a href="{{ route('portfolio') }}" class="btn btn--ghost self-start md:self-auto">--}}
{{--                    <span>الأرشيف الكامل</span>--}}
{{--                    <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">--}}
{{--                        <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                    </svg>--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="space-y-24 md:space-y-32">--}}
{{--                @foreach($featuredProjects->take(3) as $i => $project)--}}
{{--                    @php $reverse = $i % 2 === 1; @endphp--}}
{{--                    <a href="{{ route('projects.show', $project->slug) }}"--}}
{{--                       class="work-card group grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-12 items-center"--}}
{{--                       data-reveal>--}}
{{--                        <div class="md:col-span-7 {{ $reverse ? 'md:order-2' : '' }}">--}}
{{--                            <div class="work-card__media">--}}
{{--                                @if($project->main_image)--}}
{{--                                    <img src="{{ Storage::url($project->main_image) }}"--}}
{{--                                         alt="{{ $project->title }}"--}}
{{--                                         loading="lazy"--}}
{{--                                         data-parallax="0.08" />--}}
{{--                                @else--}}
{{--                                    <div class="work-card__media-fallback">{{ $project->title }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="md:col-span-5 {{ $reverse ? 'md:order-1' : '' }}">--}}
{{--                            <div class="type-eyebrow mb-5 flex items-center gap-3">--}}
{{--                                <span class="type-numeral text-base">{{ sprintf('%02d', $i + 1) }}</span>--}}
{{--                                <span class="w-6 h-px bg-[color:var(--color-line-strong)]"></span>--}}
{{--                                @if($project->types && $project->types->count())--}}
{{--                                    <span>{{ $project->types->first()->name_ar }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <h3 class="type-h2 transition-colors duration-300 group-hover:text-[color:var(--color-accent)]">--}}
{{--                                {{ $project->title }}--}}
{{--                            </h3>--}}
{{--                            @if($project->short_description)--}}
{{--                                <p class="type-body mt-4 max-w-md">{{ $project->short_description }}</p>--}}
{{--                            @endif--}}
{{--                            <div class="mt-8 inline-flex items-center gap-2 type-small text-[color:var(--color-ink)]">--}}
{{--                                <span>عرض المشروع</span>--}}
{{--                                <svg width="14" height="10" viewBox="0 0 16 10" fill="none" class="btn-arrow" aria-hidden="true">--}}
{{--                                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    @endif

    {{-- ================================================================
         5. STATS
         ================================================================ --}}
    @if($stats && $stats->count())
    <section class="section-pad hairline-y" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl mb-16" data-reveal>
                <x-ui.eyebrow number="03">بالأرقام</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">
                    نتائج قابلة للقياس.
                </h2>
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
                        <div class="type-numeral text-[clamp(3rem,6vw,5.5rem)] leading-none text-[color:var(--color-ink)]"
                             data-count="{{ $value }}"
                             data-count-format="{{ $suffix }}"
                             data-count-decimals="{{ $decimals }}"
                             dir="ltr">
                            0{{ $suffix }}
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
         6. PROCESS TIMELINE
         ================================================================ --}}
    <section id="process" class="section-pad" data-process data-section style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl mb-20" data-reveal>
                <x-ui.eyebrow number="04">منهجنا</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">
                    أربع مراحل، <span class="text-[color:var(--color-ink-muted)]">نتيجة واحدة.</span>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl">
                    نتعامل مع كل مشروع كحرفة. تحديد المشكلة، تصميم الحلّ، البناء بإتقان، ثم القياس والتكرار.
                </p>
            </div>

            <div class="process relative pt-12 md:pt-20">
                <div class="process__rail" aria-hidden="true"></div>

                @php
                    $steps = [
                        ['n' => '01', 'title' => 'الاكتشاف', 'desc' => 'نفهم سياقك، أهدافك، والمستخدم النهائي قبل أي شيء.'],
                        ['n' => '02', 'title' => 'التصميم',   'desc' => 'ننتقل من الفرضيات إلى نماذج تفاعلية يمكن اختبارها.'],
                        ['n' => '03', 'title' => 'البناء',    'desc' => 'هندسة برمجية متينة، اختبار آلي، ومراجعات منتظمة.'],
                        ['n' => '04', 'title' => 'القياس',    'desc' => 'إطلاق مدروس، ثم تحسين قائم على بيانات حقيقية.'],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 md:gap-10 ps-8 md:ps-0 md:pt-10">
                    @foreach($steps as $idx => $step)
                        <div data-reveal data-reveal-stagger="{{ $idx * 120 }}">
                            <div class="type-numeral text-3xl text-[color:var(--color-accent)] mb-4" dir="ltr">{{ $step['n'] }}</div>
                            <h3 class="type-h3 mb-3">{{ $step['title'] }}</h3>
                            <p class="type-body max-w-[18rem]">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         7. TESTIMONIALS
         ================================================================ --}}
    @if($testimonials && $testimonials->count())
    <section id="testimonials" class="section-pad" data-section style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mb-16" data-reveal>
                <x-ui.eyebrow number="05">ما يقولون</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">
                    شهادات من شركاء العمل.
                </h2>
            </div>

            <div class="embla" data-embla-root>
                <div class="embla__viewport" data-embla-viewport>
                    <div class="embla__container">
                        @foreach($testimonials as $t)
                            <div class="embla__slide">
                                <figure class="max-w-3xl">
                                    <blockquote class="type-display-serif" style="font-size: clamp(1.5rem, 3.2vw, 2.5rem); line-height: 1.3;">
                                        <span class="text-[color:var(--color-accent)]">"</span>{{ $t->testimonial }}<span class="text-[color:var(--color-accent)]">"</span>
                                    </blockquote>
                                    <figcaption class="mt-10 flex items-center gap-4">
                                        @if($t->client_avatar)
                                            <img src="{{ Storage::url($t->client_avatar) }}"
                                                 alt="{{ $t->client_name }}"
                                                 class="w-14 h-14 rounded-full object-cover hairline-t hairline-b"
                                                 style="border: 1px solid var(--color-line-strong);" />
                                        @endif
                                        <div>
                                            <div class="type-body text-[color:var(--color-ink)] font-medium">{{ $t->client_name }}</div>
                                            <div class="type-small text-[color:var(--color-ink-subtle)]">
                                                {{ trim(($t->client_position ?? '') . ($t->client_company ? ' — ' . $t->client_company : '')) }}
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="embla__controls">
                    <div class="embla__dots" data-embla-dots></div>
                    <div class="flex items-center gap-3">
                        <button type="button" class="embla__arrow" data-embla-prev aria-label="السابق">
                            <svg width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M1.5 5H15M10 .5l5 4.5-5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" class="embla__arrow" data-embla-next aria-label="التالي">
                            <svg width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         8. LATEST WRITING
         ================================================================ --}}
    @if($latestArticles && $latestArticles->count())
    <section id="writing" class="section-pad" data-section style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="06">المدونة</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">
                        كتابات حديثة.
                    </h2>
                </div>
                <a href="{{ route('articles') }}" class="btn btn--ghost self-start md:self-auto">
                    <span>الأرشيف الكامل</span>
                    <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                        <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
                @foreach($latestArticles->take(3) as $idx => $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="article-card group"
                       data-reveal data-reveal-stagger="{{ $idx * 120 }}">
                        <div class="article-card__cover">
                            @if($article->featured_image)
                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" />
                            @endif
                        </div>
                        <div class="type-eyebrow mb-4 flex items-center gap-3">
                            @if($article->published_at)
                                <time datetime="{{ $article->published_at->toIso8601String() }}">
                                    {{ $article->published_at->translatedFormat('j F Y') }}
                                </time>
                            @endif
                        </div>
                        <h3 class="article-card__title type-h3 leading-snug">{{ $article->title }}</h3>
                        @if($article->excerpt)
                            <p class="type-body mt-3 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt), 120) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         9. CLOSING CTA
         ================================================================ --}}
    <section id="cta" class="section-pad" data-section style="background: var(--color-surface-inset);">
        <div class="container-page">
            <div class="max-w-4xl" data-reveal>
                <x-ui.eyebrow number="07">لنبدأ</x-ui.eyebrow>
                <h2 class="type-display mt-6">
                    لنصنع شيئًا <span class="type-display-serif italic">يستحقّ</span> الانتباه.
                </h2>
                <p class="type-body-lg mt-8 max-w-xl">
                    أرسل لنا تفاصيل مشروعك، ونتواصل خلال يوم عمل واحد بمقترح أوّليّ.
                </p>

                <div class="mt-12 flex flex-wrap items-center gap-5">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary">
                        <span>ابدأ مشروعك</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    @if($companySettings && $companySettings->main_email)
                        <a href="mailto:{{ $companySettings->main_email }}" class="btn btn--link">
                            {{ $companySettings->main_email }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
