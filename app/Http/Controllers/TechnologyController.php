<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\View\View;

class TechnologyController extends Controller
{
    public function __invoke(): View
    {
        $technologies = Technology::query()->active()->ordered()->get();

        return view('technologies.index', [
            'groupedTechnologies' => $technologies->groupBy(fn (Technology $tech) => $tech->category->value),
        ]);
    }
}
