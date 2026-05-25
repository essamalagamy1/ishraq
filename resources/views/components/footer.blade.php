@props(['companySettings' => null, 'socialLinks' => null])

@php
    $companySettings = $companySettings ?? \App\Models\CompanySetting::first();
    $socialLinks = $socialLinks ?? \App\Models\SocialLink::where('is_active', true)->get();
    $companyName = $companySettings->company_name ?? 'إشراق';
    $year = now()->year;
@endphp

<footer class="relative" style="background: var(--color-surface-inset);" role="contentinfo">
    <div class="container-page py-20 md:py-28">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-8">

            {{-- Brand block --}}
            <div class="md:col-span-5">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3" aria-label="{{ $companyName }}" wire:navigate>
                    @if($companySettings && $companySettings->logo_path)
                        <img src="{{ Storage::url($companySettings->logo_path) }}" alt="{{ $companyName }}" class="h-10 w-auto object-contain" style="width: 180px;"/>
                    @else
                        <span class="type-h2 font-medium tracking-tight">{{ $companyName }}</span>
                    @endif
                </a>

                @if($companySettings && $companySettings->about_short)
                    <p class="type-body mt-6 max-w-md text-[color:var(--color-ink-muted)]">
                        {{ $companySettings->about_short }}
                    </p>
                @else
                    <p class="type-body mt-6 max-w-md text-[color:var(--color-ink-muted)]">
                        نصنع منتجات رقمية متينة وبمعايير عالية — تجارب رقمية تُترجم تطلّع شركتك إلى نتائج ملموسة.
                    </p>
                @endif

                @if($socialLinks && $socialLinks->count())
                    <ul class="mt-10 flex items-center gap-3">
                        @foreach($socialLinks as $social)
                            <li>
                                <a href="{{ $social->url }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[color:var(--color-line-strong)] text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-ink)] hover:border-[color:var(--color-accent)] transition-colors duration-300"
                                   aria-label="{{ $social->platform }}">
                                    <x-ui.social-icon :platform="$social->platform" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Sitemap --}}
            <div class="md:col-span-4 grid grid-cols-2 gap-8">
                <div>
                    <h3 class="type-eyebrow mb-6">موارد</h3>
                    <ul class="space-y-3.5">
                        <li><a href="{{ route('articles') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>المدونة</a></li>
                        <li><a href="{{ route('request-design.create') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>طلب تصميم</a></li>
                        <li><a href="{{ route('contact') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>تواصل</a></li>
                        <li><a href="{{ route('testimonial.create') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>قصة عميل</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="type-eyebrow mb-6">الشركة</h3>
                    <ul class="space-y-3.5">
                        <li><a href="{{ route('about') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>من نحن</a></li>
                        <li><a href="{{ route('services') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>الخدمات</a></li>
                        {{--                        <li><a href="{{ route('portfolio') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>الأعمال</a></li>--}}
                        <li><a href="{{ route('careers') }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>الفرص</a></li>
                    </ul>
                </div>
            </div>

            {{-- Contact --}}
            <div class="md:col-span-3">
                <h3 class="type-eyebrow mb-6">تواصل</h3>
                <ul class="space-y-3.5">
                    @if($companySettings && $companySettings->main_email)
                        <li>
                            <a href="mailto:{{ $companySettings->main_email }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors">
                                {{ $companySettings->main_email }}
                            </a>
                        </li>
                    @endif
                    @if($companySettings && $companySettings->phone_primary)
                        <li>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $companySettings->phone_primary) }}" class="type-body hover:text-[color:var(--color-ink)] transition-colors" dir="ltr">
                                {{ $companySettings->phone_primary }}
                            </a>
                        </li>
                    @endif
                    @if($companySettings && $companySettings->location_text)
                        <li class="type-body">{{ $companySettings->location_text }}</li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Bottom strip --}}
        <div class="mt-20 pt-8 hairline-t flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <p class="type-small text-[color:var(--color-ink-subtle)]">
                © {{ $year }} {{ $companyName }} — جميع الحقوق محفوظة.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('privacy') }}" class="type-small text-[color:var(--color-ink-subtle)] hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>سياسة الخصوصية</a>
                <span class="w-px h-3 bg-[color:var(--color-line)]"></span>
                <a href="{{ route('terms') }}" class="type-small text-[color:var(--color-ink-subtle)] hover:text-[color:var(--color-ink)] transition-colors" wire:navigate>الشروط والأحكام</a>
            </div>
        </div>
    </div>
</footer>
