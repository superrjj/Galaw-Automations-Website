@extends('layouts.admin')
@section('title', 'Settings')
@section('heading', 'Website settings')
@section('subheading', 'Company details and SEO. API keys stay in .env.')
@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-3xl space-y-4 rounded-2xl border border-line bg-white p-6">
@csrf
@method('PUT')
<x-ui.input label="Company name" name="company_name" :value="$settings['company_name'] ?? ''" required />
<x-ui.input label="Tagline" name="tagline" :value="$settings['tagline'] ?? ''" />
<x-ui.input label="Company email" name="company_email" type="email" :value="$settings['company_email'] ?? ''" />
<x-ui.input label="Company phone" name="company_phone" :value="$settings['company_phone'] ?? ''" />
<x-ui.input label="Company address" name="company_address" :value="$settings['company_address'] ?? ''" />
<x-ui.input label="Admin notification email" name="admin_notification_email" type="email" :value="$settings['admin_notification_email'] ?? ''" />
<x-ui.input label="SEO title" name="seo_title" :value="$settings['seo_title'] ?? ''" />
<x-ui.textarea label="SEO description" name="seo_description" :value="$settings['seo_description'] ?? ''" rows="3" />
<x-ui.textarea label="About intro" name="about_intro" :value="$settings['about_intro'] ?? ''" rows="4" />
<x-ui.textarea label="Mission" name="mission" :value="$settings['mission'] ?? ''" rows="3" />
<x-ui.textarea label="Vision" name="vision" :value="$settings['vision'] ?? ''" rows="3" />
<x-ui.textarea label="Philosophy" name="philosophy" :value="$settings['philosophy'] ?? ''" rows="3" />
<x-ui.textarea label="Values (one per line)" name="values" :value="$settings['values'] ?? ''" rows="4" />
<x-ui.input label="Facebook URL" name="social_facebook" type="url" :value="$settings['social_facebook'] ?? ''" />
<x-ui.input label="LinkedIn URL" name="social_linkedin" type="url" :value="$settings['social_linkedin'] ?? ''" />
<x-ui.input label="GitHub URL" name="social_github" type="url" :value="$settings['social_github'] ?? ''" />
<x-ui.input label="X URL" name="social_x" type="url" :value="$settings['social_x'] ?? ''" />
<x-ui.button type="submit">Save settings</x-ui.button>
</form>
@endsection
