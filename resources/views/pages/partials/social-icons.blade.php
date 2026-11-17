@if($socialLinks->isNotEmpty())
<div class="footer-social-icons" aria-label="Follow MAA on social media">
    @foreach($socialLinks as $social)
    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Follow MAA on {{ $social['label'] }}" title="{{ $social['label'] }}">
        @switch($social['label'])
            @case('Facebook')
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4.2c-.5-.1-2.2-.2-4.1-.2C9 4 6.3 6.4 6.3 10.8V14H2v4.2h4.3V24h5.2v-5.8h4.2l.7-4.2h-4.9v-2.8C11.5 9.9 11.9 8 14 8Z"/></svg>
                @break
            @case('Instagram')
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.4" cy="6.7" r="1" class="social-fill"/></svg>
                @break
            @case('YouTube')
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 7.2a3 3 0 0 0-2.1-2.1C17.6 4.6 12 4.6 12 4.6s-5.6 0-7.5.5a3 3 0 0 0-2.1 2.1A31 31 0 0 0 2 12a31 31 0 0 0 .4 4.8 3 3 0 0 0 2.1 2.1c1.9.5 7.5.5 7.5.5s5.6 0 7.5-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22 12a31 31 0 0 0-.4-4.8ZM10 15.4V8.6l6 3.4-6 3.4Z"/></svg>
                @break
            @case('LinkedIn')
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5.3 7.8A2.7 2.7 0 1 0 5.3 2.4a2.7 2.7 0 0 0 0 5.4ZM3 9.8h4.6V22H3V9.8Zm7.4 0h4.4v1.7h.1c.6-1.1 2.1-2.3 4.3-2.3 4.6 0 5.5 3 5.5 7V22h-4.6v-5.2c0-1.2 0-2.9-1.8-2.9s-2.1 1.4-2.1 2.8V22h-4.6V9.8h-1.2Z"/></svg>
                @break
            @case('X')
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 2H22l-6.8 7.8L23 22h-6.1l-4.8-6.2L6.7 22H3.6l7-8L3 2h6.3l4.3 5.7L18.9 2Zm-1.1 17.8h1.7L8.4 4.1H6.5l11.3 15.7Z"/></svg>
                @break
            @case('TikTok')
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16.7 2c.4 2.4 1.8 3.8 4.3 4v4.1a9.4 9.4 0 0 1-4.2-1v7.6a7.3 7.3 0 1 1-6.3-7.2v4.2a3.2 3.2 0 1 0 2.2 3V2h4Z"/></svg>
                @break
            @default
                <span class="material-symbols-outlined">share</span>
        @endswitch
    </a>
    @endforeach
</div>
@endif
