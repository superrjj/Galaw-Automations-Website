@props(['settings' => []])

<footer class="border-t border-line bg-ink text-white">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-4">
        <div class="md:col-span-2">
            <div class="text-lg font-semibold">{{ $settings['company_name'] ?? 'Galaw Automations' }}</div>
            <p class="mt-3 max-w-md text-sm leading-relaxed text-white/70">
                We build websites, mobile applications, business systems, AI-powered solutions, integrations, and automation tools for businesses.
            </p>
        </div>

        <div>
            <div class="text-sm font-semibold uppercase tracking-wide text-white/50">Company</div>
            <div class="mt-4 flex flex-col gap-2 text-sm text-white/80">
                <a href="{{ route('about') }}" class="hover:text-white">About</a>
                <a href="{{ route('process') }}" class="hover:text-white">Process</a>
                <a href="{{ route('faq') }}" class="hover:text-white">FAQ</a>
                <a href="{{ route('contact') }}" class="hover:text-white">Contact</a>
            </div>
        </div>

        <div>
            <div class="text-sm font-semibold uppercase tracking-wide text-white/50">Contact</div>
            <div class="mt-4 space-y-2 text-sm text-white/80">
                @if (!empty($settings['company_email']))
                    <div>{{ $settings['company_email'] }}</div>
                @endif
                @if (!empty($settings['company_phone']) && !str_contains($settings['company_phone'], '[Replace'))
                    <div>{{ $settings['company_phone'] }}</div>
                @endif
                @if (!empty($settings['company_address']) && !str_contains($settings['company_address'], '[Replace'))
                    <div>{{ $settings['company_address'] }}</div>
                @endif
                <a href="{{ route('request-service') }}" class="inline-block text-accent hover:underline">Start a Project</a>
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
                <div class="mt-4 flex flex-wrap gap-3 text-sm">
                    @foreach ($socials as $label => $url)
                        <a href="{{ $url }}" class="text-white/70 hover:text-white" target="_blank" rel="noopener noreferrer">{{ $label }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="border-t border-white/10 px-4 py-4 text-center text-xs text-white/50">
        &copy; {{ date('Y') }} {{ $settings['company_name'] ?? 'Galaw Automations' }}. All rights reserved.
    </div>
</footer>
