@props(['service'])

<a
    href="{{ route('services.show', $service) }}"
    {{ $attributes->merge(['class' => 'group block bg-paper p-5 transition hover:bg-paper-soft focus-visible:relative focus-visible:z-10 sm:p-6']) }}
>
    <div class="flex items-start justify-between gap-4">
        <h3 class="text-base font-semibold text-ink group-hover:text-accent sm:text-lg">{{ $service->name }}</h3>
        <x-icon name="arrow-right" class="mt-1 h-4 w-4 shrink-0 text-ink-muted group-hover:text-accent" aria-hidden="true" />
    </div>
    <p class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $service->short_description }}</p>
</a>
