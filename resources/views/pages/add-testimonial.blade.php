<x-layouts.app>
    <section class="section-pad" style="background: var(--color-canvas);">
        <div class="container-page">
            <div class="max-w-3xl" data-reveal>
                <x-ui.eyebrow number="01">{{ __('التقييمات') }}</x-ui.eyebrow>
                <x-ui.split-heading as="h1" class="type-display mt-6">
                    {{ __('شاركنا تجربتك') }}
                </x-ui.split-heading>
                <p class="type-body-lg mt-6">{{ __('رأيك يساعدنا على التحسين المستمر.') }}</p>
            </div>
        </div>
    </section>

    <section class="section-pad" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-2xl mx-auto">
                @if(session('success'))
                    <div class="surface-card p-6 mb-8 text-center">
                        <p class="type-body text-[color:var(--color-ink)]">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('testimonial.store') }}" method="POST" class="surface-card p-8">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="form-label">{{ __('تقييمك') }}</label>
                            <div class="flex gap-2" id="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="rating-star text-2xl text-[color:var(--color-ink-subtle)] hover:text-[color:var(--color-accent)] transition-colors" data-value="{{ $i }}">★</button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="5" required>
                        </div>

                        <div>
                            <label class="form-label">{{ __('اسمك') }}</label>
                            <input type="text" name="client_name" required class="form-input" placeholder="{{ __('اسمك الكامل') }}">
                        </div>

                        <div>
                            <label class="form-label">{{ __('منصبك (اختياري)') }}</label>
                            <input type="text" name="client_position" class="form-input" placeholder="{{ __('مثال: مدير تنفيذي') }}">
                        </div>

                        <div>
                            <label class="form-label">{{ __('اسم الشركة (اختياري)') }}</label>
                            <input type="text" name="client_company" class="form-input" placeholder="{{ __('اسم شركتك') }}">
                        </div>

                        <div>
                            <label class="form-label">{{ __('تجربتك معنا') }}</label>
                            <textarea name="testimonial" rows="5" required class="form-textarea" placeholder="{{ __('شاركنا تجربتك...') }}"></textarea>
                        </div>

                        <button type="submit" class="btn btn--primary w-full justify-center">
                            <span>{{ __('إرسال التقييم') }}</span>
                            <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
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
                    star.classList.toggle('text-[color:var(--color-accent)]', index < rating);
                    star.classList.toggle('text-[color:var(--color-ink-subtle)]', index >= rating);
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
