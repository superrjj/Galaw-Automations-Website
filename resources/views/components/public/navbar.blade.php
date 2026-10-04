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
    class="sticky top-0 z-50 border-b border-line bg-paper"
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
>
    <div class="site-shell flex h-[4.25rem] items-center gap-5 lg:gap-8">
        <a
            href="{{ route('home') }}"
            class="flex shrink-0 items-center"
            aria-label="Galaw Automations home"
        >
            <x-brand-logo variant="mark" />
        </a>

        <nav class="hidden min-w-0 flex-1 items-center lg:flex" aria-label="Primary">
            <ul class="flex flex-wrap items-center gap-x-1 gap-y-1">
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

        <button
            type="button"
            class="ml-auto inline-flex h-10 w-10 items-center justify-center border border-line text-ink transition hover:border-ink hover:bg-ink hover:text-white lg:hidden"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-controls="mobile-nav"
            aria-label="Toggle menu"
        >
            <x-icon name="menu" class="h-5 w-5" x-show="!open" />
            <x-icon name="x" class="h-5 w-5" x-cloak x-show="open" />
        </button>
    </div>

    <div
        id="mobile-nav"
        class="border-t border-line bg-ink lg:hidden"
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        role="navigation"
        aria-label="Mobile"
    >
        <div class="site-shell py-5">
            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-accent">Explore</p>
            <ul class="mt-4 space-y-1">
                @foreach ($links as $index => [$label, $href, $active])
                    <li>
                        <a
                            href="{{ $href }}"
                            class="flex items-baseline gap-3 py-2.5 text-lg font-semibold transition {{ $active ? 'text-accent' : 'text-white hover:text-accent' }}"
                            @click="open = false"
                            @if ($active) aria-current="page" @endif
                        >
                            <span class="w-6 text-xs font-medium text-white/35">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span>{{ $label }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</header>
