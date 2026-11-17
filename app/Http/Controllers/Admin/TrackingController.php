<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function edit(): View
    {
        $values = Setting::query()->get()->mapWithKeys(fn (Setting $setting) => [$setting->key=>$setting->value]);
        return view('admin.tracking.edit', compact('values'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tracking_enabled'=>['required','boolean'],
            'meta_pixel_id'=>['nullable','regex:/^[0-9]{5,30}$/'],
            'ga4_measurement_id'=>['nullable','regex:/^G-[A-Z0-9]{4,20}$/i'],
            'gtm_container_id'=>['nullable','regex:/^GTM-[A-Z0-9]{4,20}$/i'],
            'google_site_verification'=>['nullable','string','max:255'],
        ]);
        foreach ($data as $key=>$value) {
            if (is_string($value)) $value = in_array($key, ['ga4_measurement_id','gtm_container_id'], true) ? strtoupper(trim($value)) : trim($value);
            Setting::query()->updateOrCreate(['key'=>$key], ['value'=>$value]);
        }
        return back()->with('success', 'Analytics and tracking settings updated.');
    }
}
