@props([
    'items' => [],
    'muted' => true,
])

@php
    $textClass = $muted ? 'text-ink-subtle' : 'text-ink';
@endphp

<div class="marquee" {{ $attributes }}>
    <div class="marquee__track">
        @foreach($items as $item)
            <span class="type-eyebrow {{ $textClass }} flex items-center gap-12">
                {{ $item }}
                <span class="w-1 h-1 rounded-full bg-line-bold"></span>
            </span>
        @endforeach
    </div>
    <div class="marquee__track" aria-hidden="true">
        @foreach($items as $item)
            <span class="type-eyebrow {{ $textClass }} flex items-center gap-12">
                {{ $item }}
                <span class="w-1 h-1 rounded-full bg-line-bold"></span>
            </span>
        @endforeach
    </div>
</div>

