<header class="site-header site-header--solid inner-header" x-data="{ open: false }">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="MAA home"><img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}"></a>
        <nav class="desktop-nav" aria-label="Primary navigation">
            @foreach($mainNavigation as $item)<a class="{{ request()->is(ltrim($item->url, '/')) ? 'current' : '' }}" href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}</a>@endforeach
        </nav>
        <div class="header-actions">
            <a class="button button--ghost" href="{{ route('donate') }}">Donate</a>
            <button class="menu-button" type="button" x-on:click="open = !open" :aria-expanded="open" aria-controls="inner-mobile-menu" aria-label="Toggle navigation"><span></span><span></span></button>
        </div>
    </div>
    <nav id="inner-mobile-menu" class="mobile-nav" x-show="open" x-transition x-cloak>
        @foreach($mainNavigation as $item)<a href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}</a>@endforeach<a href="{{ route('donate') }}">Donate</a>
        @if($socialLinks->isNotEmpty())<div class="mobile-nav-social"><span>Follow MAA</span>@include('pages.partials.social-icons')</div>@endif
    </nav>
</header>
