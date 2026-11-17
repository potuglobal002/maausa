@extends('layouts.admin')
@section('title', 'Social Media | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">@include('admin.partials.sidebar')<main class="admin-main">@include('admin.partials.topbar')<div class="admin-content">
<div class="module-heading"><div><p class="eyebrow">Community channels</p><h1>Social media</h1><p>Add official MAA profiles. Completed links automatically appear in the public footer.</p></div></div>
@include('admin.partials.flash')
<form class="cms-form" method="POST" action="{{ route('admin.social.update') }}">@csrf @method('PUT')<section class="cms-card"><div class="cms-grid">@foreach($fields as $key=>$label)<label><span>{{ $label }} URL</span><input type="url" name="{{ $key }}" value="{{ old($key,$values->get($key)) }}" placeholder="https://">@error($key)<small class="field-error">{{ $message }}</small>@enderror</label>@endforeach</div></section>
<div class="cms-save"><span>Leave a field empty to hide that platform.</span><button class="module-action" type="submit">Save social links</button></div></form>
</div></main></div>
@endsection
