@extends('layouts.admin')

@section('title', 'Services')
@section('heading', 'Services')
@section('subheading', 'Manage public service offerings')

@section('content')
<div class="mb-6 flex justify-end">
    <x-ui.button href="{{ route('admin.services.create') }}">Add service</x-ui.button>
</div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
    <table class="min-w-full text-left text-sm">
        <thead class="border-b border-line bg-mist/60 text-ink/60">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Order</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-line">
            @foreach ($services as $service)
                <tr>
                    <td class="px-4 py-3 font-medium">{{ $service->name }}</td>
                    <td class="px-4 py-3">{{ $service->category?->name ?: '—' }}</td>
                    <td class="px-4 py-3">{{ $service->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="px-4 py-3">{{ $service->sort_order }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.services.edit', $service) }}" class="text-accent hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $services->links() }}</div>
@endsection
