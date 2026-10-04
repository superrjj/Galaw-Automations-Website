<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Galaw Automations</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-mist text-ink">
    <div class="min-h-screen lg:grid lg:grid-cols-[240px_1fr]">
        <aside class="border-b border-line bg-ink text-white lg:border-b-0 lg:border-r lg:border-ink-soft">
            <div class="px-5 py-6">
                <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold tracking-tight">Galaw Admin</a>
                <p class="mt-1 text-sm text-white/60">Website management</p>
            </div>
            <nav class="space-y-1 px-3 pb-6 text-sm">
                @php
                    $links = [
                        ['Dashboard', route('admin.dashboard'), request()->routeIs('admin.dashboard')],
                        ['Inquiries', route('admin.inquiries.index'), request()->routeIs('admin.inquiries.*')],
                        ['Services', route('admin.services.index'), request()->routeIs('admin.services.*')],
                        ['Portfolio', route('admin.portfolio.index'), request()->routeIs('admin.portfolio.*')],
                        ['Technologies', route('admin.technologies.index'), request()->routeIs('admin.technologies.*')],
                        ['Testimonials', route('admin.testimonials.index'), request()->routeIs('admin.testimonials.*')],
                        ['FAQs', route('admin.faqs.index'), request()->routeIs('admin.faqs.*')],
                        ['Messages', route('admin.messages.index'), request()->routeIs('admin.messages.*')],
                        ['Settings', route('admin.settings.edit'), request()->routeIs('admin.settings.*')],
                    ];
                @endphp
                @foreach ($links as [$label, $href, $active])
                    <a href="{{ $href }}" class="block rounded-lg px-3 py-2 {{ $active ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">{{ $label }}</a>
                @endforeach
                <a href="{{ route('home') }}" class="mt-4 block rounded-lg px-3 py-2 text-white/50 hover:text-white">View website</a>
                <form method="POST" action="{{ route('logout') }}" class="px-3 pt-2">
                    @csrf
                    <button type="submit" class="text-white/50 hover:text-white">Log out</button>
                </form>
            </nav>
        </aside>

        <div class="min-w-0">
            <header class="flex items-center justify-between border-b border-line bg-white px-4 py-4 sm:px-6">
                <div>
                    <h1 class="text-xl font-semibold tracking-tight">@yield('heading', 'Dashboard')</h1>
                    <p class="text-sm text-ink/60">@yield('subheading', 'Manage Galaw Automations website content')</p>
                </div>
                <div class="text-sm text-ink/60">{{ auth()->user()?->name }}</div>
            </header>

            <div class="px-4 py-6 sm:px-6">
                @if (session('success'))
                    <div class="mb-4">
                        <x-ui.alert type="success">{{ session('success') }}</x-ui.alert>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4">
                        <x-ui.alert type="error">Please check the highlighted fields.</x-ui.alert>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
