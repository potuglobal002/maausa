<?php $__env->startSection('title', ($page->seo_title ?: $page->title).' | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', [
    'eyebrow' => $content['hero_eyebrow'] ?? 'Our services',
    'title' => $content['hero_title'] ?? 'Guidance for every chapter.',
    'description' => $content['hero_description'] ?? '',
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="section services-page">
    <div class="container">
        <div class="services-page-intro">
            <div>
                <p class="eyebrow"><?php echo e($content['programs_label'] ?? 'How we help'); ?></p>
                <h2><?php echo e($content['programs_title'] ?? 'Practical support for families.'); ?></h2>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content['programs_intro'])): ?><p><?php echo e($content['programs_intro']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="services-page-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="service-card">
                    <span><?php echo e(str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                    <div><h3><?php echo e($program['title']); ?></h3><p><?php echo e($program['description']); ?></p></div>
                    <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <aside class="services-contact-panel">
            <div><p class="eyebrow">Need guidance?</p><h2>Start with a conversation.</h2></div>
            <a class="button button--light button--large" href="<?php echo e(route('contact')); ?>">Contact MAA <span class="material-symbols-outlined">arrow_forward</span></a>
        </aside>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\programs.blade.php ENDPATH**/ ?>