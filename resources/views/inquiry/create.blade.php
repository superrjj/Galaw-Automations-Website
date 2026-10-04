@extends('layouts.public')

@section('title', 'Start a Project | Galaw Automations')
@section('meta_description', 'Submit a project inquiry to Galaw Automations for websites, mobile apps, custom software, AI solutions, and automation.')

@section('content')
<section class="border-b border-line bg-gradient-to-b from-mist to-foam">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Request a Service</div>
        <h1 class="mt-3 text-4xl font-semibold tracking-tight text-ink">Start a project</h1>
        <p class="mt-5 max-w-2xl text-lg text-ink/70">Tell us about your goals. We’ll review your inquiry and contact you with next steps.</p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-4 py-16">
    <form method="POST" action="{{ route('request-service.store') }}" enctype="multipart/form-data" class="space-y-4 rounded-2xl border border-line bg-white p-6 sm:p-8">
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

        <x-ui.select
            label="Service"
            name="service_id"
            :options="$services->pluck('name', 'id')->all()"
            :selected="old('service_id', $selectedService?->id)"
            placeholder="Select a service"
        />

        <x-ui.input label="Project title" name="project_title" required />
        <x-ui.textarea label="Project description" name="description" rows="6" required />
        <div class="grid gap-4 sm:grid-cols-2">
            <x-ui.input label="Estimated budget" name="budget" placeholder="Optional" />
            <x-ui.input label="Expected timeline" name="timeline" placeholder="Optional" />
        </div>
        <x-ui.textarea label="Additional requirements" name="additional_requirements" rows="4" />
        <div>
            <label for="attachment" class="mb-1.5 block text-sm font-medium text-ink">Attachment</label>
            <input id="attachment" name="attachment" type="file" class="block w-full text-sm text-ink/70 file:mr-4 file:rounded-lg file:border-0 file:bg-mist file:px-4 file:py-2 file:text-sm file:font-medium file:text-ink">
            <p class="mt-1 text-xs text-ink/50">Optional. PDF, DOC, DOCX, images, TXT, or ZIP up to 5MB.</p>
            @error('attachment')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <x-ui.button type="submit">Submit inquiry</x-ui.button>
    </form>
</section>
@endsection
