<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login') — Galaw Automations</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-mist text-ink">
    <div class="mx-auto flex min-h-screen w-full max-w-md items-center px-4 py-10">
        <div class="w-full rounded-2xl border border-line bg-white p-8 shadow-sm">
            @yield('content')
        </div>
    </div>
</body>
</html>
