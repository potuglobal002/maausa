<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('pages.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main id="main-content"><?php echo $__env->yieldContent('page-content'); ?></main>
    <?php echo $__env->make('pages.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views/layouts/public.blade.php ENDPATH**/ ?>