@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', 'Inquiries and messages that need attention')

@section('content')
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ([
        ['New inquiries', $stats['new_inquiries'], route('admin.inquiries.index', ['status' => 'new'])],
        ['Active inquiries', $stats['active_inquiries'], route('admin.inquiries.index')],
        ['Completed', $stats['completed_projects'], route('admin.inquiries.index', ['status' => 'completed'])],
        ['Contact messages', $stats['contact_messages'], route('admin.messages.index')],
    ] as [$label, $value, $href])
        <a href="{{ $href }}" class="admin-panel block p-5 transition hover:border-ink">
            <div class="text-sm text-ink-muted">{{ $label }}</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight text-ink">{{ $value }}</div>
        </a>
    @endforeach
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-2">
    <section class="admin-panel p-5" aria-labelledby="recent-inquiries">
        <div class="flex items-center justify-between gap-4">
            <h2 id="recent-inquiries" class="font-semibold text-ink">Recent inquiries</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="text-sm font-medium text-accent hover:text-accent-dark">View all</a>
        </div>
        <div class="mt-4 divide-y divide-line">
            @forelse ($recentInquiries as $inquiry)
                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="block py-3 text-sm hover:text-accent">
                    <div class="font-medium text-ink">{{ $inquiry->project_title }}</div>
                    <div class="mt-0.5 text-ink-muted">{{ $inquiry->name }} · {{ $inquiry->status->label() }}</div>
                </a>
            @empty
                <div class="py-8 text-sm text-ink-muted">
                    <p class="font-medium text-ink">No project inquiries yet.</p>
                    <p class="mt-1">When visitors submit a project request, it will appear here.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="admin-panel p-5" aria-labelledby="recent-messages">
        <div class="flex items-center justify-between gap-4">
            <h2 id="recent-messages" class="font-semibold text-ink">Recent messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-medium text-accent hover:text-accent-dark">View all</a>
        </div>
        <div class="mt-4 divide-y divide-line">
            @forelse ($recentMessages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="block py-3 text-sm hover:text-accent">
                    <div class="font-medium text-ink">{{ $message->subject }}</div>
                    <div class="mt-0.5 text-ink-muted">{{ $message->name }} · {{ $message->is_read ? 'Read' : 'Unread' }}</div>
                </a>
            @empty
                <div class="py-8 text-sm text-ink-muted">
                    <p class="font-medium text-ink">No contact messages yet.</p>
                    <p class="mt-1">Messages from the contact form will appear here.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
