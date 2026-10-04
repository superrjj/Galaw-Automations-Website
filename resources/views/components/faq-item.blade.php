@props(['faq'])

<div class="border-b border-line py-5" x-data="{ open: false }">
    <button type="button" class="flex w-full items-center justify-between gap-4 text-left" @click="open = !open">
        <span class="text-base font-semibold text-ink">{{ $faq->question }}</span>
        <span class="text-accent" x-text="open ? '−' : '+'"></span>
    </button>
    <div class="mt-3 text-sm leading-relaxed text-ink/70" x-cloak x-show="open">
        {{ $faq->answer }}
    </div>
</div>
