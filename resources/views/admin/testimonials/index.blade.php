@extends('layouts.admin')
@section('title', 'Testimonials')
@section('heading', 'Testimonials')
@section('subheading', 'Only publish verified testimonials. Do not invent reviews.')
@section('content')
<div class="mb-6 flex justify-end"><x-ui.button href="{{ route('admin.testimonials.create') }}">Add testimonial</x-ui.button></div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
<table class="min-w-full text-left text-sm">
<thead class="border-b border-line bg-mist/60 text-ink/60"><tr><th class="px-4 py-3">Client</th><th class="px-4 py-3">Company</th><th class="px-4 py-3">Active</th><th class="px-4 py-3"></th></tr></thead>
<tbody class="divide-y divide-line">
@forelse ($testimonials as $testimonial)
<tr>
<td class="px-4 py-3 font-medium">{{ $testimonial->client_name }}</td>
<td class="px-4 py-3">{{ $testimonial->company ?: '—' }}</td>
<td class="px-4 py-3">{{ $testimonial->is_active ? 'Yes' : 'No' }}</td>
<td class="px-4 py-3 text-right"><a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-accent">Edit</a></td>
</tr>
@empty
<tr><td colspan="4" class="px-4 py-10 text-center text-ink/50">No testimonials yet. Add only real client feedback.</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="mt-6">{{ $testimonials->links() }}</div>
@endsection
