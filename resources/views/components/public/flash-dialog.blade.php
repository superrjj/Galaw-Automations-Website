@props([
    'type' => 'success',
    'message',
    'title' => null,
])

@php
    $isError = $type === 'error';
    $title = $title ?? ($isError ? 'Something went wrong' : 'Thank you');
    $dialogId = 'pub-flash-'.($isError ? 'error' : 'success');
@endphp

<dialog
    id="{{ $dialogId }}"
    class="pub-flash-dialog"
    aria-labelledby="{{ $dialogId }}-title"
    aria-describedby="{{ $dialogId }}-body"
>
    <div class="pub-flash-dialog__body">
        <h2 id="{{ $dialogId }}-title" class="text-base font-semibold text-ink">{{ $title }}</h2>
        <p id="{{ $dialogId }}-body" class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $message }}</p>
        <x-ui.button type="button" data-pub-flash-close class="mt-5 w-full justify-center">OK</x-ui.button>
    </div>
</dialog>

<script>
    (function () {
        var dlg = document.getElementById(@json($dialogId));
        if (!dlg) return;

        function closeDialog() {
            if (typeof dlg.close === 'function') dlg.close();
        }

        if (typeof dlg.showModal === 'function') dlg.showModal();

        dlg.querySelectorAll('[data-pub-flash-close]').forEach(function (btn) {
            btn.addEventListener('click', closeDialog);
        });
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg) closeDialog();
        });
        dlg.addEventListener('cancel', function (e) {
            e.preventDefault();
            closeDialog();
        });
    })();
</script>
