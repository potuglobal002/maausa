<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingsController extends Controller
{
    private array $fields = [
        'site_name'=>'Organization name', 'tagline'=>'Tagline', 'email'=>'Public email', 'phone'=>'Public phone',
        'phone_link'=>'Phone link (international format)', 'address'=>'Address', 'footer_description'=>'Footer description',
        'copyright_text'=>'Copyright text', 'default_language'=>'Default language', 'timezone'=>'Website timezone',
    ];

    public function edit(): View
    {
        $values = Setting::query()->get()->mapWithKeys(fn (Setting $setting) => [$setting->key=>$setting->value]);
        return view('admin.settings.edit', ['fields'=>$this->fields,'values'=>$values]);
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = collect($this->fields)->mapWithKeys(fn ($label, $key) => [$key=>['nullable','string','max:2000']])->all();
        $rules['logo'] = ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'];
        $rules['favicon'] = ['nullable', 'file', 'mimes:png,ico,svg', 'max:1024'];
        $data = $request->validate($rules);
        foreach (array_intersect_key($data, $this->fields) as $key => $value) Setting::query()->updateOrCreate(['key'=>$key], ['value'=>$value ?? '']);

        foreach (['logo'=>'logo_path', 'favicon'=>'favicon_path'] as $upload => $key) {
            if (! $request->hasFile($upload)) continue;
            $old = Setting::query()->where('key', $key)->first()?->value;
            if (is_string($old) && str_starts_with($old, '/uploads/branding/')) File::delete(public_path(ltrim($old, '/')));
            $directory = public_path('uploads/branding');
            File::ensureDirectoryExists($directory);
            $filename = Str::uuid().'.'.strtolower($request->file($upload)->getClientOriginalExtension());
            $request->file($upload)->move($directory, $filename);
            Setting::query()->updateOrCreate(['key'=>$key], ['value'=>'/uploads/branding/'.$filename]);
        }
        return back()->with('success', 'Site settings updated.');
    }
}
