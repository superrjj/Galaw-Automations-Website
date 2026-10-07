@extends('layouts.public')

@section('title', ($settings['seo_title'] ?? 'Galaw Automations | Software Solutions & Automation'))
@section('meta_description', ($settings['seo_description'] ?? 'Galaw Automations builds websites, mobile apps, business systems, AI solutions, integrations, and automation tools for businesses.'))

@section('content')
{{-- Hero matching agency system diagram mockup --}}
<section class="hero-grid border-b border-line">
    <div class="site-shell grid items-center gap-10 py-12 lg:grid-cols-2 lg:gap-6 lg:py-14 xl:gap-10">
        <div class="max-w-xl">
            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-accent">
                Your idea × our code = real solutions
            </p>

            <h1 class="mt-4 text-[2.75rem] font-bold tracking-tight text-ink text-balance sm:text-5xl sm:leading-[1.05] lg:text-[3.25rem]">
                <span class="block">Build Smarter.</span>
                <span class="mt-1 block text-accent">Automate Better.</span>
            </h1>

            <p class="mt-5 max-w-md text-[15px] leading-relaxed text-ink-muted sm:text-base">
                We design and build websites, mobile apps, business systems, AI features, integrations, and automation tools for companies that need reliable software.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button href="{{ route('request-service') }}">
                    Start a Project
                    <x-ui.icon name="arrow-right" class="h-4 w-4" />
                </x-ui.button>
                <x-ui.button href="{{ route('services.index') }}" variant="secondary">View Our Services</x-ui.button>
            </div>
        </div>

        <x-home.hero-visual />
    </div>
</section>

@php
    $svg = fn (string $body) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $body . '</svg>';

    // icon + fallback tags, picked by keywords in the service title/slug (tags are used only when the service has none of its own)
    $kinds = [
        'website'  => [$svg('<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>'), ['Responsive', 'Fast', 'Secure']],
        'mobile'   => [$svg('<rect x="6" y="2" width="12" height="20" rx="2.5"/><path d="M11 18h2"/>'), ['Native', 'Cross-platform', 'Scalable']],
        'custom'   => [$svg('<path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16"/>'), ['Efficient', 'Flexible', 'Long-term support']],
        'business' => [$svg('<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>'), ['Streamlined', 'Organized', 'Results-driven']],
        'ai'       => [$svg('<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M15 2v2M15 20v2M2 15h2M2 9h2M20 15h2M20 9h2M9 2v2M9 20v2"/>'), ['Smart', 'Automated', 'Future-ready']],
        'api'      => [$svg('<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9z"/>'), ['Connected', 'Secure', 'Reliable']],
    ];
    $fallbackKind = [$svg('<path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/>'), []];

    $kindFor = function ($service) use ($kinds, $fallbackKind) {
        $haystack = strtolower(($service->slug ?? '') . ' ' . ($service->title ?? $service->name ?? ''));
        foreach ($kinds as $word => $kind) {
            if (preg_match('/\b' . $word . '\b/', $haystack)) return $kind;
        }
        return $fallbackKind;
    };
@endphp

