@props(['settings' => []])

<header class="sticky top-0 z-40 border-b border-line/80 bg-foam/90 backdrop-blur" x-data="{ open: false }">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4">
        <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight text-ink">
            {{ $settings['company_name'] ?? 'Galaw Automations' }}
        </a>

        <nav class="hidden items-center gap-6 text-sm text-ink/70 lg:flex">
            <a href="{{ route('about') }}" class="hover:text-ink">About</a>
            <a href="{{ route('services.index') }}" class="hover:text-ink">Services</a>
            <a href="{{ route('portfolio.index') }}" class="hover:text-ink">Portfolio</a>
            <a href="{{ route('technologies') }}" class="hover:text-ink">Technologies</a>
            <a href="{{ route('process') }}" class="hover:text-ink">Process</a>
            <a href="{{ route('faq') }}" class="hover:text-ink">FAQ</a>
            <a href="{{ route('contact') }}" class="hover:text-ink">Contact</a>
        </nav>

        <div class="hidden lg:block">
            <x-ui.button href="{{ route('request-service') }}">Start a Project</x-ui.button>
        </div>

        <button type="button" class="rounded-lg border border-line p-2 lg:hidden" @click="open = !open" aria-label="Toggle menu">
            <x-icon name="menu" class="h-5 w-5" x-show="!open" />
            <x-icon name="x" class="h-5 w-5" x-cloak x-show="open" />
        </button>
    </div>

    <div class="border-t border-line bg-white px-4 py-4 lg:hidden" x-cloak x-show="open">
        <div class="flex flex-col gap-3 text-sm">
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('portfolio.index') }}">Portfolio</a>
            <a href="{{ route('technologies') }}">Technologies</a>
            <a href="{{ route('process') }}">Process</a>
            <a href="{{ route('faq') }}">FAQ</a>
            <a href="{{ route('contact') }}">Contact</a>
            <x-ui.button href="{{ route('request-service') }}" class="mt-2 w-full justify-center">Start a Project</x-ui.button>
        </div>
    </div>
</header>
