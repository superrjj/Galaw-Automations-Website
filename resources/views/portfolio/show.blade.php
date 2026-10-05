@extends('layouts.public')

@section('title', $project->title.' | Portfolio')
@section('meta_description', $project->short_description)

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        @if ($project->category)
            <div class="page-kicker">{{ $project->category }}</div>
        @endif
        <h1 class="page-title">{{ $project->title }}</h1>
        <p class="page-lead">{{ $project->short_description }}</p>
        @if ($project->project_type)
            <div class="mt-4"><x-ui.badge>{{ $project->project_type }}</x-ui.badge></div>
        @endif
    </div>
</section>

<section class="site-shell grid gap-12 py-16 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-8">
        <div class="aspect-[16/9] overflow-hidden border border-line bg-ink">
            @if ($project->cover_image)
                <img src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover">
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-ink">Overview</h2>
            <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $project->description }}</p>
        </div>

        @if ($project->problem)
            <div>
                <h2 class="text-2xl font-semibold text-ink">Problem</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $project->problem }}</p>
            </div>
        @endif

        @if ($project->solution)
            <div>
                <h2 class="text-2xl font-semibold text-ink">Solution</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $project->solution }}</p>
            </div>
        @endif

        @if (!empty($project->features))
            <div>
                <h2 class="text-2xl font-semibold text-ink">Features</h2>
                <ul class="mt-3 space-y-2 text-sm text-ink-muted">
                    @foreach ($project->features as $feature)
                        <li class="flex gap-2"><x-ui.icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($project->results)
            <div>
                <h2 class="text-2xl font-semibold text-ink">Results</h2>
                <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $project->results }}</p>
            </div>
        @endif
    </div>

    <aside class="space-y-6">
        @if (!empty($project->technologies))
            <div class="border border-line bg-paper p-6">
                <h3 class="font-semibold text-ink">Technologies</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($project->technologies as $tech)
                        <x-technology-badge :icon="\Illuminate\Support\Str::slug($tech)">{{ $tech }}</x-technology-badge>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($project->project_url)
            <div class="border border-line bg-paper p-6">
                <h3 class="font-semibold text-ink">Project link</h3>
                <a href="{{ $project->project_url }}" class="mt-3 inline-block text-sm text-accent hover:underline" target="_blank" rel="noopener noreferrer">Visit project</a>
            </div>
        @endif

        <div class="border border-ink bg-ink p-6 text-white">
            <h3 class="text-lg font-semibold">Need something similar?</h3>
            <p class="mt-2 text-sm text-white/60">Share your requirements and we’ll review your inquiry.</p>
            <div class="mt-5">
                <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
            </div>
        </div>
    </aside>
</section>
@endsection
