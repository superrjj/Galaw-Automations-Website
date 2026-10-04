<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', ($siteSettings['seo_title'] ?? 'Galaw Automations'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['seo_description'] ?? 'Galaw Automations builds websites, mobile apps, business systems, AI solutions, integrations, and automation tools.')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('title', ($siteSettings['seo_title'] ?? 'Galaw Automations'))">
    <meta property="og:description" content="@yield('meta_description', $siteSettings['seo_description'] ?? '')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <link rel="icon" href="{{ asset('logo-galaw-automations-no-bg.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="flex min-h-screen flex-col">
    <a href="#main-content" class="skip-link">Skip to content</a>

    <x-public.navbar :settings="$siteSettings ?? []" />

    @if (session('success'))
        <div class="site-shell pt-4">
            <x-ui.alert type="success">{{ session('success') }}</x-ui.alert>
        </div>
    @endif

    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    <x-public.footer :settings="$siteSettings ?? []" />
    @livewireScripts
</body>
</html>
