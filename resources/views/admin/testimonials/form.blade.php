<form method="POST" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" class="max-w-2xl space-y-4 rounded-2xl border border-line bg-white p-6">
@csrf
@if ($testimonial) @method('PUT') @endif
<x-ui.input label="Client name" name="client_name" :value="$testimonial?->client_name" required />
<x-ui.input label="Company" name="company" :value="$testimonial?->company" />
<x-ui.textarea label="Testimonial" name="content" :value="$testimonial?->content" rows="5" required />
<x-ui.input label="Image path" name="image" :value="$testimonial?->image" />
<x-ui.input label="Sort order" name="sort_order" type="number" :value="$testimonial?->sort_order ?? 0" />
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial?->is_active ?? false))> Active (publish only verified testimonials)</label>
<div class="flex items-center gap-3">
<x-ui.button type="submit">{{ $testimonial ? 'Update' : 'Create' }}</x-ui.button>
@if ($testimonial)
<button form="delete-testimonial" type="submit" class="text-sm text-red-600" onclick="return confirm('Delete?')">Delete</button>
@endif
</div>
</form>
@if ($testimonial)
<form id="delete-testimonial" method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="hidden">@csrf @method('DELETE')</form>
@endif
