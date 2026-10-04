@extends('layouts.public')

@section('title', 'Services | Galaw Automations')
@section('meta_description', 'Explore Galaw Automations services including website development, mobile apps, custom software, AI solutions, API integration, cloud, and automation.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Services</div>
        <h1 class="page-title">Software development services for growing businesses</h1>
        <p class="page-lead">Choose a service to learn more, then request a project with that service already selected.</p>
    </div>
</section>

<section class="site-shell py-12 sm:py-16">
    <div class="grid gap-px border border-line bg-line sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($services as $service)
            <x-service-card :service="$service" />
        @empty
            <p class="col-span-full bg-paper p-8 text-sm text-ink-muted">No services have been published yet.</p>
        @endforelse
    </div>
</section>
@endsection
