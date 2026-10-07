@extends('layouts.public')

@section('title', 'Contact | Galaw Automations')
@section('meta_description', 'Contact Galaw Automations for software development and automation questions.')

@php
    $hasEmail = ! empty($siteSettings['company_email']);
    $hasPhone = ! empty($siteSettings['company_phone']) && ! str_contains($siteSettings['company_phone'], '[Replace');
    $hasAddress = ! empty($siteSettings['company_address']) && ! str_contains($siteSettings['company_address'], '[Replace');
    $hasContactDetails = $hasEmail || $hasPhone || $hasAddress;
@endphp

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Contact</div>
        <h1 class="page-title">Get in touch</h1>
        <p class="page-lead">
            Send a general message and we’ll follow up. For project requests, use
            <a href="{{ route('request-service') }}" class="font-medium text-ink underline decoration-line underline-offset-4 transition hover:text-accent hover:decoration-accent">Start a Project</a>.
        </p>
    </div>
</section>

<section class="site-shell py-12 sm:py-16">
    <form
        method="POST"
        action="{{ route('contact.store') }}"
        class="mx-auto max-w-3xl space-y-0 border border-line bg-paper p-6 sm:p-8"
        x-data="{ submitting: false }"
        @submit="submitting = true"
    >
        @csrf

        <fieldset class="form-section">
            <legend class="form-section-title">Your details</legend>
            <div class="grid gap-4 sm:grid-cols-2">
                <x-ui.input label="Name" name="name" required autocomplete="name" autofocus />
                <x-ui.input label="Email" name="email" type="email" required autocomplete="email" placeholder="name@company.com" />
                <x-ui.input label="Phone (optional)" name="phone" type="tel" autocomplete="tel" placeholder="+63…" />
                <x-ui.input label="Company (optional)" name="company" autocomplete="organization" />
            </div>
        </fieldset>

        <fieldset class="form-section">
            <legend class="form-section-title">Your message</legend>
            <div class="space-y-4">
                <x-ui.input
                    label="Subject"
                    name="subject"
                    required
                    placeholder="What is this about?"
                />
                <x-ui.textarea
                    label="Message"
                    name="message"
                    rows="6"
                    required
                    placeholder="Share a bit of context so we can reply with something useful."
                    hint="A short note is fine. Include links or background if they help."
                />
            </div>
        </fieldset>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <x-ui.button type="submit" class="w-full sm:w-auto" x-bind:disabled="submitting">
                <span x-show="!submitting">Send message</span>
                <span x-cloak x-show="submitting">Sending…</span>
            </x-ui.button>
            <p class="text-xs text-ink-muted sm:max-w-xs sm:text-right">We’ll only use your details to reply to this message.</p>
        </div>
    </form>

    @if ($hasContactDetails)
        <div class="mx-auto mt-10 max-w-3xl border-t border-line pt-8">
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-ink">Or reach us directly</p>
            <div class="mt-4 grid gap-5 text-sm text-ink-muted sm:grid-cols-3">
                @if ($hasEmail)
                    <div>
                        <div class="font-medium text-ink">Email</div>
                        <a href="mailto:{{ $siteSettings['company_email'] }}" class="mt-1 inline-block hover:text-accent">{{ $siteSettings['company_email'] }}</a>
                    </div>
                @endif
                @if ($hasPhone)
                    <div>
                        <div class="font-medium text-ink">Phone</div>
                        <div class="mt-1">{{ $siteSettings['company_phone'] }}</div>
                    </div>
                @endif
                @if ($hasAddress)
                    <div>
                        <div class="font-medium text-ink">Address</div>
                        <div class="mt-1">{{ $siteSettings['company_address'] }}</div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</section>
@endsection
