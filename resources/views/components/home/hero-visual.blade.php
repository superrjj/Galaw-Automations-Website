{{-- Decorative hero system diagram — layout matched to design reference --}}
<div {{ $attributes->merge(['class' => 'relative mx-auto w-full max-w-[38rem]']) }} aria-hidden="true">
    <div class="relative mx-auto h-[32rem] w-full sm:h-[34rem]">
        {{-- Dotted connector network --}}
        <svg class="pointer-events-none absolute inset-0 h-full w-full" viewBox="0 0 580 540" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g stroke="#459e97" stroke-width="1.6" stroke-dasharray="3.5 4.5" opacity="0.65">
                {{-- IDE to Web Application --}}
                <path d="M260 175 V105" />
                {{-- IDE to Mobile App --}}
                <path d="M320 170 C390 145 420 125 455 105" />
                {{-- IDE to Business System --}}
                <path d="M345 245 C410 245 445 265 475 285" />
                {{-- IDE to Automation --}}
                <path d="M330 310 C400 335 430 365 465 390" />
                {{-- Tech stack to IDE --}}
                <path d="M95 215 C145 215 190 200 230 190" />
                <path d="M95 265 C145 265 195 255 235 245" />
                <path d="M95 315 C145 315 195 300 235 285" />
                {{-- Workflow to IDE --}}
                <path d="M200 385 C230 355 250 335 265 320" />
                <path d="M290 385 C290 355 290 335 290 320" />
                <path d="M380 385 C350 355 320 335 300 320" />
            </g>
        </svg>

        {{-- Center IDE --}}
        <div class="absolute left-[48%] top-[18%] z-10 w-[54%] -translate-x-1/2 overflow-hidden rounded-2xl bg-ink shadow-[0_28px_60px_-28px_rgba(26,51,80,0.55)] sm:w-[50%]">
            <div class="flex items-center justify-between border-b border-white/10 px-3 py-2.5">
                <div class="flex min-w-0 items-center gap-2">
                    <span class="text-[10px] text-white/45">&lt;/&gt;</span>
                    <span class="truncate text-[10px] font-medium tracking-wide text-white/55">Laravel · PHP · APIs · Automation</span>
                </div>
                <div class="flex shrink-0 items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-[#FF5F57]"></span>
                    <span class="h-2 w-2 rounded-full bg-[#FEBC2E]"></span>
                    <span class="h-2 w-2 rounded-full bg-[#28C840]"></span>
                </div>
            </div>
            <div class="flex">
                <div class="flex w-8 shrink-0 flex-col items-center gap-3 border-r border-white/10 py-3 text-white/30">
                    <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
                    <span class="h-1.5 w-1.5 rounded-full bg-white/25"></span>
                    <span class="h-1.5 w-1.5 rounded-full bg-white/25"></span>
                    <span class="h-1.5 w-1.5 rounded-full bg-white/25"></span>
                </div>
                <div class="min-w-0 flex-1 space-y-2.5 px-3.5 py-3.5">
                    <div class="h-1.5 w-[78%] rounded-full bg-[#5B9FD4]"></div>
                    <div class="h-1.5 w-[58%] rounded-full bg-[#E8A87C]"></div>
                    <div class="h-1.5 w-[88%] rounded-full bg-white/70"></div>
                    <div class="h-1.5 w-[42%] rounded-full bg-accent"></div>
                    <div class="h-1.5 w-[70%] rounded-full bg-[#7EB6E0]"></div>
                    <div class="h-1.5 w-[52%] rounded-full bg-white/40"></div>
                    <div class="pt-0.5 font-mono text-[10px] text-accent sm:text-[11px]">return view('home');</div>
                </div>
            </div>
        </div>

        {{-- Left tech stack --}}
        <div class="absolute left-[1%] top-[32%] z-20 flex flex-col gap-3.5">
            @foreach ([
                ['laravel', '#FF2D20'],
                ['mysql', '#4479A1'],
                ['cloud-platforms', '#4285F4'],
            ] as [$tech, $color])
                <div class="flex h-11 w-11 items-center justify-center rounded-full border border-line bg-paper shadow-[0_10px_22px_-12px_rgba(26,51,80,0.5)]">
                    <x-technology-icon :name="$tech" class="h-5 w-5" style="color: {{ $color }}" />
                </div>
            @endforeach
        </div>

        {{-- Service cards --}}
        <div class="absolute left-[10%] top-[1%] z-20 w-[46%] rounded-xl border border-line bg-paper p-3 shadow-[0_14px_34px_-18px_rgba(26,51,80,0.4)] sm:left-[12%] sm:w-[42%] sm:p-3.5">
            <div class="flex items-start gap-2.5">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    <x-ui.icon name="globe" class="h-4 w-4" />
                </span>
                <div class="min-w-0">
                    <div class="text-[12px] font-semibold text-ink sm:text-[13px]">Web Application</div>
                    <div class="mt-0.5 text-[10px] leading-snug text-ink-muted sm:text-[11px]">Fast. Secure. Scalable.</div>
                </div>
            </div>
        </div>

        <div class="absolute right-0 top-[6%] z-20 w-[44%] rounded-xl border border-line bg-paper p-3 shadow-[0_14px_34px_-18px_rgba(26,51,80,0.4)] sm:w-[40%] sm:p-3.5">
            <div class="flex items-start gap-2.5">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    <x-ui.icon name="smartphone" class="h-4 w-4" />
                </span>
                <div class="min-w-0">
                    <div class="text-[12px] font-semibold text-ink sm:text-[13px]">Mobile App</div>
                    <div class="mt-0.5 text-[10px] leading-snug text-ink-muted sm:text-[11px]">iOS &amp; Android</div>
                </div>
            </div>
        </div>

        <div class="absolute right-0 top-[36%] z-20 w-[44%] rounded-xl border border-line bg-paper p-3 shadow-[0_14px_34px_-18px_rgba(26,51,80,0.4)] sm:w-[40%] sm:p-3.5">
            <div class="flex items-start gap-2.5">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    <x-ui.icon name="layers" class="h-4 w-4" />
                </span>
                <div class="min-w-0">
                    <div class="text-[12px] font-semibold text-ink sm:text-[13px]">Business System</div>
                    <div class="mt-0.5 text-[10px] leading-snug text-ink-muted sm:text-[11px]">Streamline Operations</div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-[28%] right-0 z-20 w-[44%] rounded-xl border border-line bg-paper p-3 shadow-[0_14px_34px_-18px_rgba(26,51,80,0.4)] sm:bottom-[26%] sm:w-[40%] sm:p-3.5">
            <div class="flex items-start gap-2.5">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-soft text-accent">
                    <x-ui.icon name="sliders" class="h-4 w-4" />
                </span>
                <div class="min-w-0">
                    <div class="text-[12px] font-semibold text-ink sm:text-[13px]">Automation</div>
                    <div class="mt-0.5 text-[10px] leading-snug text-ink-muted sm:text-[11px]">Save Time. Reduce Work.</div>
                </div>
            </div>
        </div>

        {{-- Workflow --}}
        <div class="absolute bottom-[7%] left-[8%] z-20 flex w-[58%] items-center gap-2 sm:left-[10%] sm:w-[54%]">
            @foreach ([
                ['bolt', 'Trigger'],
                ['sliders', 'Process'],
                ['check', 'Result'],
            ] as $i => [$icon, $label])
                @if ($i > 0)
                    <div class="h-px flex-1 border-t border-dashed border-accent/55"></div>
                @endif
                <div class="flex min-w-[4.25rem] flex-col items-center gap-1.5 rounded-xl border border-line bg-paper px-2 py-2 shadow-[0_10px_24px_-16px_rgba(26,51,80,0.45)]">
                    <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-accent-soft text-accent">
                        <x-ui.icon :name="$icon" class="h-3.5 w-3.5" />
                    </span>
                    <span class="text-[10px] font-semibold text-ink">{{ $label }}</span>
                </div>
            @endforeach
        </div>

        {{-- Mini devices --}}
        <div class="absolute bottom-[6%] right-[2%] z-10 hidden items-end gap-2 sm:flex">
            <div class="h-[4.25rem] w-9 rounded-[10px] border border-line bg-paper p-1 shadow-sm">
                <div class="flex h-full flex-col gap-1 rounded-md bg-paper-soft p-1">
                    <div class="h-1 w-full rounded-full bg-line"></div>
                    <div class="h-1 w-2/3 rounded-full bg-line"></div>
                    <div class="mt-auto h-4 rounded bg-accent/20"></div>
                </div>
            </div>
            <div class="h-14 w-[4.75rem] rounded-md border border-line bg-paper p-1 shadow-sm">
                <div class="h-full rounded-sm bg-ink p-1.5">
                    <div class="mb-1 h-1 w-1/2 rounded-full bg-white/30"></div>
                    <div class="space-y-1">
                        <div class="h-1 w-full rounded-full bg-sky-400/50"></div>
                        <div class="h-1 w-3/4 rounded-full bg-white/25"></div>
                        <div class="h-1 w-1/2 rounded-full bg-accent/40"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-0 text-right text-[10px] font-semibold uppercase tracking-[0.28em] text-accent/70 sm:text-[11px]">
        Scalable / Secure / Reliable
    </p>
</div>
