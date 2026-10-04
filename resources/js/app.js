import Alpine from 'alpinejs';

window.Alpine = Alpine;

if (! window.Alpine.version || ! document.documentElement.__alpine_started) {
    document.documentElement.__alpine_started = true;
    Alpine.start();
}
