<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProcessController extends Controller
{
    public function __invoke(): View
    {
        return view('process', [
            'stages' => [
                ['title' => 'Discovery', 'description' => 'We learn about your business, goals, constraints, and what success should look like.'],
                ['title' => 'Requirements', 'description' => 'We clarify features, priorities, users, and technical needs in plain language.'],
                ['title' => 'Planning', 'description' => 'We define scope, milestones, architecture direction, and delivery approach.'],
                ['title' => 'UI/UX Design', 'description' => 'We shape clear interfaces and flows that support real users and business goals.'],
                ['title' => 'Development', 'description' => 'We build the product in focused stages with maintainable, modern technology.'],
                ['title' => 'Testing', 'description' => 'We verify functionality, edge cases, responsiveness, and readiness for launch.'],
                ['title' => 'Deployment', 'description' => 'We release the application carefully and confirm the production environment is ready.'],
                ['title' => 'Maintenance', 'description' => 'We support updates, fixes, and improvements after launch as your needs evolve.'],
            ],
        ]);
    }
}
