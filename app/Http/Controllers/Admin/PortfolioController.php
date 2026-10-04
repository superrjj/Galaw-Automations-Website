<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\PortfolioProject;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('admin.portfolio.index', [
            'projects' => PortfolioProject::query()->ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.portfolio.create');
    }

    public function store(StorePortfolioRequest $request, ActivityLogger $logger): RedirectResponse
    {
        $data = $this->preparePayload($request->validated());

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        $project = PortfolioProject::query()->create($data);
        $logger->log('created portfolio project', $project);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project created.');
    }

    public function edit(PortfolioProject $portfolio): View
    {
        return view('admin.portfolio.edit', [
            'project' => $portfolio,
        ]);
    }

    public function update(UpdatePortfolioRequest $request, PortfolioProject $portfolio, ActivityLogger $logger): RedirectResponse
    {
        $data = $this->preparePayload($request->validated(), $portfolio);

        if ($request->hasFile('cover_image')) {
            if ($portfolio->cover_image) {
                Storage::disk('public')->delete($portfolio->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        $portfolio->update($data);
        $logger->log('updated portfolio project', $portfolio);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project updated.');
    }

    public function destroy(PortfolioProject $portfolio, ActivityLogger $logger): RedirectResponse
    {
        $logger->log('deleted portfolio project', $portfolio, ['title' => $portfolio->title]);

        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project deleted.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function preparePayload(array $data, ?PortfolioProject $project = null): array
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['features'] = $this->linesToArray($data['features'] ?? null);
        $data['technologies'] = $this->linesToArray($data['technologies'] ?? null);

        return $data;
    }

    /**
     * @return array<int, string>
     */
    private function linesToArray(null|string|array $value): array
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map('trim', $value)));
        }

        if (blank($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value) ?: [])));
    }
}
