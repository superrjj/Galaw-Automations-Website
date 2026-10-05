@props([
    'name' => null,
])

@php
    $component = \App\Support\TechnologySimpleIcon::component($name);
@endphp

@if ($component)
    <x-dynamic-component
        :component="$component"
        {{ $attributes->merge(['class' => 'h-4 w-4 shrink-0 fill-current']) }}
        aria-hidden="true"
    />
@else
    {{-- Fallback when Simple Icons has no brand mark (e.g. OpenAI). --}}
    <svg
        {{ $attributes->merge(['class' => 'h-4 w-4 shrink-0']) }}
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        aria-hidden="true"
    >
        <path d="M12 3.2c1.3-.8 3-.8 4.3 0l.2.1a4.2 4.2 0 0 1 2 4.5l-.1.3a4.2 4.2 0 0 1 1.4 4.7l-.1.3a4.2 4.2 0 0 1-3.4 2.7h-.3a4.2 4.2 0 0 1-4.3 2.1l-.3-.1a4.2 4.2 0 0 1-4.3 0l-.2-.1a4.2 4.2 0 0 1-2-4.5l.1-.3a4.2 4.2 0 0 1-1.4-4.7l.1-.3A4.2 4.2 0 0 1 7.4 5h.3A4.2 4.2 0 0 1 12 3.2Z" />
    </svg>
@endif
