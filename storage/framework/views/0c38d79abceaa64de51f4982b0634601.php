<?php $__env->startSection('title', 'Hero Carousel | MAA Administration'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-shell" x-data="{ navOpen:false, adding:false }">
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main class="admin-main">
        <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="admin-content carousel-workspace">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Homepage experience</p><h1>Hero carousel</h1><p>Create a strong first impression with focused photography and concise storytelling.</p></div>
                <div class="heading-actions"><a class="secondary-action" href="<?php echo e(route('admin.pages.edit',$page)); ?>">Back to page</a><a class="secondary-action" target="_blank" href="<?php echo e(route('home')); ?>">Preview website <span class="material-symbols-outlined">open_in_new</span></a></div>
            </div>
            <?php echo $__env->make('admin.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="flash error"><strong>Please review the highlighted fields.</strong><ul><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><li><?php echo e($error); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="carousel-guidance">
                <span class="material-symbols-outlined">auto_awesome</span><div><strong>Editorial guidance</strong><p>Three to five slides works best. Use 1920 × 1080px images with clear space behind the copy, and keep headings to three short lines.</p></div>
                <button class="module-action" type="button" x-on:click="adding=!adding"><span class="material-symbols-outlined" x-text="adding ? 'close' : 'add'">add</span><span x-text="adding ? 'Close form' : 'Add slide'">Add slide</span></button>
            </div>

            <section class="cms-card new-slide-card" x-show="adding" x-transition x-cloak>
                <div class="editor-card-heading"><div><span class="material-symbols-outlined">add_photo_alternate</span><div><h2>Create a new slide</h2><p>Add its story, image and calls to action.</p></div></div></div>
                <form method="POST" action="<?php echo e(route('admin.hero-slides.store',$page)); ?>" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                    <?php echo $__env->make('admin.hero-slides.fields', ['slide'=>null, 'prefix'=>'new'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">add</span> Add to carousel</button></div>
                </form>
            </section>

            <div class="slide-editor-list">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="cms-card slide-editor-card" x-data="{ editing:false }">
                    <div class="slide-card-summary">
                        <div class="slide-thumb" style="background-image:url('<?php echo e($slide->image); ?>');background-position:<?php echo e($slide->image_position); ?>"><span><?php echo e(str_pad($loop->iteration,2,'0',STR_PAD_LEFT)); ?></span></div>
                        <div class="slide-summary-copy"><div><span class="status-pill <?php echo e($slide->is_active ? 'published' : 'draft'); ?>"><?php echo e($slide->is_active ? 'Visible' : 'Hidden'); ?></span><span class="slide-order">Order <?php echo e($slide->sort_order); ?></span></div><p><?php echo e($slide->eyebrow); ?></p><h2><?php echo e(Str::limit(str_replace("\n", ' / ', $slide->title), 90)); ?></h2></div>
                        <button class="secondary-action" type="button" x-on:click="editing=!editing"><span class="material-symbols-outlined">edit</span><span x-text="editing ? 'Close' : 'Edit slide'">Edit slide</span></button>
                    </div>
                    <div class="slide-edit-panel" x-show="editing" x-transition x-cloak>
                        <form method="POST" action="<?php echo e(route('admin.hero-slides.update',[$page,$slide])); ?>" enctype="multipart/form-data"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <?php echo $__env->make('admin.hero-slides.fields', ['slide'=>$slide, 'prefix'=>'slide-'.$slide->id], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save slide</button></div>
                        </form>
                        <form class="delete-slide-form" method="POST" action="<?php echo e(route('admin.hero-slides.destroy',[$page,$slide])); ?>" onsubmit="return confirm('Remove this slide permanently?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit"><span class="material-symbols-outlined">delete</span> Remove slide</button></form>
                    </div>
                </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="cms-card empty-carousel"><span class="material-symbols-outlined">view_carousel</span><h2>No carousel slides yet</h2><p>Add the first slide to replace the fallback homepage hero.</p></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\hero-slides\index.blade.php ENDPATH**/ ?>