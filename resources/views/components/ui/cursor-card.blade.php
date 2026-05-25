@props([
    'href' => null,
])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'cursor-card']) }}>
        {{ $slot }}
    </a>
@else
    <div {{ $attributes->merge(['class' => 'cursor-card']) }}>
        {{ $slot }}
    </div>
@endif

