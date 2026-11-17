@extends('layouts.public')
@section('title', 'Video Gallery | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']])

<section class="section video-page" x-data="videoModal" x-on:keydown.escape.window="close()">
    <div class="container">
        <div class="video-grid">
            @foreach($collections as $collection)
            <article class="video-card">
                <div class="video-poster">
                    <img src="{{ $collection['image'] }}" alt="{{ $collection['title'] }}" loading="lazy">
                    <button type="button" x-on:click="play(@js($collection['url']), @js($collection['title']))" aria-label="Play {{ $collection['title'] }}"><span class="material-symbols-outlined">play_arrow</span></button>
                </div>
                <h2>{{ $collection['title'] }}</h2>
            </article>
            @endforeach
        </div>
    </div>

    <template x-teleport="body">
        <div class="video-modal" x-show="open" x-transition.opacity x-cloak x-on:click.self="close()" role="dialog" aria-modal="true" :aria-label="title">
            <div class="video-modal-panel" x-show="open" x-transition.scale.origin.center>
                <div class="video-modal-head"><div><span>MAA video</span><h2 x-text="title"></h2></div><button type="button" x-on:click="close()" aria-label="Close video"><span class="material-symbols-outlined">close</span></button></div>
                <div class="video-modal-player">
                    <template x-if="type === 'video'"><video :src="url" controls autoplay playsinline></video></template>
                    <template x-if="type === 'iframe'"><iframe :src="url" :title="title" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe></template>
                </div>
            </div>
        </div>
    </template>
</section>
@endsection
