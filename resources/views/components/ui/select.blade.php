@props(['label' => null, 'name', 'options' => [], 'selected' => null, 'placeholder' => 'Select an option'])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-ink">{{ $label }}</label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-line bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition focus:border-accent focus:ring-2 focus:ring-accent/20']) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $value => $labelText)
            <option value="{{ $value }}" @selected((string) old($name, $selected) === (string) $value)>{{ $labelText }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
