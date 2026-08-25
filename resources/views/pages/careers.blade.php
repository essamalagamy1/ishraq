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
                    <x-ui.eyebrow number="01">{{ __('فرص العمل') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <span class="type-eyebrow text-[color:var(--color-accent)]">{{ __('انضم إلى فريق إشراق') }}</span>
                </div>

                <h1 class="type-display mt-6 leading-tight">
                    <span>{{ __('نبني المستقبل معًا') }}</span>
                    <span class="block text-[color:var(--color-accent)] italic font-serif">{{ __('بشغف وإتقان لا يهدأ.') }}</span>
                </h1>

                <p class="type-body-lg mt-8 max-w-2xl text-[color:var(--color-ink-muted)] leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ __('نبحث باستمرار عن عقول مبدعة ومواهب استثنائية تشاركنا الشغف بصناعة منتجات رقمية فارقة ترتقي بالمعايير.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. PERKS & APPLICATION FORM
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-3xl mx-auto space-y-16">
                
                {{-- Perks Strip --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-reveal>
                    <div class="surface-card p-6 rounded-2xl border border-[color:var(--color-line)] group hover:border-[color:var(--color-accent-ring)] transition-all">
                        <span class="font-mono text-xs text-[color:var(--color-accent)] font-semibold mb-3 block" dir="ltr">01 // الثقافة</span>
                        <h3 class="type-h3 text-lg mb-2 text-[color:var(--color-ink)]">{{ __('بيئة نخبويّة') }}</h3>
                        <p class="type-body text-xs text-[color:var(--color-ink-muted)] leading-relaxed">
                            {{ __('اعمل بجانب محترفين شغوفين يركزون على جودة العمل والقيمة الحقيقية.') }}
                        </p>
                    </div>
                    <div class="surface-card p-6 rounded-2xl border border-[color:var(--color-line)] group hover:border-[color:var(--color-accent-ring)] transition-all">
                        <span class="font-mono text-xs text-[color:var(--color-accent)] font-semibold mb-3 block" dir="ltr">02 // التحدي</span>
                        <h3 class="type-h3 text-lg mb-2 text-[color:var(--color-ink)]">{{ __('مشاريع واعدة') }}</h3>
                        <p class="type-body text-xs text-[color:var(--color-ink-muted)] leading-relaxed">
                            {{ __('تحديات تقنية وتصميمية مثرية في بناء منتجات لشركات ناشئة ومؤسسات رائدة.') }}
                        </p>
                    </div>
                    <div class="surface-card p-6 rounded-2xl border border-[color:var(--color-line)] group hover:border-[color:var(--color-accent-ring)] transition-all">
                        <span class="font-mono text-xs text-[color:var(--color-accent)] font-semibold mb-3 block" dir="ltr">03 // النمو</span>
                        <h3 class="type-h3 text-lg mb-2 text-[color:var(--color-ink)]">{{ __('تطوير متواصل') }}</h3>
                        <p class="type-body text-xs text-[color:var(--color-ink-muted)] leading-relaxed">
                            {{ __('مساحة كاملة للابتكار والتجربة واستخدام أحدث التقنيات وأدوات الذكاء الاصطناعي.') }}
                        </p>
                    </div>
                </div>

                {{-- Application Form --}}
                <div data-reveal data-reveal-stagger="150">
                    @if(session('success'))
                        <div class="surface-card p-8 mb-10 rounded-3xl border border-[color:var(--color-accent)] bg-[color:var(--color-accent-soft)] text-center">
                            <div class="w-12 h-12 rounded-full bg-[color:var(--color-accent)] text-black flex items-center justify-center mx-auto mb-4 font-bold text-lg">
                                ✓
                            </div>
                            <h3 class="type-h3 mb-2 text-[color:var(--color-ink)]">{{ __('تم استلام طلبك بنجاح!') }}</h3>
                            <p class="type-body text-[color:var(--color-ink-muted)]">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data"
                          class="surface-card p-8 md:p-14 rounded-3xl border border-[color:var(--color-line-strong)] space-y-8 shadow-2xl">
                        @csrf

                        <div>
                            <span class="font-mono text-xs font-semibold text-[color:var(--color-accent)] uppercase tracking-wider block mb-2" dir="ltr">// Application</span>
                            <h2 class="type-h2 mb-2 leading-snug">{{ __('قدّم طلب الانضمام') }}</h2>
                            <p class="type-small text-[color:var(--color-ink-muted)] mb-8">{{ __('شاركنا سيرتك الذاتية وخبرتك وسنتواصل معك فور توفر فرصة مناسبة.') }}</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الاسم الكامل *') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input @error('name') border-red-500 @enderror" required placeholder="{{ __('اسمك الكامل') }}">
                                @error('name')<p class="form-help text-red-400 mt-1.5">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="email" class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('البريد الإلكتروني *') }}</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input @error('email') border-red-500 @enderror" required placeholder="example@email.com">
                                @error('email')<p class="form-help text-red-400 mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('رقم الهاتف *') }}</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-input @error('phone') border-red-500 @enderror" required placeholder="+966 5X XXX XXXX" dir="ltr">
                                @error('phone')<p class="form-help text-red-400 mt-1.5">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="years_of_experience" class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('سنوات الخبرة *') }}</label>
                                <input type="number" id="years_of_experience" name="years_of_experience" value="{{ old('years_of_experience') }}" min="0" max="50" class="form-input @error('years_of_experience') border-red-500 @enderror" required placeholder="{{ __('مثال: 3') }}">
                                @error('years_of_experience')<p class="form-help text-red-400 mt-1.5">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="specialization" class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('مجال التخصص والدور المطلوب *') }}</label>
                            <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}" class="form-input @error('specialization') border-red-500 @enderror" required placeholder="{{ __('مثال: Senior Frontend Engineer / UI-UX Designer') }}">
                            @error('specialization')<p class="form-help text-red-400 mt-1.5">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('السيرة الذاتية (CV / Resume) *') }}</label>
                            <div class="surface-card--raised p-6 rounded-2xl border border-dashed border-[color:var(--color-line-bold)] text-center hover:border-[color:var(--color-accent)] transition-colors">
                                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="hidden @error('cv') border-red-500 @enderror" required>
                                <label for="cv" class="cursor-pointer flex flex-col items-center justify-center gap-2">
                                    <div class="w-10 h-10 rounded-full bg-[color:var(--color-surface)] flex items-center justify-center text-[color:var(--color-accent)] font-mono text-lg">
                                        ↑
                                    </div>
                                    <span class="type-small font-medium text-[color:var(--color-ink)]">{{ __('اضغط هنا لاختيار ملف السيرة الذاتية') }}</span>
                                    <span class="type-small text-[color:var(--color-ink-subtle)] text-xs">{{ __('الصيغ المقبولة: PDF, DOC, DOCX (الحد الأقصى: 20 ميجابايت)') }}</span>
                                </label>
                            </div>
                            @error('cv')<p class="form-help text-red-400 mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="pt-4 border-t border-[color:var(--color-line)]">
                            <button type="submit" class="btn btn--primary w-full justify-center py-4 text-sm font-medium">
                                <span>{{ __('إرسال طلب الانضمام') }}</span>
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

