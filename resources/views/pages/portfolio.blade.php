@php
    $heroTitle = $heroSection?->title_line1 ?? __('الأعمال');
    $heroSubtitle = $heroSection?->subtitle ?? __('مشاريع مختارة تعكس أسلوبنا ومنهجنا في البناء.');
@endphp

<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
                <div class="max-w-3xl" data-reveal>
                    <x-ui.eyebrow number="01">{{ __('الأعمال') }}</x-ui.eyebrow>
                    <x-ui.split-heading as="h1" class="type-display mt-6">
                        {{ $heroTitle }}
                        @if($heroSection?->title_line2)
                            <span class="text-[color:var(--color-ink-muted)]">{{ $heroSection->title_line2 }}</span>
                        @endif
                    </x-ui.split-heading>
                    <p class="type-body-lg mt-6" data-reveal data-reveal-stagger="200">{{ $heroSubtitle }}</p>
                </div>
                @if($stats && $stats->count())
                    <div class="flex gap-8" data-reveal data-reveal-stagger="300">
                        @foreach($stats->take(2) as $stat)
                            <div>
                                <div class="type-numeral text-4xl text-[color:var(--color-ink)]" dir="ltr">{{ $stat->number }}</div>
                                <div class="type-small text-[color:var(--color-ink-subtle)]">{{ $stat->label }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if(isset($projectTypes) && $projectTypes->count())
        <section class="py-6 sticky top-20 z-40" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('portfolio') }}" class="chip {{ !$selectedType ? 'is-active' : '' }}" wire:navigate>{{ __('الكل') }}</a>
                    @foreach($projectTypes as $type)
                        <a href="{{ route('portfolio', ['type' => $type->slug]) }}"
                           class="chip {{ $selectedType === $type->slug ? 'is-active' : '' }}"
                           wire:navigate>
                            {{ $type->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            @if(isset($projects) && count($projects) > 0)
                <div class="masonry">
                    @foreach($projects as $project)
                        <div class="masonry-item">
                            <a href="{{ route('projects.show', $project) }}" class="work-card" wire:navigate>
                                <div class="work-card__media">
                                    @if($project->main_image)
                                        <img src="{{ Storage::url($project->main_image) }}" alt="{{ $project->title }}" loading="lazy" />
                                    @else
                                        <div class="work-card__media-fallback">{{ $project->title }}</div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="type-eyebrow mb-3">
                                        {{ $project->types?->first()?->name ?? __('مشروع') }}
                                    </div>
                                    <h3 class="type-h3 mb-3">{{ $project->title }}</h3>
                                    @if($project->short_description)
                                        <p class="type-body line-clamp-2">{{ $project->short_description }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            @else
                <div class="surface-card p-12 text-center">
                    <h3 class="type-h3 mb-3">{{ __('لا توجد مشاريع حالياً') }}</h3>
                    <p class="type-body">{{ __('لم نعثر على مشاريع تطابق هذا التصنيف.') }}</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface-inset);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="02">{{ __('مشروعك التالي') }}</x-ui.eyebrow>
                <h2 class="type-h1 mt-6">{{ __('هل لديك فكرة تريد إطلاقها؟') }}</h2>
                <p class="type-body-lg mt-6">{{ __('نساعدك في تحويلها إلى منتج رقمي واضح الملامح.') }}</p>
                <div class="mt-10">
                    <x-ui.button variant="primary" :href="route('request-design.create')" icon="arrow" wire:navigate>{{ __('ابدأ مشروعك') }}</x-ui.button>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
