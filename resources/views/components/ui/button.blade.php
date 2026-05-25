@props([
    'variant' => 'ghost',
    'href' => null,
    'type' => 'button',
    'icon' => null,
])

@php
    $classes = 'btn btn--' . $variant;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if($icon === 'arrow')
            <svg class="btn-arrow" width="16" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span>{{ $slot }}</span>
        @if($icon === 'arrow')
            <svg class="btn-arrow" width="16" height="10" viewBox="0 0 16 10" fill="none" aria-hidden="true">
                <path d="M14.5 5H1M6 .5 1 5l5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @endif
    </button>
@endif
