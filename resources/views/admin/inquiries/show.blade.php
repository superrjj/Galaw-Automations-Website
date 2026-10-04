@extends('layouts.admin')

@section('title', 'Inquiry Details')
@section('heading', $inquiry->project_title)
@section('subheading', 'Submitted '.$inquiry->created_at->format('M j, Y g:i A'))

@section('content')
<div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="space-y-6">
        <div class="rounded-2xl border border-line bg-white p-6">
            <h2 class="font-semibold">Client information</h2>
            <dl class="mt-4 grid gap-3 text-sm sm:grid-cols-2">
                <div><dt class="text-ink/50">Name</dt><dd>{{ $inquiry->name }}</dd></div>
                <div><dt class="text-ink/50">Email</dt><dd>{{ $inquiry->email }}</dd></div>
                <div><dt class="text-ink/50">Phone</dt><dd>{{ $inquiry->phone ?: '—' }}</dd></div>
                <div><dt class="text-ink/50">Company</dt><dd>{{ $inquiry->company ?: '—' }}</dd></div>
                <div><dt class="text-ink/50">Service</dt><dd>{{ $inquiry->service?->name ?: '—' }}</dd></div>
                <div><dt class="text-ink/50">Budget</dt><dd>{{ $inquiry->budget ?: '—' }}</dd></div>
                <div><dt class="text-ink/50">Timeline</dt><dd>{{ $inquiry->timeline ?: '—' }}</dd></div>
                <div><dt class="text-ink/50">Status</dt><dd><x-ui.badge :tone="$inquiry->status->tone()">{{ $inquiry->status->label() }}</x-ui.badge></dd></div>
            </dl>
        </div>

        <div class="rounded-2xl border border-line bg-white p-6">
            <h2 class="font-semibold">Project description</h2>
            <p class="mt-3 whitespace-pre-wrap text-sm leading-relaxed text-ink/75">{{ $inquiry->description }}</p>
            @if ($inquiry->additional_requirements)
                <h3 class="mt-6 font-semibold">Additional requirements</h3>
                <p class="mt-2 whitespace-pre-wrap text-sm text-ink/75">{{ $inquiry->additional_requirements }}</p>
            @endif
        </div>

        @if ($inquiry->attachments->isNotEmpty())
            <div class="rounded-2xl border border-line bg-white p-6">
                <h2 class="font-semibold">Attachments</h2>
                <ul class="mt-3 space-y-2 text-sm">
                    @foreach ($inquiry->attachments as $attachment)
                        <li>{{ $attachment->original_name }} ({{ number_format($attachment->file_size / 1024, 1) }} KB)</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($inquiry->ai_analysis))
            <div class="rounded-2xl border border-line bg-white p-6">
                <h2 class="font-semibold">AI analysis (internal assistance)</h2>
                <p class="mt-1 text-xs text-ink/50">Review carefully. This does not promise pricing, delivery dates, or guaranteed architecture.</p>
                <pre class="mt-4 overflow-x-auto rounded-xl bg-mist p-4 text-xs text-ink/80">{{ json_encode($inquiry->ai_analysis, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
            </div>
        @endif
    </div>

    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}" class="rounded-2xl border border-line bg-white p-6">
            @csrf
            @method('PUT')
            <h2 class="font-semibold">Update inquiry</h2>
            <div class="mt-4 space-y-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Status</label>
                    <select name="status" class="w-full rounded-xl border border-line px-3.5 py-2.5 text-sm">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected($inquiry->status === $status)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <x-ui.textarea label="Internal notes" name="admin_notes" :value="$inquiry->admin_notes" rows="6" />
                <x-ui.button type="submit">Save changes</x-ui.button>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-600 hover:underline">Delete inquiry</button>
        </form>
    </div>
</div>
@endsection
