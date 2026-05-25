@props(['number' => null])

<div {{ $attributes->merge(['class' => 'type-eyebrow inline-flex items-center gap-3']) }}>
    @if($number)
        <span class="text-[color:var(--color-accent)]">{{ $number }}</span>
        <span class="w-6 h-px bg-[color:var(--color-line-strong)]"></span>
    @endif
    <span>{{ $slot }}</span>
</div>
