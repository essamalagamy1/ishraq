@php
    $heroTitle = $heroSection?->title_line1 ?? __('تواصل معنا');
    $heroTitle2 = $heroSection?->title_line2 ?? __('ودعنا نبدأ الحديث.');
    $heroSubtitle = $heroSection?->subtitle ?? __('يسعدنا الاستماع لتفاصيل مشروعك؛ نراجع كل طلب بعناية ونعود إليك بخطة واضحة خلال يوم عمل واحد.');
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
                    <x-ui.eyebrow number="01">{{ __('التواصل المباشر') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <span class="type-eyebrow text-[color:var(--color-accent)]">{{ __('ابدأ محادثتك') }}</span>
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
         2. CONTACT FORM & CHANNELS — Split Grid
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                {{-- Left Channels Column --}}
                <div class="lg:col-span-5 space-y-8" data-reveal>
                    <div>
                        <x-ui.eyebrow number="02">{{ __('قنوات الاتصال') }}</x-ui.eyebrow>
                        <h2 class="type-h1 mt-6">{{ __('نحن هنا لمساعدتك.') }}</h2>
                        <p class="type-body mt-4 text-[color:var(--color-ink-muted)]">
                            {{ __('اختر القناة الأنسب لك، أو املأ النموذج وسيتولى فريقنا متابعة طلبك فورًا.') }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        @if($companySettings && $companySettings->main_email)
                            <a href="mailto:{{ $companySettings->main_email }}"
                               class="surface-card p-6 rounded-2xl flex items-center justify-between group hover:border-[color:var(--color-accent-ring)] transition-all duration-300 block">
                                <div>
                                    <div class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-wider mb-1">{{ __('البريد الإلكتروني') }}</div>
                                    <div class="type-body font-medium text-[color:var(--color-ink)] group-hover:text-[color:var(--color-accent)] transition-colors">
                                        {{ $companySettings->main_email }}
                                    </div>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] flex items-center justify-center text-[color:var(--color-ink-muted)] group-hover:bg-[color:var(--color-accent)] group-hover:text-black transition-all">
                                    ↗
                                </div>
                            </a>
                        @endif

                        @if($companySettings && $companySettings->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}"
                               target="_blank"
                               class="surface-card p-6 rounded-2xl flex items-center justify-between group hover:border-[color:var(--color-accent-ring)] transition-all duration-300 block">
                                <div>
                                    <div class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-wider mb-1">{{ __('محادثة واتساب سريعة') }}</div>
                                    <div class="type-body font-medium text-[color:var(--color-ink)] group-hover:text-[color:var(--color-accent)] transition-colors" dir="ltr">
                                        {{ $companySettings->whatsapp_number }}
                                    </div>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] flex items-center justify-center text-[color:var(--color-ink-muted)] group-hover:bg-[color:var(--color-accent)] group-hover:text-black transition-all">
                                    ↗
                                </div>
                            </a>
                        @endif

                        @if($companySettings && $companySettings->location_text)
                            <div class="surface-card p-6 rounded-2xl">
                                <div class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-wider mb-1">{{ __('المقر والموقع') }}</div>
                                <div class="type-body font-medium text-[color:var(--color-ink)]">{{ $companySettings->location_text }}</div>
                            </div>
                        @endif
                    </div>

                    @if($socialLinks && $socialLinks->count())
                        <div class="pt-6 border-t border-[color:var(--color-line)]">
                            <div class="font-mono text-xs text-[color:var(--color-ink-subtle)] uppercase tracking-widest mb-4">{{ __('منصات التواصل') }}</div>
                            <div class="flex items-center gap-3">
                                @foreach($socialLinks as $link)
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                       class="w-11 h-11 inline-flex items-center justify-center rounded-full border border-[color:var(--color-line-strong)] text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-ink)] hover:border-[color:var(--color-accent)] hover:bg-[color:var(--color-accent-soft)] transition-all duration-300"
                                       aria-label="{{ $link->platform }}">
                                        <x-ui.social-icon :platform="$link->platform" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Form Column --}}
                <div class="lg:col-span-7" data-reveal data-reveal-stagger="120">
                    @if(session('success'))
                        <div class="surface-card p-6 mb-8 rounded-2xl border border-[color:var(--color-accent)] bg-[color:var(--color-accent-soft)]">
                            <div class="type-body text-[color:var(--color-ink)] font-medium text-center">
                                ✦ {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST"
                          class="surface-card p-8 md:p-12 rounded-3xl border border-[color:var(--color-line-strong)] shadow-2xl relative">
                        @csrf
                        <h3 class="type-h2 mb-2 leading-snug">{{ __('أرسل رسالتك') }}</h3>
                        <p class="type-small text-[color:var(--color-ink-muted)] mb-8">{{ __('املأ الحقول التالية وسنتواصل معك خلال 24 ساعة.') }}</p>

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="form-label font-medium text-xs tracking-wider uppercase font-mono">{{ __('الاسم الكامل *') }}</label>
                                    <input type="text" name="name" id="name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                                </div>
                                <div>
                                    <label for="email" class="form-label font-medium text-xs tracking-wider uppercase font-mono">{{ __('البريد الإلكتروني *') }}</label>
                                    <input type="email" name="email" id="email" required class="form-input" placeholder="example@email.com">
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="form-label font-medium text-xs tracking-wider uppercase font-mono">{{ __('رقم الجوال (اختياري)') }}</label>
                                <input type="tel" name="phone" id="phone" class="form-input" placeholder="+966 5X XXX XXXX" dir="ltr">
                            </div>

                            <div>
                                <label for="message" class="form-label font-medium text-xs tracking-wider uppercase font-mono">{{ __('الرسالة أو متطلبات المشروع *') }}</label>
                                <textarea name="message" id="message" rows="5" required class="form-textarea" placeholder="{{ __('اكتب تفاصيل استفسارك أو فكرة مشروعك هنا...') }}"></textarea>
                            </div>

                            <button type="submit" class="btn btn--primary w-full justify-center py-4 text-sm font-medium">
                                <span>{{ __('إرسال الرسالة الآن') }}</span>
                                <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

