<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->when($request->string('filter')->toString() === 'archived', fn ($q) => $q->where('is_archived', true))
            ->when($request->string('filter')->toString() !== 'archived', fn ($q) => $q->notArchived())
            ->when($request->string('filter')->toString() === 'unread', fn ($q) => $q->unread())
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'filter' => $request->string('filter')->toString(),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', [
            'message' => $message->fresh(),
        ]);
    }

    public function markRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Message marked as read.');
    }

    public function markUnread(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => false]);

        return back()->with('success', 'Message marked as unread.');
    }

    public function archive(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_archived' => true]);

        return back()->with('success', 'Message archived.');
    }

    public function destroy(ContactMessage $message, ActivityLogger $logger): RedirectResponse
    {
        $logger->log('deleted contact message', $message, ['email' => $message->email]);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}
