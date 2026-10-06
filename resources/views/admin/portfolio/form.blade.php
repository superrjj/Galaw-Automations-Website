@php
    $featureText = old('features', is_array($project?->features ?? null) ? implode("\n", $project->features) : '');
    $techText = old('technologies', is_array($project?->technologies ?? null) ? implode("\n", $project->technologies) : '');
@endphp

<style>
    /* scoped layout for this form; no Tailwind rebuild needed */
    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 19rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-main > * + * { margin-top: 1.25rem; }
    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.25rem; }
    .sf-card > h2 { margin: 0 0 1rem; font-size: .9375rem; font-weight: 600; }
    .sf-stack > * + * { margin-top: 1rem; }
    .sf-cols { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr)); }
    .sf-error { margin: .35rem 0 0; font-size: .8125rem; color: #b42318; }
    .sf-check { display: flex; align-items: center; gap: .5rem; font-size: .875rem; }
    .sf-checks { display: grid; gap: .6rem; }
    .sf-actions { display: flex; align-items: center; gap: .75rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #edf0f4; }
    .sf-cancel { font-size: .875rem; color: #5b6b7e; text-decoration: none; }
    .sf-cancel:hover { text-decoration: underline; }
    .sf-danger { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #edf0f4; }
    .sf-danger button { padding: 0; border: 0; background: none; font: inherit; font-size: .875rem; color: #b42318; cursor: pointer; }
    .sf-danger button:hover { text-decoration: underline; }

    /* cover image picker */
    .sf-file { position: relative; display: flex; flex-wrap: wrap; align-items: center; gap: .6rem; }
    .sf-file-input { position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden; }
    .sf-file-btn {
        display: inline-flex; align-items: center; gap: .45rem; height: 2.25rem; padding: 0 .85rem;
        border: 1px solid #dfe5ec; border-radius: .5rem; background: #fff; color: #27384f;
        font-size: .8125rem; font-weight: 500; cursor: pointer; white-space: nowrap;
        transition: background-color .15s, border-color .15s;
    }
    .sf-file-btn:hover { background: #f4f7fa; border-color: #cfd8e1; }
    .sf-file-btn svg { width: 1rem; height: 1rem; flex: none; }
    .sf-file-input:focus-visible + .sf-file-btn { outline: 2px solid #0f9474; outline-offset: 2px; }
    .sf-file-name { flex: 1 1 6rem; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: .8125rem; color: #5b6b7e; }
    .sf-file-clear { padding: 0; border: 0; background: none; font: inherit; font-size: .8125rem; color: #b42318; cursor: pointer; }
    .sf-file-clear:hover { text-decoration: underline; }
    .sf-file-preview { display: block; width: 100%; aspect-ratio: 16 / 9; object-fit: cover; margin-top: .25rem; border: 1px solid #e3e8ee; border-radius: .5rem; background: #f4f7fa; }
    .sf-file [hidden] { display: none !important; }
</style>

<form method="POST" action="{{ $project ? route('admin.portfolio.update', $project) : route('admin.portfolio.store') }}" enctype="multipart/form-data" class="sf-grid">
    @csrf
    @if ($project) @method('PUT') @endif

    {{-- Main column: the project itself --}}
    <div class="sf-main">
        <section class="sf-card" aria-labelledby="sf-details">
            <h2 id="sf-details">Details</h2>
            <div class="sf-stack">
                <div class="sf-cols">
                    <x-ui.input label="Title" name="title" :value="$project?->title" required />
                    <x-ui.input label="Slug" name="slug" :value="$project?->slug" />
                </div>
                <x-ui.input label="Short description" name="short_description" :value="$project?->short_description" required />
                <x-ui.textarea label="Description" name="description" :value="$project?->description" rows="5" required />
                <div class="sf-cols">
                    <x-ui.input label="Category" name="category" :value="$project?->category" />
                    <x-ui.input label="Project type" name="project_type" :value="$project?->project_type" />
                </div>
                <div class="sf-cols">
                    <x-ui.input label="Project URL" name="project_url" type="url" :value="$project?->project_url" />
                    <x-ui.input label="Completed at" name="completed_at" type="date" :value="optional($project?->completed_at)->format('Y-m-d')" />
                </div>
            </div>
        </section>

        <section class="sf-card" aria-labelledby="sf-case">
            <h2 id="sf-case">Case study</h2>
            <div class="sf-stack">
                <div class="sf-cols">
                    <x-ui.textarea label="Problem" name="problem" :value="$project?->problem" rows="4" />
                    <x-ui.textarea label="Solution" name="solution" :value="$project?->solution" rows="4" />
                </div>
                <div class="sf-cols">
                    <x-ui.textarea label="Features (one per line)" name="features" :value="$featureText" rows="4" />
                    <x-ui.textarea label="Technologies (one per line)" name="technologies" :value="$techText" rows="4" />
                </div>
                <x-ui.textarea label="Results (verified only)" name="results" :value="$project?->results" rows="3" />
            </div>
        </section>
    </div>

    {{-- Side column: publishing --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <h2>Publishing</h2>
            <div class="sf-stack">
                <div class="sf-checks">
                    <label class="sf-check"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project?->is_published ?? false))> Published</label>
                    <label class="sf-check"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project?->is_featured ?? false))> Featured</label>
                </div>

                <x-ui.input label="Sort order" name="sort_order" type="number" :value="$project?->sort_order ?? 0" />

                <div>
                    <label for="cover_image" class="mb-1.5 block text-sm font-medium">Cover image</label>
                    <div class="sf-file" data-file>
                        <input id="cover_image" type="file" name="cover_image" accept="image/*" class="sf-file-input">
                        <label for="cover_image" class="sf-file-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                            Choose image
                        </label>
                        <span class="sf-file-name" data-file-name>No file chosen</span>
                        <button type="button" class="sf-file-clear" data-file-clear hidden>Remove</button>
                        <img class="sf-file-preview" data-file-preview alt="Preview of the selected cover image" hidden>
                    </div>
                    @error('cover_image') <p class="sf-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="sf-actions">
                <x-ui.button type="submit">{{ $project ? 'Update project' : 'Create project' }}</x-ui.button>
                <a href="{{ route('admin.portfolio.index') }}" class="sf-cancel">Cancel</a>
            </div>

            @if ($project)
                <div class="sf-danger">
                    <button form="delete-portfolio" type="submit" onclick="return confirm('Delete this project?')">Delete project</button>
                </div>
            @endif
        </div>
    </aside>
</form>
@if ($project)
<form id="delete-portfolio" method="POST" action="{{ route('admin.portfolio.destroy', $project) }}" class="hidden" style="display:none">@csrf @method('DELETE')</form>
@endif

<script>
    (function () {
        var wrap = document.querySelector('[data-file]');
        if (!wrap) return;
        var input = wrap.querySelector('input[type=file]'),
            nameEl = wrap.querySelector('[data-file-name]'),
            clear = wrap.querySelector('[data-file-clear]'),
            preview = wrap.querySelector('[data-file-preview]'),
            url = null;

        function size(bytes) { return bytes >= 1048576 ? (bytes / 1048576).toFixed(1) + ' MB' : Math.max(1, Math.round(bytes / 1024)) + ' KB'; }

        function reset() {
            if (url) { URL.revokeObjectURL(url); url = null; }
            input.value = '';
            nameEl.textContent = 'No file chosen';
            preview.hidden = true; preview.removeAttribute('src');
            clear.hidden = true;
        }

        input.addEventListener('change', function () {
            var f = input.files && input.files[0];
            if (!f) { reset(); return; }
            if (url) URL.revokeObjectURL(url);
            url = URL.createObjectURL(f);
            nameEl.textContent = f.name + ' (' + size(f.size) + ')';
            preview.src = url; preview.hidden = false;
            clear.hidden = false;
        });
        clear.addEventListener('click', reset);
    })();
</script>