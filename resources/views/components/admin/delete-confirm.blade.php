@props([
    'title',
    'confirm',
    'action' => null,
    'name' => null,
    'detail' => 'from the website',
])

{{-- Simple delete confirm (list pages: data-delete-url; edit forms: action + name). --}}
<dialog id="sa-delete" class="sa-dialog" aria-labelledby="sa-delete-title" {{ $attributes }}>
    <form method="POST" action="{{ $action ?? '' }}">
        @csrf
        @method('DELETE')
        <h2 id="sa-delete-title">{{ $title }}</h2>
        <p>“<strong data-name>{{ $name }}</strong>” will be permanently removed {{ $detail }}. This can’t be undone.</p>
        <div class="sa-dialog-actions">
            <button type="button" class="sa-btn" data-close>Cancel</button>
            <button type="submit" class="sa-btn sa-btn-danger">{{ $confirm }}</button>
        </div>
    </form>
</dialog>

<script>
    (function () {
        var dlg = document.getElementById('sa-delete');
        if (!dlg) return;
        var form = dlg.querySelector('form');
        var nameEl = dlg.querySelector('[data-name]');
        var last = null;
        var openBtn = document.querySelector('[data-open-delete]');
        var canModal = typeof dlg.showModal === 'function';

        function openDialog() {
            if (canModal) dlg.showModal();
            else if (confirm(dlg.querySelector('#sa-delete-title').textContent)) form.submit();
        }

        document.querySelectorAll('[data-delete-url]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                last = btn;
                form.action = btn.dataset.deleteUrl;
                if (nameEl) nameEl.textContent = btn.dataset.name || '';
                openDialog();
            });
        });

        if (openBtn) {
            openBtn.addEventListener('click', function () {
                last = openBtn;
                openDialog();
            });
        }

        dlg.querySelectorAll('[data-close]').forEach(function (b) {
            b.addEventListener('click', function () { dlg.close(); });
        });
        dlg.addEventListener('click', function (e) {
            if (e.target === dlg) dlg.close();
        });
        dlg.addEventListener('close', function () {
            if (last) last.focus();
        });
    })();
</script>
