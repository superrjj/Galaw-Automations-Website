<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@galawautomations.com'],
            [
                'name' => 'Galaw Administrator',
                'password' => Hash::make('galawadmin@2026!'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );

        $this->call([
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            TechnologySeeder::class,
            FaqSeeder::class,
            PortfolioProjectSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
