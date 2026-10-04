@props(['project'])

<a href="{{ route('portfolio.show', $project) }}" class="group block overflow-hidden rounded-2xl border border-line bg-white transition hover:border-accent/40 hover:shadow-sm">
    <div class="aspect-[16/10] bg-gradient-to-br from-ink via-ink-soft to-accent/70">
        @if ($project->cover_image)
            <img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover">
        @endif
    </div>
    <div class="p-5">
        @if ($project->category)
            <div class="text-xs font-medium uppercase tracking-wide text-accent">{{ $project->category }}</div>
        @endif
        <h3 class="mt-2 text-lg font-semibold text-ink group-hover:text-accent">{{ $project->title }}</h3>
        <p class="mt-2 text-sm leading-relaxed text-ink/65">{{ $project->short_description }}</p>
        @if (!empty($project->technologies))
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach (array_slice($project->technologies, 0, 4) as $tech)
                    <x-technology-badge>{{ $tech }}</x-technology-badge>
                @endforeach
            </div>
        @endif
    </div>
</a>
