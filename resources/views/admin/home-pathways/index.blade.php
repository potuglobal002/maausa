@extends('layouts.admin')
@section('title', 'Homepage Pathways | MAA Administration')
@section('content')
<div class="admin-shell" x-data="{ navOpen:false, adding:false }">
    @include('admin.partials.sidebar')
    <main class="admin-main">
        @include('admin.partials.topbar')
        <div class="admin-content carousel-workspace">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Homepage navigation</p><h1>Support pathways</h1><p>Manage the quick-access cards displayed directly below the homepage hero.</p></div>
                <div class="heading-actions"><a class="secondary-action" href="{{ route('admin.pages.edit',$page) }}">Back to page</a><a class="secondary-action" target="_blank" href="{{ route('home') }}#pathways">Preview section <span class="material-symbols-outlined">open_in_new</span></a></div>
            </div>
            @include('admin.partials.flash')
            @if($errors->any())<div class="flash error"><strong>Please review the highlighted fields.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <div class="carousel-guidance">
                <span class="material-symbols-outlined">route</span><div><strong>Keep choices focused</strong><p>Three cards provide the clearest desktop layout. Every card can have its own icon, destination, display order and visibility.</p></div>
                <button class="module-action" type="button" x-on:click="adding=!adding"><span class="material-symbols-outlined" x-text="adding ? 'close' : 'add'">add</span><span x-text="adding ? 'Close form' : 'Add pathway'">Add pathway</span></button>
            </div>

            <section class="cms-card new-slide-card" x-show="adding" x-transition x-cloak>
                <div class="editor-card-heading"><div><span class="material-symbols-outlined">add_link</span><div><h2>Create a new pathway</h2><p>Add a focused entry point to an important page or homepage section.</p></div></div></div>
                <form method="POST" action="{{ route('admin.home-pathways.store',$page) }}">@csrf
                    @include('admin.home-pathways.fields', ['pathway'=>null])
                    <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">add</span> Add pathway</button></div>
                </form>
            </section>

            <div class="slide-editor-list">
                @forelse($pathways as $pathway)
                <article class="cms-card slide-editor-card" x-data="{ editing:false }">
                    <div class="slide-card-summary pathway-admin-summary">
                        <div class="pathway-admin-icon"><span class="material-symbols-outlined">{{ $pathway->icon }}</span><small>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</small></div>
                        <div class="slide-summary-copy"><div><span class="status-pill {{ $pathway->is_active ? 'published' : 'draft' }}">{{ $pathway->is_active ? 'Visible' : 'Hidden' }}</span><span class="slide-order">Order {{ $pathway->sort_order }}</span></div><h2>{{ $pathway->title }}</h2><p>{{ $pathway->description }}</p><small>{{ $pathway->link_url }}</small></div>
                        <button class="secondary-action" type="button" x-on:click="editing=!editing"><span class="material-symbols-outlined">edit</span><span x-text="editing ? 'Close' : 'Edit pathway'">Edit pathway</span></button>
                    </div>
                    <div class="slide-edit-panel" x-show="editing" x-transition x-cloak>
                        <form method="POST" action="{{ route('admin.home-pathways.update',[$page,$pathway]) }}">@csrf @method('PUT')
                            @include('admin.home-pathways.fields', ['pathway'=>$pathway])
                            <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save pathway</button></div>
                        </form>
                        <form class="delete-slide-form" method="POST" action="{{ route('admin.home-pathways.destroy',[$page,$pathway]) }}" onsubmit="return confirm('Remove this pathway permanently?')">@csrf @method('DELETE')<button type="submit"><span class="material-symbols-outlined">delete</span> Remove pathway</button></form>
                    </div>
                </article>
                @empty
                <div class="cms-card empty-carousel"><span class="material-symbols-outlined">route</span><h2>No pathways yet</h2><p>Add the first card to create the homepage quick-access section.</p></div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection
