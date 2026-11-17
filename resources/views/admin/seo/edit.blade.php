@extends('layouts.admin')
@section('title', 'SEO | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">@include('admin.partials.sidebar')<main class="admin-main">@include('admin.partials.topbar')<div class="admin-content">
<div class="module-heading"><div><p class="eyebrow">Search visibility</p><h1>SEO</h1><p>Set website-wide metadata and social sharing defaults. Page-specific SEO remains available inside each page editor.</p></div></div>
@include('admin.partials.flash')
<form class="cms-form" method="POST" action="{{ route('admin.seo.update') }}">@csrf @method('PUT')
<section class="cms-card"><h2>Search engine defaults</h2><div class="cms-grid">@foreach($fields as $key=>$label)<label class="{{ in_array($key,['seo_default_description','seo_og_description']) ? 'cms-full' : '' }}"><span>{{ $label }}</span>@if(in_array($key,['seo_default_description','seo_og_description']))<textarea name="{{ $key }}" rows="4">{{ old($key,$values->get($key)) }}</textarea>@else<input name="{{ $key }}" value="{{ old($key,$values->get($key)) }}">@endif @error($key)<small class="field-error">{{ $message }}</small>@enderror</label>@endforeach
<label class="toggle-card cms-full"><input type="hidden" name="seo_indexing" value="0"><input type="checkbox" name="seo_indexing" value="1" @checked(old('seo_indexing',$values->get('seo_indexing',true)))><span><strong>Allow search engine indexing</strong><small>Keep this enabled on production. Disable it on staging websites.</small></span></label></div></section>
<div class="cms-save"><span>Recommended title length: 50–60 characters; description: 140–160.</span><button class="module-action" type="submit">Save SEO settings</button></div></form>
</div></main></div>
@endsection
