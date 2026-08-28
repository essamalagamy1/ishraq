@php
    $heroTitle = $heroSection?->title_line1 ?? __('نصنع تجارب رقمية');
    $heroTitle2 = $heroSection?->title_line2 ?? __('تترك أثرًا وتعيش طويلاً.');
    $heroSubtitle = $heroSection?->subtitle ?? __('شريك تصميم وتطوير منتجات رقمية يقود التحول ويصنع أثرًا ملموسًا وقابلًا للقياس.');
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
                    <span class="block">{{ $heroTitle }}</span>
                    @if($heroTitle2)
                        <span class="block text-gradient mt-2">{{ $heroTitle2 }}</span>
                    @endif
                </h1>

                <p class="type-body-lg mt-10 max-w-2xl leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. STORY & MANIFESTO — Split Layout
         ================================================================ --}}
    <section class="section-pad hairline-y" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-stretch">
                {{-- Left: Story narrative --}}
                <div class="lg:col-span-7 flex flex-col justify-between" data-reveal>
                    <div>
                        <x-ui.eyebrow number="02">{{ __('قصتنا') }}</x-ui.eyebrow>
                        <h2 class="type-h1 mt-6">{{ __('نصمم بعين فنان، ونبني بعقل مهندس.') }}</h2>
                        <div class="type-body mt-8 space-y-6 text-lg leading-relaxed text-[color:var(--color-ink-muted)]">
                            <p>{{ __('بدأت إشراق من شغف بالتقنية وتحويل الأفكار إلى منتجات متقنة تعمل بكفاءة استثنائية وتعيش طويلاً.') }}</p>
                            <p>{{ __('اليوم، نعمل كفريق نخبوي عالي الحرفة، نؤمن بأن الجودة لا تأتي من التسرع، بل من وضوح الرؤية والعمق في فهم احتياج المستخدم والنشاط التجاري.') }}</p>
                            <p>{{ __('نقيس نجاحنا بما يتحقق لعملائنا من نتائج حقيقية ونمو ملموس، لا بالوعود النظرية.') }}</p>
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-[color:var(--color-line)] flex items-center gap-8">
                        <div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[color:var(--color-ink-subtle)]">{{ __('المقر') }}</div>
                            <div class="type-body font-medium mt-1 text-[color:var(--color-ink)]">{{ __('المملكة العربية السعودية') }}</div>
                        </div>
                        <div class="w-px h-8 bg-[color:var(--color-line)]"></div>
                        <div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[color:var(--color-ink-subtle)]">{{ __('مجال التركيز') }}</div>
                            <div class="type-body font-medium mt-1 text-[color:var(--color-accent)]">{{ __('المنتجات والحلول الرقمية المتطورة') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Right: Manifesto Highlight Card --}}
                <div class="lg:col-span-5" data-reveal data-reveal-stagger="150">
                    <div class="surface-card p-8 lg:p-12 rounded-3xl h-full flex flex-col justify-between relative overflow-hidden border border-[color:var(--color-line-strong)]">
                        <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full bg-[color:var(--color-accent-soft)] blur-3xl pointer-events-none"></div>

                        <div>
                            <span class="font-mono text-xs text-[color:var(--color-accent)] tracking-widest uppercase mb-4 block">{{ __('منهج العمل') }}</span>
                            <h3 class="type-h2 mb-6 leading-snug">{{ __('حرفة رقمية متقنة تسبق المعايير.') }}</h3>
                            <p class="type-body text-[color:var(--color-ink-muted)] leading-relaxed">
                                {{ __('نوازن بدقة بين الجماليات البصرية الفاخرة والبنية التقنية المتينة، لنبني حلولًا مهيأة للتوسع والنمو السلس منذ اليوم الأول.') }}
                            </p>
                        </div>

                        <div class="mt-10 pt-6 border-t border-[color:var(--color-line)]">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[color:var(--color-accent-soft)] flex items-center justify-center text-[color:var(--color-accent)] font-mono text-sm font-semibold">
                                    ✦
                                </div>
                                <span class="type-small font-medium text-[color:var(--color-ink)]">{{ __('التزام كامل بالجودة العالية والأداء الفائق') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         3. STATS — 3D Counters
         ================================================================ --}}
    @if($stats && $stats->count())
        <section class="section-pad" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="max-w-3xl mb-16" data-reveal>
                    <x-ui.eyebrow number="03">{{ __('بالأرقام') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('مؤشرات تدل على الأثر.') }}</h2>
                    <p class="type-body-lg mt-4 text-[color:var(--color-ink-muted)]">{{ __('إحصائيات تلخص مسيرتنا وشراكاتنا الناجحة.') }}</p>
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
         4. VALUES — Bento Box Grid
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface-inset);">
        <div class="container-page">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16" data-reveal>
                <div class="max-w-2xl">
                    <x-ui.eyebrow number="04">{{ __('قيمنا الراسخة') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('المبادئ التي تقود كل قرار.') }}</h2>
                </div>
                <p class="type-body max-w-md text-[color:var(--color-ink-muted)]">
                    {{ __('ثوابت مهنية نسترشد بها في كل تفصيلة من الفكرة وحتى الإطلاق.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $valuesList = ($features && $features->count()) ? $features->take(4) : collect([
                        (object)[
                            'title' => __('الدقة والحرفة'),
                            'description' => __('نراجع كل سطر كود وكل بكسل حتى تصل النتيجة إلى المستوى الذي نفتخر به ونرضى عنه.')
                        ],
                        (object)[
                            'title' => __('الشفافية الكاملة'),
                            'description' => __('نشاركك السياق الكامل والقرارات التقنية أولاً بأول، ونعمل كامتداد مباشر لفريقك.')
                        ],
                        (object)[
                            'title' => __('التحسين المستمر'),
                            'description' => __('نقيس ونختبر بناءً على بيانات وتجارب حقيقية لضمان نمو المنتج وتعظيم عائده.')
                        ],
                        (object)[
                            'title' => __('الالتزام بالمسار'),
                            'description' => __('نحترم الجداول الزمنية ونفي بالوعود بدقة وانضباط مهني صارم.')
                        ],
                    ]);
                @endphp

                @foreach($valuesList as $idx => $feature)
                    <div class="surface-card p-8 rounded-2xl flex flex-col justify-between group hover:border-[color:var(--color-accent-ring)] transition-all duration-300 relative overflow-hidden"
                         data-reveal data-reveal-stagger="{{ $idx * 120 }}">
                        <div class="flex items-center justify-between mb-8">
                            <span class="font-mono text-xs text-[color:var(--color-accent)] font-semibold tracking-wider" dir="ltr">
                                0{{ $idx + 1 }}
                            </span>
                            <span class="w-2 h-2 rounded-full bg-[color:var(--color-line-strong)] group-hover:bg-[color:var(--color-accent)] transition-colors"></span>
                        </div>
                        <div>
                            <h3 class="type-h3 mb-4 text-[color:var(--color-ink)] group-hover:text-[color:var(--color-accent)] transition-colors">
                                {{ $feature->title }}
                            </h3>
                            <p class="type-body text-[color:var(--color-ink-muted)] leading-relaxed text-sm">
                                {{ $feature->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         5. CTA SECTION
         ================================================================ --}}
    <section class="cta-ed" data-section>
        <div class="container-page">
            <div class="cta-ed__inner" data-reveal>
                <x-ui.eyebrow number="05">{{ __('ابدأ رحلتك') }}</x-ui.eyebrow>
                <h2 class="cta-ed__heading mt-6">
                    {{ __('فلنصنع منتجًا') }} <em>{{ __('يستحق البقاء') }}</em>
                </h2>
                <p class="type-body-lg mt-6 max-w-xl text-[color:var(--color-ink-muted)]">
                    {{ __('احكِ لنا عن فكرتك أو مشروعك، وسنعود إليك بخطة واضحة ومقترح مدروس خلال يوم عمل واحد.') }}
                </p>
                <div class="cta-ed__actions">
                    <a href="{{ route('request-design.create') }}" class="btn btn--primary" id="about-cta-primary" wire:navigate>
                        <span>{{ __('ابدأ مشروعك الآن') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn--ghost" id="about-cta-secondary" wire:navigate>
                        {{ __('تواصل للاستشارة') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

