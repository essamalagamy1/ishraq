<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('الشروط والأحكام') }}</x-ui.eyebrow>
                <h1 class="type-display mt-6">{{ __('شروط التعامل') }}</h1>
                <p class="type-small mt-4 text-[color:var(--color-ink-subtle)]">{{ __('آخر تحديث:') }} {{ date('Y/m/d') }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl">
                @if($companySettings?->terms_conditions)
                    <div class="prose-article">
                        {!! $companySettings->terms_conditions !!}
                    </div>
                @else
                    <div class="surface-card p-8">
                        <div class="prose-article">
                            <h2>{{ __('مقدمة') }}</h2>
                            <p>{{ __('باستخدامك لخدماتنا فأنت توافق على الالتزام بهذه الشروط والأحكام.') }}</p>
                            <h3>{{ __('الخدمات') }}</h3>
                            <p>{{ __('نقدم خدمات تطوير ويب وتطبيقات وحلول رقمية وفق المواصفات المتفق عليها.') }}</p>
                            <h3>{{ __('الدفع') }}</h3>
                            <ul>
                                <li>{{ __('30% مقدماً قبل بدء العمل') }}</li>
                                <li>{{ __('50% أثناء العمل وقبل التسليم') }}</li>
                                <li>{{ __('20% عند التسليم النهائي') }}</li>
                            </ul>
                            <h3>{{ __('التواصل') }}</h3>
                            <p>
                                {{ __('للاستفسارات أو الشكاوى، يرجى التواصل عبر صفحة') }}
                                <a href="{{ route('contact') }}" wire:navigate>{{ __('اتصل بنا') }}</a>.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layouts.app>
