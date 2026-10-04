@extends('layouts.admin')
@section('title', 'Portfolio')
@section('heading', 'Portfolio')
@section('subheading', 'Manage published and draft projects')
@section('content')
<div class="mb-6 flex justify-end"><x-ui.button href="{{ route('admin.portfolio.create') }}">Add project</x-ui.button></div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
<table class="min-w-full text-left text-sm">
<thead class="border-b border-line bg-mist/60 text-ink/60"><tr><th class="px-4 py-3">Title</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Featured</th><th class="px-4 py-3">Published</th><th class="px-4 py-3"></th></tr></thead>
<tbody class="divide-y divide-line">
@foreach ($projects as $project)
<tr>
<td class="px-4 py-3 font-medium">{{ $project->title }}</td>
<td class="px-4 py-3">{{ $project->category ?: '—' }}</td>
<td class="px-4 py-3">{{ $project->is_featured ? 'Yes' : 'No' }}</td>
<td class="px-4 py-3">{{ $project->is_published ? 'Yes' : 'No' }}</td>
<td class="px-4 py-3 text-right"><a href="{{ route('admin.portfolio.edit', $project) }}" class="text-accent hover:underline">Edit</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="mt-6">{{ $projects->links() }}</div>
@endsection
