@extends('layouts.public')

@section('title', $service->name.' | Galaw Automations')
@section('meta_description', $service->short_description)

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">{{ $service->category?->name ?? 'Service' }}</div>
        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-ink">{{ $service->name }}</h1>
        <p class="mt-5 max-w-3xl text-lg text-ink/70">{{ $service->short_description }}</p>
        <div class="mt-8">
            <x-ui.button href="{{ route('request-service', ['service' => $service->slug]) }}">Request This Service</x-ui.button>
        </div>
    </div>
</section>

<section class="mx-auto grid max-w-6xl gap-10 px-4 py-16 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-10">
        <div>
            <h2 class="text-2xl font-semibold">Overview</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink/70">{{ $service->description }}</p>
        </div>

        @if (!empty($service->features))
            <div>
                <h2 class="text-2xl font-semibold">Features</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink/70">
                    @foreach ($service->features as $feature)
                        <li class="flex gap-2"><x-icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($service->benefits))
            <div>
                <h2 class="text-2xl font-semibold">Benefits</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink/70">
                    @foreach ($service->benefits as $benefit)
                        <li class="flex gap-2"><x-icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $benefit }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($service->process_steps))
            <div>
                <h2 class="text-2xl font-semibold">Development process</h2>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($service->process_steps as $step)
                        <x-ui.badge>{{ $step }}</x-ui.badge>
                    @endforeach
                </div>
            </div>
        @endif

        @if (!empty($service->faqs))
            <div>
                <h2 class="text-2xl font-semibold">FAQ</h2>
                <div class="mt-4 divide-y divide-line rounded-2xl border border-line bg-white px-5">
                    @foreach ($service->faqs as $item)
                        <div class="py-4" x-data="{ open: false }">
                            <button type="button" class="flex w-full items-center justify-between gap-4 text-left" @click="open = !open">
                                <span class="font-medium">{{ $item['question'] ?? '' }}</span>
                                <span class="text-accent" x-text="open ? '−' : '+'"></span>
                            </button>
                            <p class="mt-2 text-sm text-ink/70" x-cloak x-show="open">{{ $item['answer'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <aside class="space-y-6">
        @if (!empty($service->technologies))
            <div class="rounded-2xl border border-line bg-white p-6">
                <h3 class="font-semibold">Technologies</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($service->technologies as $tech)
                        <x-technology-badge>{{ $tech }}</x-technology-badge>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="rounded-2xl border border-line bg-ink p-6 text-white">
            <h3 class="text-lg font-semibold">Ready to start?</h3>
            <p class="mt-2 text-sm text-white/70">Request this service and share your project goals.</p>
            <div class="mt-5">
                <x-ui.button href="{{ route('request-service', ['service' => $service->slug]) }}">Request This Service</x-ui.button>
            </div>
        </div>

        @if ($relatedProjects->isNotEmpty())
            <div class="rounded-2xl border border-line bg-white p-6">
                <h3 class="font-semibold">Example projects</h3>
                <div class="mt-4 space-y-3">
                    @foreach ($relatedProjects as $project)
                        <a href="{{ route('portfolio.show', $project) }}" class="block text-sm text-accent hover:underline">{{ $project->title }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    </aside>
</section>
@endsection
