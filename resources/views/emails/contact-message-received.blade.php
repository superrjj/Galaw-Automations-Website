<x-mail::message>
# New contact message

**Name:** {{ $message->name }}  
**Email:** {{ $message->email }}  
**Subject:** {{ $message->subject }}

{{ $message->message }}

<x-mail::button :url="route('admin.messages.show', $message)">
View message
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
