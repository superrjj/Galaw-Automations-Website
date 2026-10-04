@extends('layouts.public')

@section('title', 'Contact | Galaw Automations')
@section('meta_description', 'Contact Galaw Automations for software development and automation questions.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Contact</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">Get in touch</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">Send a message and our team will follow up. For project requests, use Start a Project.</p>
    </div>
</section>

<section class="mx-auto grid max-w-6xl gap-10 px-4 py-16 lg:grid-cols-[0.9fr_1.1fr]">
    <div class="space-y-4 text-sm text-ink/70">
        @if (!empty($siteSettings['company_email']))
            <div class="flex items-start gap-3"><x-icon name="mail" class="mt-0.5 h-5 w-5 text-accent" /> {{ $siteSettings['company_email'] }}</div>
        @endif
        @if (!empty($siteSettings['company_phone']) && !str_contains($siteSettings['company_phone'], '[Replace'))
            <div class="flex items-start gap-3"><x-icon name="phone" class="mt-0.5 h-5 w-5 text-accent" /> {{ $siteSettings['company_phone'] }}</div>
        @endif
        @if (!empty($siteSettings['company_address']) && !str_contains($siteSettings['company_address'], '[Replace'))
            <div class="flex items-start gap-3"><x-icon name="map-pin" class="mt-0.5 h-5 w-5 text-accent" /> {{ $siteSettings['company_address'] }}</div>
        @endif
        <div class="pt-4">
            <x-ui.button href="{{ route('request-service') }}" variant="secondary">Start a Project</x-ui.button>
        </div>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 rounded-2xl border border-line bg-white p-6 sm:p-8">
        @csrf
        @if ($errors->any())
            <x-ui.alert type="error">Please check the highlighted fields.</x-ui.alert>
        @endif
        <div class="grid gap-4 sm:grid-cols-2">
            <x-ui.input label="Name" name="name" required />
            <x-ui.input label="Email" name="email" type="email" required />
            <x-ui.input label="Phone" name="phone" />
            <x-ui.input label="Company" name="company" />
        </div>
        <x-ui.input label="Subject" name="subject" required />
        <x-ui.textarea label="Message" name="message" rows="6" required />
        <x-ui.button type="submit">Send message</x-ui.button>
    </form>
</section>
@endsection
