@extends('layouts.public')

@section('title', 'Process | Galaw Automations')
@section('meta_description', 'Learn how Galaw Automations approaches discovery, planning, design, development, testing, deployment, and maintenance.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Process</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">How we work with clients</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">A straightforward process designed to keep stakeholders aligned from the first conversation to ongoing support.</p>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16">
    <div class="space-y-4">
        @foreach ($stages as $index => $stage)
            <div class="grid gap-4 rounded-2xl border border-line bg-white p-6 md:grid-cols-[80px_1fr] md:items-start">
                <div class="text-sm font-semibold text-accent">0{{ $index + 1 }}</div>
                <div>
                    <h2 class="text-xl font-semibold text-ink">{{ $stage['title'] }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-ink/70">{{ $stage['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-10">
        <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
    </div>
</section>
@endsection
