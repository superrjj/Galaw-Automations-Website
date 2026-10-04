@extends('layouts.public')

@section('title', 'Technologies | Galaw Automations')
@section('meta_description', 'Technologies used by Galaw Automations across frontend, backend, mobile, database, AI, and infrastructure.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Technologies</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">Our technology stack</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">These technologies are managed from the admin panel and reflect the tools we are prepared to use on client projects.</p>
    </div>
</section>

<section class="mx-auto max-w-6xl space-y-10 px-4 py-16">
    @forelse ($groupedTechnologies as $category => $items)
        <div>
            <h2 class="text-xl font-semibold">
                {{ \App\Enums\TechnologyCategory::tryFrom($category)?->label() ?? ucfirst($category) }}
            </h2>
            <div class="mt-4 flex flex-wrap gap-3">
                @foreach ($items as $technology)
                    <div class="rounded-xl border border-line bg-white px-4 py-3 text-sm font-medium text-ink">
                        {{ $technology->name }}
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-dashed border-line bg-white p-10 text-center text-ink/60">
            No technologies have been published yet.
        </div>
    @endforelse
</section>
@endsection
