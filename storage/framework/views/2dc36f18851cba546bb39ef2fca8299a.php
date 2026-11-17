<?php $innerHeroImage=$content['hero_image'] ?? ''; $innerHeroPosition=$content['hero_image_position'] ?? 'center center'; ?>
<section class="inner-hero <?php echo e($innerHeroImage ? 'inner-hero--image' : ''); ?> <?php echo e($heroClass ?? ''); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($innerHeroImage): ?><div class="inner-hero-media" style="background-image:url('<?php echo e($innerHeroImage); ?>');background-position:<?php echo e($innerHeroPosition); ?>"></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="inner-hero-overlay"></div><div class="inner-hero-art"></div>
    <div class="container">
        <div class="hero-kicker"><span></span><p class="eyebrow eyebrow--light"><?php echo e($eyebrow); ?></p></div>
        <h1><?php echo e($title); ?></h1>
        <p><?php echo e($description); ?></p>
    </div>
</section>
<?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views/pages/partials/page-hero.blade.php ENDPATH**/ ?>