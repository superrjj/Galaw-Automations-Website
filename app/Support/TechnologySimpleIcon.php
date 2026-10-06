<?php

namespace App\Support;

final class TechnologySimpleIcon
{
    private const SVG_PATH = 'vendor/codeat3/blade-simple-icons/resources/svg';

    /**
     * Resolve a Simple Icons Blade component name (e.g. si-laravel) for a technology key.
     */
    public static function component(?string $key): ?string
    {
        if ($key === null || trim($key) === '') {
            return null;
        }

        $normalized = strtolower(trim($key));
        $normalized = str_replace(['.js', '.css'], ['js', 'css'], $normalized);
        $normalized = str_replace('_', '-', $normalized);

        $map = [
            'html' => 'html5',
            'html5' => 'html5',
            'css' => 'css',
            'javascript' => 'javascript',
            'js' => 'javascript',
            'typescript' => 'typescript',
            'ts' => 'typescript',
            'react' => 'react',
            'react-native' => 'react',
            'tailwind-css' => 'tailwindcss',
            'tailwind' => 'tailwindcss',
            'tailwindcss' => 'tailwindcss',
            'alpine-js' => 'alpinedotjs',
            'alpinejs' => 'alpinedotjs',
            'alpine' => 'alpinedotjs',
            'laravel' => 'laravel',
            'php' => 'php',
            'livewire' => 'livewire',
            'node-js' => 'nodedotjs',
            'nodejs' => 'nodedotjs',
            'node' => 'nodedotjs',
            'python' => 'python',
            'postgresql' => 'postgresql',
            'postgres' => 'postgresql',
            'mysql' => 'mysql',
            'firebase' => 'firebase',
            'gemini' => 'googlegemini',
            'googlegemini' => 'googlegemini',
            'google-gemini' => 'googlegemini',
            'ai-apis' => 'huggingface',
            'ai' => 'huggingface',
            'git' => 'git',
            'github' => 'github',
            'docker' => 'docker',
            'vite' => 'vite',
            'cloud-platforms' => 'googlecloud',
            'cloud' => 'googlecloud',
            'aws' => 'googlecloud',
            'google-cloud' => 'googlecloud',
            'rest-apis' => 'swagger',
            'rest' => 'swagger',
            'api' => 'swagger',
            'apis' => 'swagger',
            'supabase' => 'supabase',
            'nest' => 'nestjs',
            'nestjs' => 'nestjs',
            'nest-js' => 'nestjs',
            // OpenAI is not published in the current Simple Icons set.
            'openai' => null,
        ];

        if (array_key_exists($normalized, $map)) {
            $icon = $map[$normalized];

            return $icon ? 'si-'.$icon : null;
        }

        foreach ([
            str_replace('-', '', $normalized),
            $normalized,
            str_replace('-', 'dot', $normalized),
        ] as $candidate) {
            if (self::svgExists($candidate)) {
                return 'si-'.$candidate;
            }
        }

        return null;
    }

    private static function svgExists(string $icon): bool
    {
        return is_file(base_path(self::SVG_PATH.'/'.$icon.'.svg'));
    }
}
