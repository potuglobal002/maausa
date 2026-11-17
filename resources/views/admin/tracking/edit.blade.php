@extends('layouts.admin')
@section('title', 'Analytics & Tracking | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">@include('admin.partials.sidebar')<main class="admin-main">@include('admin.partials.topbar')<div class="admin-content">
<div class="module-heading"><div><p class="eyebrow">Measurement</p><h1>Analytics & tracking</h1><p>Connect Meta Pixel, Google Analytics 4, Google Tag Manager and Search Console verification.</p></div></div>
@include('admin.partials.flash')
<form class="cms-form" method="POST" action="{{ route('admin.tracking.update') }}">@csrf @method('PUT')
<section class="cms-card"><div class="cms-grid"><label class="toggle-card cms-full"><input type="hidden" name="tracking_enabled" value="0"><input type="checkbox" name="tracking_enabled" value="1" @checked(old('tracking_enabled',$values->get('tracking_enabled',false)))><span><strong>Enable tracking scripts</strong><small>Scripts are added to public pages only when this is enabled.</small></span></label>
<label><span>Meta Pixel ID</span><input name="meta_pixel_id" value="{{ old('meta_pixel_id',$values->get('meta_pixel_id')) }}" placeholder="123456789012345">@error('meta_pixel_id')<small class="field-error">{{ $message }}</small>@enderror</label>
<label><span>GA4 Measurement ID</span><input name="ga4_measurement_id" value="{{ old('ga4_measurement_id',$values->get('ga4_measurement_id')) }}" placeholder="G-XXXXXXXXXX">@error('ga4_measurement_id')<small class="field-error">{{ $message }}</small>@enderror</label>
<label><span>Google Tag Manager container</span><input name="gtm_container_id" value="{{ old('gtm_container_id',$values->get('gtm_container_id')) }}" placeholder="GTM-XXXXXXX">@error('gtm_container_id')<small class="field-error">{{ $message }}</small>@enderror</label>
<label><span>Google site verification token</span><input name="google_site_verification" value="{{ old('google_site_verification',$values->get('google_site_verification')) }}"></label></div></section>
<aside class="admin-recommendation"><strong>Recommended setup</strong><p>Use Google Tag Manager as the primary container, then manage GA4 and other marketing tags inside GTM. If GA4 is already configured in GTM, leave the direct GA4 field empty to avoid duplicate page views. Add a consent banner before enabling advertising cookies in production.</p></aside>
<div class="cms-save"><span>Only validated IDs are accepted; arbitrary scripts cannot be injected.</span><button class="module-action" type="submit">Save tracking settings</button></div></form>
</div></main></div>
@endsection
