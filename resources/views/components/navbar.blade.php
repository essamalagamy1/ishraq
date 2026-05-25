@props(['companySettings' => null])

@php
    $navLinks = [
        ['route' => 'home',     'label' => 'الرئيسية',  'match' => 'home'],
        ['route' => 'about',    'label' => 'من نحن',    'match' => 'about'],
        ['route' => 'services', 'label' => 'الخدمات',   'match' => 'services'],
        ['route' => 'portfolio','label' => 'الأعمال',   'match' => 'portfolio'],
        ['route' => 'articles', 'label' => 'المدونة',   'match' => 'articles*'],
        ['route' => 'contact',  'label' => 'تواصل',     'match' => 'contact'],
    ];
    $companyName = $companySettings->company_name ?? 'إشراق';
    $logo = $companySettings && $companySettings->logo_path ? Storage::url($companySettings->logo_path) : null;
@endphp

<nav class="site-nav" data-site-nav role="navigation" aria-label="القائمة الرئيسية">
    <div class="container-page">
        <div class="flex items-center justify-between h-[72px] md:h-[80px]">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="{{ $companyName }} — الرئيسية" wire:navigate>
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $companyName }}" style="width: 150px" width="150" height="48" class="h-7 md:h-8 lg:h-9 w-auto max-w-[150px] object-contain transition-opacity duration-300 group-hover:opacity-90" />
                @else
                    <span class="type-h3 font-medium tracking-tight">{{ $companyName }}</span>
                @endif
            </a>

            {{-- Desktop links --}}
            <div class="hidden lg:flex items-center gap-10">
                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}" wire:navigate
                       class="nav-link {{ request()->routeIs($link['match']) ? 'is-active' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ route('request-design.create') }}" class="btn btn--primary" wire:navigate>
                    <span>ابدأ مشروعك</span>
                    <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                        <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            {{-- Mobile toggle --}}
            <button type="button"
                    class="lg:hidden menu-toggle"
                    data-menu-toggle
                    aria-controls="nav-overlay"
                    aria-expanded="false"
                    aria-label="فتح القائمة">
                <span class="bar"></span>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile full-screen overlay --}}
<div id="nav-overlay" class="nav-overlay lg:hidden" data-nav-overlay>
    <div class="container-page py-12">
        <div class="flex flex-col">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}" wire:navigate
                   class="nav-link {{ request()->routeIs($link['match']) ? 'is-active' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
        <div class="mt-12 pt-8 hairline-t">
            <a href="{{ route('request-design.create') }}" class="btn btn--primary" wire:navigate>
                <span>ابدأ مشروعك</span>
                <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            @if($companySettings && $companySettings->main_email)
                <a href="mailto:{{ $companySettings->main_email }}" class="block mt-6 type-small text-[color:var(--color-ink-muted)] hover:text-[color:var(--color-ink)]">
                    {{ $companySettings->main_email }}
                </a>
            @endif
        </div>
    </div>
</div>
