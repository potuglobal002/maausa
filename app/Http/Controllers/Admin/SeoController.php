<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoController extends Controller
{
    private array $fields = [
        'seo_default_title'=>'Default meta title', 'seo_default_description'=>'Default meta description',
        'seo_keywords'=>'Default keywords', 'seo_og_title'=>'Default social sharing title',
        'seo_og_description'=>'Default social sharing description', 'seo_og_image'=>'Social sharing image URL',
        'seo_twitter_handle'=>'X / Twitter handle', 'seo_canonical_base'=>'Canonical website URL',
    ];

    public function edit(): View
    {
        return view('admin.seo.edit', ['fields'=>$this->fields, 'values'=>$this->values()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = collect($this->fields)->mapWithKeys(fn ($label, $key) => [$key=>['nullable','string','max:2000']])->all();
        $rules['seo_canonical_base'] = ['nullable','url','max:500'];
        $rules['seo_og_image'] = ['nullable','url','max:1000'];
        $rules['seo_indexing'] = ['required','boolean'];
        foreach ($request->validate($rules) as $key=>$value) Setting::query()->updateOrCreate(['key'=>$key], ['value'=>$value ?? '']);
        return back()->with('success', 'SEO defaults updated. Individual pages can still override title and description.');
    }

    private function values() { return Setting::query()->get()->mapWithKeys(fn (Setting $setting) => [$setting->key=>$setting->value]); }
}
