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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col">
    <x-public.navbar :settings="$siteSettings ?? []" />

    @if (session('success'))
        <div class="mx-auto w-full max-w-6xl px-4 pt-4">
            <x-ui.alert type="success">{{ session('success') }}</x-ui.alert>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    <x-public.footer :settings="$siteSettings ?? []" />
    @livewireScripts
</body>
</html>
