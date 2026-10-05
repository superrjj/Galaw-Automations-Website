@extends('layouts.public')

@section('title', $service->name.' | Galaw Automations')
@section('meta_description', $service->short_description)

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">{{ $service->category?->name ?? 'Service' }}</div>
        <h1 class="page-title">{{ $service->name }}</h1>
        <p class="page-lead">{{ $service->short_description }}</p>
        <div class="mt-8">
            <x-ui.button href="{{ route('request-service', ['service' => $service->slug]) }}">Request This Service</x-ui.button>
        </div>
    </div>
</section>

<section class="site-shell grid gap-12 py-16 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-10">
        <div>
            <h2 class="text-2xl font-semibold text-ink">Overview</h2>
            <p class="mt-4 text-sm leading-relaxed text-ink-muted">{{ $service->description }}</p>
        </div>

        @if (!empty($service->features))
            <div>
                <h2 class="text-2xl font-semibold text-ink">Features</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink-muted">
                    @foreach ($service->features as $feature)
                        <li class="flex gap-2"><x-icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($service->benefits))
            <div>
                <h2 class="text-2xl font-semibold text-ink">Benefits</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink-muted">
                    @foreach ($service->benefits as $benefit)
                        <li class="flex gap-2"><x-icon name="check" class="mt-0.5 h-4 w-4 text-accent" /> {{ $benefit }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($service->process_steps))
            <div>
                <h2 class="text-2xl font-semibold text-ink">Development process</h2>
                <ol class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm text-ink">
                    @foreach ($service->process_steps as $index => $step)
                        <li class="flex items-baseline gap-2">
                            <span class="font-semibold text-accent">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            {{ $step }}
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif

        @if (!empty($service->faqs))
            <div>
                <h2 class="text-2xl font-semibold text-ink">FAQ</h2>
                <div class="mt-4 divide-y divide-line border-y border-line">
                    @foreach ($service->faqs as $item)
                        <div class="py-4" x-data="{ open: false }">
                            <button type="button" class="flex w-full items-center justify-between gap-4 text-left" @click="open = !open">
                                <span class="font-medium text-ink">{{ $item['question'] ?? '' }}</span>
                                <span class="text-accent" x-text="open ? '−' : '+'"></span>
                            </button>
                            <p class="mt-2 text-sm text-ink-muted" x-cloak x-show="open">{{ $item['answer'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <aside class="space-y-6">
        @if (!empty($service->technologies))
            <div class="border border-line bg-paper p-6">
                <h3 class="font-semibold text-ink">Technologies</h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($service->technologies as $tech)
                        <x-technology-badge :icon="\Illuminate\Support\Str::slug($tech)">{{ $tech }}</x-technology-badge>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="border border-ink bg-ink p-6 text-white">
            <h3 class="text-lg font-semibold">Ready to start?</h3>
            <p class="mt-2 text-sm text-white/60">Request this service and share your project goals.</p>
            <div class="mt-5">
                <x-ui.button href="{{ route('request-service', ['service' => $service->slug]) }}">Request This Service</x-ui.button>
            </div>
        </div>

        @if ($relatedProjects->isNotEmpty())
            <div class="border border-line bg-paper p-6">
                <h3 class="font-semibold text-ink">Example projects</h3>
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
