{{-- Decorative hero system diagram — matched 1:1 to the design reference (900×680 grid) --}}
@php
    $W = 900; $H = 680;
    // absolute box in % of the 900x680 grid
    $pos = fn ($x, $y, $w, $h = null) => sprintf(
        'left:%.3f%%;top:%.3f%%;width:%.3f%%;%s',
        $x / $W * 100, $y / $H * 100, $w / $W * 100,
        $h === null ? '' : sprintf('height:%.3f%%;', $h / $H * 100)
    );
    // scalable unit: 1u = 1px at 900px wide, scales with the container
    $u = fn ($n) => 'calc(var(--u) * ' . $n . ')';

    $ico = fn (string $b) => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full">' . $b . '</svg>';

    $teeth = '';
    foreach (range(0, 315, 45) as $a) {
        $teeth .= '<path d="M12 2.4v3.2" transform="rotate(' . $a . ' 12 12)" stroke-width="3.4" stroke-linecap="butt"/>';
    }

    $icons = [
        'globe'  => $ico('<circle cx="12" cy="12" r="10"/><path d="M2 12h20M4 7h16M4 17h16M12 2c2.8 2.7 4.2 6 4.2 10s-1.4 7.3-4.2 10c-2.8-2.7-4.2-6-4.2-10S9.2 4.7 12 2z"/>'),
        'phone'  => $ico('<rect x="6.5" y="2" width="11" height="20" rx="2.6"/><path d="M11 18.6h2"/>'),
        'server' => $ico('<rect x="3" y="3" width="18" height="7.5" rx="2"/><rect x="3" y="13.5" width="18" height="7.5" rx="2"/><path d="M7 6.75h.01M7 17.25h.01M11 6.75h6M11 17.25h6"/>'),
        'gear'   => $ico('<circle cx="12" cy="12" r="6.6"/><circle cx="12" cy="12" r="2.6"/>' . $teeth),
        'bolt'   => $ico('<path d="M13.2 2 4.5 13.6h6.2L9.8 22l8.7-11.6h-6.2z" fill="currentColor"/>'),
        'home'   => $ico('<path d="M4 11 12 4l8 7M6 9.5V20h12V9.5M10 20v-5h4v5"/>'),
        'files'  => $ico('<path d="M14 3H7.5A2.5 2.5 0 0 0 5 5.5v13A2.5 2.5 0 0 0 7.5 21h9a2.5 2.5 0 0 0 2.5-2.5V8z"/><path d="M14 3v5h5"/>'),
        'search' => $ico('<circle cx="11" cy="11" r="6.5"/><path d="m16 16 4.5 4.5"/>'),
        'git'    => $ico('<circle cx="6" cy="5.5" r="2.2"/><circle cx="6" cy="18.5" r="2.2"/><circle cx="17" cy="8" r="2.2"/><path d="M6 7.7v8.6M17 10.2c0 3.5-3 4.3-6.5 4.8-2.2.3-4.5.8-4.5 3"/>'),
        'run'    => $ico('<path d="M7 4.5v15l12-7.5z"/>'),
    ];

    $check = '<svg viewBox="0 0 24 24" class="h-full w-full"><circle cx="12" cy="12" r="11" fill="#0f9474"/><path d="m7 12.5 3.2 3.2L17 8.8" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

    $mysql = '<svg viewBox="0 0 24 24" fill="none" stroke="#14998a" stroke-width="1.8" stroke-linecap="round" class="h-full w-full"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3"/></svg>';

    $cloud = '<svg viewBox="0 0 24 24" class="h-full w-full"><path d="M6.8 19a4.6 4.6 0 0 1-.6-9.16A6.2 6.2 0 0 1 18 10a4.5 4.5 0 0 1 .4 9z" fill="#2f74e8"/><path d="M9 16a2.4 2.4 0 0 1 .3-4.78 3.4 3.4 0 0 1 6.4 1 2.1 2.1 0 0 1-.3 3.78z" fill="none" stroke="#fff" stroke-width="1.4" stroke-linejoin="round"/></svg>';

    $cards = [
        [93, 18, 254, 107, 'globe', 'Web Application', 'Fast. Secure. Scalable.'],
        [460, 18, 200, 107, 'phone', 'Mobile App', 'iOS & Android'],
        [654, 156, 238, 108, 'server', 'Business System', 'Streamline Operations'],
        [654, 308, 240, 114, 'gear', 'Automation', 'Save Time. Reduce Work.'],
    ];

    $workflow = [
        [137, 'bolt', 'Trigger'],
        [286, 'gear', 'Process'],
        [430, 'check', 'Result'],
    ];

    // syntax colours
    $c = ['kw' => '#f0753f', 'cls' => '#20b8aa', 'str' => '#5aa9f0', 'fn' => '#d5dce4', 'txt' => '#aab6c6', 'cm' => '#6b7b92', 'tag' => '#8b97a8'];
    // sample code: each line is a list of [colour, text]
    $code = [
        [['tag', '<' . '?php']],
        [['cls', 'Route'], ['txt', '::'], ['fn', 'get'], ['txt', '('], ['str', "'/'"], ['txt', ', '], ['kw', 'function'], ['txt', ' () {']],
        [['txt', '    '], ['kw', 'return'], ['txt', ' '], ['fn', 'view'], ['txt', '('], ['str', "'home'"], ['txt', ');']],
        [['txt', '});']],
        [],
        [['cls', 'Route'], ['txt', '::'], ['fn', 'post'], ['txt', '('], ['str', "'/order'"], ['txt', ', '], ['kw', 'function'], ['txt', ' () {']],
        [['txt', '    '], ['cls', 'Order'], ['txt', '::'], ['fn', 'create'], ['txt', '('], ['fn', 'request'], ['txt', '()->'], ['fn', 'all'], ['txt', '());']],
        [['txt', '    '], ['kw', 'return'], ['txt', ' ['], ['str', "'status'"], ['txt', ' => '], ['str', "'ok'"], ['txt', '];']],
        [['txt', '});']],
        [['cm', '// Build smarter. Automate better.']],
    ];
