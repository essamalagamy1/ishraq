@props([
    'id' => null,
    'surface' => 'canvas', // canvas | surface | inset
    'narrow' => false,
    'padded' => true,
])

@php
    $bg = match($surface) {
        'surface' => 'background: var(--color-surface);',
        'inset'   => 'background: var(--color-surface-inset);',
        default   => '',
    };
    $container = $narrow ? 'container-narrow' : 'container-page';
@endphp

<section
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => ($padded ? 'section-pad ' : '') . 'relative']) }}
    @if($bg) style="{{ $bg }}" @endif
>
    <div class="{{ $container }}">
        {{ $slot }}
    </div>
</section>
