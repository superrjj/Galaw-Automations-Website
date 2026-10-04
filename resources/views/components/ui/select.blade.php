@props([
    'label' => null,
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Select an option',
    'hint' => null,
])

@php
    $required = $attributes->has('required');
    $hasError = $errors->has($name);
    $hintId = $hint ? "{$name}-hint" : null;
    $errorId = $hasError ? "{$name}-error" : null;
    $describedBy = collect([$hintId, $errorId])->filter()->implode(' ');
    $fieldClasses = 'w-full rounded-md border bg-paper px-3.5 py-2.5 text-sm text-ink outline-none transition focus:ring-2 focus:ring-accent/20';
    $fieldClasses .= $hasError
        ? ' border-red-400 focus:border-red-500'
        : ' border-line focus:border-accent';
@endphp

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-ink">
            {{ $label }}
            @if ($required)
                <span class="text-accent" aria-hidden="true">*</span>
            @endif
        </label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($required) aria-required="true" @endif
        @if ($hasError) aria-invalid="true" @endif
        @if ($describedBy !== '') aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->merge(['class' => $fieldClasses]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $labelText)
            <option value="{{ $value }}" @selected((string) old($name, $selected) === (string) $value)>{{ $labelText }}</option>
        @endforeach
    </select>
    @if ($hint)
        <p id="{{ $hintId }}" class="mt-1 text-xs text-ink-muted">{{ $hint }}</p>
    @endif
    @error($name)
        <p id="{{ $errorId }}" class="mt-1 text-sm text-red-700" role="alert">{{ $message }}</p>
    @enderror
</div>
