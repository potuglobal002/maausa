@extends('layouts.public')
@section('title', ($page->seo_title ?: $page->title).' | MAA')

@section('page-content')
@include('pages.partials.page-hero', [
    'eyebrow' => $content['hero_eyebrow'] ?? 'Our services',
    'title' => $content['hero_title'] ?? 'Guidance for every chapter.',
    'description' => $content['hero_description'] ?? '',
])

<section class="section services-page">
    <div class="container">
        <div class="services-page-intro">
            <div>
                <p class="eyebrow">{{ $content['programs_label'] ?? 'How we help' }}</p>
                <h2>{{ $content['programs_title'] ?? 'Practical support for families.' }}</h2>
            </div>
            @if(!empty($content['programs_intro']))<p>{{ $content['programs_intro'] }}</p>@endif
        </div>

        <div class="services-page-grid">
            @foreach($programs as $program)
                <article class="service-card">
                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div><h3>{{ $program['title'] }}</h3><p>{{ $program['description'] }}</p></div>
                    <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                </article>
            @endforeach
        </div>

        <aside class="services-contact-panel">
            <div><p class="eyebrow">Need guidance?</p><h2>Start with a conversation.</h2></div>
            <a class="button button--light button--large" href="{{ route('contact') }}">Contact MAA <span class="material-symbols-outlined">arrow_forward</span></a>
        </aside>
    </div>
</section>
@endsection
