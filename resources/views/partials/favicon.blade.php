{{-- Same favicon on guest (login) and admin — cropped asset reads at normal tab size. --}}
@php($favicon = asset('logo-galaw-automations-cropped.png'))
<link rel="icon" href="{{ $favicon }}" type="image/png" sizes="32x32">
<link rel="shortcut icon" href="{{ $favicon }}" type="image/png">
<link rel="apple-touch-icon" href="{{ $favicon }}">
