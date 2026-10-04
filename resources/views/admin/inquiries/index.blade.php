@extends('layouts.admin')

@section('title', 'Inquiries')
@section('heading', 'Inquiries')
@section('subheading', 'Review and manage project requests')

@section('content')
<form method="GET" class="mb-6 flex flex-wrap gap-3">
    <input type="search" name="q" value="{{ $filters['q'] }}" placeholder="Search name, email, project..." class="min-w-[220px] flex-1 rounded-xl border border-line bg-white px-3.5 py-2.5 text-sm">
    <select name="status" class="rounded-xl border border-line bg-white px-3.5 py-2.5 text-sm">
        <option value="">All statuses</option>
        @foreach ($statuses as $status)
            <option value="{{ $status->value }}" @selected($filters['status'] === $status->value)>{{ $status->label() }}</option>
        @endforeach
    </select>
    <x-ui.button type="submit" variant="secondary">Filter</x-ui.button>
</form>

<div class="overflow-hidden rounded-2xl border border-line bg-white">
    <table class="min-w-full text-left text-sm">
        <thead class="border-b border-line bg-mist/60 text-ink/60">
            <tr>
                <th class="px-4 py-3 font-medium">Project</th>
                <th class="px-4 py-3 font-medium">Client</th>
                <th class="px-4 py-3 font-medium">Service</th>
                <th class="px-4 py-3 font-medium">Status</th>
                <th class="px-4 py-3 font-medium">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-line">
            @forelse ($inquiries as $inquiry)
                <tr class="hover:bg-mist/40">
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="font-medium text-ink hover:text-accent">{{ $inquiry->project_title }}</a>
                    </td>
                    <td class="px-4 py-3">
                        <div>{{ $inquiry->name }}</div>
                        <div class="text-ink/50">{{ $inquiry->email }}</div>
                    </td>
                    <td class="px-4 py-3">{{ $inquiry->service?->name ?: '—' }}</td>
                    <td class="px-4 py-3"><x-ui.badge>{{ $inquiry->status->label() }}</x-ui.badge></td>
                    <td class="px-4 py-3 text-ink/60">{{ $inquiry->created_at->format('M j, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center text-ink/50">No inquiries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $inquiries->links() }}</div>
@endsection
