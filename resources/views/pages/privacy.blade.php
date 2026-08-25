<x-layouts.app>
    {{-- ================================================================
         1. HERO — Editorial Typography
         ================================================================ --}}
    <section class="section-pad relative overflow-hidden" style="background: var(--color-canvas);">
        <div class="hero-blob hero-blob--1" aria-hidden="true"></div>

        <div class="container-page relative z-10">
            <div class="max-w-4xl" data-reveal>
                <div class="flex items-center gap-3 mb-6">
                    <x-ui.eyebrow number="01">{{ __('السياسات القانونية') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <span class="type-eyebrow text-[color:var(--color-accent)]">{{ __('سياسة الخصوصية') }}</span>
                </div>

                <h1 class="type-display mt-6 leading-tight">
                    <span>{{ __('خصوصيتك وأمان بياناتك') }}</span>
                    <span class="block text-[color:var(--color-accent)] italic font-serif">{{ __('في صلب أولوياتنا.') }}</span>
                </h1>

                <p class="type-small mt-6 text-[color:var(--color-ink-subtle)] font-mono">
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

