@php
    $featureText = old('features', is_array($service?->features) ? implode("\n", $service->features) : '');
    $techText = old('technologies', is_array($service?->technologies) ? implode("\n", $service->technologies) : '');
    $benefitText = old('benefits', is_array($service?->benefits) ? implode("\n", $service->benefits) : '');
@endphp

<form method="POST" action="{{ $service ? route('admin.services.update', $service) : route('admin.services.store') }}" class="max-w-3xl space-y-4 rounded-2xl border border-line bg-white p-6">
    @csrf
    @if ($service) @method('PUT') @endif

    <div>
        <label class="mb-1.5 block text-sm font-medium">Category</label>
        <select name="service_category_id" class="w-full rounded-xl border border-line px-3.5 py-2.5 text-sm">
            <option value="">No category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('service_category_id', $service?->service_category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <x-ui.input label="Name" name="name" :value="$service?->name" required />
    <x-ui.input label="Slug" name="slug" :value="$service?->slug" />
    <x-ui.input label="Short description" name="short_description" :value="$service?->short_description" required />
    <x-ui.textarea label="Description" name="description" :value="$service?->description" rows="6" required />
    <x-ui.input label="Icon" name="icon" :value="$service?->icon" placeholder="globe, smartphone, code..." />
    <x-ui.textarea label="Features (one per line)" name="features" :value="$featureText" rows="5" />
    <x-ui.textarea label="Technologies (one per line)" name="technologies" :value="$techText" rows="4" />
    <x-ui.textarea label="Benefits (one per line)" name="benefits" :value="$benefitText" rows="4" />
    <x-ui.input label="Sort order" name="sort_order" type="number" :value="$service?->sort_order ?? 0" />
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service?->is_active ?? true))>
        Active
    </label>
    <div class="flex items-center gap-3">
        <x-ui.button type="submit">{{ $service ? 'Update service' : 'Create service' }}</x-ui.button>
        @if ($service)
            <button form="delete-service" type="submit" class="text-sm text-red-600" onclick="return confirm('Delete this service?')">Delete</button>
        @endif
    </div>
</form>
@if ($service)
    <form id="delete-service" method="POST" action="{{ route('admin.services.destroy', $service) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endif
