@props(['settings' => []])

<footer class="border-t border-white/10 bg-ink text-white">
    <div class="site-shell grid gap-12 py-14 md:grid-cols-4">
        <div class="md:col-span-2">
            <a href="{{ route('home') }}" class="inline-block bg-paper px-3 py-2">
                <x-brand-logo variant="light" />
            </a>
            <p class="mt-5 max-w-md text-sm leading-relaxed text-white/60">
                We build websites, mobile applications, business systems, AI-powered solutions, integrations, and automation tools for businesses.
            </p>
        </div>

        <div>
            <div class="text-xs font-semibold uppercase tracking-[0.18em] text-white/35">Company</div>
            <div class="mt-4 flex flex-col gap-2.5 text-sm text-white/70">
                <a href="{{ route('about') }}" class="transition hover:text-white">About</a>
                <a href="{{ route('services.index') }}" class="transition hover:text-white">Services</a>
                <a href="{{ route('portfolio.index') }}" class="transition hover:text-white">Portfolio</a>
                <a href="{{ route('process') }}" class="transition hover:text-white">Process</a>
                <a href="{{ route('faq') }}" class="transition hover:text-white">FAQ</a>
                <a href="{{ route('contact') }}" class="transition hover:text-white">Contact</a>
            </div>
        </div>

        <div>
            <div class="text-xs font-semibold uppercase tracking-[0.18em] text-white/35">Contact</div>
            <div class="mt-4 space-y-2 text-sm text-white/70">
                @if (!empty($settings['company_email']))
                    <div>{{ $settings['company_email'] }}</div>
                @endif
                @if (!empty($settings['company_phone']) && !str_contains($settings['company_phone'], '[Replace'))
                    <div>{{ $settings['company_phone'] }}</div>
                @endif
                @if (!empty($settings['company_address']) && !str_contains($settings['company_address'], '[Replace'))
                    <div>{{ $settings['company_address'] }}</div>
                @endif
                <a href="{{ route('request-service') }}" class="inline-flex items-center gap-1 font-medium text-accent transition hover:text-white">
                    Start a Project
                    <x-ui.icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>

            @php
                $socials = collect([
                    'Facebook' => $settings['social_facebook'] ?? null,
                    'LinkedIn' => $settings['social_linkedin'] ?? null,
                    'GitHub' => $settings['social_github'] ?? null,
                    'X' => $settings['social_x'] ?? null,
                ])->filter();
            @endphp
            @if ($socials->isNotEmpty())
                <div class="mt-5 flex flex-wrap gap-3 text-sm">
                    @foreach ($socials as $label => $url)
                        <a href="{{ $url }}" class="text-white/50 transition hover:text-white" target="_blank" rel="noopener noreferrer">{{ $label }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="border-t border-white/10 px-4 py-5 text-center text-xs text-white/35">
        &copy; {{ date('Y') }} {{ $settings['company_name'] ?? 'Galaw Automations' }}. All rights reserved.
    </div>
</footer>
