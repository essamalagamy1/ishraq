@props([
    'as' => 'h2',
    'class' => 'type-h1',
])

@php
    $tag = $as;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $class, 'data-split-lines' => true]) }}>
    {{ $slot }}
</{{ $tag }}>