@endphp

<style>
    @keyframes hd-flow { to { stroke-dashoffset: -20; } }
    .hd-flow path { animation: hd-flow 1.4s linear infinite; }
    @media (prefers-reduced-motion: reduce) {
        .hd-flow path { animation: none; }
        .hd-packet { display: none; }
    }
    @media (min-width: 1024px) {
        .hero-diagram { width: 122%; max-width: none; margin-left: -18%; }
    }
</style>
<div {{ $attributes->merge(['class' => 'hero-diagram relative mx-auto w-full max-w-[56rem]']) }} style="container-type: inline-size; font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif;" aria-hidden="true">
    <div class="relative w-full" style="aspect-ratio: 900 / 680; --u: calc(100cqw / 900);">

        {{-- Dotted connectors --}}
        <svg class="pointer-events-none absolute inset-0 z-0 h-full w-full" viewBox="0 0 900 680" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g class="hd-flow" stroke="#17a07f" stroke-width="1.8" stroke-dasharray="4 6" stroke-linecap="round" opacity="0.85">
                {{-- tech stack -> IDE --}}
                <path id="hd-stack" d="M89 205 H111 Q123 205 123 217 V435 Q123 447 111 447 H89" />
                <path id="hd-mysql" d="M89 319 H141" />
                {{-- mobile -> IDE top --}}
                {{-- web application -> IDE top --}}
                <path id="hd-web" d="M220 125 V159" />
                <path id="hd-top" d="M457 69 H415 Q403 69 403 81 V159" />
                {{-- IDE -> right cards / devices --}}
                <path id="hd-r1" d="M586 265 H598 Q610 265 610 253 V217 Q610 205 622 205 H650" />
                <path id="hd-r2" d="M610 265 V349 Q610 361 622 361 H650" />
                <path id="hd-r3" d="M610 349 V541 Q610 565 586 565 H526" />
                {{-- IDE -> workflow --}}
                <path id="hd-w1" d="M183 462 V511" />
                <path id="hd-w2" d="M333 462 V511" />
                <path id="hd-w3" d="M476 462 V511" />
                {{-- workflow links --}}
                <path id="hd-l1" d="M232 565 H286" />
                <path id="hd-l2" d="M379 565 H430" />
            </g>
            <g fill="#17a07f">
                <circle cx="89" cy="205" r="3.4" />
                <circle cx="89" cy="319" r="3.4" />
                <circle cx="89" cy="447" r="3.4" />
                <circle cx="123" cy="319" r="3.4" />
                <circle cx="457" cy="69" r="3.4" />
                <circle cx="220" cy="125" r="3.4" />
                <circle cx="220" cy="159" r="3.4" />
                <circle cx="650" cy="205" r="3.4" />
                <circle cx="650" cy="361" r="3.4" />
                <circle cx="183" cy="511" r="3.4" />
                <circle cx="333" cy="511" r="3.4" />
                <circle cx="476" cy="511" r="3.4" />
                <circle cx="232" cy="565" r="3.4" />
                <circle cx="383" cy="565" r="3.4" />
                <circle cx="426" cy="565" r="3.4" />
                <circle cx="526" cy="565" r="3.4" />
            </g>
            {{-- travelling "data packets" along the connectors --}}
            <g class="hd-packet">
                @foreach ([
                    ['hd-stack', 3.6, 0], ['hd-mysql', 1.8, 0], ['hd-web', 1.4, -0.4], ['hd-top', 2.6, -1],
                    ['hd-r1', 2.4, 0], ['hd-r2', 2.0, -0.8], ['hd-r3', 3.8, -1.4],
                    ['hd-w1', 1.6, 0], ['hd-w2', 1.6, -0.5], ['hd-w3', 1.6, -1],
                    ['hd-l1', 1.4, -0.3], ['hd-l2', 1.4, -0.9],
                ] as [$pid, $dur, $begin])
                    <g>
                        <circle r="7" fill="#17a07f" opacity=".18" />
                        <circle r="3.8" fill="#17a07f" />
                        <animateMotion dur="{{ $dur }}s" begin="{{ $begin }}s" repeatCount="indefinite" calcMode="linear">
                            <mpath href="#{{ $pid }}" />
                        </animateMotion>
                    </g>
                @endforeach
            </g>
        </svg>

        {{-- Center IDE --}}
        <div class="absolute z-10 flex flex-col overflow-hidden shadow-[0_30px_60px_-30px_rgba(15,32,56,0.6)]"
             style="{{ $pos(141, 159, 445, 303) }} background:#17283f; border-radius: {{ $u(9) }};">
            <div class="flex items-center justify-between" style="height:17%; padding: 0 {{ $u(18) }};">
                <div class="flex items-center whitespace-nowrap" style="gap: {{ $u(12) }}; color: rgba(255,255,255,.85); font-size: {{ $u(14) }};">
                    <span style="color: rgba(255,255,255,.7); letter-spacing:.05em;">&lt;/&gt;</span>
                    <span>Laravel · PHP · APIs · Automation</span>
                </div>
                <div class="flex items-center" style="gap: {{ $u(4) }};">
                    <span class="rounded-full" style="width:{{ $u(5) }};height:{{ $u(5) }};background:#3b9cf0"></span>
                    <span class="rounded-full" style="width:{{ $u(5) }};height:{{ $u(5) }};background:#3b9cf0"></span>
                    <span class="rounded-full" style="width:{{ $u(5) }};height:{{ $u(5) }};background:#3b9cf0"></span>
                </div>
            </div>
            <div class="flex min-h-0 flex-1">
                {{-- activity bar --}}
                <div class="relative flex shrink-0 flex-col items-center" style="width:17%; padding: {{ $u(10) }} 0 {{ $u(10) }}; gap: {{ $u(8) }}; background:#13243a;">
                    <span class="absolute left-0 rounded-r" style="top: {{ $u(10) }}; width:{{ $u(2.5) }}; height:{{ $u(34) }}; background:#3dd1b0;"></span>
                    <span class="flex items-center justify-center" style="width:{{ $u(34) }};height:{{ $u(34) }};border-radius:{{ $u(8) }};background:#294760;border:1px solid rgba(255,255,255,.12);color:#8fd9c7;">
                        <span style="width:{{ $u(20) }};height:{{ $u(20) }};display:block">{!! $icons['home'] !!}</span>
                    </span>
                    @foreach (['files', 'search', 'git', 'run'] as $ai)
                        <span class="flex items-center justify-center" style="width:{{ $u(34) }};height:{{ $u(26) }};color: rgba(255,255,255,.5);">
                            <span style="width:{{ $u(17) }};height:{{ $u(17) }};display:block">{!! $icons[$ai] !!}</span>
                        </span>
                    @endforeach
                    <span class="mt-auto flex items-center justify-center" style="width:{{ $u(34) }};height:{{ $u(26) }};color: rgba(255,255,255,.4);">
                        <span style="width:{{ $u(17) }};height:{{ $u(17) }};display:block">{!! $icons['gear'] !!}</span>
                    </span>
                </div>

                {{-- editor: tabs + code --}}
                <div class="flex min-w-0 flex-1 flex-col" style="margin-right: {{ $u(10) }};">
                    <div class="flex items-stretch" style="height: {{ $u(22) }}; background:#122338; font-size: {{ $u(10) }};">
                        <span class="flex items-center whitespace-nowrap" style="gap:{{ $u(6) }}; padding: 0 {{ $u(12) }}; background:#0b1a2d; color:#d5dce4; border-top: {{ $u(1.5) }} solid #3dd1b0;">
                            <span style="width:{{ $u(6) }};height:{{ $u(6) }};border-radius:2px;background:#8f9bd1;display:block"></span>web.php
                        </span>
                        <span class="flex items-center whitespace-nowrap" style="gap:{{ $u(6) }}; padding: 0 {{ $u(12) }}; color:#6b7b92;">
                            <span style="width:{{ $u(6) }};height:{{ $u(6) }};border-radius:2px;background:#4a5b73;display:block"></span>OrderController.php
                        </span>
                    </div>
                    {{-- code panel --}}
                    <div class="min-h-0 flex-1 overflow-hidden" style="background:#0b1a2d; padding: {{ $u(6) }} {{ $u(12) }}; font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, 'Liberation Mono', monospace; font-size: {{ $u(12.5) }}; line-height: {{ $u(18) }};">
                        @foreach ($code as $i => $line)
                            <div class="flex whitespace-pre"><span class="shrink-0 select-none" style="width: {{ $u(22) }}; color:#46576f;">{{ $i + 1 }}</span><span>@foreach ($line as [$k, $t])<span style="color: {{ $c[$k] }};">{{ $t }}</span>@endforeach</span></div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- status bar --}}
            <div class="flex shrink-0 items-center justify-between whitespace-nowrap" style="height: {{ $u(22) }}; padding: 0 {{ $u(12) }}; background:#0f9474; color:#fff; font-size: {{ $u(10) }};">
                <span class="flex items-center" style="gap:{{ $u(6) }};">
                    <span style="width:{{ $u(11) }};height:{{ $u(11) }};display:block">{!! $icons['git'] !!}</span>main
                </span>
                <span style="opacity:.92;">Ln 10, Col 36 &nbsp;·&nbsp; UTF-8 &nbsp;·&nbsp; PHP 8.3</span>
            </div>
        </div>

        {{-- Left tech stack (bare icons + labels) --}}
        @foreach ([['laravel', 195, 54, 'Laravel'], ['mysql', 318, 46, 'MySQL'], ['cloud', 450, 44, 'Cloud']] as [$tech, $cy, $size, $label])
            <div class="absolute z-20 flex flex-col items-center" style="left: {{ 8 / $W * 100 }}%; width: {{ 80 / $W * 100 }}%; top: {{ ($cy - $size / 2) / $H * 100 }}%; gap: {{ $u(13) }};">
                <span class="block" style="width: {{ $u($size) }}; height: {{ $u($size) }};">
                    @if ($tech === 'laravel')
                        <x-technology-icon name="laravel" style="color:#FF2D20; width:100%; height:100%;" />
                    @elseif ($tech === 'mysql')
                        {!! $mysql !!}
                    @else
                        {!! $cloud !!}
                    @endif
                </span>
                <span class="whitespace-nowrap font-medium leading-none" style="color:#0f2340; font-size: {{ $u(14.5) }};">{{ $label }}</span>
            </div>
        @endforeach

        {{-- Service cards --}}
        @foreach ($cards as [$x, $y, $w, $h, $icon, $title, $sub])
            <div class="absolute z-20 flex items-center bg-white shadow-[0_14px_34px_-18px_rgba(26,51,80,0.35)]"
                 style="{{ $pos($x, $y, $w, $h) }} padding-left: {{ $u(22) }}; gap: {{ $u(18) }}; border-radius: {{ $u(10) }}; border:1px solid #edf1f5;">
                <span class="block shrink-0" style="width: {{ $u(44) }}; height: {{ $u(44) }}; color:#0f9474;">{!! $icons[$icon] !!}</span>
                <div class="min-w-0 whitespace-nowrap">
                    <div class="font-semibold leading-tight" style="color:#0f2340; font-size: {{ $u(16.5) }};">{{ $title }}</div>
                    <div class="leading-tight" style="color:#55657d; font-size: {{ $u(13.2) }}; margin-top: {{ $u(5) }};">{{ $sub }}</div>
                </div>
            </div>
        @endforeach

        {{-- Workflow --}}
        @foreach ($workflow as [$x, $icon, $label])
            <div class="absolute z-20 flex flex-col items-center justify-center bg-white shadow-[0_10px_24px_-16px_rgba(26,51,80,0.45)]"
                 style="{{ $pos($x, 514, 93, 108) }} gap: {{ $u(10) }}; border-radius: {{ $u(10) }}; border:1px solid #edf1f5;">
                <span class="block" style="width: {{ $u(36) }}; height: {{ $u(36) }}; color:#0f9474;">
                    @if ($icon === 'check') {!! $check !!} @else {!! $icons[$icon] !!} @endif
                </span>
                <span class="font-semibold leading-none" style="color:#0f2340; font-size: {{ $u(14.5) }};">{{ $label }}</span>
            </div>
        @endforeach

        {{-- Phone --}}
        <div class="absolute z-20 flex flex-col items-center bg-white shadow-md"
             style="{{ $pos(642, 479, 55, 125) }} border: {{ $u(3.5) }} solid #14243d; border-radius: {{ $u(11) }}; padding: {{ $u(6) }} {{ $u(7) }};">
            <span class="block" style="width:35%; height:{{ $u(3) }}; background:#14243d; border-radius:99px;"></span>
            <span class="flex items-center justify-center rounded-full" style="margin-top:{{ $u(12) }}; width:{{ $u(28) }}; height:{{ $u(28) }}; border: {{ $u(2.5) }} solid #0f9474;">
                <span class="block rounded-full" style="width:{{ $u(9) }}; height:{{ $u(9) }}; border: {{ $u(2) }} solid #0f9474;"></span>
            </span>
            <div class="mt-auto w-full" style="display:flex; flex-direction:column; gap:{{ $u(4) }};">
                <span class="block" style="height:{{ $u(4) }}; background:#dde4ea; border-radius:99px;"></span>
                <span class="block" style="height:{{ $u(4) }}; width:66%; background:#dde4ea; border-radius:99px;"></span>
            </div>
            <span class="block rounded-full" style="margin-top:{{ $u(8) }}; width:{{ $u(6) }}; height:{{ $u(6) }}; background:#14243d;"></span>
        </div>

        {{-- Desktop --}}
        <div class="absolute z-20 flex flex-col items-center" style="{{ $pos(712, 450, 160, 155) }}">
            <div class="flex w-full flex-1 flex-col overflow-hidden bg-[#f4f6f8] shadow-md" style="border: {{ $u(5) }} solid #14243d; border-radius: {{ $u(6) }}; padding: {{ $u(6) }};">
                <div class="flex items-center" style="gap:{{ $u(3) }}; margin-bottom:{{ $u(6) }};">
                    <span class="rounded-full" style="width:{{ $u(4) }};height:{{ $u(4) }};background:#FF5F57"></span>
                    <span class="rounded-full" style="width:{{ $u(4) }};height:{{ $u(4) }};background:#FEBC2E"></span>
                    <span class="rounded-full" style="width:{{ $u(4) }};height:{{ $u(4) }};background:#28C840"></span>
                </div>
                <div class="flex min-h-0 flex-1" style="gap:{{ $u(6) }};">
                    <div class="flex flex-col" style="width:24%; gap:{{ $u(5) }};">
                        <span class="block" style="height:{{ $u(14) }}; background:#dfe5ea; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(14) }}; background:#dfe5ea; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(14) }}; background:#dfe5ea; border-radius:{{ $u(3) }};"></span>
                    </div>
                    <div class="flex flex-1 flex-col" style="gap:{{ $u(5) }};">
                        <span class="block" style="height:{{ $u(9) }}; background:#cdd6dd; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(11) }}; background:#7fd6b4; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(11) }}; background:#7fd6b4; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(11) }}; background:#dfe5ea; border-radius:{{ $u(3) }};"></span>
                        <span class="block" style="height:{{ $u(11) }}; background:#dfe5ea; border-radius:{{ $u(3) }};"></span>
                    </div>
                </div>
            </div>
            <div style="width:{{ $u(16) }}; height:{{ $u(10) }}; background:#14243d;"></div>
            <div style="width:{{ $u(46) }}; height:{{ $u(5) }}; background:#14243d; border-radius:99px;"></div>
        </div>

        {{-- Tagline --}}
        <p class="absolute right-0 whitespace-nowrap text-right font-semibold uppercase" style="top: {{ 655 / $H * 100 }}%; color:#5b6b86; font-size: {{ $u(13) }}; letter-spacing: .22em;">
            Scalable / Secure / Reliable
        </p>
    </div>
</div>