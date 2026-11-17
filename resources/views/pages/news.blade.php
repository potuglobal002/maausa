@extends('layouts.public')
@section('title', 'News & PR | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']])

<section class="news-page" x-data="{ category: 'All' }">
    <div class="container news-shell">
        @if($featuredPost)
        <article class="news-feature">
            <a class="news-feature-image" href="{{ route('news.show',$featuredPost) }}">@if($featuredPost->featured_image)<img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->image_alt ?: $featuredPost->title }}">@else<span class="material-symbols-outlined">newspaper</span>@endif<span>Featured story</span></a>
            <div class="news-feature-copy"><p class="news-meta"><span>{{ $featuredPost->category }}</span><time datetime="{{ $featuredPost->published_at?->toDateString() }}">{{ $featuredPost->published_at?->format('F j, Y') }}</time></p><h2><a href="{{ route('news.show',$featuredPost) }}">{{ $featuredPost->title }}</a></h2><p>{{ $featuredPost->excerpt }}</p><a class="news-read" href="{{ route('news.show',$featuredPost) }}">Read the story <span class="material-symbols-outlined">arrow_forward</span></a></div>
        </article>
        @endif

        <header class="news-index-heading"><div><p class="eyebrow">Latest from MAA</p><h2>News, stories<br>and perspectives.</h2></div><div class="news-filters"><button :class="{'active':category==='All'}" x-on:click="category='All'">All</button>@foreach($categories as $category)<button :class="{'active':category===@js($category)}" x-on:click="category=@js($category)">{{ $category }}</button>@endforeach</div></header>

        <div class="news-grid">
            @forelse($posts as $post)
            <article class="news-card" x-show="category === 'All' || category === @js($post->category)" x-transition.opacity>
                <a class="news-card-image" href="{{ route('news.show',$post) }}">@if($post->featured_image)<img src="{{ $post->featured_image }}" alt="{{ $post->image_alt ?: $post->title }}" loading="lazy">@else<span class="material-symbols-outlined">newspaper</span>@endif</a>
                <div class="news-card-copy"><p class="news-meta"><span>{{ $post->category }}</span><time>{{ $post->published_at?->format('M j, Y') }}</time></p><h3><a href="{{ route('news.show',$post) }}">{{ $post->title }}</a></h3><p>{{ $post->excerpt }}</p><a class="news-read" href="{{ route('news.show',$post) }}" aria-label="Read {{ $post->title }}">Read more <span class="material-symbols-outlined">north_east</span></a></div>
            </article>
            @empty
                @if(!$featuredPost)<div class="news-empty"><span class="material-symbols-outlined">newspaper</span><h2>MAA updates are coming soon.</h2><p>News, program announcements and media stories will be published here.</p></div>@endif
            @endforelse
        </div>

        <aside class="press-cta"><div><p class="eyebrow">Media & partnerships</p><h2>{{ $content['press_title'] ?? 'Connect with MAA.' }}</h2><p>{{ $content['press_text'] ?? 'For interviews, program information and partnership inquiries, contact the MAA team.' }}</p></div><a class="button button--light" href="{{ route('contact') }}">Contact our team <span class="material-symbols-outlined">arrow_forward</span></a></aside>
    </div>
</section>
@endsection
