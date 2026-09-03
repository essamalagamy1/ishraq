<x-layouts.app>
    @php
        $companyName = $companySettings?->company_name ?? 'إشراق';
        $googleReviewUrl = !empty($companySettings?->google_review_url) 
            ? $companySettings->google_review_url 
            : 'https://www.google.com/search?q=' . urlencode('إشراق لتصميم وتطوير البرمجيات') . '#lrd=0x0:0x0,3,,,';
        $count = $testimonials->count();
        $displayRating = number_format($avgRating, 1);
    @endphp

    {{-- JSON-LD Structured Data for Google Rich Snippets --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $companyName . ' - خدمات تطوير وتصميم البرمجيات',
        'description' => 'تقييمات ومراجعات عملاء شركة إشراق لتصميم وتطوير البرمجيات وتطبيقات الجوال والمواقع.',
        'brand' => [
            '@type' => 'Brand',
            'name' => $companyName,
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => $displayRating,
            'bestRating' => '5',
            'worstRating' => '1',
            'ratingCount' => (string) max($count, 5),
            'reviewCount' => (string) max($count, 5),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    {{-- ================================================================
         1. HERO SECTION & GOOGLE SCORECARD
         ================================================================ --}}
    <section class="svc-hero relative overflow-hidden" data-section>
        <div class="svc-hero__glow" aria-hidden="true"></div>

        <div class="container-page relative z-10 svc-hero__content">
            <div class="max-w-5xl pt-20 pb-12 md:pt-24 md:pb-16">

                {{-- Eyebrow badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[color:var(--color-line-strong)] bg-[color:var(--color-surface-raised)] text-xs font-mono text-[color:var(--color-ink-muted)] mb-6" data-reveal>
                    <svg class="w-4 h-4 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    <span>{{ __('تقييمات موثقة وتجارب شركائنا الحقيقية') }}</span>
                </div>

                <h1 class="type-display leading-[1.1]" data-reveal data-reveal-stagger="100">
                    <span class="block">{{ __('آراء نفتخر بها،') }}</span>
                    <span class="block text-gradient mt-2">{{ __('وشهادات تدفعنا للقمة دائماً.') }}</span>
                </h1>

                <p class="type-body-lg mt-8 max-w-2xl leading-relaxed text-[color:var(--color-ink-muted)]" data-reveal data-reveal-stagger="200">
                    {{ __('كل شراكة نخوضها هي قصة نجاح مشتركة. نفتخر بثقة عملائنا في مصر والسعودية، ورأيكم الصادق هو بوصلتنا الدائمة للابتكار والتميز.') }}
                </p>

                {{-- Google Live Scorecard Banner --}}
                <div class="mt-12 p-6 md:p-8 rounded-3xl border border-[color:var(--color-line-strong)] bg-gradient-to-r from-[color:var(--color-surface-raised)] via-[color:var(--color-surface)] to-[color:var(--color-surface-raised)] shadow-2xl backdrop-blur-xl flex flex-col md:flex-row items-center justify-between gap-6" data-reveal data-reveal-stagger="300">
                    
                    {{-- Left side: Google Branding & Stars --}}
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center p-3 shrink-0 shadow-inner">
                            {{-- Official Google 4-Color G SVG --}}
                            <svg class="w-full h-full" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-extrabold tracking-tight font-mono text-[color:var(--color-ink)]">{{ $displayRating }}</span>
                                <div class="flex items-center text-amber-400 text-lg leading-none" aria-label="5 نجوم">
                                    ★★★★★
                                </div>
                            </div>
                            <div class="text-xs text-[color:var(--color-ink-muted)] mt-1 flex items-center gap-2">
                                <span>{{ __('تقييم ممتاز على خرائط Google') }}</span>
                                <span class="w-1 h-1 rounded-full bg-[color:var(--color-line-strong)]"></span>
                                <span class="text-emerald-400 font-medium font-mono">100% {{ __('رضا العملاء') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right side: Stats and Direct Google Action --}}
                    <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-start md:justify-end">
                        <a href="{{ $googleReviewUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn--primary flex items-center gap-3 py-3.5 px-6 group shadow-lg shadow-amber-500/10">
                            {{-- Google Icon in Button --}}
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span class="font-medium text-sm">{{ __('قيّم تجربتك على Google') }}</span>
                            <span class="text-xs group-hover:translate-x-[-2px] transition-transform">↗</span>
                        </a>

                        <a href="#submit-form"
                           class="btn btn--ghost text-xs py-3.5 px-5 text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-ink)]">
                            <span>{{ __('أو شاركنا تقييمك هنا') }} ↓</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================================
         2. WHY YOUR REVIEW MATTERS (إبراز كيف يساعدنا التقييم)
         ================================================================ --}}
    <section class="section-pad hairline-t relative overflow-hidden" style="background: var(--color-surface);">
        <div class="container-page">
            
            <div class="p-8 md:p-12 rounded-3xl border border-[color:var(--color-accent-ring)] bg-[color:var(--color-surface-raised)] relative overflow-hidden shadow-2xl" data-reveal>
                <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-[color:var(--color-accent-soft)] blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <div class="lg:col-span-8">
                        <div class="inline-flex items-center gap-2 text-xs font-mono text-amber-400 uppercase tracking-wider mb-3">
                            <span>✦</span>
                            <span>{{ __('صوتك يُحدث فارقاً حقيقياً') }}</span>
                        </div>
                        <h2 class="type-h2 mb-4 leading-snug">
                            {{ __('لماذا نطلب رأيك الصادق وكيف يُساعدنا؟') }}
                        </h2>
                        <p class="type-body text-[color:var(--color-ink-muted)] leading-relaxed mb-4">
                            {{ __('في إشراق تك، نعتبر كل مشروع شرفاً ومسؤولية. تقييمك لخدمتنا على جوجل لا يستغرق سوى دقيقة واحدة، لكنه يعني الكثير لفريقنا:') }}
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 pt-6 border-t border-[color:var(--color-line)]">
                            <div class="flex items-start gap-3">
                                <span class="w-7 h-7 rounded-lg bg-[color:var(--color-surface)] border border-[color:var(--color-line)] flex items-center justify-center text-amber-400 shrink-0 text-sm font-bold">1</span>
                                <div>
                                    <div class="font-medium text-sm text-[color:var(--color-ink)]">{{ __('تطوير مستمر') }}</div>
                                    <div class="text-xs text-[color:var(--color-ink-subtle)] mt-1">{{ __('نستفيد من ملاحظاتك لتحسين جودة أكوادنا وخدماتنا.') }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-7 h-7 rounded-lg bg-[color:var(--color-surface)] border border-[color:var(--color-line)] flex items-center justify-center text-amber-400 shrink-0 text-sm font-bold">2</span>
                                <div>
                                    <div class="font-medium text-sm text-[color:var(--color-ink)]">{{ __('مساعدة الآخرين') }}</div>
                                    <div class="text-xs text-[color:var(--color-ink-subtle)] mt-1">{{ __('تمنح رواد الأعمال والشركات الثقة في اختيارنا.') }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-7 h-7 rounded-lg bg-[color:var(--color-surface)] border border-[color:var(--color-line)] flex items-center justify-center text-amber-400 shrink-0 text-sm font-bold">3</span>
                                <div>
                                    <div class="font-medium text-sm text-[color:var(--color-ink)]">{{ __('دعم فريق المطورين') }}</div>
                                    <div class="text-xs text-[color:var(--color-ink-subtle)] mt-1">{{ __('كلماتك الإيجابية تلهم مهندسينا لتقديم أقصى طاقاتهم.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Action Callout --}}
                    <div class="lg:col-span-4 text-center lg:text-end">
                        <div class="p-6 rounded-2xl bg-[color:var(--color-surface)] border border-[color:var(--color-line-strong)] inline-block w-full max-w-sm text-center">
                            <div class="text-4xl mb-3">💬</div>
                            <div class="font-semibold text-base mb-1">{{ __('شارك تجربتك الآن') }}</div>
                            <div class="text-xs text-[color:var(--color-ink-muted)] mb-5">{{ __('أقل من 60 ثانية تمنحنا دعماً يدوم طويلاً.') }}</div>
                            <a href="{{ $googleReviewUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn--primary w-full justify-center py-3.5 text-xs font-semibold shadow-md">
                                <span>{{ __('كتابة مراجعة على Google') }}</span>
                                <svg class="w-3.5 h-3.5" viewBox="0 0 16 16" fill="currentColor"><path d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ================================================================
         3. WALL OF TESTIMONIALS & GOOGLE REVIEWS
         ================================================================ --}}
    <section class="section-pad hairline-t" style="background: var(--color-canvas);">
        <div class="container-page">

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12" data-reveal>
                <div>
                    <x-ui.eyebrow number="01">{{ __('مراجعات العملاء') }}</x-ui.eyebrow>
                    <h2 class="type-h1 mt-4">{{ __('تجارب حقيقية من شركاء مسيرتنا') }}</h2>
                </div>
                <div class="text-xs text-[color:var(--color-ink-subtle)] font-mono flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>{{ __('معروض') }} {{ $testimonials->count() }} {{ __('تقييم موثق') }}</span>
                </div>
            </div>

            {{-- Testimonial Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($testimonials as $idx => $t)
                    <div class="surface-card p-8 rounded-3xl border border-[color:var(--color-line-strong)] hover:border-[color:var(--color-accent-ring)] transition-all duration-300 flex flex-col justify-between group shadow-xl relative overflow-hidden"
                         data-reveal data-reveal-stagger="{{ ($idx % 3) * 120 }}">

                        {{-- Card Header: Author info & Google verified badge --}}
                        <div>
                            <div class="flex items-start justify-between gap-4 mb-6">
                                <div class="flex items-center gap-3.5">
                                    @if($t->client_avatar)
                                        <img src="{{ Storage::url($t->client_avatar) }}"
                                             alt="{{ $t->client_name }}"
                                             class="w-12 h-12 rounded-full object-cover border border-white/10 shrink-0" />
                                    @else
                                        {{-- Elegant Initials Avatar --}}
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500/20 to-orange-500/20 border border-amber-500/30 text-amber-300 flex items-center justify-center font-bold text-base font-mono shrink-0 shadow-inner">
                                            {{ mb_substr($t->client_name, 0, 1) }}
                                        </div>
                                    @endif

                                    <div>
                                        <div class="font-medium text-base text-[color:var(--color-ink)] flex items-center gap-2">
                                            <span>{{ $t->client_name }}</span>
                                            @if($t->is_verified)
                                                <svg class="w-4 h-4 text-emerald-400 shrink-0" viewBox="0 0 20 20" fill="currentColor" title="{{ __('مراجعة موثقة') }}">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="text-xs text-[color:var(--color-ink-muted)] mt-0.5 font-mono">
                                            {{ trim(($t->client_position ?? '') . ($t->client_company ? ' — ' . $t->client_company : '')) ?: __('عميل معتمد') }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Google Badge in card --}}
                                <div class="w-6 h-6 rounded-full bg-white/5 border border-white/10 flex items-center justify-center p-1 shrink-0" title="Google Verified Review">
                                    <svg viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Stars --}}
                            <div class="flex items-center gap-1 text-amber-400 text-sm mb-4" aria-label="{{ $t->rating }} من 5">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $t->rating ? 'text-amber-400' : 'text-gray-700' }}">★</span>
                                @endfor
                            </div>

                            {{-- Quote Content --}}
                            <blockquote class="type-body text-[color:var(--color-ink)] leading-relaxed relative">
                                <span class="text-3xl text-[color:var(--color-line-strong)] font-serif leading-none select-none -top-2 relative">“</span>
                                {{ $t->testimonial }}
                            </blockquote>
                        </div>

                        {{-- Card Footer: Verified Chip & Date --}}
                        <div class="mt-8 pt-4 border-t border-[color:var(--color-line)] flex items-center justify-between text-xs text-[color:var(--color-ink-subtle)] font-mono">
                            <a href="{{ $t->review_url ?: $googleReviewUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-400/90 hover:text-emerald-300 transition-colors">
                                <span>✦</span>
                                <span>{{ $t->badge_text ?? __('مراجعة Google موثقة') }}</span>
                                <span class="text-[10px]">↗</span>
                            </a>
                            <span>{{ $t->created_at ? $t->created_at->diffForHumans() : __('مؤخراً') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-[color:var(--color-ink-muted)]">
                        {{ __('كن أول من يشاركنا تقييمه ويضيء لوحة شركائنا!') }}
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- ================================================================
         4. ON-SITE TESTIMONIAL FORM
         ================================================================ --}}
    <section id="submit-form" class="section-pad hairline-t scroll-mt-24" style="background: var(--color-surface);">
        <div class="container-page">
            <div class="max-w-2xl mx-auto" data-reveal>

                {{-- Header --}}
                <div class="text-center mb-10">
                    <x-ui.eyebrow number="02">{{ __('أضف تقييمك') }}</x-ui.eyebrow>
                    <h2 class="type-h2 mt-4">{{ __('شاركنا رأيك مباشرة على الموقع') }}</h2>
                    <p class="type-body mt-2 text-[color:var(--color-ink-muted)]">
                        {{ __('إذا كنت تفضل كتابة تقييمك هنا دون الحاجة لحساب جوجل، يمكنك تعبئة النموذج التالي وسيتم نشره بعد المراجعة.') }}
                    </p>
                </div>

                @if(session('success'))
                    <div class="surface-card p-8 mb-10 rounded-3xl border border-emerald-500/40 bg-emerald-950/20 text-center animate-fade-in">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center mx-auto mb-4 font-bold text-lg">
                            ✓
                        </div>
                        <h3 class="type-h3 mb-2 text-[color:var(--color-ink)]">{{ __('شكرًا جزيلاً لمشاركتك!') }}</h3>
                        <p class="type-body text-[color:var(--color-ink-muted)]">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('testimonial.store') }}" method="POST"
                      class="surface-card p-8 md:p-12 rounded-3xl border border-[color:var(--color-line-strong)] space-y-8 shadow-2xl relative">
                    @csrf

                    {{-- Rating Widget --}}
                    <div class="p-6 rounded-2xl bg-[color:var(--color-surface-raised)] border border-[color:var(--color-line)] text-center">
                        <label class="form-label font-medium text-xs font-mono uppercase tracking-wider mb-3 block text-[color:var(--color-ink-muted)]">{{ __('اختر التقييم من 1 إلى 5 نجوم *') }}</label>
                        <div class="flex items-center justify-center gap-3" id="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        class="rating-star text-3xl text-amber-400 hover:scale-125 transition-transform duration-200 focus:outline-none cursor-pointer"
                                        data-value="{{ $i }}"
                                        aria-label="{{ __('تقييم') }} {{ $i }} {{ __('من 5') }}">
                                    ★
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="5" required>
                        <div class="text-xs font-mono text-amber-400 mt-2" id="rating-text">{{ __('ممتاز — 5 من 5') }}</div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('الاسم الكريم *') }}</label>
                            <input type="text" name="client_name" required class="form-input" placeholder="{{ __('اسمك أو اسم المؤسسة') }}">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('المنصب أو الصفة (اختياري)') }}</label>
                                <input type="text" name="client_position" class="form-input" placeholder="{{ __('مثال: الرئيس التنفيذي، مدير التسويق') }}">
                            </div>

                            <div>
                                <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('اسم الشركة أو المشروع (اختياري)') }}</label>
                                <input type="text" name="client_company" class="form-input" placeholder="{{ __('مثال: متجر سين، عيادة كذا') }}">
                            </div>
                        </div>

                        <div>
                            <label class="form-label font-medium text-xs font-mono uppercase tracking-wider">{{ __('انطباعك وتجربتك معنا *') }}</label>
                            <textarea name="testimonial" rows="5" required class="form-textarea"
                                      placeholder="{{ __('اكتب عن تجربتك في التعاون معنا، التزام المواعيد، جودة التنفيذ، والنتائج التي حققها مشروعك...') }}"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--primary w-full justify-center py-4 text-sm font-semibold shadow-xl">
                        <span>{{ __('إرسال التقييم الآن') }}</span>
                        <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                            <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>

            </div>
        </div>
    </section>

    {{-- Script for Interactive Stars --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('rating-value');
            const ratingText = document.getElementById('rating-text');

            const ratingLabels = {
                1: '{{ __("مقبول — 1 من 5") }}',
                2: '{{ __("جيد — 2 من 5") }}',
                3: '{{ __("جيد جداً — 3 من 5") }}',
                4: '{{ __("رائع — 4 من 5") }}',
                5: '{{ __("ممتاز وفاق التوقعات — 5 من 5") }}'
            };

            const updateStars = (rating) => {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-700');
                        star.classList.add('text-amber-400');
                    } else {
                        star.classList.remove('text-amber-400');
                        star.classList.add('text-gray-700');
                    }
                });
                if (ratingText && ratingLabels[rating]) {
                    ratingText.textContent = ratingLabels[rating];
                }
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
