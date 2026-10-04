@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-md px-5 py-2.5 text-sm font-semibold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent disabled:cursor-not-allowed disabled:opacity-60';

    $classes = match ($variant) {
        'secondary' => $base.' border border-ink bg-transparent text-ink hover:bg-ink hover:text-white',
        'ghost' => 'inline-flex items-center justify-center gap-2 rounded-md px-3 py-2 text-sm font-semibold text-ink-muted transition hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent',
        'dark' => $base.' bg-paper text-ink hover:bg-accent-soft',
        default => $base.' bg-accent text-white hover:bg-accent-dark',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
