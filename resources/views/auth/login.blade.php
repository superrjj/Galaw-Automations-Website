@extends('layouts.guest')

@section('title', 'Admin Login')

@section('content')
<div>
    <div class="text-sm font-medium uppercase tracking-[0.18em] text-accent">Galaw Automations</div>
    <h1 class="mt-3 text-2xl font-semibold tracking-tight">Admin login</h1>
    <p class="mt-2 text-sm text-ink/60">Sign in to manage website content and inquiries.</p>

    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-4">
        @csrf
        @if ($errors->any())
            <x-ui.alert type="error">{{ $errors->first() }}</x-ui.alert>
        @endif
        <x-ui.input label="Email" name="email" type="email" required />
        <x-ui.input label="Password" name="password" type="password" required />
        <label class="flex items-center gap-2 text-sm text-ink/70">
            <input type="checkbox" name="remember" value="1" class="rounded border-line">
            Remember me
        </label>
        <x-ui.button type="submit" class="w-full justify-center">Sign in</x-ui.button>
    </form>
</div>
@endsection
