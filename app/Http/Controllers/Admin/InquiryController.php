<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInquiryRequest;
use App\Models\Inquiry;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = Inquiry::query()
            ->with('service')
            ->search($request->string('q')->toString())
            ->when($request->filled('status'), fn ($q) => $q->status($request->string('status')->toString()))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.inquiries.index', [
            'inquiries' => $inquiries,
            'statuses' => InquiryStatus::cases(),
            'filters' => [
                'q' => $request->string('q')->toString(),
                'status' => $request->string('status')->toString(),
            ],
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', [
            'inquiry' => $inquiry->load(['service', 'attachments']),
            'statuses' => InquiryStatus::cases(),
        ]);
    }

    public function update(UpdateInquiryRequest $request, Inquiry $inquiry, ActivityLogger $logger): RedirectResponse
    {
        $inquiry->update($request->validated());

        $logger->log('updated inquiry', $inquiry, [
            'status' => $inquiry->status->value,
        ]);

        return back()->with('success', 'Inquiry updated successfully.');
    }

    public function destroy(Inquiry $inquiry, ActivityLogger $logger): RedirectResponse
    {
        $logger->log('deleted inquiry', $inquiry, [
            'email' => $inquiry->email,
            'project_title' => $inquiry->project_title,
        ]);

        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted.');
    }
}
