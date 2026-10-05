<?php

namespace Database\Seeders;

use App\Enums\TechnologyCategory;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            ['name' => 'HTML', 'category' => TechnologyCategory::Frontend, 'sort_order' => 1],
            ['name' => 'CSS', 'category' => TechnologyCategory::Frontend, 'sort_order' => 2],
            ['name' => 'JavaScript', 'category' => TechnologyCategory::Frontend, 'sort_order' => 3],
            ['name' => 'TypeScript', 'category' => TechnologyCategory::Frontend, 'sort_order' => 4],
            ['name' => 'React', 'category' => TechnologyCategory::Frontend, 'sort_order' => 5],
            ['name' => 'Tailwind CSS', 'category' => TechnologyCategory::Frontend, 'sort_order' => 6],
            ['name' => 'Alpine.js', 'category' => TechnologyCategory::Frontend, 'sort_order' => 7],
            ['name' => 'Laravel', 'category' => TechnologyCategory::Backend, 'sort_order' => 1],
            ['name' => 'PHP', 'category' => TechnologyCategory::Backend, 'sort_order' => 2],
            ['name' => 'Livewire', 'category' => TechnologyCategory::Backend, 'sort_order' => 3],
            ['name' => 'Node.js', 'category' => TechnologyCategory::Backend, 'sort_order' => 4],
            ['name' => 'Python', 'category' => TechnologyCategory::Backend, 'sort_order' => 5],
            ['name' => 'React Native', 'category' => TechnologyCategory::Mobile, 'sort_order' => 1],
            ['name' => 'PostgreSQL', 'category' => TechnologyCategory::Database, 'sort_order' => 1],
            ['name' => 'MySQL', 'category' => TechnologyCategory::Database, 'sort_order' => 2],
            ['name' => 'Firebase', 'category' => TechnologyCategory::Database, 'sort_order' => 3],
            ['name' => 'OpenAI', 'category' => TechnologyCategory::Ai, 'sort_order' => 1],
            ['name' => 'Gemini', 'category' => TechnologyCategory::Ai, 'sort_order' => 2],
            ['name' => 'AI APIs', 'category' => TechnologyCategory::Ai, 'sort_order' => 3],
            ['name' => 'Git', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 1],
            ['name' => 'GitHub', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 2],
            ['name' => 'Docker', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 3],
            ['name' => 'Vite', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 4],
            ['name' => 'Cloud platforms', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 5],
            ['name' => 'REST APIs', 'category' => TechnologyCategory::Infrastructure, 'sort_order' => 6],
        ];

        foreach ($technologies as $technology) {
            $slug = Str::slug($technology['name']);

            Technology::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $technology['name'],
                    'category' => $technology['category'],
                    'description' => null,
                    'icon' => $slug,
                    'is_active' => true,
                    'sort_order' => $technology['sort_order'],
                ],
            );
        }
    }
}
