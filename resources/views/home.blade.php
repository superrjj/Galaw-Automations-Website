@extends('layouts.public')

@section('title', ($settings['seo_title'] ?? 'Galaw Automations | Software Solutions & Automation'))
@section('meta_description', ($settings['seo_description'] ?? 'Galaw Automations builds websites, mobile apps, business systems, AI solutions, integrations, and automation tools for businesses.'))

@section('content')
<section class="border-b border-line bg-paper">
    <div class="site-shell py-16 sm:py-20 lg:py-24">
        <div class="max-w-2xl">
            <img
                src="{{ asset('logo-galaw-automations-no-bg.png') }}"
                alt="Galaw Automations"
                class="h-16 w-auto sm:h-20"
            >

            <h1 class="mt-8 text-3xl font-semibold tracking-tight text-ink text-balance sm:text-4xl sm:leading-tight">
                {{ $settings['tagline'] ?? 'Software solutions built around your business.' }}
            </h1>

            <p class="mt-5 max-w-xl text-base leading-relaxed text-ink-muted">
                We design and build websites, mobile apps, business systems, AI features, integrations, and automation tools for companies that need reliable software.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button href="{{ route('request-service') }}">
                    Start a Project
                    <x-icon name="arrow-right" class="h-4 w-4" />
                </x-ui.button>
                <x-ui.button href="{{ route('services.index') }}" variant="secondary">View Our Services</x-ui.button>
            </div>
        </div>
    </div>
</section>

<section class="site-shell py-16 sm:py-20" aria-labelledby="services-heading">
    <x-ui.section-heading
        id="services-heading"
        eyebrow="Services"
        title="What we build"
        description="Practical software for real business workflows — from public websites to internal systems."
    />
    <div class="mt-10 grid gap-px border border-line bg-line sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($services as $service)
            <x-service-card :service="$service" />
        @empty
            <p class="col-span-full bg-paper p-8 text-sm text-ink-muted">Services will appear here once published.</p>
        @endforelse
    </div>
</section>

<section class="border-y border-line bg-paper-soft" aria-labelledby="why-heading">
    <div class="site-shell py-16 sm:py-20">
        <x-ui.section-heading
            id="why-heading"
            eyebrow="Why Galaw Automations"
            title="Built for clarity and long-term use"
            description="We prioritize maintainable systems, clear communication, and outcomes your team can operate."
        />
        <div class="mt-10 divide-y divide-line border-y border-line">
            @foreach ([
                ['Custom solutions', 'Software shaped around your process, users, and goals.'],
                ['Practical technology', 'Stacks chosen for fit, maintainability, and ownership.'],
                ['Clear delivery', 'Priorities, timelines, and communication kept understandable.'],
                ['Ongoing support', 'Improvements after launch when your business needs them.'],
            ] as $index => [$title, $copy])
                <div class="grid gap-2 py-5 sm:grid-cols-[4rem_1fr] sm:gap-6">
                    <div class="text-sm font-semibold text-accent">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div>
                        <h3 class="text-base font-semibold text-ink">{{ $title }}</h3>
                        <p class="mt-1 text-sm leading-relaxed text-ink-muted">{{ $copy }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if ($featuredProjects->isNotEmpty())
<section class="site-shell py-16 sm:py-20" aria-labelledby="portfolio-heading">
    <div class="flex flex-wrap items-end justify-between gap-6">
        <x-ui.section-heading
            id="portfolio-heading"
            eyebrow="Selected work"
            title="Featured projects"
            description="Published work and sample entries available for review."
        />
        <a href="{{ route('portfolio.index') }}" class="link-arrow">
            View portfolio
            <x-icon name="arrow-right" class="h-4 w-4" />
        </a>
    </div>
    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($featuredProjects as $project)
            <x-portfolio-card :project="$project" />
        @endforeach
    </div>
</section>
@endif

@if ($technologies->isNotEmpty())
<section class="border-y border-line bg-paper-soft" aria-labelledby="tech-heading">
    <div class="site-shell py-16 sm:py-20">
        <x-ui.section-heading
            id="tech-heading"
            eyebrow="Capabilities"
            title="Technologies we work with"
            description="Tools we use to design, build, integrate, and maintain software systems."
        />
        <ul class="mt-8 flex flex-wrap gap-2" role="list">
            @foreach ($technologies->take(16) as $technology)
                <li><x-technology-badge :technology="$technology" /></li>
            @endforeach
        </ul>
        <div class="mt-6">
            <a href="{{ route('technologies') }}" class="link-arrow">
                View all technologies
                <x-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>
    </div>
</section>
@endif

<section class="site-shell py-16 sm:py-20" aria-labelledby="process-heading">
    <x-ui.section-heading
        id="process-heading"
        eyebrow="Process"
        title="From idea to launch"
        description="A straightforward path that keeps stakeholders aligned."
    />
    <ol class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        @foreach (['Discovery', 'Planning', 'Design', 'Development', 'Testing', 'Deployment', 'Support'] as $index => $stage)
            <li class="flex items-baseline gap-3 border-l-2 border-accent/40 pl-3 text-sm">
                <span class="font-semibold text-accent">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-medium text-ink">{{ $stage }}</span>
            </li>
        @endforeach
    </ol>
    <div class="mt-6">
        <a href="{{ route('process') }}" class="link-arrow">
            Explore the full process
            <x-icon name="arrow-right" class="h-4 w-4" />
        </a>
    </div>
</section>

<section class="border-t border-line bg-ink text-white">
    <div class="site-shell flex flex-col items-start justify-between gap-8 py-14 md:flex-row md:items-center">
        <div class="max-w-xl">
            <h2 class="text-2xl font-semibold tracking-tight sm:text-3xl">Have a project in mind?</h2>
            <p class="mt-3 text-base leading-relaxed text-white/65">Tell us what you want to build. We’ll review your inquiry and follow up with next steps.</p>
        </div>
        <x-ui.button href="{{ route('request-service') }}" variant="dark">
            Start a Project
            <x-icon name="arrow-right" class="h-4 w-4" />
        </x-ui.button>
    </div>
</section>
@endsection
