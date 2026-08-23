<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('طلب تصميم') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ __('ابدأ مشروعك') }}
                </x-ui.split-heading>
                <p class="type-body-lg mt-6">{{ __('أخبرنا بتفاصيلك وسنعود إليك خلال 24 ساعة.') }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">
                @if(session('success'))
                    <div class="surface-card p-6 mb-8 text-center">
                        <p class="type-body text-[color:var(--color-ink)]">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('request-design.store') }}" method="POST" enctype="multipart/form-data" class="surface-card p-8 space-y-8">
                    @csrf

                    <div>
                        <h2 class="type-h2 mb-6">{{ __('معلومات المشروع') }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">{{ __('الاسم الكامل') }}</label>
                                <input type="text" name="full_name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                            </div>
                            <div>
                                <label class="form-label">{{ __('البريد الإلكتروني') }}</label>
                                <input type="email" name="email" required class="form-input" placeholder="example@email.com">
                            </div>
                            <div>
                                <label class="form-label">{{ __('رقم الجوال') }}</label>
                                <input type="tel" name="phone" required class="form-input" placeholder="+966 XX XXX XXXX">
                            </div>
                            <div>
                                <label class="form-label">{{ __('اسم الشركة (اختياري)') }}</label>
                                <input type="text" name="company_name" class="form-input" placeholder="{{ __('اسم شركتك') }}">
                            </div>
                        </div>
                    </div>

                    <div class="surface-card--raised p-6">
                        <h3 class="type-h3 mb-4">{{ __('تفاصيل المشروع') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="form-label">{{ __('نوع المشروع') }}</label>
                                <select name="project_type" required class="form-select">
                                    <option value="">{{ __('اختر نوع المشروع') }}</option>
                                    <option value="موقع ويب">{{ __('موقع ويب') }}</option>
                                    <option value="تطبيق جوال">{{ __('تطبيق جوال') }}</option>
                                    <option value="متجر إلكتروني">{{ __('متجر إلكتروني') }}</option>
                                    <option value="نظام إدارة">{{ __('نظام إدارة مخصص') }}</option>
                                    <option value="تصميم UI/UX">{{ __('تصميم UI/UX') }}</option>
                                    <option value="أخرى">{{ __('أخرى') }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">{{ __('الميزانية المتوقعة') }}</label>
                                <input type="text" name="budget_range" class="form-input" placeholder="{{ __('مثال: 500 - 1000 ريال') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label">{{ __('الموعد النهائي') }}</label>
                                <input type="text" name="deadline" class="form-input" placeholder="{{ __('مثال: خلال أسبوع') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">{{ __('تفاصيل المشروع') }}</label>
                        <textarea name="details" rows="6" required class="form-textarea" placeholder="{{ __('اكتب وصفًا تفصيليًا عن المشروع...') }}"></textarea>
                    </div>

                    <div>
                        <label class="form-label">{{ __('مرفقات (اختياري)') }}</label>
                        <input type="file" name="attachment" class="form-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
                        <p class="form-help mt-2">{{ __('PDF أو Word أو صور') }}</p>
                    </div>

                    <button type="submit" class="btn btn--primary w-full justify-center">
                        <span>{{ __('إرسال الطلب') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <p class="type-small text-center text-[color:var(--color-ink-subtle)]">
                        {{ __('بالضغط على إرسال فإنك توافق على') }}
                        <a href="{{ route('terms') }}" class="underline" wire:navigate>{{ __('الشروط والأحكام') }}</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>
