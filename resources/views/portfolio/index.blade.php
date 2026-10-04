@extends('layouts.public')

@section('title', 'Portfolio | Galaw Automations')
@section('meta_description', 'Browse selected Galaw Automations projects and sample portfolio entries.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Portfolio</div>
        <h1 class="page-title">Selected work</h1>
        <p class="page-lead">Published projects appear here. Sample entries are clearly labeled until real client work is ready to share.</p>
    </div>
</section>

<section class="site-shell py-16">
    @if ($projects->isEmpty())
        <div class="border border-dashed border-line p-10 text-center text-ink-muted">
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
