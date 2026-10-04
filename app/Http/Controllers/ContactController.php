<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Services\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact');
    }

    public function store(StoreContactMessageRequest $request, SiteSettings $settings): RedirectResponse
    {
        $message = ContactMessage::query()->create($request->validated());

        try {
            $adminEmail = $settings->get('admin_notification_email') ?: config('mail.from.address');

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactMessageReceived($message));
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been sent successfully. Our team will get back to you soon.');
    }
}
