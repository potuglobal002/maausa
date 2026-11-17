@extends('layouts.public')
@section('title', 'Gallery | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']])

<section class="gallery-page" x-data="galleryExperience(@js($images->map(fn($item) => ['image'=>$item->image,'alt'=>$item->alt_text ?: $item->title,'title'=>$item->title,'caption'=>$item->caption,'category'=>$item->category])->values()))">
    <div class="container gallery-shell">
        <header class="gallery-heading">
            <div><p class="eyebrow">Community in focus</p><h2>Real moments.<br><span>Shared purpose.</span></h2></div>
            <p>Explore photographs from MAA programs, celebrations, advocacy initiatives and the families who make our community stronger.</p>
        </header>

        @if($images->isNotEmpty())
        <div class="gallery-toolbar">
            <div class="gallery-filters" aria-label="Filter gallery"><button type="button" :class="{ 'active': filter === 'All' }" x-on:click="filter='All'">All</button>@foreach($categories as $category)<button type="button" :class="{ 'active': filter === @js($category) }" x-on:click="filter=@js($category)">{{ $category }}</button>@endforeach</div>
            <span>{{ $images->count() }} photographs</span>
        </div>

        <div class="editorial-gallery">
            @foreach($images as $image)
            <article class="gallery-tile gallery-tile--{{ ($loop->index % 7) + 1 }}" x-show="filter === 'All' || filter === @js($image->category)" x-transition.opacity>
                <button type="button" x-on:click="open({{ $loop->index }})" aria-label="View {{ $image->title ?: 'gallery photograph' }}">
                    <img src="{{ $image->image }}" alt="{{ $image->alt_text ?: $image->title ?: 'MAA community photograph' }}" loading="lazy">
                    <span class="gallery-tile-overlay"><span><small>{{ $image->category }}</small>@if($image->title)<strong>{{ $image->title }}</strong>@endif</span><i class="material-symbols-outlined">open_in_full</i></span>
                </button>
            </article>
            @endforeach
        </div>
        @else
        <div class="gallery-empty"><span class="material-symbols-outlined">photo_library</span><h2>New photographs are coming soon.</h2><p>MAA is preparing moments from recent programs and community gatherings.</p></div>
        @endif
    </div>

    <div class="gallery-lightbox" x-show="selected !== null" x-cloak x-on:click.self="close()" x-on:keydown.escape.window="close()" role="dialog" aria-modal="true" aria-label="Gallery photograph viewer">
        <button class="gallery-lightbox-close" type="button" x-on:click="close()" aria-label="Close image"><span class="material-symbols-outlined">close</span></button>
        <button class="gallery-lightbox-nav previous" type="button" x-on:click="previous()" aria-label="Previous image"><span class="material-symbols-outlined">arrow_back</span></button>
        <figure><img :src="current()?.image" :alt="current()?.alt || ''"><figcaption><small x-text="current()?.category"></small><strong x-text="current()?.title"></strong><p x-show="current()?.caption" x-text="current()?.caption"></p></figcaption></figure>
        <button class="gallery-lightbox-nav next" type="button" x-on:click="next()" aria-label="Next image"><span class="material-symbols-outlined">arrow_forward</span></button>
    </div>
</section>
@endsection
