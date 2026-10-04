@props([
    'eyebrow' => null,
    'title',
    'description' => null,
])

<div {{ $attributes->class('max-w-2xl')->except('id') }}>
    @if ($eyebrow)
        <div class="page-kicker">{{ $eyebrow }}</div>
    @endif
    <h2 @if ($attributes->get('id')) id="{{ $attributes->get('id') }}" @endif class="mt-3 text-2xl font-semibold tracking-tight text-ink sm:text-3xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-3 text-base leading-relaxed text-ink-muted">{{ $description }}</p>
    @endif
</div>
