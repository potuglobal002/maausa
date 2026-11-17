<?php $__env->startSection('title', ($page->seo_title ?: $page->title).' | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'] ?? '', 'title' => $content['hero_title'] ?? $page->title, 'description' => $content['hero_description'] ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<section class="section generic-page"><div class="container"><p class="eyebrow"><?php echo e($page->title); ?></p><h2><?php echo e($content['content_title'] ?? $page->title); ?></h2><div class="rich-content"><?php echo $content['content_body'] ?? ''; ?></div></div></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\generic.blade.php ENDPATH**/ ?>