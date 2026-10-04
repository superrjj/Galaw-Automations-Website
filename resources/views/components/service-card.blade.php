@props(['service'])

<a href="{{ route('services.show', $service) }}" class="group block rounded-2xl border border-line bg-white p-6 transition hover:border-accent/40 hover:shadow-sm">
    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-mist text-accent">
        <x-icon :name="$service->icon ?: 'code'" class="h-5 w-5" />
    </div>
    <h3 class="mt-5 text-lg font-semibold text-ink group-hover:text-accent">{{ $service->name }}</h3>
    <p class="mt-2 text-sm leading-relaxed text-ink/65">{{ $service->short_description }}</p>
    <div class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-accent">
        Learn more <x-icon name="arrow-right" class="h-4 w-4" />
    </div>
</a>
