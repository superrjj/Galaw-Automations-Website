@php
    $featureText = old('features', is_array($project?->features ?? null) ? implode("\n", $project->features) : '');
    $techText = old('technologies', is_array($project?->technologies ?? null) ? implode("\n", $project->technologies) : '');
@endphp
<form method="POST" action="{{ $project ? route('admin.portfolio.update', $project) : route('admin.portfolio.store') }}" enctype="multipart/form-data" class="max-w-3xl space-y-4 rounded-2xl border border-line bg-white p-6">
    @csrf
    @if ($project) @method('PUT') @endif
    <x-ui.input label="Title" name="title" :value="$project?->title" required />
    <x-ui.input label="Slug" name="slug" :value="$project?->slug" />
    <x-ui.input label="Short description" name="short_description" :value="$project?->short_description" required />
    <x-ui.textarea label="Description" name="description" :value="$project?->description" rows="5" required />
    <div class="grid gap-4 sm:grid-cols-2">
        <x-ui.input label="Category" name="category" :value="$project?->category" />
        <x-ui.input label="Project type" name="project_type" :value="$project?->project_type" />
    </div>
    <x-ui.textarea label="Problem" name="problem" :value="$project?->problem" rows="4" />
    <x-ui.textarea label="Solution" name="solution" :value="$project?->solution" rows="4" />
    <x-ui.textarea label="Features (one per line)" name="features" :value="$featureText" rows="4" />
    <x-ui.textarea label="Technologies (one per line)" name="technologies" :value="$techText" rows="4" />
    <x-ui.textarea label="Results (verified only)" name="results" :value="$project?->results" rows="3" />
    <x-ui.input label="Project URL" name="project_url" type="url" :value="$project?->project_url" />
    <x-ui.input label="Completed at" name="completed_at" type="date" :value="optional($project?->completed_at)->format('Y-m-d')" />
    <div>
        <label class="mb-1.5 block text-sm font-medium">Cover image</label>
        <input type="file" name="cover_image" accept="image/*" class="block w-full text-sm">
    </div>
    <x-ui.input label="Sort order" name="sort_order" type="number" :value="$project?->sort_order ?? 0" />
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project?->is_featured ?? false))> Featured</label>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project?->is_published ?? false))> Published</label>
    <div class="flex items-center gap-3">
        <x-ui.button type="submit">{{ $project ? 'Update project' : 'Create project' }}</x-ui.button>
        @if ($project)
            <button form="delete-portfolio" type="submit" class="text-sm text-red-600" onclick="return confirm('Delete this project?')">Delete</button>
        @endif
    </div>
</form>
@if ($project)
<form id="delete-portfolio" method="POST" action="{{ route('admin.portfolio.destroy', $project) }}" class="hidden">@csrf @method('DELETE')</form>
@endif
