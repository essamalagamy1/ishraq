<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('الوظائف') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ __('انضم إلى فريقنا') }}
                </x-ui.split-heading>
                <p class="type-body-lg mt-6">{{ __('نبحث عن مواهب تصنع فرقًا حقيقيًا في جودة المنتج.') }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">
                @if(session('success'))
                    <div class="surface-card p-6 mb-8">
                        <p class="type-body text-[color:var(--color-ink)]">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="surface-card p-8">
                    <h2 class="type-h2 mb-6">{{ __('قدّم طلبك الآن') }}</h2>
                    <form action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="form-label">{{ __('الاسم الكامل') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input @error('name') border-red-500 @enderror" required>
                                @error('name')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input @error('email') border-red-500 @enderror" required>
                                @error('email')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="form-label">{{ __('رقم الهاتف') }}</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-input @error('phone') border-red-500 @enderror" required>
                                @error('phone')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="years_of_experience" class="form-label">{{ __('سنوات الخبرة') }}</label>
                                <input type="number" id="years_of_experience" name="years_of_experience" value="{{ old('years_of_experience') }}" min="0" max="50" class="form-input @error('years_of_experience') border-red-500 @enderror" required>
                                @error('years_of_experience')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="specialization" class="form-label">{{ __('التخصص') }}</label>
                            <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}" class="form-input @error('specialization') border-red-500 @enderror" required>
                            @error('specialization')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="cv" class="form-label">{{ __('السيرة الذاتية') }}</label>
                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="form-input @error('cv') border-red-500 @enderror" required>
                            <p class="form-help mt-2">{{ __('الصيغ المقبولة: PDF, DOC, DOCX (الحد الأقصى: 20 ميجابايت)') }}</p>
                            @error('cv')<p class="form-help text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn btn--primary w-full justify-center">
                            <span>{{ __('إرسال الطلب') }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="mt-12 grid md:grid-cols-3 gap-6">
                    <div class="surface-card p-6 text-center">
                        <div class="type-eyebrow mb-3">{{ __('فريق متميز') }}</div>
                        <p class="type-body">{{ __('انضم لفريق من المحترفين المبدعين.') }}</p>
                    </div>
                    <div class="surface-card p-6 text-center">
                        <div class="type-eyebrow mb-3">{{ __('مشاريع مبتكرة') }}</div>
                        <p class="type-body">{{ __('اعمل على منتجات رقمية متطورة.') }}</p>
                    </div>
                    <div class="surface-card p-6 text-center">
                        <div class="type-eyebrow mb-3">{{ __('تطوير مستمر') }}</div>
                        <p class="type-body">{{ __('فرص للنمو والتعلم المستمر.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
