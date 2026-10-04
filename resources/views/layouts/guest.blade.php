<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login') — Galaw Automations</title>
    <link rel="icon" href="{{ asset('logo-galaw-automations-no-bg.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper-soft text-ink">
    <div class="mx-auto flex min-h-screen w-full max-w-md items-center px-4 py-10">
        <div class="w-full border border-line bg-paper p-8">
            <div class="mb-8 flex justify-center">
                <a href="{{ route('home') }}">
                    <x-brand-logo class="h-14" />
                </a>
            </div>
            @yield('content')
        </div>
    </div>
</body>
</html>
