@props([
    'variant' => 'full', // full | mark | light
    'class' => '',
])

@php
    // Cropped asset removes empty PNG padding so height maps to the real mark.
    $height = match ($variant) {
        'mark' => 'h-12 sm:h-14',
        'light' => 'h-12 sm:h-14',
        default => 'h-12 sm:h-14',
    };
@endphp

<img
    src="{{ asset('logo-galaw-automations-cropped.png') }}"
    alt="Galaw Automations"
    {{ $attributes->merge(['class' => trim("$height w-auto object-contain object-left $class")]) }}
>
