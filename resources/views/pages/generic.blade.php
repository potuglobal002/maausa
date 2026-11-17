@extends('layouts.public')
@section('title', ($page->seo_title ?: $page->title).' | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'] ?? '', 'title' => $content['hero_title'] ?? $page->title, 'description' => $content['hero_description'] ?? ''])
<section class="section generic-page"><div class="container"><p class="eyebrow">{{ $page->title }}</p><h2>{{ $content['content_title'] ?? $page->title }}</h2><div class="rich-content">{!! $content['content_body'] ?? '' !!}</div></div></section>
@endsection
