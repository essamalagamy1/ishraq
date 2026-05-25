<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('سياسة الخصوصية') }}</x-ui.eyebrow>
                <h1 class="type-display mt-6">{{ __('خصوصيتك أولاً') }}</h1>
                <p class="type-small mt-4 text-[color:var(--color-ink-subtle)]">{{ __('آخر تحديث:') }} {{ date('Y/m/d') }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl">
                @if($companySettings?->privacy_policy)
                    <div class="prose-article">
                        {!! $companySettings->privacy_policy !!}
                    </div>
                @else
                    <div class="surface-card p-8">
                        <div class="prose-article">
                            <h2>{{ __('مقدمة') }}</h2>
                            <p>{{ __('نحترم خصوصيتك ونلتزم بحماية بياناتك الشخصية. توضح هذه السياسة كيفية جمعنا واستخدامنا وحمايتنا للمعلومات.') }}</p>
                            <h3>{{ __('المعلومات التي نجمعها') }}</h3>
                            <ul>
                                <li>{{ __('الاسم والبريد الإلكتروني ورقم الهاتف') }}</li>
                                <li>{{ __('معلومات المشروع والمتطلبات') }}</li>
                                <li>{{ __('بيانات الاستخدام والتصفح') }}</li>
                            </ul>
                            <h3>{{ __('كيف نستخدم المعلومات') }}</h3>
                            <ul>
                                <li>{{ __('تقديم الخدمات المطلوبة') }}</li>
                                <li>{{ __('التواصل بشأن المشروع') }}</li>
                                <li>{{ __('تحسين جودة الخدمات') }}</li>
                            </ul>
                            <h3>{{ __('التواصل معنا') }}</h3>
                            <p>
                                {{ __('للاستفسارات المتعلقة بالخصوصية، يرجى التواصل معنا عبر صفحة') }}
                                <a href="{{ route('contact') }}" wire:navigate>{{ __('اتصل بنا') }}</a>.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layouts.app>
