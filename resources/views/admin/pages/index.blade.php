@extends('layouts.admin')
@section('title', 'Pages | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false }">@include('admin.partials.sidebar')<main class="admin-main">@include('admin.partials.topbar')
<div class="admin-content"><div class="module-heading"><div><p class="eyebrow">Content management</p><h1>Website pages</h1><p>Edit the landing page and every inner page from one place.</p></div></div>
@if(session('success'))<div class="admin-success">{{ session('success') }}</div>@endif
<div class="cms-table"><div class="cms-table-row cms-table-head"><span>Page</span><span>URL</span><span>Status</span><span>Action</span></div>
@foreach($pages as $page)<div class="cms-table-row"><div><strong>{{ $page->title }}</strong><small>Updated {{ $page->updated_at->diffForHumans() }}</small></div><code>/{{ $page->slug === 'home' ? '' : $page->slug }}</code><span class="status-pill {{ $page->status }}">{{ ucfirst($page->status) }}</span><a class="text-action" href="{{ route('admin.pages.edit',$page) }}">Edit content →</a></div>@endforeach</div>
</div></main></div>
@endsection
