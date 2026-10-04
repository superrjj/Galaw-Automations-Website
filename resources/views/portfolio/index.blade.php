@extends('layouts.public')

@section('title', 'Portfolio | Galaw Automations')
@section('meta_description', 'Browse selected Galaw Automations projects and sample portfolio entries.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Portfolio</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">Selected work</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">Published projects appear here. Sample entries are clearly labeled until real client work is ready to share.</p>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16">
    @if ($projects->isEmpty())
        <div class="rounded-2xl border border-dashed border-line bg-white p-10 text-center text-ink/60">
            No published portfolio projects yet.
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <x-portfolio-card :project="$project" />
            @endforeach
        </div>
        <div class="mt-10">{{ $projects->links() }}</div>
    @endif
</section>
@endsection
