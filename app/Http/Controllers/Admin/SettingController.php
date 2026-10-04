<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Services\ActivityLogger;
use App\Services\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(SiteSettings $settings): View
    {
        return view('admin.settings.edit', [
            'settings' => $settings->all(),
        ]);
    }

    public function update(UpdateSettingsRequest $request, SiteSettings $settings, ActivityLogger $logger): RedirectResponse
    {
        $settings->setMany($request->validated(), 'general');
        $logger->log('updated settings');

        return back()->with('success', 'Settings updated successfully.');
    }
}
