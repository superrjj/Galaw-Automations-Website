@extends('layouts.public')

@section('title', $project->title.' | Portfolio')
@section('meta_description', $project->short_description)

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        @if ($project->category)
            <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">{{ $project->category }}</div>
        @endif
        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-ink">{{ $project->title }}</h1>
        <p class="mt-5 max-w-3xl text-lg text-ink/70">{{ $project->short_description }}</p>
        @if ($project->project_type)
            <div class="mt-4"><x-ui.badge>{{ $project->project_type }}</x-ui.badge></div>
        @endif
    </div>
</section>

<section class="mx-auto grid max-w-6xl gap-10 px-4 py-16 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-8">
        <div class="overflow-hidden rounded-2xl border border-line bg-gradient-to-br from-ink via-ink-soft to-accent/70 aspect-[16/9]">
            @if ($project->cover_image)
                <img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover">
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-semibold">Overview</h2>
            <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $project->description }}</p>
        </div>

        @if ($project->problem)
            <div>
                <h2 class="text-2xl font-semibold">Problem</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $project->problem }}</p>
            </div>
        @endif

        @if ($project->solution)
            <div>
                <h2 class="text-2xl font-semibold">Solution</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $project->solution }}</p>
            </div>
        @endif

        @if (!empty($project->features))
            <div>
                <h2 class="text-2xl font-semibold">Features</h2>
                <ul class="mt-3 space-y-2 text-sm text-ink/70">
                    @foreach ($project->features as $feature)
                        <li class="flex gap-2"><x-icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($project->results)
            <div>
                <h2 class="text-2xl font-semibold">Results</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $project->results }}</p>
            </div>
        @endif
    </div>

    <aside class="space-y-6">
        @if (!empty($project->technologies))
            <div class="rounded-2xl border border-line bg-white p-6">
                <h3 class="font-semibold">Technologies</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($project->technologies as $tech)
                        <x-technology-badge>{{ $tech }}</x-technology-badge>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($project->project_url)
            <div class="rounded-2xl border border-line bg-white p-6">
                <h3 class="font-semibold">Project link</h3>
                <a href="{{ $project->project_url }}" class="mt-3 inline-block text-sm text-accent hover:underline" target="_blank" rel="noopener noreferrer">Visit project</a>
            </div>
        @endif

        <div class="rounded-2xl border border-line bg-ink p-6 text-white">
            <h3 class="text-lg font-semibold">Need something similar?</h3>
            <p class="mt-2 text-sm text-white/70">Share your requirements and we’ll review your inquiry.</p>
            <div class="mt-5">
                <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
            </div>
        </div>
    </aside>
</section>
@endsection
