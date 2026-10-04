@extends('layouts.admin')
@section('title', 'Messages')
@section('heading', 'Contact messages')
@section('content')
<div class="mb-6 flex gap-3 text-sm">
<a href="{{ route('admin.messages.index') }}" class="{{ $filter === '' ? 'text-accent' : 'text-ink/60' }}">Inbox</a>
<a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="{{ $filter === 'unread' ? 'text-accent' : 'text-ink/60' }}">Unread</a>
<a href="{{ route('admin.messages.index', ['filter' => 'archived']) }}" class="{{ $filter === 'archived' ? 'text-accent' : 'text-ink/60' }}">Archived</a>
</div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
<table class="min-w-full text-left text-sm">
<thead class="border-b border-line bg-mist/60 text-ink/60"><tr><th class="px-4 py-3">Subject</th><th class="px-4 py-3">From</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Date</th></tr></thead>
<tbody class="divide-y divide-line">
@forelse ($messages as $message)
<tr class="hover:bg-mist/40">
<td class="px-4 py-3"><a href="{{ route('admin.messages.show', $message) }}" class="font-medium hover:text-accent">{{ $message->subject }}</a></td>
<td class="px-4 py-3">{{ $message->name }}<div class="text-ink/50">{{ $message->email }}</div></td>
<td class="px-4 py-3">{{ $message->is_archived ? 'Archived' : ($message->is_read ? 'Read' : 'Unread') }}</td>
<td class="px-4 py-3 text-ink/60">{{ $message->created_at->format('M j, Y') }}</td>
</tr>
@empty
<tr><td colspan="4" class="px-4 py-10 text-center text-ink/50">No messages found.</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="mt-6">{{ $messages->links() }}</div>
@endsection
