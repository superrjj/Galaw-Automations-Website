@props([
    'name' => 'check',
    'class' => 'h-5 w-5',
])

@php
    $paths = [
        'globe' => 'M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0c2.5-2.7 4-6.1 4-9s-1.5-6.3-4-9m0 18c-2.5-2.7-4-6.1-4-9s1.5-6.3 4-9M3 12h18',
        'smartphone' => 'M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm5 16h.01',
        'code' => 'm8 8-4 4 4 4M16 8l4 4-4 4M14 4l-4 16',
        'sparkles' => 'M12 3v4M12 17v4M3 12h4M17 12h4M5.6 5.6l2.8 2.8M15.6 15.6l2.8 2.8M18.4 5.6l-2.8 2.8M8.4 15.6l-2.8 2.8',
        'link' => 'M10 13a5 5 0 0 0 7.07 0l1.42-1.42a5 5 0 0 0-7.07-7.07L10 5M14 11a5 5 0 0 0-7.07 0L5.5 12.42a5 5 0 0 0 7.07 7.07L14 19',
        'cloud' => 'M17.5 19a4.5 4.5 0 1 0-.9-8.9A6 6 0 1 0 6 17.5',
        'building' => 'M4 21h16M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M9 8h.01M15 8h.01M9 12h.01M15 12h.01M9 16h.01M15 16h.01',
        'layers' => 'm12 2 9 5-9 5-9-5 9-5Zm0 10 9 5-9 5-9-5 9-5Z',
        'workflow' => 'M6 3v6M18 15v6M6 9a3 3 0 1 0 0.001 0M18 9a3 3 0 1 0 0.001 0M6 21a3 3 0 1 0 0.001 0M9 9h6M9 21h6M15 9v6',
        'wrench' => 'M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4 4 0 0 0 5.4-5.4l-2.5 2.5-2.5-2.5 2.5-2.5Z',
        'arrow-right' => 'M5 12h14M13 6l6 6-6 6',
        'menu' => 'M4 7h16M4 12h16M4 17h16',
        'x' => 'M6 6l12 12M18 6 6 18',
        'check' => 'M5 13l4 4L19 7',
        'mail' => 'M4 6h16v12H4V6Zm0 0 8 7 8-7',
        'phone' => 'M6 3h4l2 5-3 2a12 12 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 4 5a2 2 0 0 1 2-2Z',
        'map-pin' => 'M12 21s7-5.3 7-11a7 7 0 1 0-14 0c0 5.7 7 11 7 11Zm0-8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z',
    ];
@endphp

<svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $paths[$name] ?? $paths['check'] }}" />
</svg>
