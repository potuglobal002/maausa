<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialController extends Controller
{
    private array $fields = ['social_facebook'=>'Facebook','social_instagram'=>'Instagram','social_youtube'=>'YouTube','social_linkedin'=>'LinkedIn','social_x'=>'X / Twitter','social_tiktok'=>'TikTok','social_whatsapp'=>'WhatsApp'];

    public function edit(): View
    {
        $values = Setting::query()->get()->mapWithKeys(fn (Setting $setting) => [$setting->key=>$setting->value]);
        return view('admin.social.edit', ['fields'=>$this->fields,'values'=>$values]);
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = collect($this->fields)->mapWithKeys(fn ($label,$key)=>[$key=>['nullable','url','max:1000']])->all();
        foreach ($request->validate($rules) as $key=>$value) Setting::query()->updateOrCreate(['key'=>$key], ['value'=>$value ?? '']);
        return back()->with('success', 'Social media links updated. Active links now appear in the website footer.');
    }
}
