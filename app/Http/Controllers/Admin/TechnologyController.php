<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TechnologyCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTechnologyRequest;
use App\Http\Requests\Admin\UpdateTechnologyRequest;
use App\Models\Technology;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TechnologyController extends Controller
{
    public function index(): View
    {
        return view('admin.technologies.index', [
            'technologies' => Technology::query()->ordered()->paginate(30),
        ]);
    }

    public function create(): View
    {
        return view('admin.technologies.create', [
            'categories' => TechnologyCategory::cases(),
        ]);
    }

    public function store(StoreTechnologyRequest $request, ActivityLogger $logger): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $technology = Technology::query()->create($data);
        $logger->log('created technology', $technology);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology created.');
    }

    public function edit(Technology $technology): View
    {
        return view('admin.technologies.edit', [
            'technology' => $technology,
            'categories' => TechnologyCategory::cases(),
        ]);
    }

    public function update(UpdateTechnologyRequest $request, Technology $technology, ActivityLogger $logger): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $technology->update($data);
        $logger->log('updated technology', $technology);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated.');
    }

    public function destroy(Technology $technology, ActivityLogger $logger): RedirectResponse
    {
        $logger->log('deleted technology', $technology, ['name' => $technology->name]);
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted.');
    }
}
