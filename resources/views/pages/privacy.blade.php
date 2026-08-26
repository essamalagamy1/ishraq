<x-layouts.app>
    {{-- ================================================================
         1. HERO
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-40 pb-24 md:pt-48 md:pb-32">

                <h1 class="type-display leading-[1.1]" data-reveal>
                    <span class="block">{{ __('خصوصيتك وأمان بياناتك') }}</span>
                    <span class="block text-gradient mt-2">{{ __('في صلب أولوياتنا.') }}</span>
                </h1>

                <p class="type-small mt-8 text-[color:var(--color-ink-subtle)] font-mono" data-reveal data-reveal-stagger="200">
                    {{ __('آخر تحديث وتدقيق:') }} {{ date('Y/m/d') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. LEGAL PROSE CONTENT
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto" data-reveal>
                <div class="surface-card p-8 md:p-14 rounded-3xl border border-[color:var(--color-line-strong)] shadow-2xl">
                    @if($companySettings?->privacy_policy)
                        <div class="prose-article text-lg leading-relaxed">
                            {!! $companySettings->privacy_policy !!}
                        </div>
                    @else
                        <div class="prose-article text-lg leading-relaxed space-y-6">
                            <h2 class="type-h2 text-2xl font-bold mb-4">{{ __('مقدمة والالتزام') }}</h2>
                            <p>{{ __('نحن في إشراق نلتزم بأعلى معايير الشفافية وحماية خصوصية عملائنا وزوارنا. توضح هذه السياسة آلية جمع ومعالجة وحماية البيانات أثناء استخدامك لموقعنا وخدماتنا.') }}</p>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('المعلومات التي نقوم بجمعها') }}</h3>
                            <ul class="list-disc pr-6 space-y-2 text-[color:var(--color-ink-muted)]">
                                <li>{{ __('البيانات الشخصية: مثل الاسم الكامل، البريد الإلكتروني، ورقم الهاتف عند تعبئة نماذج التواصل أو طلب الخدمات.') }}</li>
                                <li>{{ __('بيانات المشروع: المواصفات، الميزانيات التقديرية، والملفات المرفقة لغرض دراسة الطلب وإعداد المقترحات.') }}</li>
                                <li>{{ __('البيانات الفنية: ملفات تعريف الارتباط وسجلات التصفح لتحسين تجربة الاستخدام وسرعة الأداء.') }}</li>
                            </ul>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('كيف نستخدم معلوماتك') }}</h3>
                            <ul class="list-disc pr-6 space-y-2 text-[color:var(--color-ink-muted)]">
                                <li>{{ __('تقديم الاستشارات وعروض الأسعار والبدء في تنفيذ المشاريع المتعاقد عليها.') }}</li>
                                <li>{{ __('التواصل المستمر وإطلاعك على سير العمل ومراحل الإنجاز.') }}</li>
                                <li>{{ __('تطوير مستوى الأمان وحماية الموقع من أي أنشطة غير مصرح بها.') }}</li>
                            </ul>

                            <h3 class="type-h3 text-xl font-semibold mt-8 mb-4">{{ __('الاستفسارات وحقوق الخصوصية') }}</h3>
                            <p>
                                {{ __('إذا كان لديك أي استفسار أو طلب لتعديل بياناتك، يسعدنا تواصلك معنا مباشرة عبر صفحة') }}
                                <a href="{{ route('contact') }}" class="text-[color:var(--color-accent)] underline hover:text-[color:var(--color-accent-hover)]" wire:navigate>{{ __('اتصل بنا') }}</a>.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

