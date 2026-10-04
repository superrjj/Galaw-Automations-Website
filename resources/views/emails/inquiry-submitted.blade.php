<x-mail::message>
# New project inquiry

A new inquiry was submitted on the Galaw Automations website.

**Name:** {{ $inquiry->name }}  
**Email:** {{ $inquiry->email }}  
**Company:** {{ $inquiry->company ?: '—' }}  
**Service:** {{ $inquiry->service?->name ?: 'Not specified' }}  
**Project:** {{ $inquiry->project_title }}

{{ $inquiry->description }}

<x-mail::button :url="route('admin.inquiries.show', $inquiry)">
View inquiry
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
