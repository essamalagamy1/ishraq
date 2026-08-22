@php
    $hero = $heroSection ?? null;
    $heroTitleLine1 = $hero->title_line1 ?? 'مع إشراق، أفكارك';
    $heroTitleLine2 = $hero->title_line2 ?? 'تتحول إلى واقع مُشرق';
    $heroSubtitle = $hero->subtitle ?? 'نُبدع حلولاً رقمية مُشرقة ومُبتكرة. من مواقع الويب المتألقة إلى التطبيقات الذكية، نُنير رحلتك الرقمية بأحدث التقنيات والإبداع اللامحدود.';
    $heroCtaPrimaryText = $hero->cta_primary_text ?? 'ابدأ مشروعك';
    $heroCtaPrimaryLink = $hero->cta_primary_link ?? route('request-design.create');
    $heroCtaSecondaryText = $hero->cta_secondary_text ?? 'استكشف أعمالنا';
    $heroCtaSecondaryLink = $hero->cta_secondary_link ?? route('portfolio');
@endphp

<x-layouts.app>

    {{-- ================================================================
         1. HERO — Editorial Typography
         ================================================================ --}}
    <section id="hero" class="hero-ed" data-section>
        <div class="container-page">

            {{-- Top strip: brief label --}}
            {{-- <div class="hero-ed__top" data-reveal>
                <span class="hero-ed__label">وكالة رقمية</span>
                <span class="hero-ed__line-h"></span>
                <span class="hero-ed__label">تصميم · تطوير · إستراتيجية</span>
            </div> --}}

            {{-- Main headline --}}
            <div class="hero-ed__headline">
                <h1 data-reveal data-reveal-stagger="100">
                    <span class="hero-ed__line">{{ $heroTitleLine1 }}</span>
                    <span class="hero-ed__line hero-ed__line--accent">{{ $heroTitleLine2 }}</span>
                </h1>
            </div>

            {{-- Bottom area: subtitle + CTAs + stats --}}
            <div class="hero-ed__bottom">
                <div class="hero-ed__col-text" data-reveal data-reveal-stagger="300">
                    <p class="hero-ed__subtitle">{{ $heroSubtitle }}</p>
                    <div class="hero-ed__ctas">
                        <a href="{{ $heroCtaPrimaryLink }}" class="btn btn--primary">
                            <span>{{ $heroCtaPrimaryText }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ $heroCtaSecondaryLink }}" class="btn btn--ghost">
                            {{ $heroCtaSecondaryText }}
                        </a>
                    </div>
                </div>

                @if($stats && $stats->count())
                <div class="hero-ed__col-stats" data-reveal data-reveal-stagger="500">
                    @foreach($stats->take(3) as $idx => $stat)
                        @php
                            $raw = (string) ($stat->number ?? '');
                            preg_match('/(\d+(?:\.\d+)?)\s*(\D*)/u', $raw, $m);
                            $value = isset($m[1]) ? (float) $m[1] : 0;
                            $suffix = $m[2] ?? '';
                            $decimals = (strpos($raw, '.') !== false) ? 1 : 0;
                        @endphp
                        <div class="hero-stat">
                            <span class="hero-stat__num"
                                  data-count="{{ $value }}"
                                  data-count-format="{{ $suffix }}"
                                  data-count-decimals="{{ $decimals }}"
                                  dir="ltr">0{{ $suffix }}</span>
                            <span class="hero-stat__label">{{ $stat->label }}</span>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </section>

    {{-- ================================================================
         2. MARQUEE RIBBON
         ================================================================ --}}
    <div class="hairline-y py-8" style="background: var(--color-canvas);">
        @php
            $ribbon = ['تصميم منتجات', 'تطوير ويب', 'تطبيقات جوال', 'هندسة برمجية', 'إستراتيجية رقمية', 'تجربة مستخدم', 'هويات بصرية', 'بنية تحتية', 'تجارة إلكترونية', 'تكاملات API'];
        @endphp
        <x-ui.marquee :items="$ribbon" />
    </div>

    {{-- ================================================================
         3. SERVICES — Accordion
         ================================================================ --}}
    @if($services && $services->count())
    <section id="services" class="section-pad" data-section style="background: var(--color-canvas);">
        <div class="container-page">

            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">01</span>
                <div>
                    <h2 class="type-h1">ما نقدّمه</h2>
                    <p class="type-body-lg mt-4 max-w-xl">كل خدمة هي نتاج تعاون بين مصممين ومهندسين، ومسؤولية مشتركة عن النتيجة.</p>
                </div>
            </div>

            <div class="svc-accordion" data-accordion>
                @foreach($services as $idx => $service)
                    <div class="svc-accordion__item {{ $idx === 0 ? 'is-open' : '' }}" data-accordion-item>
                        <button type="button" class="svc-accordion__trigger" data-accordion-trigger aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                            <span class="svc-accordion__num" dir="ltr">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="svc-accordion__title">{{ $service->title }}</span>
                            <span class="svc-accordion__icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>
                            </span>
                        </button>
                        <div class="svc-accordion__body" data-accordion-body>
                            <div class="svc-accordion__content">
                                <p class="type-body-lg max-w-2xl">{{ $service->short_description ?? $service->description }}</p>

                                @if($service->features && $service->features->count())
                                    <ul class="svc-accordion__features">
                                        @foreach($service->features as $feature)
                                            <li>
                                                <span class="svc-accordion__dot"></span>
                                                {{ $feature->feature_text }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <a href="{{ route('services') }}#{{ $service->slug ?? '' }}" class="btn btn--link mt-6">
                                    استكشف الخدمة
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         4. FEATURED WORK
         ================================================================ --}}
    @if($featuredProjects && $featuredProjects->count())
    <section id="work" class="section-pad" data-section style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-16" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="02">مختارات من أعمالنا</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">
                        ما صنعناه مؤخرًا.
                    </h2>
                </div>
                <a href="{{ route('portfolio') }}" class="btn btn--ghost self-start md:self-auto">
                    <span>الأرشيف الكامل</span>
                    <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                        <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="space-y-24 md:space-y-32">
                @foreach($featuredProjects->take(3) as $i => $project)
                    @php $reverse = $i % 2 === 1; @endphp
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="work-card group grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-12 items-center"
                       data-reveal>
                        <div class="md:col-span-7 {{ $reverse ? 'md:order-2' : '' }}">
                            <div class="work-card__media">
                                @if($project->main_image)
                                    <img src="{{ Storage::url($project->main_image) }}"
                                         alt="{{ $project->title }}"
                                         loading="lazy"
                                         data-parallax="0.08" />
                                @else
                                    <div class="work-card__media-fallback">{{ $project->title }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-5 {{ $reverse ? 'md:order-1' : '' }}">
                            <div class="type-eyebrow mb-5 flex items-center gap-3">
                                <span class="type-numeral text-base">{{ sprintf('%02d', $i + 1) }}</span>
                                <span class="w-6 h-px bg-[color:var(--color-line-strong)]"></span>
                                @if($project->types && $project->types->count())
                                    <span>{{ $project->types->first()->name_ar }}</span>
                                @endif
                            </div>
                            <h3 class="type-h2 transition-colors duration-300 group-hover:text-[color:var(--color-accent)]">
                                {{ $project->title }}
                            </h3>
                            @if($project->short_description)
                                <p class="type-body mt-4 max-w-md">{{ $project->short_description }}</p>
                            @endif
                            <div class="mt-8 inline-flex items-center gap-2 type-small text-[color:var(--color-ink)]">
                                <span>عرض المشروع</span>
                                <svg width="14" height="10" viewBox="0 0 16 10" fill="none" class="btn-arrow" aria-hidden="true">
                                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         5. STATS — Full-width big numbers (if more than 3 stats)
         ================================================================ --}}
    @if($stats && $stats->count() > 3)
    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">02</span>
                <div>
                    <h2 class="type-h1">بالأرقام</h2>
                </div>
            </div>

            <div class="stats-grid">
                @foreach($stats as $idx => $stat)
                    @php
                        $raw = (string) ($stat->number ?? '');
                        preg_match('/(\d+(?:\.\d+)?)\s*(\D*)/u', $raw, $m);
                        $value = isset($m[1]) ? (float) $m[1] : 0;
                        $suffix = $m[2] ?? '';
                        $decimals = (strpos($raw, '.') !== false) ? 1 : 0;
                    @endphp
                    <div class="stats-grid__item" data-reveal data-reveal-stagger="{{ $idx * 100 }}">
                        <div class="stats-grid__num"
                             data-count="{{ $value }}"
                             data-count-format="{{ $suffix }}"
                             data-count-decimals="{{ $decimals }}"
                             dir="ltr">0{{ $suffix }}</div>
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
         6. PROCESS — Large numbered steps
         ================================================================ --}}
    <section id="process" class="section-pad" data-section style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">03</span>
                <div>
                    <h2 class="type-h1">كيف نعمل</h2>
                    <p class="type-body-lg mt-4 max-w-xl">نتعامل مع كل مشروع كحرفة. تحديد المشكلة، تصميم الحلّ، البناء بإتقان، ثم القياس والتكرار.</p>
                </div>
            </div>

            @php
                $steps = [
                    ['n' => '01', 'title' => 'الاكتشاف', 'desc' => 'نفهم سياقك، أهدافك، والمستخدم النهائي قبل أي شيء.'],
                    ['n' => '02', 'title' => 'التصميم',   'desc' => 'ننتقل من الفرضيات إلى نماذج تفاعلية يمكن اختبارها.'],
                    ['n' => '03', 'title' => 'البناء',    'desc' => 'هندسة برمجية متينة، اختبار آلي، ومراجعات منتظمة.'],
                    ['n' => '04', 'title' => 'القياس',    'desc' => 'إطلاق مدروس، ثم تحسين قائم على بيانات حقيقية.'],
                ];
            @endphp

            <div class="process-grid">
                @foreach($steps as $idx => $step)
                    <div class="process-grid__card" data-reveal data-reveal-stagger="{{ $idx * 120 }}">
                        <span class="process-grid__num" dir="ltr">{{ $step['n'] }}</span>
                        <h3 class="process-grid__title">{{ $step['title'] }}</h3>
                        <p class="process-grid__desc">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         7. TESTIMONIALS — Featured quote
         ================================================================ --}}
    @if($testimonials && $testimonials->count())
    <section id="testimonials" class="section-pad" data-section style="background: var(--color-surface);">
        <div class="container-page">
            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">04</span>
                <div>
                    <h2 class="type-h1">ما يقولون</h2>
                </div>
            </div>

            <div class="testimonials-ed">
                @foreach($testimonials->take(3) as $idx => $t)
                    <figure class="testimonial-ed {{ $idx === 0 ? 'testimonial-ed--featured' : '' }}" data-reveal data-reveal-stagger="{{ $idx * 150 }}">
                        <blockquote class="testimonial-ed__quote">
                            <span class="testimonial-ed__mark" aria-hidden="true">"</span>
                            {{ $t->testimonial }}
                        </blockquote>
                        <figcaption class="testimonial-ed__author">
                            @if($t->client_avatar)
                                <img src="{{ Storage::url($t->client_avatar) }}"
                                     alt="{{ $t->client_name }}"
                                     class="testimonial-ed__avatar" />
                            @endif
                            <div>
                                <div class="testimonial-ed__name">{{ $t->client_name }}</div>
                                <div class="testimonial-ed__role">
                                    {{ trim(($t->client_position ?? '') . ($t->client_company ? ' — ' . $t->client_company : '')) }}
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
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
            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">05</span>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                        <h2 class="type-h1">كتابات حديثة</h2>
                        <a href="{{ route('articles') }}" class="btn btn--ghost self-start md:self-auto">
                            <span>الأرشيف الكامل</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
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
         9. CLOSING CTA — Clean & Minimal
         ================================================================ --}}
    <section id="cta" class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <div class="cta-ed__content">
                    <h2 class="cta-ed__heading">
                        لنصنع شيئًا <em>يستحقّ</em> الانتباه.
                    </h2>
                    <p class="type-body-lg mt-6 max-w-xl">
                        أرسل لنا تفاصيل مشروعك، ونتواصل خلال يوم عمل واحد بمقترح أوّليّ.
                    </p>
                    <div class="cta-ed__actions">
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
        </div>
    </section>

</x-layouts.app>
