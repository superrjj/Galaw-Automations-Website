@props([
    'eyebrow' => null,
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'max-w-2xl']) }}>
    @if ($eyebrow)
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">{{ $eyebrow }}</div>
    @endif
    <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-ink sm:text-4xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-4 text-base leading-relaxed text-ink/70">{{ $description }}</p>
    @endif
</div>
