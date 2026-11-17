@extends('layouts.public')
@section('title', ($post->seo_title ?: $post->title).' | MAA')
@section('meta_title', $post->seo_title ?: $post->title.' | MAA')
@section('meta_description', $post->seo_description ?: $post->excerpt)
@section('og_image', $post->featured_image ?: '')
@section('og_type', 'article')

@section('page-content')
<article class="article-page">
    <header class="article-hero"><div class="container"><a class="article-back" href="{{ route('news') }}"><span class="material-symbols-outlined">arrow_back</span> News & PR</a><p class="news-meta"><span>{{ $post->category }}</span><time>{{ $post->published_at?->format('F j, Y') }}</time></p><h1>{{ $post->title }}</h1><p>{{ $post->excerpt }}</p></div></header>
    @if($post->featured_image)<figure class="article-cover container"><img src="{{ $post->featured_image }}" alt="{{ $post->image_alt ?: $post->title }}"></figure>@endif
    <div class="container article-layout"><div class="article-share"><span>Share</span><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener">Facebook</a><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener">LinkedIn</a></div><div class="article-body">{!! $post->body !!}<div class="article-author"><span>Published by</span><strong>{{ $post->author ?: 'MAA' }}</strong></div></div></div>
</article>
@if($relatedPosts->isNotEmpty())<section class="related-news"><div class="container"><header><p class="eyebrow">Continue reading</p><h2>Related stories</h2></header><div class="news-grid">@foreach($relatedPosts as $related)<article class="news-card"><a class="news-card-image" href="{{ route('news.show',$related) }}"><img src="{{ $related->featured_image }}" alt="{{ $related->image_alt ?: $related->title }}"></a><div class="news-card-copy"><p class="news-meta"><span>{{ $related->category }}</span><time>{{ $related->published_at?->format('M j, Y') }}</time></p><h3><a href="{{ route('news.show',$related) }}">{{ $related->title }}</a></h3></div></article>@endforeach</div></div></section>@endif
@endsection
