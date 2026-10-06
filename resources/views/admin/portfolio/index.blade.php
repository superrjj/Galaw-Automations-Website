@extends('layouts.admin')

@section('title', 'Portfolio')
@section('heading', 'Portfolio')
@section('subheading', 'Manage published and draft projects')

@section('content')
<style>
    /* scoped to this page; no Tailwind rebuild needed */
    .sa-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; }
    .sa-count { margin: 0; font-size: .875rem; color: #5b6b7e; }

    .sa-card { overflow: hidden; border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; }
    .sa-scroll { overflow-x: auto; }
    .sa-table { width: 100%; min-width: 40rem; border-collapse: collapse; text-align: left; font-size: .875rem; }
    .sa-table thead th {
        padding: .7rem 1rem; background: #f8fafb; border-bottom: 1px solid #e3e8ee;
        font-size: .75rem; font-weight: 600; letter-spacing: .02em; text-transform: uppercase; color: #5b6b7e; white-space: nowrap;
    }
    .sa-table tbody td { padding: .8rem 1rem; border-bottom: 1px solid #edf0f4; vertical-align: middle; }
    .sa-table tbody tr:last-child td { border-bottom: 0; }
    .sa-table tbody tr:hover { background: #fafbfc; }
    .sa-name { font-weight: 600; color: inherit; text-decoration: none; }
    .sa-name:hover { text-decoration: underline; }
    .sa-muted { color: #5b6b7e; }
    .    .sa-col-actions { width: 1%; white-space: nowrap; text-align: right; }

    .sa-status-off { color: #8a97a8; }

    .sa-actions { display: inline-flex; gap: .4rem; }
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

    .sa-empty { padding: 3rem 1rem; text-align: center; }
    .sa-empty p { margin: 0 0 1rem; color: #5b6b7e; }

    .sa-dialog { width: min(26rem, calc(100vw - 2rem)); padding: 0; border: 1px solid #e3e8ee; border-radius: .75rem; box-shadow: 0 20px 50px -20px rgba(15, 35, 64, .45); color: #0f2340; }
    .sa-dialog::backdrop { background: rgba(15, 35, 64, .45); }
    .sa-dialog form { padding: 1.5rem; }
    .sa-dialog h2 { margin: 0 0 .5rem; font-size: 1.125rem; font-weight: 600; }
    .sa-dialog p { margin: 0; font-size: .875rem; line-height: 1.6; color: #5b6b7e; }
    .sa-dialog-actions { display: flex; justify-content: flex-end; gap: .5rem; margin-top: 1.5rem; }
    .sa-dialog .sa-btn { height: 2.25rem; padding: 0 1rem; }
</style>

<div class="sa-toolbar">
    @if (method_exists($projects, 'total'))
        <p class="sa-count">
            @if ($projects->total() > 0)
                Showing {{ $projects->firstItem() }}–{{ $projects->lastItem() }} of {{ $projects->total() }} {{ \Illuminate\Support\Str::plural('project', $projects->total()) }}
            @else
                No projects yet
            @endif
        </p>
    @else
        <span></span>
    @endif

    <x-ui.button href="{{ route('admin.portfolio.create') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" style="margin-right:.4rem"><path d="M12 5v14M5 12h14"/></svg>
        Add project
    </x-ui.button>
</div>

<div class="sa-card">
    @if ($projects->count() === 0)
        <div class="sa-empty">
            <p>No projects have been added yet.</p>
            <x-ui.button href="{{ route('admin.portfolio.create') }}">Add your first project</x-ui.button>
        </div>
    @else
        <div class="sa-scroll">
            <table class="sa-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Published</th>
                        <th scope="col"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><a href="{{ route('admin.portfolio.edit', $project) }}" class="sa-name">{{ $project->title }}</a></td>
                            <td class="sa-muted">{{ $project->category ?: '—' }}</td>
                            <td class="{{ $project->is_featured ? '' : 'sa-status-off' }}">{{ $project->is_featured ? 'Yes' : 'No' }}</td>
                            <td class="{{ $project->is_published ? '' : 'sa-status-off' }}">{{ $project->is_published ? 'Yes' : 'No' }}</td>
                            <td class="sa-col-actions">
                                <div class="sa-actions">
                                    <a href="{{ route('admin.portfolio.edit', $project) }}" class="sa-btn" aria-label="Edit {{ $project->title }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                                        Edit
                                    </a>
                                    @if (\Illuminate\Support\Facades\Route::has('admin.portfolio.destroy'))
                                        <button
                                            type="button"
                                            class="sa-btn sa-btn-delete"
                                            data-delete-url="{{ route('admin.portfolio.destroy', $project) }}"
                                            data-name="{{ $project->title }}"
                                            aria-label="Delete {{ $project->title }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6M10 11v6M14 11v6"/></svg>
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<div class="mt-6">{{ $projects->links() }}</div>

{{-- One confirmation dialog, reused for every row --}}
<dialog id="sa-delete" class="sa-dialog" aria-labelledby="sa-delete-title">
    <form method="POST" action="">
        @csrf
        @method('DELETE')
        <h2 id="sa-delete-title">Delete this project?</h2>
        <p>“<strong data-name></strong>” will be permanently removed from your portfolio. This can’t be undone.</p>
        <div class="sa-dialog-actions">
            <button type="button" class="sa-btn" data-close>Cancel</button>
            <button type="submit" class="sa-btn sa-btn-danger">Delete project</button>
        </div>
    </form>
</dialog>

<script>
    (function () {
        var dlg = document.getElementById('sa-delete');
        if (!dlg || typeof dlg.showModal !== 'function') return;
        var form = dlg.querySelector('form'), nameEl = dlg.querySelector('[data-name]'), last = null;

        document.querySelectorAll('[data-delete-url]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                last = btn;
                form.action = btn.dataset.deleteUrl;
                nameEl.textContent = btn.dataset.name;
                dlg.showModal();
            });
        });
        dlg.querySelectorAll('[data-close]').forEach(function (b) { b.addEventListener('click', function () { dlg.close(); }); });
        dlg.addEventListener('click', function (e) { if (e.target === dlg) dlg.close(); });
        dlg.addEventListener('close', function () { if (last) last.focus(); });
    })();
</script>
@endsection