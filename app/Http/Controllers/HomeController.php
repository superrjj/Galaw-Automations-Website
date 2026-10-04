<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use App\Models\Service;
use App\Models\Technology;
use App\Services\SiteSettings;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(SiteSettings $settings): View
    {
        return view('home', [
            'services' => Service::query()->active()->ordered()->take(6)->get(),
            'featuredProjects' => PortfolioProject::query()->published()->featured()->ordered()->take(3)->get(),
            'technologies' => Technology::query()->active()->ordered()->get(),
            'settings' => $settings->all(),
        ]);
    }
}
