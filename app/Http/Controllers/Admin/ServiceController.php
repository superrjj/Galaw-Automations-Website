<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->with('category')->ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create', [
            'categories' => ServiceCategory::query()->ordered()->get(),
        ]);
    }

    public function store(StoreServiceRequest $request, ActivityLogger $logger): RedirectResponse
    {
        $data = $this->preparePayload($request->validated());
        $service = Service::query()->create($data);
        $logger->log('created service', $service);

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
            'categories' => ServiceCategory::query()->ordered()->get(),
        ]);
    }

    public function update(UpdateServiceRequest $request, Service $service, ActivityLogger $logger): RedirectResponse
    {
        $service->update($this->preparePayload($request->validated(), $service));
        $logger->log('updated service', $service);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service, ActivityLogger $logger): RedirectResponse
    {
        $logger->log('deleted service', $service, ['name' => $service->name]);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function preparePayload(array $data, ?Service $service = null): array
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['features'] = $this->linesToArray($data['features'] ?? null);
        $data['technologies'] = $this->linesToArray($data['technologies'] ?? null);
        $data['benefits'] = $this->linesToArray($data['benefits'] ?? null);

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
