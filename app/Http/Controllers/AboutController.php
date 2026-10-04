<?php

namespace App\Http\Controllers;

use App\Services\SiteSettings;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(SiteSettings $settings): View
    {
        return view('about', [
            'settings' => $settings->all(),
        ]);
    }
}
