@props(['settings' => []])

@php
    $links = [
        ['Home', route('home'), request()->routeIs('home')],
        ['About', route('about'), request()->routeIs('about')],
        ['Services', route('services.index'), request()->routeIs('services.*')],
        ['Portfolio', route('portfolio.index'), request()->routeIs('portfolio.*')],
        ['Technologies', route('technologies'), request()->routeIs('technologies')],
        ['Process', route('process'), request()->routeIs('process')],
        ['FAQ', route('faq'), request()->routeIs('faq')],
        ['Contact', route('contact'), request()->routeIs('contact')],
    ];
@endphp

<header
    class="sticky top-0 z-50 border-b border-line bg-paper/95 backdrop-blur-sm"
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
>
    <div class="site-shell grid h-[4.75rem] grid-cols-[auto_1fr_auto] items-center gap-4 sm:h-[5.25rem]">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center py-1" aria-label="Galaw Automations home">
            <x-brand-logo variant="mark" />
        </a>

        <nav class="hidden items-center justify-center lg:flex" aria-label="Primary">
            <ul class="flex flex-wrap items-center justify-center gap-x-0.5">
                @foreach ($links as [$label, $href, $active])
                    <li>
                        <a
                            href="{{ $href }}"
                            class="nav-link {{ $active ? 'nav-link-active' : '' }}"
                            @if ($active) aria-current="page" @endif
                        >{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="flex items-center justify-end gap-2">
            <x-ui.button href="{{ route('request-service') }}" class="hidden lg:inline-flex">
                Start a Project
                <x-ui.icon name="arrow-right" class="h-4 w-4" />
            </x-ui.button>

            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center border border-line text-ink transition hover:border-ink hover:bg-ink hover:text-white lg:hidden"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="mobile-nav"
                aria-label="Toggle menu"
            >
                <x-ui.icon name="menu" class="h-5 w-5" x-show="!open" />
                <x-ui.icon name="x" class="h-5 w-5" x-cloak x-show="open" />
            </button>
        </div>
    </div>

    <div
        id="mobile-nav"
        class="border-t border-line bg-paper lg:hidden"
        x-cloak
        x-show="open"
        x-transition
        role="navigation"
        aria-label="Mobile"
    >
        <div class="site-shell space-y-1 py-4">
            @foreach ($links as [$label, $href, $active])
                <a
                    href="{{ $href }}"
                    class="block rounded-md px-3 py-2.5 text-sm font-medium {{ $active ? 'bg-accent-soft text-ink' : 'text-ink-muted hover:bg-paper-soft hover:text-ink' }}"
                    @click="open = false"
                    @if ($active) aria-current="page" @endif
                >{{ $label }}</a>
            @endforeach
            <x-ui.button href="{{ route('request-service') }}" class="mt-3 w-full justify-center">
                Start a Project
                <x-ui.icon name="arrow-right" class="h-4 w-4" />
            </x-ui.button>
        </div>
    </div>
</header>
