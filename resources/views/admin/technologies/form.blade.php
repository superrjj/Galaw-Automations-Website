<style>
    /* scoped layout for this form; no Tailwind rebuild needed */
    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 19rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.25rem; }
    .sf-card > h2 { margin: 0 0 1rem; font-size: .9375rem; font-weight: 600; }
    .sf-stack > * + * { margin-top: 1rem; }
    .sf-cols { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr)); }
    .sf-error { margin: .35rem 0 0; font-size: .8125rem; color: #b42318; }
    .sf-check { display: flex; align-items: center; gap: .5rem; font-size: .875rem; }
    .sf-actions { display: flex; align-items: center; gap: .75rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #edf0f4; }
    .sf-cancel { font-size: .875rem; color: #5b6b7e; text-decoration: none; }
    .sf-cancel:hover { text-decoration: underline; }
    .sf-danger { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #edf0f4; }
    .sf-danger button { padding: 0; border: 0; background: none; font: inherit; font-size: .875rem; color: #b42318; cursor: pointer; }
    .sf-danger button:hover { text-decoration: underline; }
</style>

<form method="POST" action="{{ $technology ? route('admin.technologies.update', $technology) : route('admin.technologies.store') }}" class="sf-grid">
    @csrf
    @if ($technology) @method('PUT') @endif

    {{-- Main column: what the technology is --}}
    <section class="sf-card" aria-labelledby="sf-details">
        <h2 id="sf-details">Details</h2>
        <div class="sf-stack">
            <div class="sf-cols">
                <x-ui.input label="Name" name="name" :value="$technology?->name" required />
                <x-ui.input label="Slug" name="slug" :value="$technology?->slug" />
            </div>

            <div class="sf-cols">
                <div>
                    <label for="category" class="mb-1.5 block text-sm font-medium">Category</label>
                    <select id="category" name="category" class="w-full rounded-xl border border-line px-3.5 py-2.5 text-sm" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->value }}" @selected(old('category', $technology?->category?->value) === $category->value)>{{ $category->label() }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="sf-error">{{ $message }}</p> @enderror
                </div>
                <x-ui.input label="Icon" name="icon" :value="$technology?->icon" />
            </div>

            <x-ui.textarea label="Description" name="description" :value="$technology?->description" rows="3" />
        </div>
    </section>

    {{-- Side column: publishing --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <h2>Publishing</h2>
            <div class="sf-stack">
                <label class="sf-check">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $technology?->is_active ?? true))>
                    Active
                </label>
                <x-ui.input label="Sort order" name="sort_order" type="number" :value="$technology?->sort_order ?? 0" />
            </div>

            <div class="sf-actions">
                <x-ui.button type="submit">{{ $technology ? 'Update' : 'Create' }}</x-ui.button>
                <a href="{{ route('admin.technologies.index') }}" class="sf-cancel">Cancel</a>
            </div>

            @if ($technology)
                <div class="sf-danger">
                    <button form="delete-tech" type="submit" onclick="return confirm('Delete this technology?')">Delete technology</button>
                </div>
            @endif
        </div>
    </aside>
</form>
@if ($technology)
    <form id="delete-tech" method="POST" action="{{ route('admin.technologies.destroy', $technology) }}" class="hidden" style="display:none">@csrf @method('DELETE')</form>
@endif