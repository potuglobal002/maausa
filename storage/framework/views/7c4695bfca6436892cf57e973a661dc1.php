<?php $__env->startSection('title', ucfirst(str_replace('-', ' ', $page)).' | MAA'); ?>

<?php $__env->startSection('content'); ?>
<main class="placeholder-page">
    <a class="brand brand--dark" href="<?php echo e(route('home')); ?>"><img class="brand-logo" src="<?php echo e(asset(ltrim($settings['logo_path'],'/'))); ?>" alt="<?php echo e($settings['site_name']); ?>"></a>
    <div>
        <p class="eyebrow">Page in development</p>
        <h1><?php echo e(ucfirst(str_replace('-', ' ', $page))); ?></h1>
        <p>This page shell is ready and will be connected to the MAA content system during the next development phase.</p>
        <a class="button button--primary" href="<?php echo e(route('home')); ?>">Return home <span>→</span></a>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\coming-soon.blade.php ENDPATH**/ ?>