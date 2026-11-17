@extends('layouts.admin')
@section('title', 'Hero Carousel | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false, adding:false }">
    @include('admin.partials.sidebar')
    <main class="admin-main">
        @include('admin.partials.topbar')
        <div class="admin-content carousel-workspace">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Homepage experience</p><h1>Hero carousel</h1><p>Create a strong first impression with focused photography and concise storytelling.</p></div>
                <div class="heading-actions"><a class="secondary-action" href="{{ route('admin.pages.edit',$page) }}">Back to page</a><a class="secondary-action" target="_blank" href="{{ route('home') }}">Preview website <span class="material-symbols-outlined">open_in_new</span></a></div>
            </div>
            @include('admin.partials.flash')
            @if($errors->any())<div class="flash error"><strong>Please review the highlighted fields.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <div class="carousel-guidance">
                <span class="material-symbols-outlined">auto_awesome</span><div><strong>Editorial guidance</strong><p>Three to five slides works best. Use 1920 × 1080px images with clear space behind the copy, and keep headings to three short lines.</p></div>
                <button class="module-action" type="button" x-on:click="adding=!adding"><span class="material-symbols-outlined" x-text="adding ? 'close' : 'add'">add</span><span x-text="adding ? 'Close form' : 'Add slide'">Add slide</span></button>
            </div>

            <section class="cms-card new-slide-card" x-show="adding" x-transition x-cloak>
                <div class="editor-card-heading"><div><span class="material-symbols-outlined">add_photo_alternate</span><div><h2>Create a new slide</h2><p>Add its story, image and calls to action.</p></div></div></div>
                <form method="POST" action="{{ route('admin.hero-slides.store',$page) }}" enctype="multipart/form-data">@csrf
                    @include('admin.hero-slides.fields', ['slide'=>null, 'prefix'=>'new'])
                    <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">add</span> Add to carousel</button></div>
                </form>
            </section>

            <div class="slide-editor-list">
                @forelse($slides as $slide)
                <article class="cms-card slide-editor-card" x-data="{ editing:false }">
                    <div class="slide-card-summary">
                        <div class="slide-thumb" style="background-image:url('{{ $slide->image }}');background-position:{{ $slide->image_position }}"><span>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span></div>
                        <div class="slide-summary-copy"><div><span class="status-pill {{ $slide->is_active ? 'published' : 'draft' }}">{{ $slide->is_active ? 'Visible' : 'Hidden' }}</span><span class="slide-order">Order {{ $slide->sort_order }}</span></div><p>{{ $slide->eyebrow }}</p><h2>{{ Str::limit(str_replace("\n", ' / ', $slide->title), 90) }}</h2></div>
                        <button class="secondary-action" type="button" x-on:click="editing=!editing"><span class="material-symbols-outlined">edit</span><span x-text="editing ? 'Close' : 'Edit slide'">Edit slide</span></button>
                    </div>
                    <div class="slide-edit-panel" x-show="editing" x-transition x-cloak>
                        <form method="POST" action="{{ route('admin.hero-slides.update',[$page,$slide]) }}" enctype="multipart/form-data">@csrf @method('PUT')
                            @include('admin.hero-slides.fields', ['slide'=>$slide, 'prefix'=>'slide-'.$slide->id])
                            <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save slide</button></div>
                        </form>
                        <form class="delete-slide-form" method="POST" action="{{ route('admin.hero-slides.destroy',[$page,$slide]) }}" onsubmit="return confirm('Remove this slide permanently?')">@csrf @method('DELETE')<button type="submit"><span class="material-symbols-outlined">delete</span> Remove slide</button></form>
                    </div>
                </article>
                @empty
                <div class="cms-card empty-carousel"><span class="material-symbols-outlined">view_carousel</span><h2>No carousel slides yet</h2><p>Add the first slide to replace the fallback homepage hero.</p></div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection
