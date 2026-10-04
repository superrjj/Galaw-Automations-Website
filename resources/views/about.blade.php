@extends('layouts.public')

@section('title', 'About Us | Galaw Automations')
@section('meta_description', 'Learn about Galaw Automations — a software solutions and automation company building websites, apps, systems, AI features, and integrations.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">About Us</div>
        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-ink sm:text-5xl">Software solutions with a practical, business-first approach</h1>
        <p class="mt-6 max-w-3xl text-lg leading-relaxed text-ink/70">{{ $settings['about_intro'] ?? 'Galaw Automations is a software solutions and automation company.' }}</p>
    </div>
</section>

<section class="mx-auto grid max-w-6xl gap-8 px-4 py-16 md:grid-cols-2">
    <div class="rounded-2xl border border-line bg-white p-8">
        <h2 class="text-xl font-semibold">Mission</h2>
        <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $settings['mission'] ?? '[Replace] Mission statement' }}</p>
    </div>
    <div class="rounded-2xl border border-line bg-white p-8">
        <h2 class="text-xl font-semibold">Vision</h2>
        <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $settings['vision'] ?? '[Replace] Vision statement' }}</p>
    </div>
    <div class="rounded-2xl border border-line bg-white p-8 md:col-span-2">
        <h2 class="text-xl font-semibold">Development philosophy</h2>
        <p class="mt-3 text-sm leading-relaxed text-ink/70">{{ $settings['philosophy'] ?? 'We focus on clear requirements, maintainable architecture, and practical outcomes.' }}</p>
    </div>
</section>

<section class="border-y border-line bg-white">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <h2 class="text-2xl font-semibold">Values</h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (preg_split('/\r\n|\r|\n/', $settings['values'] ?? "Clarity\nReliability\nPractical innovation\nLong-term support\nHonest communication") as $value)
                @if (filled(trim($value)))
                    <div class="rounded-xl border border-line px-5 py-4 text-sm font-medium text-ink">{{ trim($value) }}</div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16">
    <div class="grid gap-8 lg:grid-cols-2">
        <div>
            <h2 class="text-2xl font-semibold">Technology approach</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink/70">We choose technology based on fit, maintainability, and long-term ownership. AI is used where it adds value, and core systems are designed to work without depending on AI availability.</p>
        </div>
        <div>
            <h2 class="text-2xl font-semibold">Commitment to clients</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink/70">We prioritize clear communication, honest scoping, and software that teams can continue to operate and improve. Placeholder company history, awards, or team bios are intentionally omitted until verified details are available.</p>
        </div>
    </div>
    <div class="mt-10">
        <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
    </div>
</section>
@endsection
