<?php

namespace App\Services\Ai;

use App\Models\Inquiry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class InquiryAnalyzer
{
    /**
     * Analyze an inquiry and return structured assistance for admins.
     *
     * @return array<string, mixed>|null
     */
    public function analyze(Inquiry $inquiry): ?array
    {
        if (! config('ai.enabled')) {
            return null;
        }

        $apiKey = config('ai.openai.api_key');

        if (blank($apiKey)) {
            return null;
        }

        $prompt = $this->buildPrompt($inquiry);

        try {
            $response = Http::withToken($apiKey)
                ->timeout((int) config('ai.timeout', 20))
                ->post(rtrim((string) config('ai.openai.base_url'), '/').'/chat/completions', [
                    'model' => config('ai.openai.model', 'gpt-4o-mini'),
                    'temperature' => 0.2,
                    'response_format' => ['type' => 'json_object'],
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You assist software agency admins. Return JSON only. Never promise pricing, delivery dates, guaranteed features, or guaranteed architecture. Provide cautious internal suggestions only.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                ]);

            if (! $response->successful()) {
                Log::warning('AI inquiry analysis failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            $content = data_get($response->json(), 'choices.0.message.content');

            if (! is_string($content) || blank($content)) {
                return null;
            }

            /** @var array<string, mixed>|null $decoded */
            $decoded = json_decode($content, true);

            return is_array($decoded) ? $decoded : null;
        } catch (Throwable $exception) {
            Log::warning('AI inquiry analysis exception', [
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    private function buildPrompt(Inquiry $inquiry): string
    {
        $service = $inquiry->service?->name ?? 'Not specified';

        return <<<PROMPT
Analyze this project inquiry for an admin review. Return JSON with keys:
project_type, likely_requirements (array), suggested_technologies (array), estimated_complexity (low|medium|high|unknown), development_considerations (array), caveats (array).

Service: {$service}
Project title: {$inquiry->project_title}
Description: {$inquiry->description}
Budget: {$inquiry->budget}
Timeline: {$inquiry->timeline}
Additional requirements: {$inquiry->additional_requirements}
PROMPT;
    }
}
