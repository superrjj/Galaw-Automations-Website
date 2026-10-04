<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AI Integration
    |--------------------------------------------------------------------------
    |
    | AI features are optional. The website must work when AI is disabled
    | or when API credentials are missing.
    |
    */

    'enabled' => (bool) env('AI_ENABLED', false),

    'timeout' => (int) env('AI_TIMEOUT', 20),

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
        'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
    ],

];
