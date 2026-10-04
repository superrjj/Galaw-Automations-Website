@extends('layouts.admin')
@section('title', 'Technologies')
@section('heading', 'Technologies')
@section('content')
<div class="mb-6 flex justify-end"><x-ui.button href="{{ route('admin.technologies.create') }}">Add technology</x-ui.button></div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
<table class="min-w-full text-left text-sm">
<thead class="border-b border-line bg-mist/60 text-ink/60"><tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Active</th><th class="px-4 py-3"></th></tr></thead>
<tbody class="divide-y divide-line">
@foreach ($technologies as $technology)
<tr>
<td class="px-4 py-3 font-medium">{{ $technology->name }}</td>
<td class="px-4 py-3">{{ $technology->category->label() }}</td>
<td class="px-4 py-3">{{ $technology->is_active ? 'Yes' : 'No' }}</td>
<td class="px-4 py-3 text-right"><a href="{{ route('admin.technologies.edit', $technology) }}" class="text-accent">Edit</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="mt-6">{{ $technologies->links() }}</div>
@endsection
