@extends('layouts.app')

@section('content')
@php
    $heroPosition=$content['hero_image_position'] ?? 'center center';
    $primaryLabel=$content['hero_primary_label'] ?? 'Contact MAA'; $primaryUrl=$content['hero_primary_url'] ?? route('contact');
    $secondaryLabel=$content['hero_secondary_label'] ?? 'Discover MAA'; $secondaryUrl=$content['hero_secondary_url'] ?? '#purpose';
@endphp
<div x-data="siteHeader" x-on:scroll.window="scrolled = window.scrollY > 20">
    <header class="site-header" :class="{ 'site-header--solid': scrolled || open }">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="MAA home">
                <img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}">
            </a>
            <nav class="desktop-nav" aria-label="Primary navigation">
                @foreach($mainNavigation as $item)<a href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}</a>@endforeach
            </nav>
            <div class="header-actions">
                <a class="button button--ghost" href="{{ route('donate') }}">Donate</a>
                <button class="menu-button" type="button" x-on:click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" aria-label="Toggle navigation"><span></span><span></span></button>
            </div>
        </div>
        <nav id="mobile-menu" class="mobile-nav" x-show="open" x-transition x-cloak>
            @foreach($mainNavigation as $item)<a href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}</a>@endforeach<a href="{{ route('donate') }}">Donate</a>
            @if($socialLinks->isNotEmpty())<div class="mobile-nav-social"><span>Follow MAA</span>@include('pages.partials.social-icons')</div>@endif
        </nav>
    </header>

    <main id="main-content">
        <section id="top" class="hero hero-carousel" x-data="heroCarousel({{ $heroSlides->count() }})" x-on:focusin="pause()" x-on:focusout="resume()" x-on:keydown.right.window="next()" x-on:keydown.left.window="previous()" x-on:touchstart.passive="touchStart=$event.changedTouches[0].clientX" x-on:touchend.passive="swipe($event.changedTouches[0].clientX)">
            @foreach($heroSlides as $slide)
            <article class="hero-slide" x-show="current === {{ $loop->index }}" x-transition:enter="hero-enter" x-transition:enter-start="hero-enter-start" x-transition:enter-end="hero-enter-end" x-transition:leave="hero-leave" x-transition:leave-start="hero-leave-start" x-transition:leave-end="hero-leave-end" @if(!$loop->first) x-cloak @endif>
                <div class="hero-slide-media" style="background-image:url('{{ $slide['image'] }}');background-position:{{ $slide['image_position'] }}" role="img" aria-label="{{ $slide['eyebrow'] ?: 'MAA community' }}"></div>
                <div class="hero-slide-shade"></div>
                <div class="container hero-slide-content">
                    <div class="hero-slide-copy">
                        @if($slide['eyebrow'])<p class="hero-slide-kicker"><span></span>{{ $slide['eyebrow'] }}</p>@endif
                        @if($loop->first)<h1 class="hero-slide-title {{ mb_strlen($slide['title']) > 52 ? 'hero-slide-title--compact' : '' }}">@else<h2 class="hero-slide-title {{ mb_strlen($slide['title']) > 52 ? 'hero-slide-title--compact' : '' }}">@endif
                            @foreach(preg_split('/\r\n|\r|\n/', $slide['title']) as $line)<span>{{ $line }}</span>@endforeach
                        @if($loop->first)</h1>@else</h2>@endif
                        @if($slide['description'])<p class="hero-slide-description">{{ $slide['description'] }}</p>@endif
                        <div class="hero-slide-actions">
                            @if($slide['primary_label'] && $slide['primary_url'])<a class="button button--light button--large" href="{{ $slide['primary_url'] }}">{{ $slide['primary_label'] }} <span class="material-symbols-outlined">arrow_forward</span></a>@endif
                            @if($slide['secondary_label'] && $slide['secondary_url'])<a class="hero-text-action" href="{{ $slide['secondary_url'] }}">{{ $slide['secondary_label'] }} <span class="material-symbols-outlined">north_east</span></a>@endif
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
            <div class="container hero-carousel-controls" x-show="count > 1">
                <div class="hero-slide-count"><strong x-text="String(current + 1).padStart(2,'0')">01</strong><span></span><small>{{ str_pad($heroSlides->count(),2,'0',STR_PAD_LEFT) }}</small></div>
                <div class="hero-progress"><i :style="`width:${progress}%`"></i></div>
                <div class="hero-dots" role="tablist" aria-label="Choose hero slide">@foreach($heroSlides as $slide)<button type="button" :class="{ 'is-active': current === {{ $loop->index }} }" x-on:click="go({{ $loop->index }})" aria-label="Show slide {{ $loop->iteration }}"></button>@endforeach</div>
                <div class="hero-arrows"><button type="button" x-on:click="previous()" aria-label="Previous slide"><span class="material-symbols-outlined">arrow_back</span></button><button type="button" x-on:click="next()" aria-label="Next slide"><span class="material-symbols-outlined">arrow_forward</span></button></div>
            </div>
            <a class="hero-scroll" href="{{ $pathways->isNotEmpty() ? '#pathways' : '#purpose' }}"><span>Scroll to explore</span><i></i></a>
        </section>

        <section class="hero hero-static" aria-hidden="true">
            <div class="hero-image" role="img" aria-label="MAA community members gathering at an event" style="background-image:url('{{ $content['hero_image'] }}');background-position:{{ $heroPosition }}"></div>
            <div class="hero-overlay"></div><div class="hero-texture" aria-hidden="true"></div>
            <div class="container hero-content">
                <div class="hero-kicker"><span></span><p class="eyebrow eyebrow--light">{{ $content['hero_eyebrow'] }}</p></div>
                <div class="hero-heading-wrap"><span class="hero-section-number">01</span><h1>@foreach(preg_split('/\r\n|\r|\n/', $content['hero_title']) as $line)<span class="{{ $loop->last ? 'hero-title-accent' : '' }}">{{ $line }}</span>@endforeach</h1><span class="hero-heading-mark" aria-hidden="true"></span></div>
                <p class="hero-lead">{{ $content['hero_lead'] }}</p>
                <div class="hero-actions hero-actions--dynamic"><a class="button button--light button--large" href="{{ $primaryUrl }}">{{ $primaryLabel }} <span aria-hidden="true">→</span></a><a class="button button--glass button--large" href="{{ $secondaryUrl }}"><span class="play-icon">▶</span> {{ $secondaryLabel }}</a></div>
                {{-- Legacy support actions removed with the retired Get Support page.
                <div class="hero-actions hero-actions--legacy">
                    <a class="button button--light button--large" href="{{ route('get.support') }}">Find support <span>→</span></a>
                    <a class="button button--glass button--large" href="#purpose"><span class="play-icon">▶</span> Discover MAA</a>
                </div>
                --}}
                <div class="hero-values" aria-label="MAA values"><span>Advocacy</span><span>Guidance</span><span>Community</span></div>
            </div>
            <aside class="hero-photo-note"><span>Community-led support</span><strong>A village where every family belongs.</strong></aside>
            <a class="scroll-cue" href="{{ $pathways->isNotEmpty() ? '#pathways' : '#purpose' }}" aria-label="Explore the page"><span></span>Explore</a>
        </section>

        @if(false)
        <section id="pathways" class="pathways" aria-label="Ways MAA can help">
            <div class="container pathway-grid">
                <a href="{{ route('contact') }}" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                    <span><strong>Child & family support</strong><small>Guidance, resources and empathetic support for your family.</small></span><b>→</b>
                </a>
                <a href="#programs" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M12 22c4-2 7-6 7-11-4 0-7 2-7 6 0-4-3-6-7-6 0 5 3 9 7 11Zm0-11c-2-2-2-6 0-9 2 3 2 7 0 9Z"/></svg></span>
                    <span><strong>Mothers’ well-being</strong><small>Care, connection and tools to support your well-being.</small></span><b>→</b>
                </a>
                <a href="#community" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01"/></svg></span>
                    <span><strong>Community & events</strong><small>Gather, learn and grow with other mothers and families.</small></span><b>→</b>
                </a>
            </div>
        </section>
        @endif

        @if($pathways->isNotEmpty())
        <section id="pathways" class="pathways" aria-label="Ways MAA can help">
            <div class="container pathway-grid" style="--pathway-count:{{ min($pathways->count(), 4) }}">
                @foreach($pathways as $pathway)
                <a href="{{ $pathway->link_url }}" class="pathway-card">
                    <span class="icon-box"><span class="material-symbols-outlined">{{ $pathway->icon }}</span></span>
                    <span><strong>{{ $pathway->title }}</strong>@if($pathway->description)<small>{{ $pathway->description }}</small>@endif</span>
                    <span class="material-symbols-outlined pathway-arrow" aria-hidden="true">arrow_forward</span>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        <section id="purpose" class="section purpose-section">
            <div class="container">
                <div class="section-intro purpose-intro">
                    <div><p class="eyebrow">{{ $content['purpose_label'] }}</p><h2>{!! nl2br(e($content['purpose_title'])) !!}</h2></div>
                    <div class="intro-copy"><p>{{ $content['purpose_text'] }}</p><a class="text-link" href="{{ route('about') }}">Meet MAA <span>→</span></a></div>
                </div>
                <div class="purpose-media">
                    <figure><img src="{{ $content['purpose_image'] }}" alt="MAA community members at a public gathering"></figure>
                    <aside><span class="surface-number">01</span><h3>{{ $content['purpose_card_title'] }}</h3><p>{{ $content['purpose_card_text'] }}</p></aside>
                </div>
            </div>
        </section>

        <section id="programs" class="section programs-section">
            <div class="container programs-layout">
                <div class="programs-heading"><p class="eyebrow">{{ $content['programs_label'] }}</p><h2>{{ $content['programs_title'] }}</h2><a class="text-link" href="{{ route('programs') }}">View our programs <span>→</span></a></div>
                <div class="program-list" x-data="programAccordion">
                    @foreach($programs as $program)
                    <article class="program-item" :class="{ 'is-active': active === {{ $loop->index }} }">
                        <button type="button" x-on:click="toggle({{ $loop->index }})" :aria-expanded="active === {{ $loop->index }}">
                            <span class="program-number">0{{ $loop->iteration }}</span><strong>{{ $program['title'] }}</strong><span class="toggle-mark" x-text="active === {{ $loop->index }} ? '−' : '+'"></span>
                        </button>
                        <div class="program-description" x-show="active === {{ $loop->index }}"><p>{{ $program['description'] }}</p></div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="community" class="section community-section">
            <div class="container">
                <div class="section-title-row"><div><p class="eyebrow">{{ $content['community_label'] }}</p><h2>{{ $content['community_title'] }}</h2></div><a class="text-link" href="{{ route('gallery') }}">Explore our community <span>→</span></a></div>
                <div class="community-grid">
                    <article class="story-card story-card--wide"><img src="{{ $content['community_image_1'] }}" alt="MAA community members outdoors"><p class="card-label">{{ $content['community_card_1_label'] ?? 'Community' }}</p><h3>{{ $content['community_card_1_title'] ?? 'Moments that bring us together.' }}</h3><p>{{ $content['community_card_1_text'] ?? 'Space to connect, exchange experiences and celebrate every family.' }}</p></article>
                    <article class="story-card"><img src="{{ $content['community_image_2'] }}" alt="MAA community gathering"><p class="card-label">{{ $content['community_card_2_label'] ?? 'Conversations' }}</p><h3>{{ $content['community_card_2_title'] ?? 'Support starts with being heard.' }}</h3><p>{{ $content['community_card_2_text'] ?? 'Real discussions, shared experiences and practical support from mothers who understand.' }}</p></article>
                </div>
            </div>
        </section>

        {{-- The standalone Resources module has been retired.
        <section id="resources" class="section resources-section">
            <div class="container">
                <p class="eyebrow">{{ $content['resources_label'] }}</p><h2>{{ $content['resources_title'] }}</h2>
                <div class="resources-layout">
                    <a class="featured-resource" href="{{ route('resources') }}"><span class="resource-icon">⌑</span><span><small>Guidance</small><strong>Understanding your child’s IEP</strong><em>Explore resources →</em></span></a>
                    <div class="resource-links">
                        <a href="{{ route('resources') }}"><span class="mini-icon">▻</span><span><strong>Conversations on motherhood</strong><small>Watch real discussions on advocacy, well-being and family support.</small></span><b>→</b></a>
                        <a href="{{ route('get.support') }}"><span class="mini-icon">◉</span><span><strong>Connect with MAA</strong><small>Have a question or need guidance? We’re here to listen and help.</small></span><b>→</b></a>
                    </div>
                </div>
            </div>
        </section>
        --}}

        <section class="cta-section">
            <div class="container cta-grid"><h2>{!! nl2br(e($content['cta_title'])) !!}</h2><div><p>{{ $content['cta_text'] }}</p><div><a class="button button--light button--large" href="{{ route('contact') }}">Get involved <span class="material-symbols-outlined">arrow_forward</span></a><a class="button button--glass button--large" href="{{ route('donate') }}">Donate</a></div></div></div>
        </section>
    </main>

    @include('pages.partials.footer')
</div>
@endsection
