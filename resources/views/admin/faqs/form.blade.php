<form method="POST" action="{{ $faq ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" class="max-w-2xl space-y-4 rounded-2xl border border-line bg-white p-6">
@csrf
@if ($faq) @method('PUT') @endif
<x-ui.input label="Question" name="question" :value="$faq?->question" required />
<x-ui.textarea label="Answer" name="answer" :value="$faq?->answer" rows="6" required />
<x-ui.input label="Sort order" name="sort_order" type="number" :value="$faq?->sort_order ?? 0" />
<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq?->is_active ?? true))> Active</label>
<div class="flex items-center gap-3">
<x-ui.button type="submit">{{ $faq ? 'Update' : 'Create' }}</x-ui.button>
@if ($faq)
<button form="delete-faq" type="submit" class="text-sm text-red-600" onclick="return confirm('Delete?')">Delete</button>
@endif
</div>
</form>
@if ($faq)
<form id="delete-faq" method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="hidden">@csrf @method('DELETE')</form>
@endif
