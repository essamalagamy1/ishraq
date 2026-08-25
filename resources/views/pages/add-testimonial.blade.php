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
                    <x-ui.eyebrow number="01">{{ __('تقييم العملاء') }}</x-ui.eyebrow>
                    <span class="w-1.5 h-1.5 rounded-full bg-[color:var(--color-accent)] animate-pulse"></span>
                    <span class="type-eyebrow text-[color:var(--color-accent)]">{{ __('صوت العميل // Feedback') }}</span>
                </div>

                <h1 class="type-display mt-6 leading-tight">
                    <span>{{ __('شاركنا تجربتك') }}</span>
                    <span class="block text-[color:var(--color-accent)] italic font-serif">{{ __('ورأيك في شراكتنا معك.') }}</span>
                </h1>

                <p class="type-body-lg mt-8 max-w-2xl text-[color:var(--color-ink-muted)] leading-relaxed" data-reveal data-reveal-stagger="200">
                    {{ __('نعتز بكل شراكة نبنيها، ورأيك الصادق يساعدنا في مواصلة التطوير وتقديم تجارب رقمية تليق بتطلعاتك.') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ================================================================
         2. TESTIMONIAL FORM
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-2xl mx-auto" data-reveal>
                @if(session('success'))
                    <div class="surface-card p-8 mb-10 rounded-3xl border border-[color:var(--color-accent)] bg-[color:var(--color-accent-soft)] text-center">
                        <div class="w-12 h-12 rounded-full bg-[color:var(--color-accent)] text-black flex items-center justify-center mx-auto mb-4 font-bold text-lg">
                            ✓
                        </div>
                        <h3 class="type-h3 mb-2 text-[color:var(--color-ink)]">{{ __('شكرًا لمشاركتك!') }}</h3>
                        <p class="type-body text-[color:var(--color-ink-muted)]">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('testimonial.store') }}" method="POST"
                      class="surface-card p-8 md:p-12 rounded-3xl border border-[color:var(--color-line-strong)] space-y-8 shadow-2xl">
                    @csrf
                    
                    {{-- Rating Widget --}}
                    <div class="p-6 rounded-2xl bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] text-center">
                        <label class="form-label font-medium text-xs font-mono uppercase tracking-wider mb-4 block">{{ __('تقييمك الإجمالي للتجربة *') }}</label>
                        <div class="flex items-center justify-center gap-3" id="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        class="rating-star text-3xl text-[color:var(--color-accent)] hover:scale-125 transition-transform duration-200 focus:outline-none cursor-pointer"
                                        data-value="{{ $i }}"
                                        aria-label="{{ __('تقييم') }} {{ $i }} {{ __('من 5') }}">
                                    ★
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="5" required>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الاسم الكريم *') }}</label>
                            <input type="text" name="client_name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('المنصب / المسمى الوظيفي (اختياري)') }}</label>
                                <input type="text" name="client_position" class="form-input" placeholder="{{ __('مثال: الرئيس التنفيذي / مدير التسويق') }}">
                            </div>

                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('اسم الشركة أو المنظمة (اختياري)') }}</label>
                                <input type="text" name="client_company" class="form-input" placeholder="{{ __('اسم الشركة أو الجهة') }}">
                            </div>
                        </div>

                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('انطباعك وتجربتك معنا *') }}</label>
                            <textarea name="testimonial" rows="5" required class="form-textarea"
                                      placeholder="{{ __('حدثنا عن تجربتك في العمل معنا، جودة المخرجات، والنتائج التي تحققت لمشروعك...') }}"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--primary w-full justify-center py-4 text-sm font-medium">
                        <span>{{ __('إرسال التقييم') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('rating-value');

            const updateStars = (rating) => {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-[color:var(--color-ink-faint)]');
                        star.classList.add('text-[color:var(--color-accent)]');
                    } else {
                        star.classList.remove('text-[color:var(--color-accent)]');
                        star.classList.add('text-[color:var(--color-ink-faint)]');
                    }
                });
            };

            updateStars(5);

            stars.forEach((star) => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.getAttribute('data-value') || '5', 10);
                    ratingInput.value = value;
                    updateStars(value);
                });
            });
        });
    </script>
</x-layouts.app>

