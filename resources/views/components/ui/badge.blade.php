@props(['tone' => 'default'])

@php
    $classes = match ($tone) {
        'accent' => 'bg-accent/10 text-accent',
        'success' => 'bg-emerald-50 text-emerald-700',
        'warn' => 'bg-amber-50 text-amber-700',
        default => 'bg-mist text-ink/70',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {$classes}"]) }}>
    {{ $slot }}
</span>
