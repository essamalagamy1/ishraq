@props([
    'badge' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center',
    'dark' => false,
])

@php
    $alignClasses = [
        'center' => 'text-center',
        'left' => 'text-right', // RTL
        'right' => 'text-left', // RTL
    ];
    
    $titleColor = $dark ? 'text-white' : 'text-gray-900';
    $subtitleColor = $dark ? 'text-gray-300' : 'text-gray-600';
    $badgeStyle = $dark 
        ? 'bg-gradient-to-r from-accent-400 to-teal-400 text-navy-600' 
        : 'bg-gradient-to-r from-accent-500 to-teal-500 text-white';
@endphp

<div class="{{ $alignClasses[$align] ?? $alignClasses['center'] }} mb-16">
    @if($badge)
        <div class="inline-block mb-4">
            <span class="{{ $badgeStyle }} text-sm font-bold px-5 py-2 rounded-full">
                {{ $badge }}
            </span>
        </div>
    @endif
    
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-black {{ $titleColor }} mb-6">
        {!! $title !!}
    </h2>
    
    @if($subtitle)
        <p class="text-xl md:text-2xl {{ $subtitleColor }} max-w-3xl mx-auto leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>
