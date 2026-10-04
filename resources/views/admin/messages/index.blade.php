@extends('layouts.admin')

@section('title', 'Messages')
@section('heading', 'Contact messages')
@section('subheading', 'Messages from the public contact form')

@section('content')
<nav class="mb-6 flex flex-wrap gap-4 text-sm" aria-label="Message filters">
    <a href="{{ route('admin.messages.index') }}" class="{{ $filter === '' ? 'font-semibold text-ink' : 'text-ink-muted hover:text-ink' }}">Inbox</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="{{ $filter === 'unread' ? 'font-semibold text-ink' : 'text-ink-muted hover:text-ink' }}">Unread</a>
    <a href="{{ route('admin.messages.index', ['filter' => 'archived']) }}" class="{{ $filter === 'archived' ? 'font-semibold text-ink' : 'text-ink-muted hover:text-ink' }}">Archived</a>
</nav>

<div class="admin-table-wrap">
    <table class="min-w-full text-left text-sm">
        <thead class="border-b border-line bg-paper-soft text-ink-muted">
            <tr>
                <th scope="col" class="px-4 py-3 font-medium">Subject</th>
                <th scope="col" class="px-4 py-3 font-medium">From</th>
                <th scope="col" class="px-4 py-3 font-medium">Status</th>
                <th scope="col" class="hidden px-4 py-3 font-medium sm:table-cell">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-line">
            @forelse ($messages as $message)
                <tr class="hover:bg-paper-soft">
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.messages.show', $message) }}" class="font-medium text-ink hover:text-accent">{{ $message->subject }}</a>
                    </td>
                    <td class="px-4 py-3">
                        <div>{{ $message->name }}</div>
                        <div class="text-ink-muted">{{ $message->email }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @if ($message->is_archived)
                            <x-ui.badge tone="muted">Archived</x-ui.badge>
                        @elseif ($message->is_read)
                            <x-ui.badge tone="muted">Read</x-ui.badge>
                        @else
                            <x-ui.badge tone="info">Unread</x-ui.badge>
                        @endif
                    </td>
                    <td class="hidden px-4 py-3 text-ink-muted sm:table-cell">{{ $message->created_at->format('M j, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-10 text-center">
                        <p class="font-medium text-ink">No contact messages yet.</p>
                        <p class="mt-1 text-ink-muted">Messages from the contact form will appear here.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">{{ $messages->links() }}</div>
@endsection
