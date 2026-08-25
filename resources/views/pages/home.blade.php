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
    <section id="hero" class="hero-ed" data-section data-hero-section>
        {{-- Halo glow — follows cursor via JS --}}
        <div class="hero-halo" aria-hidden="true"></div>

        {{-- Decorative ambient blobs --}}
        <div class="hero-blob hero-blob--1" aria-hidden="true"></div>
        <div class="hero-blob hero-blob--2" aria-hidden="true"></div>

        <div class="container-page" style="position:relative;z-index:1;">

            {{-- Main headline --}}
            <div class="hero-ed__headline">
                <h1 data-hero-title>
                    <span class="hero-ed__line" data-reveal data-reveal-stagger="0">{{ $heroTitleLine1 }}</span>
                    <span class="hero-ed__line hero-ed__line--accent" data-reveal data-reveal-stagger="120">{{ $heroTitleLine2 }}</span>
                </h1>
            </div>

            {{-- Bottom area: subtitle + CTAs + stats --}}
            <div class="hero-ed__bottom">
                <div class="hero-ed__col-text" data-reveal data-reveal-stagger="300">
                    <p class="hero-ed__subtitle">{{ $heroSubtitle }}</p>
                    <div class="hero-ed__ctas">
                        <a href="{{ $heroCtaPrimaryLink }}" class="btn btn--primary" id="hero-cta-primary">
                            <span>{{ $heroCtaPrimaryText }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="{{ $heroCtaSecondaryLink }}" class="btn btn--ghost" id="hero-cta-secondary">
                            {{ $heroCtaSecondaryText }}
                        </a>
                    </div>
                </div>

                @if($stats && $stats->count())
                <div class="hero-ed__col-stats" data-reveal data-reveal-stagger="480">
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
         4. FEATURED WORK — Bento Grid
         ================================================================ --}}
    @if($featuredProjects && $featuredProjects->count())
    <section id="work" class="section-pad work-bento" data-section>
        <div class="container-page">

            {{-- Section header --}}
            <div class="ed-section-head" data-reveal>
                <span class="ed-section-num" dir="ltr">02</span>
                <div class="flex-1">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                        <div>
                            <h2 class="type-h1">ما صنعناه مؤخرًا.</h2>
                            <p class="type-body-lg mt-4 max-w-xl">حلول مُشيّدة بعناية، تقيس الأثر بمؤشرات حقيقية.</p>
                        </div>
                        <a href="{{ route('portfolio') }}" class="btn btn--ghost self-start lg:self-auto group" id="work-archive-btn">
                            <span>الأرشيف الكامل</span>
                            <span class="font-mono text-[color:var(--color-accent)] text-xs" dir="ltr">{{ str_pad($featuredProjects->count(), 2, '0', STR_PAD_LEFT) }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            @php
                $firstProject  = $featuredProjects->first();
                $otherProjects = $featuredProjects->skip(1)->values();
                $secondProject = $otherProjects->get(0);
                $thirdProject  = $otherProjects->get(1);
                $extraProjects = $otherProjects->skip(2)->take(2);
            @endphp

            {{-- Bento Grid --}}
            <div class="work-bento__grid">

                {{-- SPOTLIGHT — large left card --}}
                @if($firstProject)
                <div class="work-bento__spotlight" data-reveal data-reveal-stagger="0">
                    <a href="{{ route('projects.show', $firstProject->slug) }}"
                       class="work-bento__card group"
                       aria-label="{{ $firstProject->title }}">

                        {{-- Image --}}
                        <div class="work-bento__media">
                            @if($firstProject->main_image)
                                <img src="{{ Storage::url($firstProject->main_image) }}"
                                     alt="{{ $firstProject->title }}"
                                     class="work-bento__img"
                                     loading="eager" />
                            @else
                                <div class="work-bento__fallback">
                                    <span>{{ $firstProject->title }}</span>
                                </div>
                            @endif
                            {{-- Gradient overlay --}}
                            <div class="work-bento__overlay" aria-hidden="true"></div>
                        </div>

                        {{-- Hover info panel --}}
                        <div class="work-bento__info">
                            <div class="work-bento__meta">
                                <span class="work-bento__index" dir="ltr">01</span>
                                @if($firstProject->types && $firstProject->types->count())
                                    <span class="work-bento__tag">
                                        {{ $firstProject->types->first()->name_ar ?? $firstProject->types->first()->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="work-bento__title-wrap">
                                <h3 class="work-bento__title">{{ $firstProject->title }}</h3>
                                @if($firstProject->short_description)
                                    <p class="work-bento__desc">{{ Str::limit($firstProject->short_description, 100) }}</p>
                                @endif
                            </div>
                            <div class="work-bento__cta">
                                <span>استكشف المشروع</span>
                                <span class="work-bento__arrow" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M10 2L2 10M10 2H4M10 2V8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </a>
                </div>
                @endif

                {{-- STACK — two cards stacked on the right --}}
                <div class="work-bento__stack">

                    @if($secondProject)
                    <div class="work-bento__secondary" data-reveal data-reveal-stagger="150">
                        <a href="{{ route('projects.show', $secondProject->slug) }}"
                           class="work-bento__card group"
                           aria-label="{{ $secondProject->title }}">
                            <div class="work-bento__media">
                                @if($secondProject->main_image)
                                    <img src="{{ Storage::url($secondProject->main_image) }}"
                                         alt="{{ $secondProject->title }}"
                                         class="work-bento__img"
                                         loading="lazy" />
                                @else
                                    <div class="work-bento__fallback">
                                        <span>{{ $secondProject->title }}</span>
                                    </div>
                                @endif
                                <div class="work-bento__overlay" aria-hidden="true"></div>
                            </div>
                            <div class="work-bento__info">
                                <div class="work-bento__meta">
                                    <span class="work-bento__index" dir="ltr">02</span>
                                    @if($secondProject->types && $secondProject->types->count())
                                        <span class="work-bento__tag">{{ $secondProject->types->first()->name_ar ?? $secondProject->types->first()->name }}</span>
                                    @endif
                                </div>
                                <div class="work-bento__title-wrap">
                                    <h3 class="work-bento__title work-bento__title--sm">{{ $secondProject->title }}</h3>
                                </div>
                                <div class="work-bento__cta">
                                    <span>عرض التفاصيل</span>
                                    <span class="work-bento__arrow" aria-hidden="true">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M10 2L2 10M10 2H4M10 2V8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if($thirdProject)
                    <div class="work-bento__secondary" data-reveal data-reveal-stagger="280">
                        <a href="{{ route('projects.show', $thirdProject->slug) }}"
                           class="work-bento__card group"
                           aria-label="{{ $thirdProject->title }}">
                            <div class="work-bento__media">
                                @if($thirdProject->main_image)
                                    <img src="{{ Storage::url($thirdProject->main_image) }}"
                                         alt="{{ $thirdProject->title }}"
                                         class="work-bento__img"
                                         loading="lazy" />
                                @else
                                    <div class="work-bento__fallback">
                                        <span>{{ $thirdProject->title }}</span>
                                    </div>
                                @endif
                                <div class="work-bento__overlay" aria-hidden="true"></div>
                            </div>
                            <div class="work-bento__info">
                                <div class="work-bento__meta">
                                    <span class="work-bento__index" dir="ltr">03</span>
                                    @if($thirdProject->types && $thirdProject->types->count())
                                        <span class="work-bento__tag">{{ $thirdProject->types->first()->name_ar ?? $thirdProject->types->first()->name }}</span>
                                    @endif
                                </div>
                                <div class="work-bento__title-wrap">
                                    <h3 class="work-bento__title work-bento__title--sm">{{ $thirdProject->title }}</h3>
                                </div>
                                <div class="work-bento__cta">
                                    <span>عرض التفاصيل</span>
                                    <span class="work-bento__arrow" aria-hidden="true">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M10 2L2 10M10 2H4M10 2V8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                </div>{{-- /stack --}}

            </div>{{-- /bento grid --}}

            {{-- Extra projects row (4th, 5th) --}}
            @if($extraProjects->count())
            <div class="work-bento__extra-row">
                @foreach($extraProjects as $idx => $project)
                <div class="work-bento__extra-card" data-reveal data-reveal-stagger="{{ ($idx + 1) * 150 }}">
                    <a href="{{ route('projects.show', $project->slug) }}" class="work-bento__card group">
                        <div class="work-bento__media">
                            @if($project->main_image)
                                <img src="{{ Storage::url($project->main_image) }}" alt="{{ $project->title }}" class="work-bento__img" loading="lazy" />
                            @else
                                <div class="work-bento__fallback"><span>{{ $project->title }}</span></div>
                            @endif
                            <div class="work-bento__overlay" aria-hidden="true"></div>
                        </div>
                        <div class="work-bento__info">
                            <div class="work-bento__meta">
                                <span class="work-bento__index" dir="ltr">{{ str_pad($idx + 4, 2, '0', STR_PAD_LEFT) }}</span>
                                @if($project->types && $project->types->count())
                                    <span class="work-bento__tag">{{ $project->types->first()->name_ar ?? $project->types->first()->name }}</span>
                                @endif
                            </div>
                            <h3 class="work-bento__title work-bento__title--sm">{{ $project->title }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif

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
                    <div class="stats-grid__item stat-3d" data-reveal data-reveal-stagger="{{ $idx * 100 }}">
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
    <section id="process" class="section-pad process-section" data-section data-process-section style="background: var(--color-canvas);">
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
                       data-reveal data-reveal-stagger="{{ $idx * 130 }}">
                        <div class="article-card__cover">
                            @if($article->featured_image)
                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" />
                            @endif
                        </div>
                        <div class="article-card__eyebrow">
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
                        <div class="flex items-center gap-2 mt-4 text-xs font-mono text-[color:var(--color-ink-subtle)] group-hover:text-[color:var(--color-accent)] transition-colors">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M10 6H2M4 3L1 6l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>اقرأ المقال</span>
                        </div>
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
