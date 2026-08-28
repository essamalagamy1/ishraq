<x-layouts.app>
    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-20 pb-12 md:pt-24 md:pb-16">

                <h1 class="type-display leading-[1.1]" data-reveal>
                    <span class="block">{{ __('ابدأ مشروعك معنا') }}</span>
                    <span class="block text-gradient mt-2">{{ __('وحوّل فكرتك إلى واقع مُبهر.') }}</span>
                </h1>

                <p class="type-body-lg mt-10 max-w-2xl leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ __('املأ تفاصيل مشروعك وسنقوم بدراسة المتطلبات وتقديم مقترح زمني ومالي مدروس خلال 24 ساعة عمل.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. BRIEFING FORM
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto" data-reveal>
                @if(session('success'))
                    <div class="surface-card p-8 mb-10 rounded-3xl border border-[color:var(--color-accent)] bg-[color:var(--color-accent-soft)] text-center">
                        <div class="w-12 h-12 rounded-full bg-[color:var(--color-accent)] text-black flex items-center justify-center mx-auto mb-4 font-bold text-lg">
                            ✓
                        </div>
                        <h3 class="type-h3 mb-2 text-[color:var(--color-ink)]">{{ __('تم استلام طلبك بنجاح!') }}</h3>
                        <p class="type-body text-[color:var(--color-ink-muted)]">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('request-design.store') }}" method="POST" enctype="multipart/form-data"
                      class="surface-card p-8 md:p-14 rounded-3xl border border-[color:var(--color-line-strong)] space-y-10 shadow-2xl">
                    @csrf

                    {{-- SECTION 1: Personal & Organization Info --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-[color:var(--color-line)]">
                            <span class="font-mono text-xs font-semibold text-[color:var(--color-accent)]" dir="ltr">01</span>
                            <h2 class="type-h3 text-xl">{{ __('معلومات الاتصال والجهة') }}</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الاسم الكامل *') }}</label>
                                <input type="text" name="full_name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                            </div>
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('البريد الإلكتروني *') }}</label>
                                <input type="email" name="email" required class="form-input" placeholder="example@domain.com">
                            </div>
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('رقم الجوال *') }}</label>
                                <input type="tel" name="phone" required class="form-input" placeholder="+966 5X XXX XXXX" dir="ltr">
                            </div>
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('اسم الشركة أو الجهة (اختياري)') }}</label>
                                <input type="text" name="company_name" class="form-input" placeholder="{{ __('اسم الشركة أو النشاط') }}">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: Project Classification & Scope --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-[color:var(--color-line)]">
                            <span class="font-mono text-xs font-semibold text-[color:var(--color-accent)]" dir="ltr">02</span>
                            <h2 class="type-h3 text-xl">{{ __('نوع المشروع والميزانية والجدول') }}</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('نوع المشروع *') }}</label>
                                <select name="project_type" required class="form-select">
                                    <option value="">{{ __('اختر نوع المشروع المطلوب') }}</option>
                                    <option value="موقع ويب">{{ __('موقع ويب متكامل (Corporate / Web App)') }}</option>
                                    <option value="تطبيق جوال">{{ __('تطبيق جوال (iOS & Android)') }}</option>
                                    <option value="متجر إلكتروني">{{ __('متجر إلكتروني متقدم') }}</option>
                                    <option value="تصميم UI/UX">{{ __('تصميم واجهات وتجربة مستخدم (UI/UX)') }}</option>
                                    <option value="نظام إدارة">{{ __('نظام إدارة مخصص / SaaS') }}</option>
                                    <option value="أخرى">{{ __('خدمة رقمية مخصصة') }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الميزانية التقديرية') }}</label>
                                <input type="text" name="budget_range" class="form-input" placeholder="{{ __('مثال: 5,000 - 15,000 ريال') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الموعد النهائي المستهدف للإطلاق') }}</label>
                                <input type="text" name="deadline" class="form-input" placeholder="{{ __('مثال: خلال شهر من بدء العمل') }}">
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: Detailed Description --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-[color:var(--color-line)]">
                            <span class="font-mono text-xs font-semibold text-[color:var(--color-accent)]" dir="ltr">03</span>
                            <h2 class="type-h3 text-xl">{{ __('تفاصيل المتطلبات والمرفقات') }}</h2>
                        </div>

                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('وصف المشروع والأهداف المطلوب تحقيقها *') }}</label>
                            <textarea name="details" rows="6" required class="form-textarea"
                                      placeholder="{{ __('اشرح فكرة المشروع، الجمهور المستهدف، الميزات الأساسية، أو أي مراجع تود مشاركتها...') }}"></textarea>
                        </div>

                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('ملف الشروط المرجعية أو المتطلبات (اختياري)') }}</label>
                            <div class="surface-card--raised p-6 rounded-2xl border border-dashed border-[color:var(--color-line-bold)] text-center hover:border-[color:var(--color-accent)] transition-colors">
                                <input type="file" name="attachment" id="attachment" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
                                <label for="attachment" class="cursor-pointer flex flex-col items-center justify-center gap-2">
                                    <div class="w-10 h-10 rounded-full bg-[color:var(--color-surface)] flex items-center justify-center text-[color:var(--color-accent)] font-mono text-lg">
                                        ↑
                                    </div>
                                    <span class="type-small font-medium text-[color:var(--color-ink)]">{{ __('اضغط هنا لرفع ملف أو وثيقة المتطلبات') }}</span>
                                    <span class="type-small text-[color:var(--color-ink-subtle)] text-xs">{{ __('الصيغ المدعومة: PDF, Word, Excel أو صور (بحد أقصى 20 ميجابايت)') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Submit CTA --}}
                    <div class="pt-6 border-t border-[color:var(--color-line)] space-y-4">
                        <button type="submit" class="btn btn--primary w-full justify-center py-4 text-sm font-medium">
                            <span>{{ __('إرسال طلب المشروع الآن') }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <p class="type-small text-center text-[color:var(--color-ink-subtle)] text-xs">
                            {{ __('بإرسال هذا النموذج فإنك توافق على') }}
                            <a href="{{ route('privacy') }}" class="underline hover:text-[color:var(--color-accent)] transition-colors" wire:navigate>{{ __('سياسة الخصوصية') }}</a>
                            {{ __('و') }}
                            <a href="{{ route('terms') }}" class="underline hover:text-[color:var(--color-accent)] transition-colors" wire:navigate>{{ __('الشروط والأحكام') }}</a>.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>

