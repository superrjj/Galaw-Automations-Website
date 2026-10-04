<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Inquiry;
use App\Models\PortfolioProject;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'total_inquiries' => Inquiry::query()->count(),
                'new_inquiries' => Inquiry::query()->status(InquiryStatus::New)->count(),
                'active_inquiries' => Inquiry::query()->whereIn('status', [
                    InquiryStatus::New->value,
                    InquiryStatus::Reviewing->value,
                    InquiryStatus::Contacted->value,
                    InquiryStatus::Quoted->value,
                ])->count(),
                'completed_projects' => Inquiry::query()->status(InquiryStatus::Completed)->count(),
                'portfolio_projects' => PortfolioProject::query()->count(),
                'services' => Service::query()->count(),
                'contact_messages' => ContactMessage::query()->notArchived()->count(),
            ],
            'recentInquiries' => Inquiry::query()->with('service')->latest()->take(5)->get(),
            'recentMessages' => ContactMessage::query()->notArchived()->latest()->take(5)->get(),
        ]);
    }
}
