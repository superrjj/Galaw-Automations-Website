<form method="POST" action="{{ $technology ? route('admin.technologies.update', $technology) : route('admin.technologies.store') }}" class="max-w-2xl space-y-4 rounded-2xl border border-line bg-white p-6">
@csrf
@if ($technology) @method('PUT') @endif
<x-ui.input label="Name" name="name" :value="$technology?->name" required />
<x-ui.input label="Slug" name="slug" :value="$technology?->slug" />
<div>
<label class="mb-1.5 block text-sm font-medium">Category</label>
<select name="category" class="w-full rounded-xl border border-line px-3.5 py-2.5 text-sm" required>
@foreach ($categories as $category)
<option value="{{ $category->value }}" @selected(old('category', $technology?->category?->value) === $category->value)>{{ $category->label() }}</option>
@endforeach
</select>
</div>
<x-ui.input label="Icon" name="icon" :value="$technology?->icon" />
<x-ui.textarea label="Description" name="description" :value="$technology?->description" rows="3" />
<x-ui.input label="Sort order" name="sort_order" type="number" :value="$technology?->sort_order ?? 0" />
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $technology?->is_active ?? true))> Active</label>
<div class="flex items-center gap-3">
<x-ui.button type="submit">{{ $technology ? 'Update' : 'Create' }}</x-ui.button>
@if ($technology)
<button form="delete-tech" type="submit" class="text-sm text-red-600" onclick="return confirm('Delete?')">Delete</button>
@endif
</div>
</form>
@if ($technology)
<form id="delete-tech" method="POST" action="{{ route('admin.technologies.destroy', $technology) }}" class="hidden">@csrf @method('DELETE')</form>
@endif