<section class="site-shell py-16 sm:py-20" aria-labelledby="services-heading">
    <style>
        /* scoped to this section */
        .svc-grid { display: grid; gap: 1.25rem; margin: 2.5rem 0 0; padding: 0; list-style: none; }
        @media (min-width: 640px) { .svc-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 1024px) { .svc-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }

        /* filled card, no outline */
        .svc-card { position: relative; display: flex; flex-direction: column; padding: 1.75rem; border-radius: .5rem; }

        .svc-top { display: flex; align-items: flex-start; justify-content: space-between; }
        .svc-icon { display: block; width: 1.875rem; height: 1.875rem; }
        .svc-icon svg { display: block; width: 100%; height: 100%; }

        .svc-title { margin: 1.25rem 0 0; font-size: 1.125rem; font-weight: 600; line-height: 1.35; }
        /* the whole card is clickable through the title link */
        .svc-title a { color: inherit; text-decoration: none; }
        .svc-title a::after { content: ""; position: absolute; inset: 0; border-radius: .5rem; }
        .svc-title a:focus-visible::after { outline: 2px solid currentColor; outline-offset: 2px; }

        /* features: one per line, easy to scan */
        .svc-tags { margin: auto 0 0; padding: 1.5rem 0 0; list-style: none; display: grid; gap: .5rem; font-size: .875rem; }
        .svc-tags li { position: relative; padding-left: 1.1rem; }
        .svc-tags li::before { content: ""; position: absolute; left: 0; top: .6em; width: 5px; height: 5px; border-radius: 50%; background: currentColor; }
    </style>

    <x-ui.section-heading
        id="services-heading"
        eyebrow="Services"
        title="What we build"
        description="Practical software for real business workflows — from public websites to internal systems."
    />

    @if ($services->isEmpty())
        <p class="mt-10 rounded-lg bg-paper-soft p-8 text-sm text-ink-muted">Services will appear here once published.</p>
    @else
        <ul class="svc-grid" role="list">
            @foreach ($services as $service)
                @php
                    [$icon, $fallbackTags] = $kindFor($service);
                    $title = $service->title ?? $service->name;
                    $desc  = $service->short_description ?? $service->summary ?? $service->description ?? '';
                    $own   = collect($service->features ?? $service->tags ?? [])->filter()->take(3)->values();
                    $tags  = $own->isNotEmpty() ? $own : collect($fallbackTags);
                    $href  = \Illuminate\Support\Facades\Route::has('services.show') ? route('services.show', $service) : route('services.index');
                @endphp
                <li class="svc-card group bg-paper-soft">
                    <div class="svc-top">
                        <span class="svc-icon text-accent" aria-hidden="true">{!! $icon !!}</span>
                        <x-ui.icon name="arrow-right" class="h-4 w-4 text-ink-muted transition-colors group-hover:text-accent" />
                    </div>
                    <h3 class="svc-title text-ink transition-colors group-hover:text-accent"><a href="{{ $href }}">{{ $title }}</a></h3>
                    @if ($desc)
                        <p class="mt-2 text-[15px] leading-relaxed text-ink-muted">{{ \Illuminate\Support\Str::limit(strip_tags($desc), 120) }}</p>
                    @endif
                    @if ($tags->isNotEmpty())
                        <ul class="svc-tags text-accent" role="list">
                            @foreach ($tags as $tag)
                                <li><span class="text-ink">{{ is_string($tag) ? $tag : ($tag->name ?? $tag->title ?? '') }}</span></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</section>

