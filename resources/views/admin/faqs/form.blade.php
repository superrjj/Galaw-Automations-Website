<style>
    /* scoped to this form; shares the sa-* button and dialog styles with the FAQs index */
    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 19rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.25rem; }
    .sf-card > h2 { margin: 0 0 1rem; font-size: .9375rem; font-weight: 600; }
    .sf-stack > * + * { margin-top: 1rem; }
    .sf-check { display: flex; align-items: center; gap: .5rem; font-size: .875rem; }
    .sf-actions { display: flex; align-items: center; gap: .5rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #edf0f4; }
    .sf-danger { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #edf0f4; }

    /* same buttons and dialog as admin/faqs index */
    .sa-btn {
        display: inline-flex; align-items: center; gap: .4rem; height: 2rem; padding: 0 .7rem;
        border: 1px solid #dfe5ec; border-radius: .4rem; background: #fff; color: #27384f;
        font: inherit; font-size: .8125rem; font-weight: 500; text-decoration: none; cursor: pointer;
        transition: background-color .15s, border-color .15s, color .15s;
    }
    .sa-btn:hover { background: #f4f7fa; }
    .sa-btn:focus-visible { outline: 2px solid #0f9474; outline-offset: 2px; }
    .sa-btn svg { width: .95rem; height: .95rem; flex: none; }
    .sa-btn-delete { color: #b42318; }
    .sa-btn-delete:hover { background: #fef3f2; border-color: #fecdca; }
    .sa-btn-danger { background: #b42318; border-color: #b42318; color: #fff; }
    .sa-btn-danger:hover { background: #912018; border-color: #912018; }

    .sa-dialog { width: min(26rem, calc(100vw - 2rem)); padding: 0; border: 1px solid #e3e8ee; border-radius: .75rem; box-shadow: 0 20px 50px -20px rgba(15, 35, 64, .45); color: #0f2340; }
    .sa-dialog::backdrop { background: rgba(15, 35, 64, .45); }
    .sa-dialog form { padding: 1.5rem; }
    .sa-dialog h2 { margin: 0 0 .5rem; font-size: 1.125rem; font-weight: 600; }
    .sa-dialog p { margin: 0; font-size: .875rem; line-height: 1.6; color: #5b6b7e; }
    .sa-dialog-actions { display: flex; justify-content: flex-end; gap: .5rem; margin-top: 1.5rem; }
    .sa-dialog .sa-btn { height: 2.25rem; padding: 0 1rem; }
</style>

<form method="POST" action="{{ $faq ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" class="sf-grid">
    @csrf
    @if ($faq) @method('PUT') @endif

    {{-- Main column: the question and its answer --}}
    <section class="sf-card" aria-labelledby="sf-details">
        <h2 id="sf-details">FAQ</h2>
        <div class="sf-stack">
            <x-ui.input label="Question" name="question" :value="$faq?->question" required />
            <x-ui.textarea label="Answer" name="answer" :value="$faq?->answer" rows="6" required />
        </div>
    </section>

    {{-- Side column: publishing --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <h2>Publishing</h2>
            <div class="sf-stack">
                <label class="sf-check">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq?->is_active ?? true))>
                    Active
                </label>
                <x-ui.input label="Sort order" name="sort_order" type="number" min="0" :value="$faq?->sort_order ?? 0" />
            </div>

            <div class="sf-actions">
                <x-ui.button type="submit">{{ $faq ? 'Update' : 'Create' }}</x-ui.button>
                <a href="{{ route('admin.faqs.index') }}" class="sa-btn">Cancel</a>
            </div>

            @if ($faq)
                <div class="sf-danger">
                    <button type="button" class="sa-btn sa-btn-delete" data-open-delete>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6M10 11v6M14 11v6"/></svg>
                        Delete FAQ
                    </button>
                </div>
            @endif
        </div>
    </aside>
</form>

@if ($faq)
    {{-- Same confirmation dialog as the index; kept outside the main form so the forms don't nest --}}
    <dialog id="sa-delete" class="sa-dialog" aria-labelledby="sa-delete-title">
        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}">
            @csrf
            @method('DELETE')
            <h2 id="sa-delete-title">Delete this FAQ?</h2>
            <p>“<strong>{{ \Illuminate\Support\Str::limit($faq->question, 80) }}</strong>” will be permanently removed from the website. This can’t be undone.</p>
            <div class="sa-dialog-actions">
                <button type="button" class="sa-btn" data-close>Cancel</button>
                <button type="submit" class="sa-btn sa-btn-danger">Delete FAQ</button>
            </div>
        </form>
    </dialog>

    <script>
        (function () {
            var dlg = document.getElementById('sa-delete'), open = document.querySelector('[data-open-delete]');
            if (!dlg || !open) return;
            open.addEventListener('click', function () {
                if (typeof dlg.showModal === 'function') dlg.showModal();
                else if (confirm('Delete this FAQ?')) dlg.querySelector('form').submit();
            });
            dlg.querySelectorAll('[data-close]').forEach(function (b) { b.addEventListener('click', function () { dlg.close(); }); });
            dlg.addEventListener('click', function (e) { if (e.target === dlg) dlg.close(); });
            dlg.addEventListener('close', function () { open.focus(); });
        })();
    </script>
@endif