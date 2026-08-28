<x-layouts.app>
    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-20 pb-12 md:pt-24 md:pb-16">

                <h1 class="type-display leading-[1.1]" data-reveal>
                    <span class="block">{{ __('الشروط والأحكام') }}</span>
                    <span class="block text-gradient mt-2">{{ __('وضوح وثقة في كل تعامل.') }}</span>
                </h1>

                <p class="type-small mt-8 text-[color:var(--color-ink-subtle)] font-mono" data-reveal data-reveal-stagger="200">
                    {{ __('آخر تحديث وتدقيق:') }} {{ date('Y/m/d') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. TERMS PROSE CONTENT
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto" data-reveal>
                <div class="surface-card p-8 md:p-14 rounded-3xl border border-[color:var(--color-line-strong)] shadow-2xl">
                    @if($companySettings?->terms_conditions)
                        <div class="prose-article text-lg leading-relaxed">
                            {!! $companySettings->terms_conditions !!}
                        </div>
                    @else
                        <div class="prose-article text-lg leading-relaxed space-y-6">
                            <h2 class="type-h2 text-2xl font-bold mb-4">{{ __('مقدمة والقبول') }}</h2>
                            <p>{{ __('باستخدامك لموقع وخدمات إشراق، فإنك تقر وتوافق على الالتزام الكامل بهذه الشروط والأحكام. تحكم هذه الاتفاقية العلاقة المهنية وحقوق الملكية والالتزامات التعاقدية.') }}</p>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('نطاق الخدمات والتعاقد') }}</h3>
                            <p>{{ __('نقدم خدمات تصميم وتطوير المواقع والتطبيقات والحلول البرمجية وفق نطاق العمل (Scope of Work) والمواصفات الفنية المعتمدة في عرض السعر الرسمي.') }}</p>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('آلية الدفع ومراحل الاستحقاق المالي') }}</h3>
                            <ul class="list-disc pr-6 space-y-2 text-[color:var(--color-ink-muted)]">
                                <li>{{ __('الدفعة الأولى (30%): دفعة مقدمة غير مستردة لتأكيد الحجز وبدء مرحلة التخطيط والتصميم.') }}</li>
                                <li>{{ __('الدفعة الثانية (50%): عند اكتمال مرحلة التصميم وبدء التطوير البرمجي الفعلي.') }}</li>
                                <li>{{ __('الدفعة النهائية (20%): عند التسليم النهائي للمشروع ورفعه على الخوادم الإنتاجية.') }}</li>
                            </ul>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('حقوق الملكية الفكرية') }}</h3>
                            <p>{{ __('تنتقل الملكية الفكرية الكاملة للكود والتصميم المخصص للعميل فور سداد كافة المستحقات المالية المتفق عليها، مع احتفاظ إشراق بحق عرض العمل في معرض أعمالها التسويقي.') }}</p>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('التواصل والاستفسارات') }}</h3>
                            <p>
                                {{ __('لأي استفسارات قانونية أو توضيحات تعاقدية، يرجى التواصل معنا عبر صفحة') }}
                                <a href="{{ route('contact') }}" class="text-[color:var(--color-accent)] underline hover:text-[color:var(--color-accent-hover)]" wire:navigate>{{ __('اتصل بنا') }}</a>.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

