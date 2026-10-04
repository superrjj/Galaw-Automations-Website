<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $portfolioId = $this->route('portfolio')?->id;

        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('portfolio_projects', 'slug')->ignore($portfolioId)],
            'short_description' => ['required', 'string', 'max:300'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:120'],
            'project_type' => ['nullable', 'string', 'max:120'],
            'problem' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'features' => ['nullable', 'string'],
            'technologies' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'completed_at' => ['nullable', 'date'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_published' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
