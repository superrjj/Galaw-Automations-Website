@extends('layouts.public')

@section('title', ($settings['seo_title'] ?? 'Galaw Automations | Software Solutions & Automation'))
@section('meta_description', ($settings['seo_description'] ?? 'Galaw Automations builds websites, mobile apps, business systems, AI solutions, integrations, and automation tools for businesses.'))

@section('content')
<section class="relative overflow-hidden border-b border-line">
    <div class="absolute inset-0 bg-gradient-to-br from-foam via-mist to-accent/10"></div>
    <div class="hero-grid absolute inset-0 opacity-70"></div>
    <div class="relative mx-auto grid max-w-6xl gap-10 px-4 py-20 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:py-28">
        <div class="fade-up">
            <div class="text-sm font-semibold uppercase tracking-[0.22em] text-accent">Galaw Automations</div>
            <h1 class="mt-4 max-w-xl text-balance font-display text-4xl font-semibold tracking-tight text-ink sm:text-5xl lg:text-6xl">
                {{ $settings['tagline'] ?? 'Build Smarter. Automate Better.' }}
            </h1>
            <p class="mt-6 max-w-xl text-lg leading-relaxed text-ink/70">
                We create websites, mobile apps, business systems, AI solutions, integrations, and automation tools that help businesses work with more clarity and less friction.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
                <x-ui.button href="{{ route('services.index') }}" variant="secondary">View Our Services</x-ui.button>
            </div>
        </div>
        <div class="fade-up-delay relative hidden min-h-[320px] lg:block">
            <div class="absolute inset-4 rounded-[2rem] bg-ink shadow-2xl"></div>
            <div class="absolute inset-0 translate-x-4 translate-y-4 rounded-[2rem] border border-white/20 bg-gradient-to-br from-accent to-ink-soft opacity-90"></div>
            <div class="absolute inset-8 rounded-[1.5rem] border border-white/10 bg-ink/80 p-8 text-white">
                <div class="text-sm uppercase tracking-[0.2em] text-white/50">Software Solutions</div>
                <div class="mt-6 space-y-4 text-sm text-white/80">
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">Websites & web applications</div>
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">Mobile app development</div>
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3">AI, APIs & automation</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <x-ui.section-heading
        eyebrow="Services"
        title="What we build"
        description="From public websites to internal systems and AI-assisted workflows, we deliver practical software for real business needs."
    />
    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $service)
            <x-service-card :service="$service" />
        @endforeach
    </div>
</section>

<section class="border-y border-line bg-white">
    <div class="mx-auto max-w-6xl px-4 py-20">
        <x-ui.section-heading
            eyebrow="Why Galaw"
            title="Built for clarity, scale, and long-term support"
            description="We focus on maintainable architecture and business outcomes — not unnecessary complexity."
        />
        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['Custom solutions', 'Software shaped around your process, users, and goals.'],
                ['Modern technology', 'Practical stacks that are maintainable and production-ready.'],
                ['Scalable architecture', 'Foundations that can grow with your business.'],
                ['Business-focused development', 'Clear priorities, clear communication, clear delivery.'],
                ['Automation', 'Reduce repetitive work with reliable workflows and integrations.'],
                ['Long-term support', 'Continued improvements after launch when you need them.'],
            ] as [$title, $copy])
                <div class="rounded-2xl border border-line p-6">
                    <h3 class="text-lg font-semibold text-ink">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink/65">{{ $copy }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if ($featuredProjects->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <x-ui.section-heading
            eyebrow="Portfolio"
            title="Featured projects"
            description="Selected work and sample portfolio entries. Replace sample items with verified projects when ready."
        />
        <x-ui.button href="{{ route('portfolio.index') }}" variant="secondary">View portfolio</x-ui.button>
    </div>
    <div class="mt-10 grid gap-6 lg:grid-cols-3">
        @foreach ($featuredProjects as $project)
            <x-portfolio-card :project="$project" />
        @endforeach
    </div>
</section>
@endif

<section class="border-y border-line bg-mist/60">
    <div class="mx-auto max-w-6xl px-4 py-20">
        <x-ui.section-heading
            eyebrow="Process"
            title="A clear path from idea to launch"
            description="We keep the process understandable for non-technical stakeholders while staying rigorous in delivery."
        />
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (['Discovery', 'Planning', 'Design', 'Development', 'Testing', 'Deployment', 'Support'] as $index => $stage)
                <div class="rounded-2xl border border-line bg-white p-5">
                    <div class="text-sm font-medium text-accent">0{{ $index + 1 }}</div>
                    <div class="mt-2 text-base font-semibold text-ink">{{ $stage }}</div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            <a href="{{ route('process') }}" class="text-sm font-medium text-accent hover:underline">Explore the full process</a>
        </div>
    </div>
</section>

@if ($technologies->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 py-20">
    <x-ui.section-heading
        eyebrow="Technologies"
        title="Tools we work with"
        description="A curated set of technologies we use to design, build, integrate, and maintain software systems."
    />
    <div class="mt-8 flex flex-wrap gap-3">
        @foreach ($technologies->take(16) as $technology)
            <x-technology-badge>{{ $technology->name }}</x-technology-badge>
        @endforeach
    </div>
    <div class="mt-8">
        <a href="{{ route('technologies') }}" class="text-sm font-medium text-accent hover:underline">View all technologies</a>
    </div>
</section>
@endif

<section class="border-t border-line bg-ink text-white">
    <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-4 py-16 md:flex-row md:items-center">
        <div>
            <h2 class="text-3xl font-semibold tracking-tight">Have a project in mind?</h2>
            <p class="mt-3 max-w-xl text-white/70">Tell us what you want to build. We’ll review your inquiry and follow up with next steps.</p>
        </div>
        <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
    </div>
</section>
@endsection
