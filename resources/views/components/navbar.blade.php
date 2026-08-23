@props(['companySettings' => null])

@php
    $navLinks = [
        ['route' => 'home',     'label' => 'الرئيسية',  'match' => 'home'],
        ['route' => 'about',    'label' => 'من نحن',    'match' => 'about'],
        ['route' => 'services', 'label' => 'الخدمات',   'match' => 'services'],
        ['route' => 'portfolio','label' => 'أعمالنا',   'match' => 'portfolio*'],
        ['route' => 'articles', 'label' => 'المدونة',   'match' => 'articles*'],
        ['route' => 'contact',  'label' => 'تواصل',     'match' => 'contact'],
    ];
    $companyName = $companySettings->company_name ?? 'إشراق';
    $logo = $companySettings && $companySettings->logo_path ? Storage::url($companySettings->logo_path) : null;
@endphp

<header class="site-header" data-site-nav role="banner">
    <nav class="nav-ed" aria-label="القائمة الرئيسية">
        <div class="nav-ed__inner">

            {{-- Brand --}}
            <a href="{{ route('home') }}" class="nav-ed__brand" aria-label="{{ $companyName }} — الرئيسية" wire:navigate>
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $companyName }}" width="140" height="44" class="nav-ed__logo" />
                @else
                    <span class="nav-ed__wordmark">{{ $companyName }}</span>
                @endif
            </a>

            {{-- Desktop links --}}
            <div class="nav-ed__links">
                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}" wire:navigate
                       class="nav-ed__link {{ request()->routeIs($link['match']) ? 'is-active' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop CTA --}}
            <div class="nav-ed__actions">
                <a href="{{ route('request-design.create') }}" class="nav-ed__cta" wire:navigate>
                    ابدأ مشروعك
                </a>
            </div>

            {{-- Mobile toggle --}}
            <button type="button"
                    class="nav-ed__toggle lg:hidden"
                    data-menu-toggle
                    aria-controls="nav-overlay"
                    aria-expanded="false"
                    aria-label="فتح القائمة">
                <span class="nav-ed__toggle-bar"></span>
            </button>

        </div>
    </nav>
</header>

{{-- Mobile full-screen overlay --}}
<div id="nav-overlay" class="nav-mobile" data-nav-overlay>
    <div class="nav-mobile__inner">
        {{-- Links --}}
        <div class="nav-mobile__links">
            @foreach($navLinks as $idx => $link)
                <a href="{{ route($link['route']) }}" wire:navigate
                   class="nav-mobile__link {{ request()->routeIs($link['match']) ? 'is-active' : '' }}">
                    <span class="nav-mobile__link-num" dir="ltr">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="nav-mobile__link-text">{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- Bottom --}}
        <div class="nav-mobile__bottom">
            <a href="{{ route('request-design.create') }}" class="btn btn--primary" wire:navigate>
                <span>ابدأ مشروعك</span>
                <svg class="btn-arrow" width="14" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                    <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            @if($companySettings && $companySettings->main_email)
                <a href="mailto:{{ $companySettings->main_email }}" class="nav-mobile__email">
                    {{ $companySettings->main_email }}
                </a>
            @endif
        </div>
    </div>
</div>
