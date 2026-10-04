@extends('layouts.public')

@section('title', 'FAQ | Galaw Automations')
@section('meta_description', 'Frequently asked questions about Galaw Automations services, timelines, AI integration, and project requests.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">FAQ</div>
        <h1 class="page-title">Frequently asked questions</h1>
        <p class="page-lead">Quick answers about how we work. Content is editable from the admin panel.</p>
    </div>
</section>

<section class="site-shell max-w-3xl py-16">
    <div class="divide-y divide-line border-y border-line">
        @forelse ($faqs as $faq)
            <x-faq-item :faq="$faq" />
        @empty
            <div class="py-10 text-center text-ink-muted">No FAQs published yet.</div>
        @endforelse
    </div>
</section>
@endsection
