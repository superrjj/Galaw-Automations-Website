<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'categories' => ServiceCategory::query()->active()->ordered()->with(['services' => fn ($q) => $q->active()->ordered()])->get(),
            'services' => Service::query()->active()->ordered()->with('category')->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $categoryName = $service->category?->name;

        return view('services.show', [
            'service' => $service->load('category'),
            'relatedProjects' => PortfolioProject::query()
                ->published()
                ->ordered()
                ->when($categoryName, fn ($q) => $q->where('category', $categoryName))
                ->take(3)
                ->get(),
        ]);
    }
}
