@php
    $heroTitle = $heroSection?->title_line1 ?? __('تواصل معنا');
    $heroSubtitle = $heroSection?->subtitle ?? __('يسعدنا الاستماع لتفاصيل مشروعك والرد خلال يوم عمل واحد.');
@endphp

<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('التواصل') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ $heroTitle }}
                    @if($heroSection?->title_line2)
                        <span class="text-[color:var(--color-ink-muted)]">{{ $heroSection->title_line2 }}</span>
                    @endif
                </x-ui.split-heading>
                <p class="type-body-lg mt-6" data-reveal data-reveal-stagger="200">{{ $heroSubtitle }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-5" data-reveal>
                    <x-ui.eyebrow number="02">{{ __('معلومات التواصل') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-6">{{ __('دعنا نبدأ الحديث.') }}</h2>
                    <div class="mt-10 space-y-4">
                        @if($companySettings && $companySettings->main_email)
                            <div class="surface-card p-6">
                                <div class="type-eyebrow mb-2">{{ __('البريد الإلكتروني') }}</div>
                                <a href="mailto:{{ $companySettings->main_email }}" class="type-body text-[color:var(--color-ink)]">
                                    {{ $companySettings->main_email }}
                                </a>
                            </div>
                        @endif
                        @if($companySettings && $companySettings->whatsapp_number)
                            <div class="surface-card p-6">
                                <div class="type-eyebrow mb-2">{{ __('واتساب') }}</div>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings->whatsapp_number) }}"
                                   class="type-body text-[color:var(--color-ink)]" dir="ltr">
                                    {{ $companySettings->whatsapp_number }}
                                </a>
                            </div>
                        @endif
                        @if($companySettings && $companySettings->location_text)
                            <div class="surface-card p-6">
                                <div class="type-eyebrow mb-2">{{ __('الموقع') }}</div>
                                <p class="type-body text-[color:var(--color-ink)]">{{ $companySettings->location_text }}</p>
                            </div>
                        @endif
                    </div>

                    @if($socialLinks && $socialLinks->count())
                        <div class="mt-10">
                            <div class="type-eyebrow mb-4">{{ __('تابعنا') }}</div>
                            <div class="flex items-center gap-3">
                                @foreach($socialLinks as $link)
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                       class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[color:var(--color-line-strong)] text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-ink)] hover:border-[color:var(--color-accent)] transition-colors duration-300"
                                       aria-label="{{ $link->platform }}">
                                        <x-ui.social-icon :platform="$link->platform" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-7" data-reveal data-reveal-stagger="120">
                    @if(session('success'))
                        <div class="surface-card p-6 mb-8">
                            <div class="type-body text-[color:var(--color-ink)]">{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="surface-card p-8">
                        @csrf
                        <h3 class="type-h2 mb-6">{{ __('أرسل رسالتك') }}</h3>
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="form-label">{{ __('الاسم الكامل') }}</label>
                                    <input type="text" name="name" id="name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                                </div>
                                <div>
                                    <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                                    <input type="email" name="email" id="email" required class="form-input" placeholder="example@email.com">
                                </div>
                            </div>
                            <div>
                                <label for="phone" class="form-label">{{ __('رقم الجوال (اختياري)') }}</label>
                                <input type="tel" name="phone" id="phone" class="form-input" placeholder="+966 XX XXX XXXX">
                            </div>
                            <div>
                                <label for="message" class="form-label">{{ __('الرسالة') }}</label>
                                <textarea name="message" id="message" rows="5" required class="form-textarea" placeholder="{{ __('اكتب رسالتك هنا...') }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn--primary w-full justify-center">
                                <span>{{ __('إرسال الرسالة') }}</span>
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
