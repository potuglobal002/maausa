<?php
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
?>
<!doctype html>
<html lang="<?php echo e($settings['default_language'] ?: 'en'); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#67103f">
    <title><?php echo e($metaTitle); ?></title>
    <meta name="description" content="<?php echo e($metaDescription); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($settings['seo_keywords'])): ?><meta name="keywords" content="<?php echo e($settings['seo_keywords']); ?>"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <meta name="robots" content="<?php echo e($settings['seo_indexing'] ? 'index,follow' : 'noindex,nofollow'); ?>">
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <meta property="og:type" content="<?php echo e(trim($__env->yieldContent('og_type')) ?: 'website'); ?>"><meta property="og:site_name" content="<?php echo e($settings['site_name']); ?>"><meta property="og:title" content="<?php echo e($metaTitle); ?>"><meta property="og:description" content="<?php echo e($metaDescription); ?>"><meta property="og:url" content="<?php echo e($canonical); ?>"><meta property="og:image" content="<?php echo e($ogImage); ?>">
    <meta name="twitter:card" content="summary_large_image"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($settings['seo_twitter_handle'])): ?><meta name="twitter:site" content="<?php echo e($settings['seo_twitter_handle']); ?>"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($settings['google_site_verification'])): ?><meta name="google-site-verification" content="<?php echo e($settings['google_site_verification']); ?>"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($settings['favicon_path'])): ?><link rel="icon" href="<?php echo e(asset(ltrim($settings['favicon_path'],'/'))); ?>"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..24,400,0,0" rel="stylesheet">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trackingEnabled && $gtmId): ?><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',<?php echo json_encode($gtmId, 15, 512) ?>);</script><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trackingEnabled && $ga4Id): ?><script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($ga4Id); ?>"></script><script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config',<?php echo json_encode($ga4Id, 15, 512) ?>);</script><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trackingEnabled && $pixelId): ?><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init',<?php echo json_encode($pixelId, 15, 512) ?>);fbq('track','PageView');</script><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trackingEnabled && $gtmId): ?><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo e($gtmId); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trackingEnabled && $pixelId): ?><noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo e($pixelId); ?>&ev=PageView&noscript=1" alt=""></noscript><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\layouts\app.blade.php ENDPATH**/ ?>