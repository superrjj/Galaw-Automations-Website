@extends('layouts.public')

@section('title', 'Process | Galaw Automations')
@section('meta_description', 'Learn how Galaw Automations approaches discovery, planning, design, development, testing, deployment, and maintenance.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Process</div>
        <h1 class="page-title">How we work with clients</h1>
        <p class="page-lead">A straightforward process designed to keep stakeholders aligned from the first conversation to ongoing support.</p>
    </div>
</section>

<section class="site-shell py-16">
    <div class="divide-y divide-line border-y border-line">
        @foreach ($stages as $index => $stage)
            <div class="grid gap-3 py-8 md:grid-cols-[5rem_1fr] md:gap-8">
                <div class="text-sm font-semibold text-accent">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div>
                    <h2 class="text-xl font-semibold text-ink">{{ $stage['title'] }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $stage['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-10">
        <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
    </div>
</section>
@endsection
