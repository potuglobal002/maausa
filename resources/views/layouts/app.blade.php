@php
    $currentPage = isset($page) && $page instanceof \App\Models\Page ? $page : null;
    $metaTitle = trim($__env->yieldContent('meta_title')) ?: ($currentPage?->seo_title ?: $settings['seo_default_title']);
    $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($currentPage?->seo_description ?: $settings['seo_default_description']);
    $canonical = rtrim($settings['seo_canonical_base'] ?: url('/'), '/').'/'.ltrim(request()->path() === '/' ? '' : request()->path(), '/');
    $ogImage = trim($__env->yieldContent('og_image')) ?: ($settings['seo_og_image'] ?: $settings['logo_path']);
    $ogImage = str_starts_with($ogImage, 'http') ? $ogImage : asset(ltrim($ogImage, '/'));
    $trackingEnabled = (bool) $settings['tracking_enabled'];
    $gtmId = preg_match('/^GTM-[A-Z0-9]{4,20}$/i', (string) $settings['gtm_container_id']) ? strtoupper($settings['gtm_container_id']) : null;
    $ga4Id = preg_match('/^G-[A-Z0-9]{4,20}$/i', (string) $settings['ga4_measurement_id']) ? strtoupper($settings['ga4_measurement_id']) : null;
    $pixelId = preg_match('/^[0-9]{5,30}$/', (string) $settings['meta_pixel_id']) ? $settings['meta_pixel_id'] : null;
    $schema = ['@context'=>'https://schema.org','@type'=>'NonProfit','name'=>$settings['site_name'],'url'=>url('/'),'logo'=>asset(ltrim($settings['logo_path'],'/')),'email'=>$settings['email'],'telephone'=>$settings['phone_link'],'sameAs'=>$socialLinks->pluck('url')->values()->all()];
@endphp
<!doctype html>
<html lang="{{ $settings['default_language'] ?: 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#67103f">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    @if(filled($settings['seo_keywords']))<meta name="keywords" content="{{ $settings['seo_keywords'] }}">@endif
    <meta name="robots" content="{{ $settings['seo_indexing'] ? 'index,follow' : 'noindex,nofollow' }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:type" content="{{ trim($__env->yieldContent('og_type')) ?: 'website' }}"><meta property="og:site_name" content="{{ $settings['site_name'] }}"><meta property="og:title" content="{{ $metaTitle }}"><meta property="og:description" content="{{ $metaDescription }}"><meta property="og:url" content="{{ $canonical }}"><meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">@if(filled($settings['seo_twitter_handle']))<meta name="twitter:site" content="{{ $settings['seo_twitter_handle'] }}">@endif
    @if(filled($settings['google_site_verification']))<meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">@endif
    @if(filled($settings['favicon_path']))<link rel="icon" href="{{ asset(ltrim($settings['favicon_path'],'/')) }}">@endif
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..24,400,0,0" rel="stylesheet">
    @if($trackingEnabled && $gtmId)<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',@json($gtmId));</script>@endif
    @if($trackingEnabled && $ga4Id)<script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4Id }}"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config',@json($ga4Id));</script>@endif
    @if($trackingEnabled && $pixelId)<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init',@json($pixelId));fbq('track','PageView');</script>@endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if($trackingEnabled && $gtmId)<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>@endif
    @if($trackingEnabled && $pixelId)<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $pixelId }}&ev=PageView&noscript=1" alt=""></noscript>@endif
    <a class="skip-link" href="#main-content">Skip to content</a>
    @yield('content')
</body>
</html>
