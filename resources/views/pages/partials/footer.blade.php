<footer class="site-footer">
    <div class="footer-accent" aria-hidden="true"></div>

    <div class="container footer-grid footer-grid--desktop">
        <a class="brand brand--dark" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}"></a>
        <p class="footer-about">{{ $settings['footer_description'] }}</p>
        <div><strong>Explore</strong>@foreach($footerNavigation as $item)<a href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}</a>@endforeach</div>
        <div><strong>Connect</strong><a href="{{ route('contact') }}">Contact us</a><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a><a href="tel:{{ $settings['phone_link'] }}">{{ $settings['phone'] }}</a>@include('pages.partials.social-icons')</div>
    </div>

    <div class="container footer-grid footer-grid--mobile">
        <div class="footer-brand-panel">
            <a class="brand brand--dark" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}"></a>
            <p class="footer-about">{{ $settings['footer_description'] }}</p>
            @include('pages.partials.social-icons')
        </div>
        <nav class="footer-column" aria-label="Footer navigation"><p class="footer-label">Explore</p><div class="footer-link-list">@foreach($footerNavigation as $item)<a href="{{ url($item->url) }}" target="{{ $item->target }}">{{ $item->label }}<span class="material-symbols-outlined">arrow_forward</span></a>@endforeach</div></nav>
        <div class="footer-column footer-contact-panel"><p class="footer-label">Connect</p><a class="footer-contact-link" href="{{ route('contact') }}"><span class="material-symbols-outlined">chat_bubble</span><span><small>Send a message</small><strong>Contact MAA</strong></span></a><a class="footer-contact-link" href="mailto:{{ $settings['email'] }}"><span class="material-symbols-outlined">mail</span><span><small>Email us</small><strong>{{ $settings['email'] }}</strong></span></a><a class="footer-contact-link" href="tel:{{ $settings['phone_link'] }}"><span class="material-symbols-outlined">call</span><span><small>Call us</small><strong>{{ $settings['phone'] }}</strong></span></a></div>
    </div>

    <div class="container footer-bottom"><span>&copy; {{ date('Y') }} {{ $settings['copyright_text'] }}</span><span><a href="#">Privacy</a><i></i><a href="#">Accessibility</a></span></div>
</footer>
