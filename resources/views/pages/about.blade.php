@extends('layouts.public')
@section('title', 'Who We Are | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description'], 'heroClass' => 'inner-hero--about'])

@php
    $founderParagraphs = collect(!empty($content['founder_paragraphs']) && is_array($content['founder_paragraphs'])
        ? $content['founder_paragraphs']
        : collect(range(1, 4))->map(fn($paragraph) => $content['founder_intro_'.$paragraph] ?? null)->all())
        ->filter()->values();
    $founderLead = $founderParagraphs->shift();
@endphp
<section class="section founder-section">
    <div class="container founder-shell">
        <div class="founder-feature">
            <div class="founder-portrait">
                <figure><img src="{{ $content['founder_image'] }}" alt="{{ $content['founder_name'] }}, founder of MAA"></figure>
            </div>
            <div class="founder-profile">
                <div class="founder-heading"><p class="eyebrow">Our founder</p><span aria-hidden="true"></span></div>
                <h2>Turning a personal journey into shared support.</h2>
                <div class="founder-identity">
                    <div><h3>{{ $content['founder_name'] }}</h3>@if(!empty($content['founder_credentials']))<p class="founder-credentials">{{ $content['founder_credentials'] }}</p>@endif</div>
                    @if(!empty($content['founder_role']))<p class="founder-role">{{ $content['founder_role'] }}</p>@endif
                </div>
                @if($founderLead)<p class="founder-lead">{{ $founderLead }}</p>@endif
                @if($founderParagraphs->isNotEmpty())
                    <div class="founder-narrative" aria-label="Founder biography" x-data="{ expanded: false }">
                        @foreach($founderParagraphs as $paragraph)
                            <p @if($loop->iteration > 2) x-show="expanded" x-cloak x-transition.opacity @endif>{{ $paragraph }}</p>
                        @endforeach
                        @if($founderParagraphs->count() > 2)
                            <button class="founder-story-toggle" type="button" x-on:click="expanded = !expanded" :aria-expanded="expanded.toString()"><span x-text="expanded ? 'Show less' : 'Read full story'">Read full story</span><span class="material-symbols-outlined" x-text="expanded ? 'arrow_upward' : 'arrow_downward'">arrow_downward</span></button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="impact-section" aria-labelledby="impact-title">
    <div class="container impact-shell">
        <div class="impact-intro">
            <p class="eyebrow eyebrow--light">{{ $content['stats_eyebrow'] ?? 'Our impact' }}</p>
            <h2 id="impact-title">{{ $content['stats_title'] ?? 'A growing village of support.' }}</h2>
            @if(!empty($content['stats_intro']))<p>{{ $content['stats_intro'] }}</p>@endif
        </div>
        <div class="impact-grid">
            @foreach(range(1, 4) as $stat)
                <article class="impact-stat">
                    <span class="impact-index">{{ str_pad((string) $stat, 2, '0', STR_PAD_LEFT) }}</span>
                    <p class="impact-number">
                        <strong x-data="animatedCounter({{ (int) ($content['stat_'.$stat.'_value'] ?? 0) }})" x-text="display">{{ $content['stat_'.$stat.'_value'] ?? 0 }}</strong><sup>{{ $content['stat_'.$stat.'_suffix'] ?? '+' }}</sup>
                    </p>
                    <h3>{{ $content['stat_'.$stat.'_label'] ?? '' }}</h3>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section story-section">
    <div class="container story-layout">
        <div><p class="eyebrow">Our story</p><h2>{{ $content['story_title'] }}</h2></div>
        <div class="story-copy">
            @foreach(range(1, 5) as $paragraph)
                @if(!empty($content['story_'.$paragraph]))<p>{{ $content['story_'.$paragraph] }}</p>@endif
            @endforeach
            <blockquote>{{ $content['quote'] }}</blockquote>
        </div>
    </div>
</section>

<section class="section values-section">
    <div class="container"><div class="section-title-row"><div><p class="eyebrow">What guides us</p><h2>Understanding, advocacy and belonging.</h2></div></div>
        <div class="value-grid">
            <article><span>01</span><h3>Our mission</h3><p>{{ $content['mission'] }}</p></article>
            <article><span>02</span><h3>Our vision</h3><p>{{ $content['vision'] }}</p></article>
            <article><span>03</span><h3>501(c)(3) Tax-Exempt</h3><p>{{ $content['nonprofit'] }}</p></article>
        </div>
    </div>
</section>
@endsection
