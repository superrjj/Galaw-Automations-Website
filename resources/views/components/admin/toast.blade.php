@props([
    'type' => 'success',
    'message' => null,
])

@php
    $message = $message ?? $slot;
    $isError = $type === 'error';
@endphp

<div
    class="adm-toast {{ $isError ? 'is-error' : 'is-success' }}"
    role="{{ $isError ? 'alert' : 'status' }}"
    aria-live="polite"
    data-adm-toast
>
    <span class="adm-toast-icon" aria-hidden="true">
        @if ($isError)
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6M9 9l6 6"/></svg>
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8.5 12.5 2.5 2.5 5-5"/></svg>
        @endif
    </span>
    <p class="adm-toast-msg">{{ $message }}</p>
    <button type="button" class="adm-toast-close" data-adm-toast-close aria-label="Dismiss">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
</div>
