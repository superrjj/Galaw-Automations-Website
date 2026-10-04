@extends('layouts.admin')
@section('title', 'Message')
@section('heading', $message->subject)
@section('subheading', $message->created_at->format('M j, Y g:i A'))
@section('content')
<div class="max-w-3xl space-y-6">
<div class="rounded-2xl border border-line bg-white p-6 text-sm">
<div class="grid gap-3 sm:grid-cols-2">
<div><div class="text-ink/50">Name</div><div>{{ $message->name }}</div></div>
<div><div class="text-ink/50">Email</div><div>{{ $message->email }}</div></div>
<div><div class="text-ink/50">Phone</div><div>{{ $message->phone ?: '—' }}</div></div>
<div><div class="text-ink/50">Company</div><div>{{ $message->company ?: '—' }}</div></div>
</div>
<p class="mt-6 whitespace-pre-wrap leading-relaxed text-ink/80">{{ $message->message }}</p>
</div>
<div class="flex flex-wrap gap-3">
@if ($message->is_read)
<form method="POST" action="{{ route('admin.messages.unread', $message) }}">@csrf <x-ui.button type="submit" variant="secondary">Mark unread</x-ui.button></form>
@else
<form method="POST" action="{{ route('admin.messages.read', $message) }}">@csrf <x-ui.button type="submit" variant="secondary">Mark read</x-ui.button></form>
@endif
@unless ($message->is_archived)
<form method="POST" action="{{ route('admin.messages.archive', $message) }}">@csrf <x-ui.button type="submit" variant="secondary">Archive</x-ui.button></form>
@endunless
<form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')
<button type="submit" class="text-sm text-red-600">Delete</button>
</form>
</div>
</div>
@endsection
