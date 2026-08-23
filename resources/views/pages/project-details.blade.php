@php
    $galleryList = [];
    if ($project->main_image) {
        $galleryList[] = [
            'url' => Storage::url($project->main_image),
            'caption' => $project->title . ' — الصورة الرئيسية',
        ];
    }
    if ($project->projectImages && $project->projectImages->count()) {
        foreach ($project->projectImages as $img) {
            if ($img->image_path) {
                $galleryList[] = [
                    'url' => Storage::url($img->image_path),
                    'caption' => $img->caption ?? $project->title,
                ];
            }
        }
    }
@endphp

<x-layouts.app :seo="$project">
    {{-- Header Section --}}
    <section class="pt-28 lg:pt-36 pb-8" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-4xl" data-reveal>
                <div class="flex items-center gap-3 mb-4">
                    <x-ui.eyebrow number="01">{{ __('تفاصيل العمل') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)]"></span>
                </div>

                <h1 class="mt-4 text-3xl lg:text-5xl font-bold leading-tight">{{ $project->title }}</h1>

                @if($project->short_description)
                    <p class="type-body-lg mt-6 text-[color:var(--color-ink-muted)] text-lg lg:text-xl leading-relaxed max-w-3xl">
                        {{ $project->short_description }}
                    </p>
                @endif

                @if($project->types && $project->types->count())
                    <div class="mt-6 flex flex-wrap gap-2.5">
                        @foreach($project->types as $type)
                            <a href="{{ route('portfolio', ['type' => $type->slug]) }}"
                               class="px-4 py-1.5 rounded-full text-sm font-medium bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line-strong)] text-[color:var(--color-ink)] hover:border-[color:var(--color-accent)] transition-all"
                               wire:navigate>
                                {{ $type->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Interactive Main Gallery Showcase --}}
    @if(count($galleryList) > 0)
        <section class="py-8" style="background: var(--color-canvas);">
            <div class="container-page">
                <div data-gallery data-gallery-images="{{ json_encode($galleryList) }}" class="space-y-6" data-reveal>
                    {{-- Main View Container --}}
                    <div class="gallery-main-container group relative">
                        {{-- Controls Header Bar --}}
                        <div class="absolute top-4 inset-x-4 z-20 flex items-center justify-between pointer-events-none">
                            <span data-gallery-counter dir="ltr"
                                  class="pointer-events-auto px-4 py-1.5 rounded-full bg-black/65 backdrop-blur-md border border-white/15 text-white font-mono text-xs font-semibold">
                                01 / {{ str_pad(count($galleryList), 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <button type="button" data-gallery-fullscreen
                                    class="pointer-events-auto group/btn inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-black/65 backdrop-blur-md border border-white/15 text-white hover:border-[color:var(--color-accent)] transition-all text-xs font-medium">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
                                </svg>
                                <span>{{ __('توسيع الشاشة') }}</span>
                            </button>
                        </div>

                        {{-- Main Display Image --}}
                        <div class="relative w-full overflow-hidden flex items-center justify-center min-h-[350px] lg:min-h-[500px]">
                            <img data-gallery-main
                                 src="{{ $galleryList[0]['url'] }}"
                                 alt="{{ $galleryList[0]['caption'] }}"
                                 class="gallery-main-img" />
                        </div>

                        {{-- Navigation Hover Arrows (Left & Right) --}}
                        @if(count($galleryList) > 1)
                            <button type="button" data-gallery-prev aria-label="{{ __('السابق') }}"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-black/60 backdrop-blur-md border border-white/15 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[color:var(--color-accent)] hover:text-black hover:border-transparent transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 18l-6-6 6-6"/>
                                </svg>
                            </button>

                            <button type="button" data-gallery-next aria-label="{{ __('التالي') }}"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-black/60 backdrop-blur-md border border-white/15 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 hover:bg-[color:var(--color-accent)] hover:text-black hover:border-transparent transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 18l6-6-6-6"/>
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Image Caption & Thumbnail Strip --}}
                    <div class="space-y-4">
                        <p data-gallery-caption class="type-small text-center text-[color:var(--color-ink-muted)] italic">
                            {{ $galleryList[0]['caption'] }}
                        </p>

                        @if(count($galleryList) > 1)
                            <div class="flex items-center gap-3 overflow-x-auto py-2 px-1 scrollbar-none justify-start lg:justify-center">
                                @foreach($galleryList as $idx => $item)
                                    <button type="button" data-gallery-thumb
                                            class="gallery-thumb {{ $idx === 0 ? 'is-active' : '' }}"
                                            aria-label="عرض الصورة {{ $idx + 1 }}">
                                        <img src="{{ $item['url'] }}" alt="{{ $item['caption'] }}" loading="lazy" />
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Main Content Section --}}
    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                {{-- Left Column (Details + Gallery Grid + Video) --}}
                <div class="lg:col-span-8 space-y-10 min-w-0">
                    {{-- Description Card --}}
                    <div class="surface-card p-8 rounded-3xl border border-[color:var(--color-line-strong)]" data-reveal>
                        <h2 class="type-h2 mb-6 pb-4 border-b border-[color:var(--color-line)] flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[color:var(--color-accent)]"></span>
                            <span>{{ __('عن المشروع والمتطلبات') }}</span>
                        </h2>
                        <div class="prose-article text-lg leading-relaxed">
                            {!! $project->description !!}
                        </div>
                    </div>

                    {{-- Expanded Image Grid (If images exist) --}}
                    @if(count($galleryList) > 1)
                        <div class="surface-card p-8 rounded-3xl border border-[color:var(--color-line-strong)]" data-reveal>
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[color:var(--color-line)]">
                                <h2 class="type-h2 flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-[color:var(--color-accent)]"></span>
                                    <span>{{ __('معرض صور العمل') }}</span>
                                </h2>
                                <span class="type-small font-mono text-[color:var(--color-accent)]" dir="ltr">
                                    [{{ count($galleryList) }} {{ __('صور') }}]
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($galleryList as $idx => $item)
                                    <div class="group relative aspect-video rounded-2xl overflow-hidden bg-[color:var(--color-surface-inset)] border border-[color:var(--color-line)] cursor-pointer"
                                         data-gallery-fullscreen>
                                        <img src="{{ $item['url'] }}" alt="{{ $item['caption'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                            <span class="text-xs text-white font-medium line-clamp-1">{{ $item['caption'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Project Video Section --}}
                    @if($project->video_url)
                        <div class="surface-card p-8 rounded-3xl border border-[color:var(--color-line-strong)]" data-reveal>
                            <h2 class="type-h2 mb-6 pb-4 border-b border-[color:var(--color-line)] flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-[color:var(--color-accent)]"></span>
                                <span>{{ __('فيديو العرض التوضيحي') }}</span>
                            </h2>
                            <div class="aspect-video rounded-2xl overflow-hidden border border-[color:var(--color-line)]">
                                <video controls class="w-full h-full object-cover">
                                    <source src="{{ Storage::url($project->video_url) }}" type="video/mp4">
                                    {{ __('متصفحك لا يدعم تشغيل الفيديو.') }}
                                </video>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Sidebar --}}
                <div class="lg:col-span-4 min-w-0">
                    <div class="sticky top-24 space-y-6">
                        @if($project->is_available_for_purchase && $companySettings && $companySettings->whatsapp_number)
                            <div class="surface-card p-6 rounded-3xl border border-[color:var(--color-accent-ring)]" data-reveal>
                                <div class="type-eyebrow mb-2 text-[color:var(--color-accent)]">{{ __('متاح للشراء والمصادرة') }}</div>
                                @if($project->price)
                                    <div class="type-numeral text-3xl font-bold mb-4 text-[color:var(--color-ink)] flex items-center gap-2" dir="ltr">
                                        <span>{{ $project->price }}</span>
                                        <x-ui.currency-symbol class="w-6 h-6 text-[color:var(--color-accent)] inline-block shrink-0" />
                                    </div>
                                @endif
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}?text={{ urlencode('مرحباً، أنا مهتم بشراء المشروع: ' . $project->title . "\n" . 'رابط المشروع: ' . request()->url()) }}"
                                   target="_blank"
                                   class="btn btn--primary w-full justify-center gap-2">
                                    <span>{{ __('اشتري عبر واتساب') }}</span>
                                </a>
                            </div>
                        @endif

                        <div class="surface-card p-6 rounded-3xl border border-[color:var(--color-line-strong)]" data-reveal>
                            <div class="type-eyebrow mb-4">{{ __('طلب مشروع مشابه') }}</div>
                            <p class="type-body text-sm text-[color:var(--color-ink-muted)] mb-6 leading-relaxed">
                                {{ __('ترغب بمنتج رقمي مماثل؟ يمكننا تخصيص الفكرة وبنائها بأحدث التقنيات.') }}
                            </p>
                            <div class="space-y-3">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number ?? '') }}?text={{ urlencode('مرحباً، أنا مهتم بطلب تصميم مشابه لمشروع: ' . $project->title) }}"
                                   target="_blank"
                                   class="btn btn--primary w-full justify-center">
                                    <span>{{ __('اطلب تصميم مشابه') }}</span>
                                </a>
                                <a href="{{ route('portfolio') }}" class="btn btn--ghost w-full justify-center" wire:navigate>
                                    <span>{{ __('عودة لمعرض الأعمال') }}</span>
                                </a>
                            </div>
                        </div>

                        <div class="surface-card p-6 rounded-3xl border border-[color:var(--color-line-strong)]" data-reveal>
                            <div class="type-eyebrow mb-4">{{ __('شارك المشروع') }}</div>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="chip hover:border-[color:var(--color-accent)]">{{ __('فيسبوك') }}</a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank" class="chip hover:border-[color:var(--color-accent)]">{{ __('تويتر') }}</a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" target="_blank" class="chip hover:border-[color:var(--color-accent)]">{{ __('لينكدإن') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Lightbox Fullscreen Modal --}}
    <div data-lightbox-modal class="fixed inset-0 z-[500] hidden items-center justify-center p-4 lg:p-8 bg-black/95 lightbox-backdrop">
        {{-- Close Button --}}
        <button type="button" data-lightbox-close aria-label="{{ __('إغلاق') }}"
                class="absolute top-6 left-6 z-50 w-12 h-12 rounded-full bg-white/10 border border-white/20 text-white flex items-center justify-center hover:bg-[color:var(--color-accent)] hover:text-black hover:border-transparent transition-all">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>

        {{-- Lightbox Image Frame --}}
        <div class="relative max-w-6xl max-h-[85vh] w-full h-full flex flex-col items-center justify-center">
            <img data-lightbox-img src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-2xl transition-all duration-300" />
            <p data-lightbox-caption class="mt-4 text-center text-sm text-gray-300 font-medium"></p>
            <span data-lightbox-counter dir="ltr" class="mt-2 text-xs font-mono text-gray-400"></span>
        </div>

        {{-- Lightbox Navigation Arrows --}}
        <button type="button" data-lightbox-prev aria-label="{{ __('السابق') }}"
                class="absolute left-6 top-1/2 -translate-y-1/2 z-50 w-14 h-14 rounded-full bg-white/10 border border-white/20 text-white flex items-center justify-center hover:bg-[color:var(--color-accent)] hover:text-black hover:border-transparent transition-all">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M15 18l-6-6 6-6"/>
            </svg>
        </button>

        <button type="button" data-lightbox-next aria-label="{{ __('التالي') }}"
                class="absolute right-6 top-1/2 -translate-y-1/2 z-50 w-14 h-14 rounded-full bg-white/10 border border-white/20 text-white flex items-center justify-center hover:bg-[color:var(--color-accent)] hover:text-black hover:border-transparent transition-all">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M9 18l6-6-6-6"/>
            </svg>
        </button>
    </div>
</x-layouts.app>
