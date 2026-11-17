@extends('layouts.admin')
@section('title', 'Site Settings | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">@include('admin.partials.sidebar')<main class="admin-main">@include('admin.partials.topbar')
<div class="admin-content"><div class="module-heading"><div><p class="eyebrow">Global configuration</p><h1>Site settings</h1><p>Manage branding, public contact information and organization-wide details.</p></div></div>
@include('admin.partials.flash')
<form class="cms-form" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">@csrf @method('PUT')
<section class="cms-card"><h2>Brand identity</h2><div class="branding-editor"><div class="brand-preview"><span>Current logo</span><img src="{{ asset(ltrim($values->get('logo_path','/images/maa-logo.png'),'/')) }}" alt="Current MAA logo"></div><div class="cms-grid"><label><span>Upload logo</span><input type="file" name="logo" accept=".png,.jpg,.jpeg,.webp,.svg"><small>Transparent PNG, SVG or WebP. Maximum 4 MB.</small></label><label><span>Upload favicon</span><input type="file" name="favicon" accept=".png,.ico,.svg"><small>Square PNG, ICO or SVG. Maximum 1 MB.</small></label></div></div></section>
<section class="cms-card"><h2>Organization details</h2><div class="cms-grid">@foreach($fields as $key=>$label)<label class="{{ in_array($key,['address','footer_description']) ? 'cms-full' : '' }}"><span>{{ $label }}</span>@if(in_array($key,['address','footer_description']))<textarea name="{{ $key }}" rows="4">{{ old($key,$values->get($key)) }}</textarea>@else<input name="{{ $key }}" value="{{ old($key,$values->get($key)) }}">@endif @error($key)<small class="field-error">{{ $message }}</small>@enderror</label>@endforeach</div></section>
<div class="cms-save"><span>These values are shared throughout the website.</span><button class="module-action" type="submit">Save site settings</button></div></form>
</div></main></div>
@endsection
