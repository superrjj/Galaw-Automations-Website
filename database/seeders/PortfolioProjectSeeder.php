<?php

namespace Database\Seeders;

use App\Models\PortfolioProject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Sample portfolio entries for development only. Replace with real project data.
        $projects = [
            [
                'title' => 'Sample Corporate Website',
                'short_description' => '[Sample data] A clean company website with service pages and an inquiry form.',
                'description' => '[Sample data — replace with a real project] This sample portfolio item demonstrates how completed website projects can be presented, including overview, technologies, and process notes.',
                'category' => 'Web Development',
                'project_type' => 'Sample / Placeholder',
                'problem' => '[Sample data] The business needed a clear online presence to explain services and collect project inquiries.',
                'solution' => '[Sample data] A responsive marketing website with service pages, process explanation, and a structured inquiry form.',
                'features' => ['Service pages', 'Inquiry form', 'Responsive layout', 'Admin content management'],
                'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'PostgreSQL'],
                'results' => null,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Sample Operations Dashboard',
                'short_description' => '[Sample data] An internal dashboard concept for tracking requests and operational status.',
                'description' => '[Sample data — replace with a real project] This placeholder shows how custom software and dashboard work can be documented in the portfolio.',
                'category' => 'Custom Software',
                'project_type' => 'Sample / Placeholder',
                'problem' => '[Sample data] Teams needed a clearer way to track incoming requests and status updates.',
                'solution' => '[Sample data] A role-protected dashboard with searchable records, status updates, and admin notes.',
                'features' => ['Request tracking', 'Status filters', 'Admin notes', 'Secure authentication'],
                'technologies' => ['Laravel', 'Livewire', 'PostgreSQL', 'Alpine.js'],
                'results' => null,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Sample API Integration Project',
                'short_description' => '[Sample data] A backend integration example connecting internal systems through APIs.',
                'description' => '[Sample data — replace with a real project] Use this placeholder until verified client projects are ready to publish.',
                'category' => 'API & Integration',
                'project_type' => 'Sample / Placeholder',
                'problem' => '[Sample data] Data was being moved manually between tools.',
                'solution' => '[Sample data] An API-based integration layer with validation, logging, and scheduled synchronization.',
                'features' => ['REST API integration', 'Scheduled sync', 'Error logging', 'Secure credentials via environment variables'],
                'technologies' => ['Laravel', 'REST APIs', 'Queues', 'PostgreSQL'],
                'results' => null,
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            PortfolioProject::query()->updateOrCreate(
                ['slug' => Str::slug($project['title'])],
                [
                    ...$project,
                    'project_url' => null,
                    'cover_image' => null,
                    'completed_at' => null,
                    'is_published' => true,
                ],
            );
        }
    }
}
