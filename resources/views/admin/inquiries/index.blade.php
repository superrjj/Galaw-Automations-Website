@extends('layouts.admin')

@section('title', 'Inquiries')
@section('heading', 'Inquiries')
@section('subheading', 'Review and manage project requests')

@section('content')
<form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-end" role="search">
    <div class="min-w-0 flex-1">
        <label for="q" class="mb-1.5 block text-sm font-medium text-ink">Search</label>
        <input
            id="q"
            type="search"
            name="q"
            value="{{ $filters['q'] }}"
            placeholder="Name, email, or project title"
            class="w-full rounded-md border border-line bg-paper px-3.5 py-2.5 text-sm outline-none focus:border-accent"
        >
    </div>
    <div>
        <label for="status" class="mb-1.5 block text-sm font-medium text-ink">Status</label>
        <select id="status" name="status" class="w-full rounded-md border border-line bg-paper px-3.5 py-2.5 text-sm outline-none focus:border-accent sm:w-48">
            <option value="">All statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected($filters['status'] === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
    <x-ui.button type="submit" variant="secondary">Filter</x-ui.button>
</form>

<div class="admin-table-wrap">
    <table class="min-w-full text-left text-sm">
        <thead class="border-b border-line bg-paper-soft text-ink-muted">
            <tr>
                <th scope="col" class="px-4 py-3 font-medium">Project</th>
                <th scope="col" class="px-4 py-3 font-medium">Client</th>
                <th scope="col" class="hidden px-4 py-3 font-medium md:table-cell">Service</th>
                <th scope="col" class="px-4 py-3 font-medium">Status</th>
                <th scope="col" class="hidden px-4 py-3 font-medium sm:table-cell">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-line">
            @forelse ($inquiries as $inquiry)
                <tr class="hover:bg-paper-soft">
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="font-medium text-ink hover:text-accent">{{ $inquiry->project_title }}</a>
                    </td>
                    <td class="px-4 py-3">
                        <div>{{ $inquiry->name }}</div>
                        <div class="text-ink-muted">{{ $inquiry->email }}</div>
                    </td>
                    <td class="hidden px-4 py-3 md:table-cell">{{ $inquiry->service?->name ?: '—' }}</td>
                    <td class="px-4 py-3">
                        <x-ui.badge :tone="$inquiry->status->tone()">{{ $inquiry->status->label() }}</x-ui.badge>
                    </td>
                    <td class="hidden px-4 py-3 text-ink-muted sm:table-cell">{{ $inquiry->created_at->format('M j, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center">
                        <p class="font-medium text-ink">No project inquiries yet.</p>
                        <p class="mt-1 text-ink-muted">When visitors submit a project inquiry, it will appear here.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $inquiries->links() }}</div>
@endsection
