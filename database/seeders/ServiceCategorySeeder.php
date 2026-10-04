<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'icon' => 'globe', 'description' => 'Business websites, web applications, and admin dashboards.', 'sort_order' => 1],
            ['name' => 'Mobile App Development', 'icon' => 'smartphone', 'description' => 'Cross-platform and native mobile applications for business use.', 'sort_order' => 2],
            ['name' => 'Custom Software', 'icon' => 'code', 'description' => 'Tailored software systems and internal business tools.', 'sort_order' => 3],
            ['name' => 'AI Solutions', 'icon' => 'sparkles', 'description' => 'Practical AI integrations and automation features.', 'sort_order' => 4],
            ['name' => 'API & Integration', 'icon' => 'link', 'description' => 'REST APIs and third-party system integrations.', 'sort_order' => 5],
            ['name' => 'Cloud & Automation', 'icon' => 'cloud', 'description' => 'Cloud deployment, automation, and operational tooling.', 'sort_order' => 6],
        ];

        foreach ($categories as $category) {
            ServiceCategory::query()->updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    ...$category,
                    'is_active' => true,
                ],
            );
        }
    }
}
