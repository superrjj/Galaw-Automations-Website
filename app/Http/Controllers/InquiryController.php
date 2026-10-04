<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Service;
use App\Services\InquiryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function create(Request $request): View
    {
        $services = Service::query()->active()->ordered()->get();
        $selectedService = null;

        if ($request->filled('service')) {
            $selectedService = $services->firstWhere('slug', $request->string('service')->toString());
        }

        return view('inquiry.create', [
            'services' => $services,
            'selectedService' => $selectedService,
        ]);
    }

    public function store(StoreInquiryRequest $request, InquiryService $inquiryService): RedirectResponse
    {
        $data = $request->safe()->except('attachment');
        $attachments = [];

        if ($request->hasFile('attachment')) {
            $attachments[] = $request->file('attachment');
        }

        $inquiryService->submit($data, $attachments);

        return redirect()
            ->route('request-service')
            ->with('success', 'Your project inquiry has been submitted successfully. Our team will review it and contact you soon.');
    }
}
