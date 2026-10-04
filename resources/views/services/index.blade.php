@extends('layouts.public')

@section('title', 'Services | Galaw Automations')
@section('meta_description', 'Explore Galaw Automations services including website development, mobile apps, custom software, AI solutions, API integration, cloud, and automation.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Services</div>
        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-ink">Software development services for growing businesses</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">Choose a service to learn more, then request a project with that service already selected.</p>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
            <x-service-card :service="$service" />
        @endforeach
    </div>
</section>
@endsection
