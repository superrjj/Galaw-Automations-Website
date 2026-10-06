@php
    $featureText = old('features', is_array($service?->features) ? implode("\n", $service->features) : '');
    $techText = old('technologies', is_array($service?->technologies) ? implode("\n", $service->technologies) : '');
    $benefitText = old('benefits', is_array($service?->benefits) ? implode("\n", $service->benefits) : '');
@endphp

<style>
    /* scoped layout for this form; no Tailwind rebuild needed */
    .sf-grid { display: grid; gap: 1.25rem; align-items: start; }
    @media (min-width: 1024px) { .sf-grid { grid-template-columns: minmax(0, 1fr) 19rem; } .sf-aside { position: sticky; top: 6.5rem; } }
    .sf-main > * + * { margin-top: 1.25rem; }
    .sf-card { border: 1px solid #e3e8ee; border-radius: .75rem; background: #fff; padding: 1.25rem; }
    .sf-card > h2 { margin: 0 0 1rem; font-size: .9375rem; font-weight: 600; }
    .sf-stack > * + * { margin-top: 1rem; }
    .sf-cols { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(14rem, 1fr)); }
    .sf-error { margin: .35rem 0 0; font-size: .8125rem; color: #b42318; }
    .sf-check { display: flex; align-items: center; gap: .5rem; font-size: .875rem; }
    .sf-actions { display: flex; align-items: center; gap: .75rem; margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #edf0f4; }
    .sf-cancel { font-size: .875rem; color: #5b6b7e; text-decoration: none; }
    .sf-cancel:hover { text-decoration: underline; }
    .sf-danger { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #edf0f4; }
    .sf-danger button { padding: 0; border: 0; background: none; font: inherit; font-size: .875rem; color: #b42318; cursor: pointer; }
    .sf-danger button:hover { text-decoration: underline; }
</style>

<form method="POST" action="{{ $service ? route('admin.services.update', $service) : route('admin.services.store') }}" class="sf-grid">
    @csrf
    @if ($service) @method('PUT') @endif

    {{-- Main column: what the service is --}}
    <div class="sf-main">
        <section class="sf-card" aria-labelledby="sf-details">
            <h2 id="sf-details">Details</h2>
            <div class="sf-stack">
                <div class="sf-cols">
                    <x-ui.input label="Name" name="name" :value="$service?->name" required />
                    <x-ui.input label="Slug" name="slug" :value="$service?->slug" />
                </div>
                <x-ui.input label="Short description" name="short_description" :value="$service?->short_description" required />
                <x-ui.textarea label="Description" name="description" :value="$service?->description" rows="5" required />
            </div>
        </section>

        <section class="sf-card" aria-labelledby="sf-lists">
            <h2 id="sf-lists">Lists</h2>
            <div class="sf-cols">
                <x-ui.textarea label="Features (one per line)" name="features" :value="$featureText" rows="5" />
                <x-ui.textarea label="Technologies (one per line)" name="technologies" :value="$techText" rows="5" />
                <x-ui.textarea label="Benefits (one per line)" name="benefits" :value="$benefitText" rows="5" />
            </div>
        </section>
    </div>

    {{-- Side column: how it is organised and published --}}
    <aside class="sf-aside">
        <div class="sf-card">
            <h2>Publishing</h2>
            <div class="sf-stack">
                <label class="sf-check">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service?->is_active ?? true))>
                    Active
                </label>

                <x-ui.input label="Sort order" name="sort_order" type="number" :value="$service?->sort_order ?? 0" />

                <div>
                    <label for="service_category_id" class="mb-1.5 block text-sm font-medium">Category</label>
                    <select id="service_category_id" name="service_category_id" class="w-full rounded-xl border border-line px-3.5 py-2.5 text-sm">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('service_category_id', $service?->service_category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('service_category_id') <p class="sf-error">{{ $message }}</p> @enderror
                </div>

                <x-ui.input label="Icon" name="icon" :value="$service?->icon" placeholder="globe, smartphone, code..." />
            </div>

            <div class="sf-actions">
                <x-ui.button type="submit">{{ $service ? 'Update service' : 'Create service' }}</x-ui.button>
                <a href="{{ route('admin.services.index') }}" class="sf-cancel">Cancel</a>
            </div>

            @if ($service)
                <div class="sf-danger">
                    <button form="delete-service" type="submit" onclick="return confirm('Delete this service?')">Delete service</button>
                </div>
            @endif
        </div>
    </aside>
</form>
@if ($service)
    <form id="delete-service" method="POST" action="{{ route('admin.services.destroy', $service) }}" class="hidden" style="display:none">
        @csrf
        @method('DELETE')
    </form>
@endif