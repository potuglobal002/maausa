@php $innerHeroImage=$content['hero_image'] ?? ''; $innerHeroPosition=$content['hero_image_position'] ?? 'center center'; @endphp
<section class="inner-hero {{ $innerHeroImage ? 'inner-hero--image' : '' }} {{ $heroClass ?? '' }}">
    @if($innerHeroImage)<div class="inner-hero-media" style="background-image:url('{{ $innerHeroImage }}');background-position:{{ $innerHeroPosition }}"></div>@endif
    <div class="inner-hero-overlay"></div><div class="inner-hero-art"></div>
    <div class="container">
        <div class="hero-kicker"><span></span><p class="eyebrow eyebrow--light">{{ $eyebrow }}</p></div>
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
    </div>
</section>
