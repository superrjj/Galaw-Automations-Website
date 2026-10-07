<style>
    /* scoped to this form; shares the sa-* button and dialog styles with the testimonials index */
    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 19rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.25rem; }
    .sf-card > h2 { margin: 0 0 1rem; font-size: .9375rem; font-weight: 600; }
    .sf-stack > * + * { margin-top: 1rem; }
    .sf-cols { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr)); }
    .sf-hint { margin: .35rem 0 0 1.5rem; font-size: .8125rem; color: #5b6b7e; }
    .sf-check { display: flex; align-items: center; gap: .5rem; font-size: .875rem; }
    .sf-actions { display: flex; align-items: center; gap: .5rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #edf0f4; }
    .sf-danger { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #edf0f4; }

    /* same buttons and dialog as admin/testimonials index */
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
</style>

<form method="POST" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" class="sf-grid">
    @csrf
    @if ($testimonial) @method('PUT') @endif

    {{-- Main column: who said it and what they said --}}
    <section class="sf-card" aria-labelledby="sf-details">
        <h2 id="sf-details">Testimonial</h2>
        <div class="sf-stack">
            <div class="sf-cols">
                <x-ui.input label="Client name" name="client_name" :value="$testimonial?->client_name" required />
                <x-ui.input label="Company" name="company" :value="$testimonial?->company" />
            </div>

            <x-ui.textarea label="Testimonial" name="content" :value="$testimonial?->content" rows="4" required />

            <x-ui.input label="Image path" name="image" :value="$testimonial?->image" />
        </div>
    </section>

    {{-- Side column: publishing --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <h2>Publishing</h2>
            <div class="sf-stack">
                <div>
                    <label class="sf-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial?->is_active ?? false))>
                        Active
                    </label>
                    <p class="sf-hint">Publish only verified testimonials.</p>
                </div>
                <x-ui.input label="Sort order" name="sort_order" type="number" min="0" :value="$testimonial?->sort_order ?? 0" />
            </div>

            <div class="sf-actions">
                <x-ui.button type="submit">{{ $testimonial ? 'Update' : 'Create' }}</x-ui.button>
                <a href="{{ route('admin.testimonials.index') }}" class="sa-btn">Cancel</a>
            </div>

            @if ($testimonial)
                <div class="sf-danger">
                    <button type="button" class="sa-btn sa-btn-delete" data-open-delete>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6M10 11v6M14 11v6"/></svg>
                        Delete testimonial
                    </button>
                </div>
            @endif
        </div>
    </aside>
</form>

@if ($testimonial)
    <x-admin.delete-confirm
        title="Delete this testimonial?"
        confirm="Delete testimonial"
        :action="route('admin.testimonials.destroy', $testimonial)"
        :name="$testimonial->client_name"
    />
@endif