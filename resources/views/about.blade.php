@extends('layouts.public')

@section('title', 'About Us | Galaw Automations')
@section('meta_description', 'Learn about Galaw Automations — a software solutions and automation company building websites, apps, systems, AI features, and integrations.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">About Us</div>
        <h1 class="page-title">Software solutions with a practical, business-first approach</h1>
        <p class="page-lead">{{ $settings['about_intro'] ?? 'Galaw Automations is a software solutions and automation company.' }}</p>
    </div>
</section>

<section class="site-shell py-16">
    <div class="grid gap-10 md:grid-cols-2">
        <div>
            <h2 class="text-xl font-semibold text-ink">Mission</h2>
            <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $settings['mission'] ?? '[Replace] Mission statement' }}</p>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-ink">Vision</h2>
            <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $settings['vision'] ?? '[Replace] Vision statement' }}</p>
        </div>
        <div class="md:col-span-2 content-rule pt-10">
            <h2 class="text-xl font-semibold text-ink">Development philosophy</h2>
            <p class="mt-3 max-w-3xl text-sm leading-relaxed text-ink-muted">{{ $settings['philosophy'] ?? 'We focus on clear requirements, maintainable architecture, and practical outcomes.' }}</p>
        </div>
    </div>
</section>

<section class="border-y border-line bg-paper-soft">
    <div class="site-shell py-16">
        <h2 class="text-2xl font-semibold text-ink">Values</h2>
        <ul class="mt-8 divide-y divide-line border-y border-line">
            @foreach (preg_split('/\r\n|\r|\n/', $settings['values'] ?? "Clarity\nReliability\nPractical innovation\nLong-term support\nHonest communication") as $value)
                @if (filled(trim($value)))
                    <li class="py-4 text-sm font-medium text-ink">{{ trim($value) }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</section>

<section class="site-shell py-16">
    <div class="grid gap-10 lg:grid-cols-2">
        <div>
            <h2 class="text-xl font-semibold text-ink">Technology approach</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink-muted">We choose technology based on fit, maintainability, and long-term ownership. AI is used where it adds value, and core systems are designed to work without depending on AI availability.</p>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-ink">Commitment to clients</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink-muted">We prioritize clear communication, honest scoping, and software that teams can continue to operate and improve. Placeholder company history, awards, or team bios are intentionally omitted until verified details are available.</p>
        </div>
    </div>
    <div class="mt-10">
        <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
    </div>
</section>
@endsection
