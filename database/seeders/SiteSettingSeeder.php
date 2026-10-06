<?php

namespace Database\Seeders;

use App\Services\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(SiteSettings::class);

        $defaults = [
            'company_name' => 'Galaw Automations',
            'tagline' => 'Build Smarter. Automate Better.',
            'company_email' => 'galawagency@gmail.com',
            'company_phone' => '+63 993 783 9142',
            'company_address' => 'Matatalaib, Tarlac, Philippines, 2300',
            'admin_notification_email' => 'galawagency@gmail.com',
            'seo_title' => 'Galaw Automations | Software Solutions & Automation',
            'seo_description' => 'Galaw Automations builds websites, mobile apps, business systems, AI solutions, integrations, and automation tools for businesses.',
            'about_intro' => 'Galaw Automations is a software solutions and automation company. We help businesses build websites, mobile applications, custom software, AI-powered features, integrations, and automation tools.',
            'mission' => '[Replace] Help businesses operate more efficiently through practical software, integrations, and automation.',
            'vision' => '[Replace] Become a trusted partner for businesses that need reliable, modern software solutions.',
            'philosophy' => 'We focus on clear requirements, maintainable architecture, and practical outcomes. Technology should support the business — not create unnecessary complexity.',
            'values' => "Clarity\nReliability\nPractical innovation\nLong-term support\nHonest communication",
            'social_facebook' => 'https://www.facebook.com/profile.php?id=61592205970594',
            'social_linkedin' => 'https://ph.linkedin.com/company/galaw-automations',
            'social_tiktok' => 'https://www.tiktok.com/@galaw.smartagency',
            'social_github' => '',
            'social_x' => '',
        ];

        foreach ($defaults as $key => $value) {
            if ($settings->get($key) === null) {
                $settings->set($key, $value);
            }
        }

        foreach ([
            'company_email',
            'company_phone',
            'company_address',
            'admin_notification_email',
            'social_facebook',
            'social_linkedin',
            'social_tiktok',
        ] as $key) {
            $current = $settings->get($key);
            $isPlaceholder = is_string($current) && (
                $current === ''
                || str_contains($current, '[Replace')
                || str_ends_with($current, '.test')
                || str_contains($current, 'facebook.com/share/')
            );

            if ($current === null || $isPlaceholder) {
                $settings->set($key, $defaults[$key]);
            }
        }
    }
}
