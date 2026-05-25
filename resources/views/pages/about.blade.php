@php
    $heroTitle = $heroSection?->title_line1 ?? __('نصنع قيمة');
    $heroSubtitle = $heroSection?->subtitle ?? __('شريك تصميم وتطوير منتجات رقمية يقود التحول ويصنع أثرًا قابلًا للقياس.');
@endphp

<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('من نحن') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ $heroTitle }}
                    @if($heroSection?->title_line2)
                        <span class="text-[color:var(--color-ink-muted)]">{{ $heroSection->title_line2 }}</span>
                    @endif
                </x-ui.split-heading>
                <p class="type-body-lg mt-8 max-w-2xl" data-reveal data-reveal-stagger="200">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div data-reveal>
                    <x-ui.eyebrow number="02">{{ __('قصتنا') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('نصمم بعين، ونبني بعقل.') }}</h2>
                    <div class="type-body mt-6 space-y-4">
                        <p>{{ __('بدأت إشراق من شغف بالتقنية وتحويل الأفكار إلى منتجات تعمل بكفاءة وتعيش طويلًا.') }}</p>
                        <p>{{ __('اليوم، نعمل كفريق صغير عالي الحرفة، نؤمن بأن الجودة لا تأتي من السرعة فقط، بل من وضوح الرؤية.') }}</p>
                        <p>{{ __('نقيس نجاحنا بما يتحقق لعملائنا من نتائج، لا بما نعرضه من وعود.') }}</p>
                    </div>
                </div>
                <div class="surface-card p-10" data-reveal data-reveal-stagger="150">
                    <div class="type-eyebrow mb-4">{{ __('منهج العمل') }}</div>
                    <div class="type-h2 mb-6">{{ __('حرفة رقمية دقيقة.') }}</div>
                    <p class="type-body">{{ __('نوازن بين التصميم والهندسة، ونبني حلولًا قابلة للنمو ومهيأة للتوسع منذ اليوم الأول.') }}</p>
                </div>
            </div>
        </div>
    </section>

    @if($stats && $stats->count())
        <section class="section-pad" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="max-w-3xl mb-16" data-reveal>
                    <x-ui.eyebrow number="03">{{ __('بالأرقام') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('مؤشرات تدل على الأثر.') }}</h2>
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
            <div class="max-w-3xl mb-16" data-reveal>
                <x-ui.eyebrow number="04">{{ __('قيمنا') }}</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">{{ __('ما يميز تعاوننا.') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach(($features ?? collect())->take(4) as $feature)
                    <div class="surface-card p-8" data-reveal>
                        <div class="type-eyebrow mb-4">{{ $feature->title }}</div>
                        <p class="type-body">{{ $feature->description }}</p>
                    </div>
                @endforeach
                @if(($features ?? collect())->isEmpty())
                    <div class="surface-card p-8" data-reveal>
                        <div class="type-eyebrow mb-4">{{ __('الدقة') }}</div>
                        <p class="type-body">{{ __('نراجع كل تفصيلة حتى تصل النتيجة إلى المستوى الذي نرضى عنه.') }}</p>
                    </div>
                    <div class="surface-card p-8" data-reveal data-reveal-stagger="120">
                        <div class="type-eyebrow mb-4">{{ __('الشفافية') }}</div>
                        <p class="type-body">{{ __('نشاركك السياق والقرارات أولًا بأول.') }}</p>
                    </div>
                    <div class="surface-card p-8" data-reveal data-reveal-stagger="240">
                        <div class="type-eyebrow mb-4">{{ __('التحسين') }}</div>
                        <p class="type-body">{{ __('نقيس ونحسن بناءً على بيانات حقيقية.') }}</p>
                    </div>
                    <div class="surface-card p-8" data-reveal data-reveal-stagger="360">
                        <div class="type-eyebrow mb-4">{{ __('الالتزام') }}</div>
                        <p class="type-body">{{ __('نحترم الوقت ونلتزم بالمسار.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="05">{{ __('ابدأ') }}</x-ui.eyebrow>
                <h2 class="type-display mt-6">{{ __('فلنصنع منتجًا يستحق البقاء.') }}</h2>
                <p class="type-body-lg mt-8 max-w-xl">{{ __('احكِ لنا عن مشروعك، وسنعود إليك بخطة واضحة خلال يوم عمل واحد.') }}</p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <x-ui.button variant="primary" :href="route('request-design.create')" icon="arrow" wire:navigate>{{ __('ابدأ مشروعك') }}</x-ui.button>
                    <x-ui.button variant="ghost" :href="route('contact')" wire:navigate>{{ __('تواصل معنا') }}</x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
