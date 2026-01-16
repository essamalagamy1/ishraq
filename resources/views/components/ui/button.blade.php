@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'icon' => null,
    'iconPosition' => 'start',
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold rounded-xl transition-all duration-300 transform';
    
    $variants = [
        'primary' => 'bg-gradient-to-r from-accent-500 to-accent-400 text-white hover:shadow-lg hover:shadow-accent-500/50 hover:scale-105',
        'secondary' => 'bg-transparent border-2 border-accent-500 text-accent-500 hover:bg-accent-500 hover:text-white',
        'ghost' => 'bg-white/10 backdrop-blur-md border-2 border-white/30 text-white hover:bg-white hover:text-navy-600',
        'outline-white' => 'bg-transparent border-2 border-white text-white hover:bg-white hover:text-navy-600',
        'dark' => 'bg-navy-600 text-white hover:bg-navy-500 hover:shadow-lg',
        'gradient' => 'bg-gradient-to-r from-accent-500 via-accent-400 to-teal-400 text-white hover:shadow-2xl hover:shadow-accent-500/50 hover:scale-105',
    ];
    
    $sizes = [
        'sm' => 'py-2 px-4 text-sm gap-2',
        'md' => 'py-3 px-6 text-base gap-2',
        'lg' => 'py-4 px-8 text-lg gap-3',
        'xl' => 'py-5 px-10 text-xl gap-3',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }}"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'start')
            <i class="{{ $icon }}"></i>
        @endif
        {{ $slot }}
        @if($icon && $iconPosition === 'end')
            <i class="{{ $icon }}"></i>
        @endif
    </button>
@endif
