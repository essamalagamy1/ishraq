@props([
    'variant' => 'default',
    'hover' => true,
    'padding' => 'lg',
])

@php
    $baseClasses = 'rounded-2xl transition-all duration-500';
    
    $variants = [
        'default' => 'bg-white border border-gray-200 shadow-lg',
        'glass' => 'bg-white/10 backdrop-blur-xl border border-white/20',
        'glass-dark' => 'bg-navy-600/80 backdrop-blur-xl border border-white/10',
        'gradient' => 'bg-gradient-to-br from-white to-gray-50 border border-gray-100',
        'accent' => 'bg-gradient-to-br from-accent-50 to-teal-50 border border-accent-100',
        'dark' => 'bg-navy-600 border border-navy-500',
    ];
    
    $hoverClasses = $hover ? 'hover:shadow-2xl hover:-translate-y-2 hover:border-accent-500/50' : '';
    
    $paddings = [
        'sm' => 'p-4',
        'md' => 'p-6',
        'lg' => 'p-8',
        'xl' => 'p-10',
    ];
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['default']) . ' ' . $hoverClasses . ' ' . ($paddings[$padding] ?? $paddings['lg']);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
