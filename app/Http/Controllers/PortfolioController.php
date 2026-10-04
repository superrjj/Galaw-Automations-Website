<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio.index', [
            'projects' => PortfolioProject::query()->published()->ordered()->paginate(9),
        ]);
    }

    public function show(PortfolioProject $project): View
    {
        abort_unless($project->is_published, 404);

        return view('portfolio.show', [
            'project' => $project->load('images'),
        ]);
    }
}
