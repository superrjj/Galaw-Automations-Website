@extends('layouts.public')

@section('title', 'Technologies | Galaw Automations')
@section('meta_description', 'Technologies used by Galaw Automations across frontend, backend, mobile, database, AI, and infrastructure.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Technologies</div>
        <h1 class="page-title">Our technology stack</h1>
        <p class="page-lead">These technologies are managed from the admin panel and reflect the tools we are prepared to use on client projects.</p>
    </div>
</section>

<section class="site-shell space-y-12 py-16">
    @forelse ($groupedTechnologies as $category => $items)
        <div>
            <h2 class="text-xl font-semibold text-ink">
                {{ \App\Enums\TechnologyCategory::tryFrom($category)?->label() ?? ucfirst($category) }}
            </h2>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($items as $technology)
                    <x-technology-badge>{{ $technology->name }}</x-technology-badge>
                @endforeach
            </div>
        </div>
    @empty
        <div class="border border-dashed border-line p-10 text-center text-ink-muted">
            No technologies have been published yet.
        </div>
    @endforelse
</section>
@endsection
