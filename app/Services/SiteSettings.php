<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettings
{
    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return Cache::remember('site_settings', 3600, function (): array {
            return SiteSetting::query()
                ->pluck('value', 'key')
                ->all();
        });
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->all()[$key] ?? $default;
    }

    public function set(string $key, mixed $value, string $type = 'string', string $group = 'general'): void
    {
        SiteSetting::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => is_bool($value) ? ($value ? '1' : '0') : $value,
                'type' => $type,
                'group' => $group,
            ],
        );

        Cache::forget('site_settings');
    }

    /**
     * @param  array<string, mixed>  $settings
     */
    public function setMany(array $settings, string $group = 'general'): void
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value, is_bool($value) ? 'boolean' : 'string', $group);
        }
    }

    public function forgetCache(): void
    {
        Cache::forget('site_settings');
    }
}
