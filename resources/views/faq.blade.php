@extends('layouts.public')

@section('title', 'FAQ | Galaw Automations')
@section('meta_description', 'Frequently asked questions about Galaw Automations services, timelines, AI integration, and project requests.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">FAQ</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">Frequently asked questions</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">Quick answers about how we work. Content is editable from the admin panel.</p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-4 py-16">
    <div class="rounded-2xl border border-line bg-white px-6">
        @forelse ($faqs as $faq)
            <x-faq-item :faq="$faq" />
        @empty
            <div class="py-10 text-center text-ink/60">No FAQs published yet.</div>
        @endforelse
    </div>
</section>
@endsection
