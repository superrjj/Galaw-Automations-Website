@extends('layouts.public')

@section('title', 'Start a Project | Galaw Automations')
@section('meta_description', 'Submit a project inquiry to Galaw Automations for websites, mobile apps, custom software, AI solutions, and automation.')

@section('content')
<section class="page-hero">
    <div class="page-hero-inner">
        <div class="page-kicker">Request a Service</div>
        <h1 class="page-title">Start a project</h1>
        <p class="page-lead">Tell us about your goals. We’ll review your inquiry and contact you with next steps.</p>
    </div>
</section>

<section class="site-shell py-12 sm:py-16">
    <form
        method="POST"
        action="{{ route('request-service.store') }}"
        enctype="multipart/form-data"
        class="mx-auto max-w-3xl space-y-0 border border-line bg-paper p-6 sm:p-8"
        x-data="{ submitting: false }"
        @submit="submitting = true"
    >
        @csrf
        @if ($errors->any())
            <div class="mb-6">
                <x-ui.alert type="error">Please check the highlighted fields and try again.</x-ui.alert>
            </div>
        @endif

        <fieldset class="form-section">
            <legend class="form-section-title">Contact information</legend>
            <div class="grid gap-4 sm:grid-cols-2">
                <x-ui.input label="Name" name="name" required autocomplete="name" />
                <x-ui.input label="Email" name="email" type="email" required autocomplete="email" placeholder="name@company.com" />
                <x-ui.input label="Phone" name="phone" type="tel" autocomplete="tel" />
                <x-ui.input label="Company" name="company" autocomplete="organization" />
            </div>
        </fieldset>

        <fieldset class="form-section">
            <legend class="form-section-title">Project information</legend>
            <div class="space-y-4">
                <x-ui.select
                    label="Service"
                    name="service_id"
                    :options="$services->pluck('name', 'id')->all()"
                    :selected="old('service_id', $selectedService?->id)"
                    placeholder="Select a service"
                />
                <x-ui.input label="Project title" name="project_title" required />
                <x-ui.textarea label="Project description" name="description" rows="6" required hint="Describe the problem, users, and what success looks like." />
                <div class="grid gap-4 sm:grid-cols-2">
                    <x-ui.input label="Estimated budget" name="budget" placeholder="Optional" />
                    <x-ui.input label="Expected timeline" name="timeline" placeholder="Optional" />
                </div>
            </div>
        </fieldset>

        <fieldset class="form-section">
            <legend class="form-section-title">Additional information</legend>
            <div class="space-y-4">
                <x-ui.textarea label="Additional requirements" name="additional_requirements" rows="4" />
                <div>
                    <label for="attachment" class="mb-1.5 block text-sm font-medium text-ink">Attachment</label>
                    <input
                        id="attachment"
                        name="attachment"
                        type="file"
                        class="block w-full text-sm text-ink-muted file:mr-4 file:border file:border-line file:bg-paper-soft file:px-3 file:py-2 file:text-sm file:font-medium file:text-ink"
                    >
                    <p class="mt-1 text-xs text-ink-muted">Optional. PDF, DOC, DOCX, images, TXT, or ZIP up to 5MB.</p>
                    @error('attachment')
                        <p class="mt-1 text-sm text-red-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        <div class="mt-8 flex flex-wrap items-center gap-4">
            <x-ui.button type="submit" x-bind:disabled="submitting">
                <span x-show="!submitting">Submit inquiry</span>
                <span x-cloak x-show="submitting">Submitting…</span>
            </x-ui.button>
            <p class="text-xs text-ink-muted">We’ll only use your details to respond to this inquiry.</p>
        </div>
    </form>
</section>
@endsection
