@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', 'Overview of inquiries, content, and messages')

@section('content')
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ([
        ['Total inquiries', $stats['total_inquiries']],
        ['New inquiries', $stats['new_inquiries']],
        ['Active inquiries', $stats['active_inquiries']],
        ['Completed inquiries', $stats['completed_projects']],
        ['Portfolio projects', $stats['portfolio_projects']],
        ['Services', $stats['services']],
        ['Contact messages', $stats['contact_messages']],
    ] as [$label, $value])
        <div class="rounded-2xl border border-line bg-white p-5">
            <div class="text-sm text-ink/60">{{ $label }}</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight">{{ $value }}</div>
        </div>
    @endforeach
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-2">
    <div class="rounded-2xl border border-line bg-white p-5">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold">Recent inquiries</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-accent">View all</a>
        </div>
        <div class="mt-4 divide-y divide-line">
            @forelse ($recentInquiries as $inquiry)
                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="block py-3 text-sm hover:text-accent">
                    <div class="font-medium">{{ $inquiry->project_title }}</div>
                    <div class="text-ink/55">{{ $inquiry->name }} · {{ $inquiry->status->label() }}</div>
                </a>
            @empty
                <div class="py-6 text-sm text-ink/50">No inquiries yet.</div>
            @endforelse
        </div>
    </div>

    <div class="rounded-2xl border border-line bg-white p-5">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold">Recent messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-sm text-accent">View all</a>
        </div>
        <div class="mt-4 divide-y divide-line">
            @forelse ($recentMessages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="block py-3 text-sm hover:text-accent">
                    <div class="font-medium">{{ $message->subject }}</div>
                    <div class="text-ink/55">{{ $message->name }} · {{ $message->is_read ? 'Read' : 'Unread' }}</div>
                </a>
            @empty
                <div class="py-6 text-sm text-ink/50">No messages yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
