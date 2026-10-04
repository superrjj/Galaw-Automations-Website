@props(['project'])

<a
    href="{{ route('portfolio.show', $project) }}"
    {{ $attributes->merge(['class' => 'group block border border-line bg-paper transition hover:border-ink focus-visible:border-accent']) }}
>
    <div class="aspect-[16/10] overflow-hidden bg-ink">
        @if ($project->cover_image)
            <img
                src="{{ asset('storage/'.$project->cover_image) }}"
                alt=""
                class="h-full w-full object-cover transition group-hover:opacity-90"
                loading="lazy"
            >
        @else
            <div class="flex h-full items-end p-5">
                <span class="text-xs font-semibold uppercase tracking-[0.16em] text-accent">{{ $project->category ?: 'Project' }}</span>
            </div>
        @endif
    </div>
    <div class="p-5">
        @if ($project->category)
            <div class="text-[11px] font-semibold uppercase tracking-[0.16em] text-accent">{{ $project->category }}</div>
        @endif
        <h3 class="mt-2 text-lg font-semibold text-ink group-hover:text-accent">{{ $project->title }}</h3>
        <p class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $project->short_description }}</p>
        @if (!empty($project->technologies))
            <p class="mt-3 text-xs text-ink-muted">{{ implode(' · ', array_slice($project->technologies, 0, 4)) }}</p>
        @endif
    </div>
</a>
