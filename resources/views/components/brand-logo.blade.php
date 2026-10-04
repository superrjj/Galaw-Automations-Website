@props([
    'variant' => 'full', // full | mark | light
    'class' => '',
])

@php
    $height = match ($variant) {
        'mark' => 'h-11',
        'light' => 'h-10 sm:h-12',
        default => 'h-10 sm:h-12',
    };
@endphp

<img
    src="{{ asset('logo-galaw-automations-no-bg.png') }}"
    alt="Galaw Automations"
    {{ $attributes->merge(['class' => trim("$height w-auto object-contain $class")]) }}
>
