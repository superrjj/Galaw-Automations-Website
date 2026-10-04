@props(['tone' => 'default'])

@php
    $classes = match ($tone) {
        'accent' => 'border-accent/40 bg-accent-soft text-accent-dark',
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
        'warn' => 'border-amber-200 bg-amber-50 text-amber-800',
        'info' => 'border-sky-200 bg-sky-50 text-sky-800',
        'danger' => 'border-red-200 bg-red-50 text-red-800',
        'muted' => 'border-line bg-paper-soft text-ink-muted',
        default => 'border-line bg-paper-soft text-ink',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center border px-2 py-0.5 text-xs font-medium {$classes}"]) }}>
    {{ $slot }}
</span>
