<x-layouts.app :seo="$project">
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-4xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('مشروع') }}</x-ui.eyebrow>
                <h1 class="type-display mt-6">{{ $project->title }}</h1>
                @if($project->short_description)
                    <p class="type-body-lg mt-6">{{ $project->short_description }}</p>
                @endif
                @if($project->types && $project->types->count())
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($project->types as $type)
                            <a href="{{ route('portfolio', ['type' => $type->slug]) }}" class="chip" wire:navigate>
                                {{ $type->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="mt-6 type-small text-[color:var(--color-ink-subtle)]">
                    <span dir="ltr">{{ $project->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>
    </section>

    @if($project->main_image)
        <section class="section-pad" style="background: var(--color-canvas);">
            <div class="container-page">
                <div class="surface-card overflow-hidden">
                    <img src="{{ Storage::url($project->main_image) }}" alt="{{ $project->title }}" />
                </div>
            </div>
        </section>
    @endif

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8 space-y-10 min-w-0">
                    <div class="surface-card p-8">
                        <h2 class="type-h2 mb-6">{{ __('تفاصيل المشروع') }}</h2>
                        <div class="prose-article">
                            {!! $project->description !!}
                        </div>
                    </div>

                    @if($project->projectImages && $project->projectImages->count())
                        <div class="surface-card p-8">
                            <h2 class="type-h2 mb-6">{{ __('معرض الصور') }}</h2>
                            <div class="embla" data-embla-root>
                                <div class="embla__viewport" data-embla-viewport>
                                    <div class="embla__container">
                                        @foreach($project->projectImages as $image)
                                            @if($image->image_path)
                                                <div class="embla__slide">
                                                    <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->caption ?? $project->title }}" class="w-full rounded-2xl" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="embla__controls">
                                    <div class="embla__dots" data-embla-dots></div>
                                    <div class="flex items-center gap-3">
                                        <button type="button" class="embla__arrow" data-embla-prev aria-label="{{ __('السابق') }}">
                                            <svg width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                                <path d="M1.5 5H15M10 .5l5 4.5-5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="embla__arrow" data-embla-next aria-label="{{ __('التالي') }}">
                                            <svg width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($project->video_url)
                        <div class="surface-card p-8">
                            <h2 class="type-h2 mb-6">{{ __('فيديو المشروع') }}</h2>
                            <div class="aspect-video">
                                <video controls class="w-full h-full rounded-2xl">
                                    <source src="{{ Storage::url($project->video_url) }}" type="video/mp4">
                                    {{ __('متصفحك لا يدعم تشغيل الفيديو.') }}
                                </video>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-4 min-w-0">
                    <div class="sticky top-24 space-y-6">
                        @if($project->is_available_for_purchase && $companySettings && $companySettings->whatsapp_number)
                            <div class="surface-card p-6">
                                <div class="type-eyebrow mb-4">{{ __('متاح للشراء') }}</div>
                                @if($project->price)
                                    <div class="type-numeral text-3xl mb-4 text-[color:var(--color-ink)]" dir="ltr">
                                        {{ number_format($project->price, 2) }} {{ __('ر.س') }}
                                    </div>
                                @endif
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}?text={{ urlencode('مرحباً، أنا مهتم بشراء المشروع: ' . $project->title . "\n" . 'رابط المشروع: ' . request()->url()) }}"
                                   target="_blank"
                                   class="btn btn--primary w-full justify-center">
                                    <span>{{ __('اشتري عبر واتساب') }}</span>
                                </a>
                            </div>
                        @endif

                        <div class="surface-card p-6">
                            <div class="type-eyebrow mb-4">{{ __('مشروع مشابه') }}</div>
                            <p class="type-body mb-6">{{ __('يمكننا مساعدتك في تنفيذ فكرة مشابهة بمواصفاتك.') }}</p>
                            <div class="space-y-3">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}?text={{ urlencode('مرحباً، أنا مهتم بطلب تصميم مشابه لمشروع: ' . $project->title) }}"
                                   class="btn btn--primary w-full justify-center">
                                    <span>{{ __('اطلب تصميم مشابه') }}</span>
                                </a>
                                <a href="{{ route('portfolio') }}" class="btn btn--ghost w-full justify-center" wire:navigate>
                                    <span>{{ __('عودة للمعرض') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="surface-card p-6">
                            <div class="type-eyebrow mb-4">{{ __('شارك المشروع') }}</div>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="chip">{{ __('فيسبوك') }}</a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank" class="chip">{{ __('تويتر') }}</a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" target="_blank" class="chip">{{ __('لينكدإن') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
