<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Galaw Automations</title>
    @include('partials.favicon')

    {{-- Set the nav state before first paint (no flash). Desktop remembers open / icon-rail; mobile always starts closed. --}}
    <script>
        (function () {
            var d = document.documentElement, wide = window.matchMedia('(min-width: 1024px)').matches, s = null;
            try { s = localStorage.getItem('adminNav'); } catch (e) {}
            d.dataset.adminNav = wide ? (s === 'closed' ? 'closed' : 'open') : 'closed';
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        /* ---- Admin shell: self-contained so it works without a Tailwind rebuild ----
           data-admin-nav="open"   -> full sidebar (desktop) / drawer visible (mobile)
           data-admin-nav="closed" -> icon rail (desktop)    / drawer hidden  (mobile) */
        :root { --adm-w: 16.25rem; --adm-rail: 4.5rem; --adm-accent: #3dd1b0; }

        .adm-sidebar {
            position: fixed; inset: 0 auto 0 0; z-index: 50;
            width: var(--adm-w); height: 100vh; height: 100dvh;
            display: flex; flex-direction: column;
            overflow: hidden;                 /* the sidebar itself never scrolls */
            overscroll-behavior: contain;
            border-right: 1px solid rgba(255, 255, 255, .08);
        }
        .adm-main { min-width: 0; min-height: 100vh; }
        .adm-header { position: sticky; top: 0; z-index: 30; gap: 1rem; }

        /* mobile: off-canvas drawer */
        @media (max-width: 1023.98px) {
            .adm-sidebar { transform: translateX(-100%); visibility: hidden; transition: transform .25s ease, visibility 0s linear .25s; }
            html[data-admin-nav="open"] .adm-sidebar { transform: none; visibility: visible; transition: transform .25s ease, visibility 0s; }
            .adm-overlay { position: fixed; inset: 0; z-index: 40; background: rgba(8, 16, 30, .55); opacity: 0; pointer-events: none; transition: opacity .25s ease; }
            html[data-admin-nav="open"] .adm-overlay { opacity: 1; pointer-events: auto; }
            html[data-admin-nav="open"] body { overflow: hidden; }
        }

        /* desktop: full sidebar <-> icon rail */
        @media (min-width: 1024px) {
            .adm-overlay { display: none; }
            .adm-sidebar { transition: width .25s ease; }
            .adm-main { margin-left: var(--adm-w); transition: margin-left .25s ease; }
            html[data-admin-nav="closed"] .adm-sidebar { width: var(--adm-rail); }
            html[data-admin-nav="closed"] .adm-main { margin-left: var(--adm-rail); }

            /* rail look */
            html[data-admin-nav="closed"] .adm-label,
            html[data-admin-nav="closed"] .adm-chev,
            html[data-admin-nav="closed"] .adm-brand-title,
            html[data-admin-nav="closed"] .adm-brand-tag,
            html[data-admin-nav="closed"] .adm-close { display: none; }
            /* same logo in both states: in the rail it is only scaled down to fit the narrower width */
            html[data-admin-nav="closed"] .adm-brand { padding: 1rem .5rem .75rem; }
            html[data-admin-nav="closed"] .adm-brand > div { width: 100%; }
            html[data-admin-nav="closed"] .adm-brand-lockup { justify-content: center; width: 100%; }
            html[data-admin-nav="closed"] .adm-logo { display: flex; justify-content: center; padding: .35rem; }
            html[data-admin-nav="closed"] .adm-logo img { width: auto; max-width: 1.75rem; height: 1.75rem !important; }
            html[data-admin-nav="closed"] .adm-nav { padding: .25rem .6rem; }
            html[data-admin-nav="closed"] .adm-foot { padding: .5rem .6rem 1rem; }
            html[data-admin-nav="closed"] .adm-link { justify-content: center; padding: .6rem 0; }
            html[data-admin-nav="closed"] .adm-ico { width: 1.3rem; height: 1.3rem; }
            html[data-admin-nav="closed"] .adm-sublink .adm-ico { width: 1.3rem; height: 1.3rem; }
            /* groups become divider + always-visible icons, like a VS Code activity bar */
            html[data-admin-nav="closed"] .adm-gbtn { display: none; }
            html[data-admin-nav="closed"] .adm-group { margin-top: .5rem; padding-top: .5rem; border-top: 1px solid rgba(255, 255, 255, .1); }
            html[data-admin-nav="closed"] .adm-sub { display: block; margin: 0; padding: 0; border: 0; }
            html[data-admin-nav="closed"] .adm-sublink { padding: .6rem 0; }
        }

        .adm-brand { display: flex; align-items: flex-start; justify-content: space-between; gap: .75rem; padding: 1.25rem 1.25rem 1rem; flex: none; }
        .adm-brand-lockup { display: flex; align-items: center; gap: .55rem; min-width: 0; }
        .adm-logo {
            flex: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: .2rem .35rem;
            border-radius: .4rem;
            background: #fff;
            text-decoration: none;
        }
        .adm-sidebar .adm-logo img {
            display: block;
            height: 2rem !important;
            width: auto !important;
            max-width: 2.35rem;
            object-fit: contain;
        }
        .adm-brand-text { min-width: 0; }
        .adm-brand-title {
            margin: 0;
            font-size: .8125rem;
            font-weight: 600;
            line-height: 1.25;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .adm-brand-tag {
            margin: .15rem 0 0;
            font-size: .6875rem;
            color: rgba(255, 255, 255, .55);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .adm-nav { flex: 1 1 auto; min-height: 0; padding: .25rem .75rem; font-size: .875rem; overflow: hidden; }
        /* safety net only: on very short screens the list can still be reached, with no visible scrollbar */
        @media (max-height: 640px) { .adm-nav { overflow-y: auto; scrollbar-width: none; } .adm-nav::-webkit-scrollbar { display: none; } }

        .adm-foot { flex: none; padding: .5rem .75rem 1rem; border-top: 1px solid rgba(255, 255, 255, .08); }

        .adm-link {
            display: flex; align-items: center; gap: .7rem; width: 100%;
            padding: .5rem .75rem; margin-bottom: .125rem; border-radius: .5rem;
            color: rgba(255, 255, 255, .7); text-decoration: none; background: none; border: 0;
            font: inherit; line-height: 1.25; text-align: left; cursor: pointer; white-space: nowrap;
            transition: background-color .15s, color .15s;
        }
        .adm-link:hover { background: rgba(255, 255, 255, .06); color: #fff; }
        .adm-link:focus-visible, .adm-close:focus-visible, .adm-toggle:focus-visible { outline: 2px solid var(--adm-accent); outline-offset: 2px; }
        .adm-link.is-active { background: rgba(255, 255, 255, .11); color: #fff; box-shadow: inset 3px 0 0 var(--adm-accent); }
        .adm-link.has-active { color: #fff; }
        .adm-link.has-active .adm-ico, .adm-link.is-active .adm-ico { color: var(--adm-accent); }
        .adm-muted { color: rgba(255, 255, 255, .5); }

        .adm-ico { display: block; flex: none; width: 1.15rem; height: 1.15rem; }
        .adm-sublink .adm-ico { width: 1rem; height: 1rem; }
        .adm-label { overflow: hidden; text-overflow: ellipsis; }

        /* collapsible groups (expanded sidebar only) */
        .adm-sub { display: none; margin: .125rem 0 .375rem 1.45rem; padding-left: .6rem; border-left: 1px solid rgba(255, 255, 255, .12); }
        .adm-group.is-open > .adm-sub { display: block; }
        .adm-chev { display: block; flex: none; width: 1rem; height: 1rem; margin-left: auto; transition: transform .2s ease; opacity: .7; }
        .adm-group.is-open > .adm-gbtn .adm-chev { transform: rotate(180deg); }
        .adm-sublink { padding: .4rem .65rem; font-size: .8125rem; }

        .adm-toggle, .adm-close {
            display: inline-flex; align-items: center; justify-content: center; flex: none;
            width: 2.25rem; height: 2.25rem; border-radius: .5rem; cursor: pointer;
            transition: background-color .15s;
        }
        .adm-toggle { border: 1px solid rgba(15, 35, 64, .15); background: transparent; color: inherit; }
        .adm-toggle:hover { background: rgba(15, 35, 64, .06); }
        .adm-close { border: 0; background: rgba(255, 255, 255, .08); color: #fff; }
        .adm-close:hover { background: rgba(255, 255, 255, .16); }

        @media (prefers-reduced-motion: reduce) {
            .adm-sidebar, .adm-main, .adm-overlay, .adm-chev { transition: none !important; }
        }

        /* Simple delete dialog — keep centered (CSS resets strip dialog margin:auto) */
        .sa-dialog {
            position: fixed;
            inset: 0;
            margin: auto;
            width: min(26rem, calc(100vw - 2rem));
            height: fit-content;
            padding: 0;
            border: 1px solid #e3e8ee;
            border-radius: .75rem;
            background: #fff;
            color: #0f2340;
            box-shadow: 0 20px 50px -20px rgba(15, 35, 64, .45);
        }
        .sa-dialog::backdrop { background: rgba(15, 35, 64, .45); }
        .sa-dialog form { margin: 0; padding: 1.5rem; }
        .sa-dialog h2 { margin: 0 0 .5rem; font-size: 1.125rem; font-weight: 600; }
        .sa-dialog p { margin: 0; font-size: .875rem; line-height: 1.6; color: #5b6b7e; }
        .sa-dialog-actions { display: flex; justify-content: flex-end; gap: .5rem; margin-top: 1.5rem; }
        .sa-dialog .sa-btn {
            display: inline-flex; align-items: center; justify-content: center;
            height: 2.25rem; padding: 0 1rem;
            border: 1px solid #dfe5ec; border-radius: .4rem; background: #fff; color: #27384f;
            font: inherit; font-size: .8125rem; font-weight: 500; cursor: pointer;
        }
        .sa-dialog .sa-btn:hover { background: #f4f7fa; }
        .sa-dialog .sa-btn-danger { background: #b42318; border-color: #b42318; color: #fff; }
        .sa-dialog .sa-btn-danger:hover { background: #912018; border-color: #912018; }

        /* Flash toast after create / update / delete */
        .adm-toast-host {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 80;
            display: flex;
            flex-direction: column;
            gap: .5rem;
            width: min(22rem, calc(100vw - 2rem));
            pointer-events: none;
        }
        .adm-toast {
            pointer-events: auto;
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            padding: .85rem .9rem;
            border-radius: .5rem;
            border: 1px solid transparent;
            background: #0f2340;
            color: #fff;
            box-shadow: 0 12px 28px -10px rgba(15, 35, 64, .45);
            font-size: .875rem;
            line-height: 1.4;
            transform: translateY(-.35rem);
            opacity: 0;
            animation: adm-toast-in .28s ease forwards;
        }
        .adm-toast.is-leaving {
            animation: adm-toast-out .22s ease forwards;
        }
        .adm-toast.is-success { border-color: rgba(61, 209, 176, .45); }
        .adm-toast.is-success .adm-toast-icon { color: var(--adm-accent); }
        .adm-toast.is-error { background: #7a1c16; border-color: rgba(254, 205, 202, .35); }
        .adm-toast.is-error .adm-toast-icon { color: #fecdca; }
        .adm-toast-icon { flex: none; display: grid; place-items: center; width: 1.25rem; height: 1.25rem; margin-top: .1rem; }
        .adm-toast-icon svg { width: 1.15rem; height: 1.15rem; }
        .adm-toast-msg { margin: 0; flex: 1; min-width: 0; }
        .adm-toast-close {
            flex: none;
            display: grid;
            place-items: center;
            width: 1.5rem;
            height: 1.5rem;
            margin: -.15rem -.2rem 0 0;
            border: 0;
            border-radius: .35rem;
            background: transparent;
            color: rgba(255, 255, 255, .7);
            cursor: pointer;
        }
        .adm-toast-close:hover { background: rgba(255, 255, 255, .1); color: #fff; }
        .adm-toast-close svg { width: .95rem; height: .95rem; }
        @keyframes adm-toast-in {
            from { opacity: 0; transform: translateY(-.5rem); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes adm-toast-out {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-.35rem); }
        }
        @media (prefers-reduced-motion: reduce) {
            .adm-toast, .adm-toast.is-leaving { animation: none; opacity: 1; transform: none; }
        }
    </style>
    <noscript>
        <style>
            .adm-sidebar { transform: none; visibility: visible; }
            .adm-sub { display: block; }
        </style>
    </noscript>
</head>
<body class="min-h-screen bg-paper-soft text-ink">
    <a href="#admin-content" class="skip-link">Skip to content</a>

    @php
        $ico = fn (string $b) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display:block;width:100%;height:100%">' . $b . '</svg>';

        $teeth = '';
        foreach (range(0, 315, 45) as $a) {
            $teeth .= '<path d="M12 2.4v3.2" transform="rotate(' . $a . ' 12 12)" stroke-width="3" stroke-linecap="butt"/>';
        }

        $icons = [
            'dashboard'    => $ico('<rect x="3" y="3" width="7" height="9" rx="1.2"/><rect x="14" y="3" width="7" height="5" rx="1.2"/><rect x="14" y="12" width="7" height="9" rx="1.2"/><rect x="3" y="16" width="7" height="5" rx="1.2"/>'),
            'inbox'        => $ico('<path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>'),
            'inquiries'    => $ico('<rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2M9 12h6M9 16h4"/>'),
            'messages'     => $ico('<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>'),
            'content'      => $ico('<path d="m12 2 10 5-10 5L2 7zM2 12l10 5 10-5M2 17l10 5 10-5"/>'),
            'services'     => $ico('<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>'),
            'portfolio'    => $ico('<path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>'),
            'technologies' => $ico('<path d="m16 18 6-6-6-6M8 6l-6 6 6 6"/>'),
            'testimonials' => $ico('<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 9h8M8 13h5"/>'),
            'faqs'         => $ico('<circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3M12 17h.01"/>'),
            'settings'     => $ico('<circle cx="12" cy="12" r="6.6"/><circle cx="12" cy="12" r="2.6"/>' . $teeth),
            'globe'        => $ico('<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2c2.8 2.7 4.2 6 4.2 10s-1.4 7.3-4.2 10c-2.8-2.7-4.2-6-4.2-10S9.2 4.7 12 2z"/>'),
            'logout'       => $ico('<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>'),
            'chevron'      => $ico('<path d="m6 9 6 6 6-6"/>'),
            'menu'         => $ico('<path d="M4 6h16M4 12h16M4 18h16"/>'),
            'x'            => $ico('<path d="M18 6 6 18M6 6l12 12"/>'),
        ];

        // [label, href, active, icon]
        $nav = [
            ['type' => 'link', 'label' => 'Dashboard', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'dashboard'],
            ['type' => 'group', 'label' => 'Inbox', 'icon' => 'inbox', 'children' => [
                ['Inquiries', route('admin.inquiries.index'), request()->routeIs('admin.inquiries.*'), 'inquiries'],
                ['Messages', route('admin.messages.index'), request()->routeIs('admin.messages.*'), 'messages'],
            ]],
            ['type' => 'group', 'label' => 'Content', 'icon' => 'content', 'children' => [
                ['Services', route('admin.services.index'), request()->routeIs('admin.services.*'), 'services'],
                ['Portfolio', route('admin.portfolio.index'), request()->routeIs('admin.portfolio.*'), 'portfolio'],
                ['Technologies', route('admin.technologies.index'), request()->routeIs('admin.technologies.*'), 'technologies'],
                ['Testimonials', route('admin.testimonials.index'), request()->routeIs('admin.testimonials.*'), 'testimonials'],
                ['FAQs', route('admin.faqs.index'), request()->routeIs('admin.faqs.*'), 'faqs'],
            ]],
            ['type' => 'link', 'label' => 'Settings', 'href' => route('admin.settings.edit'), 'active' => request()->routeIs('admin.settings.*'), 'icon' => 'settings'],
        ];
    @endphp

    <div class="adm-overlay" data-admin-nav-toggle aria-hidden="true"></div>

    <aside id="admin-sidebar" class="adm-sidebar bg-ink text-white" aria-label="Admin">
        <div class="adm-brand">
            <div class="adm-brand-lockup">
                <a href="{{ route('admin.dashboard') }}" class="adm-logo" aria-label="Galaw Automations admin home">
                    <x-brand-logo variant="mark" />
                </a>
                <div class="adm-brand-text">
                    <p class="adm-brand-title">Galaw Automations</p>
                    <p class="adm-brand-tag">Website management</p>
                </div>
            </div>
            <button type="button" class="adm-close" data-admin-nav-toggle aria-controls="admin-sidebar" aria-expanded="false" aria-label="Close navigation">
                <span class="adm-ico">{!! $icons['x'] !!}</span>
            </button>
        </div>

        <nav class="adm-nav" aria-label="Admin">
            @foreach ($nav as $item)
                @if ($item['type'] === 'link')
                    <a
                        href="{{ $item['href'] }}"
                        data-label="{{ $item['label'] }}"
                        class="adm-link {{ $item['active'] ? 'is-active' : '' }}"
                        @if ($item['active']) aria-current="page" @endif
                    >
                        <span class="adm-ico">{!! $icons[$item['icon']] !!}</span>
                        <span class="adm-label">{{ $item['label'] }}</span>
                    </a>
                @else
                    @php $open = collect($item['children'])->contains(fn ($c) => $c[2]); @endphp
                    <div class="adm-group {{ $open ? 'is-open' : '' }}">
                        <button type="button" class="adm-link adm-gbtn {{ $open ? 'has-active' : '' }}" data-adm-group aria-expanded="{{ $open ? 'true' : 'false' }}">
                            <span class="adm-ico">{!! $icons[$item['icon']] !!}</span>
                            <span class="adm-label">{{ $item['label'] }}</span>
                            <span class="adm-chev">{!! $icons['chevron'] !!}</span>
                        </button>
                        <div class="adm-sub">
                            @foreach ($item['children'] as [$label, $href, $active, $icon])
                                <a
                                    href="{{ $href }}"
                                    data-label="{{ $label }}"
                                    class="adm-link adm-sublink {{ $active ? 'is-active' : '' }}"
                                    @if ($active) aria-current="page" @endif
                                >
                                    <span class="adm-ico">{!! $icons[$icon] !!}</span>
                                    <span class="adm-label">{{ $label }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        <div class="adm-foot">
            <a href="{{ route('home') }}" data-label="View website" class="adm-link adm-muted">
                <span class="adm-ico">{!! $icons['globe'] !!}</span>
                <span class="adm-label">View website</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" data-label="Log out" class="adm-link adm-muted">
                    <span class="adm-ico">{!! $icons['logout'] !!}</span>
                    <span class="adm-label">Log out</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="adm-main">
        <header class="adm-header flex items-center justify-between border-b border-line bg-paper px-4 py-4 sm:px-6">
            <div style="display:flex; align-items:center; gap:.9rem; min-width:0;">
                <button type="button" class="adm-toggle" data-admin-nav-toggle aria-controls="admin-sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="adm-ico">{!! $icons['menu'] !!}</span>
                </button>
                <div>
                    <h1 class="text-xl font-semibold tracking-tight">@yield('heading', 'Dashboard')</h1>
                    <p class="text-sm text-ink-muted">@yield('subheading', 'Manage Galaw Automations website content')</p>
                </div>
            </div>
            <div class="text-sm text-ink-muted">{{ auth()->user()?->name }}</div>
        </header>

        <div id="admin-content" class="px-4 py-6 sm:px-6">
            @if ($errors->any())
                <div class="mb-4">
                    <x-ui.alert type="error">Please check the highlighted fields.</x-ui.alert>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    @if (session('success') || session('error'))
        <div class="adm-toast-host" aria-atomic="true">
            @if (session('success'))
                <x-admin.toast type="success" :message="session('success')" />
            @endif
            @if (session('error'))
                <x-admin.toast type="error" :message="session('error')" />
            @endif
        </div>
    @endif

    @livewireScripts

    <script>
        (function () {
            document.querySelectorAll('[data-adm-toast]').forEach(function (toast) {
                var hide = function () {
                    if (toast.classList.contains('is-leaving')) return;
                    toast.classList.add('is-leaving');
                    window.setTimeout(function () { toast.remove(); }, 220);
                };
                var btn = toast.querySelector('[data-adm-toast-close]');
                if (btn) btn.addEventListener('click', hide);
                window.setTimeout(hide, 4200);
            });

            var root = document.documentElement,
                mq = window.matchMedia('(min-width: 1024px)'),
                toggles = document.querySelectorAll('[data-admin-nav-toggle]'),
                labelled = document.querySelectorAll('.adm-sidebar [data-label]');

            function saved() { try { return localStorage.getItem('adminNav'); } catch (e) { return null; } }

            // native tooltips only while the sidebar is an icon rail
            function syncTitles() {
                var rail = mq.matches && root.dataset.adminNav === 'closed';
                labelled.forEach(function (el) {
                    if (rail) { el.setAttribute('title', el.dataset.label); } else { el.removeAttribute('title'); }
                });
            }

            function set(state, persist) {
                root.dataset.adminNav = state;
                toggles.forEach(function (b) { b.setAttribute('aria-expanded', state === 'open' ? 'true' : 'false'); });
                if (persist && mq.matches) { try { localStorage.setItem('adminNav', state); } catch (e) {} }
                syncTitles();
            }

            set(root.dataset.adminNav === 'open' ? 'open' : 'closed', false);

            toggles.forEach(function (b) {
                b.addEventListener('click', function () {
                    var opening = root.dataset.adminNav !== 'open';
                    set(opening ? 'open' : 'closed', true);
                    if (opening && !mq.matches) { var c = document.querySelector('.adm-close'); if (c) c.focus(); }
                });
            });

            // submenu accordion
            document.querySelectorAll('[data-adm-group]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var group = btn.closest('.adm-group'), open = !group.classList.contains('is-open');
                    group.classList.toggle('is-open', open);
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !mq.matches && root.dataset.adminNav === 'open') {
                    set('closed', false);
                    var t = document.querySelector('.adm-toggle'); if (t) t.focus();
                }
            });

            var onChange = function () { set(mq.matches ? (saved() === 'closed' ? 'closed' : 'open') : 'closed', false); };
            if (mq.addEventListener) { mq.addEventListener('change', onChange); } else if (mq.addListener) { mq.addListener(onChange); }
        })();
    </script>
</body>
</html>