@extends('layouts.admin')
@section('title', 'FAQs')
@section('heading', 'FAQs')
@section('content')
<div class="mb-6 flex justify-end"><x-ui.button href="{{ route('admin.faqs.create') }}">Add FAQ</x-ui.button></div>
<div class="overflow-hidden rounded-2xl border border-line bg-white">
<table class="min-w-full text-left text-sm">
<thead class="border-b border-line bg-mist/60 text-ink/60"><tr><th class="px-4 py-3">Question</th><th class="px-4 py-3">Active</th><th class="px-4 py-3">Order</th><th class="px-4 py-3"></th></tr></thead>
<tbody class="divide-y divide-line">
@foreach ($faqs as $faq)
<tr>
<td class="px-4 py-3 font-medium">{{ $faq->question }}</td>
<td class="px-4 py-3">{{ $faq->is_active ? 'Yes' : 'No' }}</td>
<td class="px-4 py-3">{{ $faq->sort_order }}</td>
<td class="px-4 py-3 text-right"><a href="{{ route('admin.faqs.edit', $faq) }}" class="text-accent">Edit</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="mt-6">{{ $faqs->links() }}</div>
@endsection
