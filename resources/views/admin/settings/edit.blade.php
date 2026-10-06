@extends('layouts.admin')

@section('title', 'Settings')
@section('heading', 'Website settings')
@section('subheading', 'Company details and SEO. API keys stay in .env.')

@section('content')
<style>
    /* scoped layout for this form; no Tailwind rebuild needed */
    @media (prefers-reduced-motion: no-preference) { html { scroll-behavior: smooth; } }

    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 15.5rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-main > * + * { margin-top: 1.25rem; }

    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.5rem; scroll-margin-top: 6.5rem; }
    .sf-head { display: flex; align-items: flex-start; gap: .75rem; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #edf0f4; }
    .sf-icon { display: grid; place-items: center; flex: none; width: 2.25rem; height: 2.25rem; border-radius: .5rem; background: #e8f5f1; color: #0f9474; }
    .sf-icon svg { width: 1.1rem; height: 1.1rem; }
    .sf-head h2 { margin: 0; font-size: 1rem; font-weight: 600; line-height: 1.4; }
    .sf-head p { margin: .1rem 0 0; font-size: .8125rem; color: #5b6b7e; }

    .sf-stack > * + * { margin-top: 1rem; }
    .sf-cols { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr)); }
    .sf-counter { margin: .35rem 0 0; font-size: .75rem; color: #8a97a8; text-align: right; }
    .sf-counter.is-over { color: #b54708; }

    .sf-nav { margin: 0 0 1rem; padding: 0; list-style: none; }
    .sf-nav a {
        display: block; padding: .45rem .75rem; border-left: 2px solid transparent; border-radius: 0 .4rem .4rem 0;
        font-size: .875rem; color: #5b6b7e; text-decoration: none; transition: background-color .15s, color .15s;
    }
    .sf-nav a:hover { background: #f4f7fa; color: #0f2340; }
    .sf-nav a[aria-current="true"] { border-left-color: #0f9474; background: #f4f7fa; color: #0f2340; font-weight: 600; }
    .sf-nav a:focus-visible { outline: 2px solid #0f9474; outline-offset: 2px; }
    @media (max-width: 1023px) { .sf-nav { display: none; } }

    .sf-save { padding-top: 1rem; border-top: 1px solid #edf0f4; }
    .sf-aside .sf-card { padding: 1.25rem; }
    .sf-status { display: flex; align-items: center; gap: .5rem; margin-bottom: .75rem; font-size: .8125rem; color: #5b6b7e; }
    .sf-status::before { content: ""; width: .5rem; height: .5rem; border-radius: 50%; background: #0f9474; flex: none; }
    .sf-status[data-dirty="true"]::before { background: #dc6803; }
    .sf-save button { width: 100%; justify-content: center; }
</style>

<form id="settings-form" method="POST" action="{{ route('admin.settings.update') }}" class="sf-grid">
    @csrf
    @method('PUT')

    <div class="sf-main">
        {{-- Company --}}
        <section id="company" class="sf-card" aria-labelledby="company-title">
            <div class="sf-head">
                <span class="sf-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M9 17h.01M15 9h.01M15 13h.01M15 17h.01"/></svg></span>
                <div>
                    <h2 id="company-title">Company</h2>
                    <p>Basic business and contact details.</p>
                </div>
            </div>
            <div class="sf-stack">
                <div class="sf-cols">
                    <x-ui.input label="Company name" name="company_name" :value="$settings['company_name'] ?? ''" required />
                    <x-ui.input label="Tagline" name="tagline" :value="$settings['tagline'] ?? ''" />
                </div>
                <div class="sf-cols">
                    <x-ui.input label="Company email" name="company_email" type="email" :value="$settings['company_email'] ?? ''" />
                    <x-ui.input label="Company phone" name="company_phone" :value="$settings['company_phone'] ?? ''" />
                </div>
                <div class="sf-cols">
                    <x-ui.input label="Company address" name="company_address" :value="$settings['company_address'] ?? ''" />
                    <x-ui.input label="Admin notification email" name="admin_notification_email" type="email" :value="$settings['admin_notification_email'] ?? ''" />
                </div>
            </div>
        </section>

        {{-- SEO --}}
        <section id="seo" class="sf-card" aria-labelledby="seo-title">
            <div class="sf-head">
                <span class="sf-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg></span>
                <div>
                    <h2 id="seo-title">SEO</h2>
                    <p>How the website appears in search results.</p>
                </div>
            </div>
            <div class="sf-stack">
                <x-ui.input label="SEO title" name="seo_title" :value="$settings['seo_title'] ?? ''" />
                <x-ui.textarea label="SEO description" name="seo_description" :value="$settings['seo_description'] ?? ''" rows="3" />
            </div>
        </section>

        {{-- About --}}
        <section id="about" class="sf-card" aria-labelledby="about-title">
            <div class="sf-head">
                <span class="sf-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8zM14 3v5h5M9 13h6M9 17h6"/></svg></span>
                <div>
                    <h2 id="about-title">About</h2>
                    <p>Introduction, mission, vision and values.</p>
                </div>
            </div>
            <div class="sf-stack">
                <x-ui.textarea label="About intro" name="about_intro" :value="$settings['about_intro'] ?? ''" rows="4" />
                <div class="sf-cols">
                    <x-ui.textarea label="Mission" name="mission" :value="$settings['mission'] ?? ''" rows="3" />
                    <x-ui.textarea label="Vision" name="vision" :value="$settings['vision'] ?? ''" rows="3" />
                </div>
                <div class="sf-cols">
                    <x-ui.textarea label="Philosophy" name="philosophy" :value="$settings['philosophy'] ?? ''" rows="4" />
                    <x-ui.textarea label="Values (one per line)" name="values" :value="$settings['values'] ?? ''" rows="4" />
                </div>
            </div>
        </section>

        {{-- Social links --}}
        <section id="social" class="sf-card" aria-labelledby="social-title">
            <div class="sf-head">
                <span class="sf-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/></svg></span>
                <div>
                    <h2 id="social-title">Social links</h2>
                    <p>Full profile URLs, starting with https://</p>
                </div>
            </div>
            <div class="sf-cols">
                <x-ui.input label="LinkedIn URL" name="social_linkedin" type="url" :value="$settings['social_linkedin'] ?? ''" />
                <x-ui.input label="Facebook URL" name="social_facebook" type="url" :value="$settings['social_facebook'] ?? ''" />
                <x-ui.input label="TikTok URL" name="social_tiktok" type="url" :value="$settings['social_tiktok'] ?? ''" />
                <x-ui.input label="GitHub URL" name="social_github" type="url" :value="$settings['social_github'] ?? ''" />
                <x-ui.input label="X URL" name="social_x" type="url" :value="$settings['social_x'] ?? ''" />
            </div>
        </section>
    </div>

    {{-- Side column: section navigation + save, stays in view while scrolling --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <nav aria-label="Settings sections">
                <ul class="sf-nav">
                    <li><a href="#company">Company</a></li>
                    <li><a href="#seo">SEO</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#social">Social links</a></li>
                </ul>
            </nav>
            <div class="sf-save">
                <p class="sf-status" data-status data-dirty="false" role="status">All changes saved</p>
                <x-ui.button type="submit">Save settings</x-ui.button>
            </div>
        </div>
    </aside>
</form>

<script>
    (function () {
        var form = document.getElementById('settings-form');
        if (!form) return;

        // Recommended length counters for the SEO fields (guidance only, not enforced)
        [['seo_title', 60], ['seo_description', 160]].forEach(function (pair) {
            var el = form.elements[pair[0]];
            if (!el) return;
            var out = document.createElement('p');
            out.className = 'sf-counter';
            out.setAttribute('aria-live', 'polite');
            el.insertAdjacentElement('afterend', out);
            function update() {
                var n = el.value.length;
                out.textContent = n + ' / ' + pair[1] + ' recommended';
                out.classList.toggle('is-over', n > pair[1]);
            }
            el.addEventListener('input', update);
            update();
        });

        // Unsaved-changes indicator and leave warning
        var status = form.querySelector('[data-status]');
        var submit = form.querySelector('[type="submit"]');
        var submitting = false, dirty = false;
        function snapshot() { return new URLSearchParams(new FormData(form)).toString(); }
        var initial = snapshot();
        function check() {
            dirty = snapshot() !== initial;
            status.dataset.dirty = dirty;
            status.textContent = dirty ? 'Unsaved changes' : 'All changes saved';
        }
        form.addEventListener('input', check);
        form.addEventListener('change', check);
        window.addEventListener('beforeunload', function (e) {
            if (dirty && !submitting) { e.preventDefault(); e.returnValue = ''; }
        });
        form.addEventListener('submit', function () {
            submitting = true;
            if (submit) { submit.setAttribute('aria-busy', 'true'); submit.textContent = 'Saving…'; submit.disabled = true; }
        });

        // Highlight the section currently in view
        var links = Array.prototype.slice.call(document.querySelectorAll('.sf-nav a'));
        if (!('IntersectionObserver' in window) || !links.length) return;
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                links.forEach(function (a) {
                    a.setAttribute('aria-current', a.getAttribute('href') === '#' + entry.target.id ? 'true' : 'false');
                });
            });
        }, { rootMargin: '-15% 0px -70% 0px' });
        links.forEach(function (a) {
            var target = document.querySelector(a.getAttribute('href'));
            if (target) observer.observe(target);
        });
        links[0].setAttribute('aria-current', 'true');
    })();
</script>
@endsection