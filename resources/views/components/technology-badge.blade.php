@props([
    'technology' => null,
    'icon' => null,
])

@php
    $label = $technology?->name ?? trim((string) $slot);
    $iconKey = $icon
        ?? $technology?->icon
        ?? $technology?->slug
        ?? \Illuminate\Support\Str::slug($label);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 border border-line bg-paper px-3 py-2 text-xs font-medium text-ink transition hover:border-ink/30']) }}>
    <x-technology-icon :name="$iconKey" class="h-4 w-4 text-ink" />
    <span>{{ $label }}</span>
</span>