<section class="border-y border-line bg-paper-soft" aria-labelledby="why-heading">
    <style>
        /* scoped to this section */
        .why-split { display: grid; gap: 2.5rem; }
        @media (min-width: 1024px) {
            .why-split { grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: 5rem; align-items: start; }
            .why-aside { position: sticky; top: 8rem; }
        }
        .why-list { margin: 0; padding: 0; list-style: none; border-top: 2px solid currentColor; }
        .why-row { display: grid; grid-template-columns: 3rem minmax(0, 1fr); gap: 1rem; padding: 1.75rem 0; border-bottom: 1px solid; }
        @media (min-width: 640px) { .why-row { grid-template-columns: 4.5rem minmax(0, 1fr); } }
        .why-num { font-size: .875rem; font-weight: 600; font-variant-numeric: tabular-nums; letter-spacing: .04em; padding-top: .35rem; }
    </style>

    <div class="site-shell py-16 sm:py-20">
        <div class="why-split">
            <div class="why-aside">
                <x-ui.section-heading
                    id="why-heading"
                    eyebrow="Why Galaw Automations"
                    title="Built for clarity and long-term use"
                    description="We prioritize maintainable systems, clear communication, and outcomes your team can operate."
                />
                <div class="mt-6">
                    <a href="{{ route('request-service') }}" class="link-arrow">
                        Start a Project
                        <x-ui.icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>
            </div>

            <ol class="why-list text-ink" role="list">
                @foreach ([
                    ['Custom solutions', 'Software shaped around your process, users, and goals.'],
                    ['Practical technology', 'Stacks chosen for fit, maintainability, and ownership.'],
                    ['Clear delivery', 'Priorities, timelines, and communication kept understandable.'],
                    ['Ongoing support', 'Improvements after launch when your business needs them.'],
                ] as $index => [$title, $copy])
                    <li class="why-row border-line">
                        <span class="why-num text-accent" aria-hidden="true">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="text-xl font-semibold tracking-tight text-ink sm:text-2xl">{{ $title }}</h3>
                            <p class="mt-2 max-w-md text-[15px] leading-relaxed text-ink-muted">{{ $copy }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
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
            <x-ui.icon name="arrow-right" class="h-4 w-4" />
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
@php
    // Official brand colour per technology. Key = icon (or name) lower-cased with everything but a-z/0-9 removed.
    // Black brands (GitHub, Next.js, Vercel…) are left out on purpose so they use the theme's text colour and stay visible in dark mode.
    $brand = [
        'nest' => '#E0234E', 'nestjs' => '#E0234E',
        'git' => '#F05032',
        'html' => '#E34F26', 'html5' => '#E34F26',
        'css' => '#1572B6', 'css3' => '#1572B6',
        'javascript' => '#F7DF1E', 'js' => '#F7DF1E',
        'typescript' => '#3178C6', 'ts' => '#3178C6',
        'laravel' => '#FF2D20',
        'php' => '#777BB4',
        'mysql' => '#4479A1',
        'postgresql' => '#336791', 'postgres' => '#336791',
        'openai' => '#10A37F',
        'gemini' => '#4285F4',
        'reactnative' => '#61DAFB', 'react' => '#61DAFB',
        'docker' => '#2496ED',
        'firebase' => '#FFA000',
        'vue' => '#4FC08D', 'vuejs' => '#4FC08D',
        'nodejs' => '#339933', 'node' => '#339933',
        'python' => '#3776AB',
        'tailwindcss' => '#06B6D4', 'tailwind' => '#06B6D4',
        'mongodb' => '#47A248',
        'redis' => '#DC382D',
        'aws' => '#FF9900',
        'flutter' => '#02569B',
        'figma' => '#F24E1E',
        'wordpress' => '#21759B',
        'bootstrap' => '#7952B3',
        'vite' => '#646CFF',
        'stripe' => '#635BFF',
        'n8n' => '#EA4B71',
        'zapier' => '#FF4A00',
        'graphql' => '#E10098',
        'supabase' => '#3FCF8E',
        'android' => '#3DDC84',
    ];
@endphp
<section class="border-y border-line bg-paper-soft" aria-labelledby="tech-heading">
    <style>
        /* scoped to this section */
        .tech-list { display: flex; flex-wrap: wrap; gap: .75rem; margin: 2.5rem 0 0; padding: 0; list-style: none; }
        /* each chip grows to fill its row, so every row ends flush with the container */
        .tech-list > li { flex: 1 1 auto; display: flex; }
        .tech-chip {
            flex: 1; display: flex; align-items: center; justify-content: center; gap: .75rem; min-height: 3.75rem; padding: .875rem 1.25rem;
            border: 1px solid; border-radius: .5rem; white-space: nowrap;
            box-shadow: 0 8px 18px -12px rgba(15, 35, 64, .22);
        }
        .tech-ico { display: block; flex: none; width: 1.5rem; height: 1.5rem; }
        .tech-ico > * { display: block; width: 100%; height: 100%; }
    </style>

    <div class="site-shell py-16 sm:py-20">
        <x-ui.section-heading
            id="tech-heading"
            eyebrow="Capabilities"
            title="Technologies we work with"
            description="Tools we use to design, build, integrate, and maintain software systems that drive results."
        />

        <ul class="tech-list" role="list">
            @foreach ($technologies->take(16) as $technology)
                @php
                    $slug  = $technology->icon ?: \Illuminate\Support\Str::slug($technology->name);
                    $key   = preg_replace('/[^a-z0-9]/', '', strtolower($technology->icon ?: $technology->name));
                    $color = $brand[$key] ?? null;
                @endphp
                <li>
                    <span class="tech-chip border-line bg-paper">
                        <span class="tech-ico {{ $color ? '' : 'text-ink' }}" @if ($color) style="color: {{ $color }}" @endif aria-hidden="true">
                            <x-technology-icon :name="$slug" />
                        </span>
                        <span class="text-sm font-medium text-ink">{{ $technology->name }}</span>
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            <a href="{{ route('technologies') }}" class="link-arrow">
                View all technologies
                <x-ui.icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>
    </div>
</section>
@endif

@php
    $svg = fn (string $body) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $body . '</svg>';

    $steps = [
        ['Discovery',   'We learn about your goals, challenges, and vision.',  $svg('<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>')],
        ['Planning',    'We define the roadmap and project strategy.',         $svg('<rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2M12 11h4M12 16h4M8 11h.01M8 16h.01"/>')],
        ['Design',      'We craft user-centric designs and experiences.',      $svg('<path d="m12 19 7-7 3 3-7 7z"/><path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18z"/><path d="m2 2 7.6 7.6"/><circle cx="11" cy="11" r="2"/>')],
        ['Development', 'We build scalable, secure, and efficient solutions.', $svg('<path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16"/>')],
        ['Testing',     'We ensure quality through rigorous testing.',         $svg('<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>')],
        ['Deployment',  'We launch your solution seamlessly.',                 $svg('<path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/>')],
        ['Support',     'We provide ongoing support and improvements.',        $svg('<path d="M3 14v-2a9 9 0 0 1 18 0v2"/><path d="M21 15v3a2 2 0 0 1-2 2h-2v-6h2a2 2 0 0 1 2 1zM3 15v3a2 2 0 0 0 2 2h2v-6H5a2 2 0 0 0-2 1z"/>')],
    ];
@endphp

<section class="site-shell py-16 sm:py-20" aria-labelledby="process-heading">
    <style>
        /* scoped to this section */
        .proc-head { text-align: center; }
        .proc-head h2 { margin: .5rem 0 0; }
        .proc-head p { margin: .6rem auto 0; max-width: 32rem; }

        .proc-list { position: relative; margin: 3rem 0 0; padding: 0; list-style: none; display: grid; gap: 0; }

        /* mobile / tablet: vertical, circle on the left */
        .proc-list::before { content: ""; position: absolute; left: 1.75rem; top: 1.75rem; bottom: 1.75rem; border-left-width: 1px; border-left-style: solid; border-left-color: inherit; }
        .proc-step { position: relative; display: grid; grid-template-columns: 3.5rem minmax(0, 1fr); column-gap: 1.25rem; padding-bottom: 2rem; }
        .proc-step:last-child { padding-bottom: 0; }
        .proc-step::after { content: ""; position: absolute; left: 1.75rem; top: 4.6rem; width: 8px; height: 8px; border-radius: 50%; background: currentColor; transform: translateX(-50%); }
        .proc-step:last-child::after { display: none; }
        .proc-badge {
            position: relative; z-index: 1; display: grid; place-items: center; width: 3.5rem; height: 3.5rem; border-radius: 50%;
            border: 1px solid; box-shadow: 0 10px 22px -14px rgba(15, 35, 64, .4);
        }
        .proc-badge svg { width: 1.5rem; height: 1.5rem; }
        .proc-num { display: block; font-size: .9375rem; font-weight: 600; font-variant-numeric: tabular-nums; }

        @media (min-width: 1024px) {
            .proc-list { grid-template-columns: repeat(7, minmax(0, 1fr)); }
            /* horizontal line through the centre of the circles (first to last column centre) */
            .proc-list::before { left: calc(100% / 14); right: calc(100% / 14); top: 1.75rem; bottom: auto; border-left: 0; border-top-width: 1px; border-top-style: solid; border-top-color: inherit; }
            .proc-step { display: block; padding: 0 .5rem; text-align: center; }
            /* dot on the line, between two circles */
            .proc-step::after { left: 100%; top: calc(1.75rem - 4px); transform: translateX(-50%); }
            .proc-badge { margin: 0 auto; }
            .proc-num { margin-top: 1.1rem; }
            .proc-copy { margin-left: auto; margin-right: auto; max-width: 11rem; }
        }
    </style>

    <div class="proc-head">
        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-accent">Our Process</p>
        <h2 id="process-heading" class="text-2xl font-bold tracking-tight text-ink sm:text-3xl">From idea to launch</h2>
        <p class="text-sm text-ink-muted">A straightforward path that keeps stakeholders aligned.</p>
    </div>

    <ol class="proc-list border-line" role="list">
        @foreach ($steps as $index => [$stage, $copy, $icon])
            <li class="proc-step text-accent">
                <span class="proc-badge border-line bg-paper text-accent">{!! $icon !!}</span>
                <div>
                    <span class="proc-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="mt-1 text-base font-semibold text-ink">{{ $stage }}</h3>
                    <p class="proc-copy mt-2 text-[13px] leading-relaxed text-ink-muted">{{ $copy }}</p>
                </div>
            </li>
        @endforeach
    </ol>

    <div class="mt-10 text-center">
        <a href="{{ route('process') }}" class="link-arrow">
            Explore the full process
            <x-ui.icon name="arrow-right" class="h-4 w-4" />
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
            <x-ui.icon name="arrow-right" class="h-4 w-4" />
        </x-ui.button>
    </div>
</section>
@endsection
