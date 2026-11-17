<?php $__env->startSection('title', 'Homepage Pathways | MAA Administration'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-shell" x-data="{ navOpen:false, adding:false }">
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main class="admin-main">
        <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="admin-content carousel-workspace">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Homepage navigation</p><h1>Support pathways</h1><p>Manage the quick-access cards displayed directly below the homepage hero.</p></div>
                <div class="heading-actions"><a class="secondary-action" href="<?php echo e(route('admin.pages.edit',$page)); ?>">Back to page</a><a class="secondary-action" target="_blank" href="<?php echo e(route('home')); ?>#pathways">Preview section <span class="material-symbols-outlined">open_in_new</span></a></div>
            </div>
            <?php echo $__env->make('admin.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="flash error"><strong>Please review the highlighted fields.</strong><ul><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><li><?php echo e($error); ?></li><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></ul></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="carousel-guidance">
                <span class="material-symbols-outlined">route</span><div><strong>Keep choices focused</strong><p>Three cards provide the clearest desktop layout. Every card can have its own icon, destination, display order and visibility.</p></div>
                <button class="module-action" type="button" x-on:click="adding=!adding"><span class="material-symbols-outlined" x-text="adding ? 'close' : 'add'">add</span><span x-text="adding ? 'Close form' : 'Add pathway'">Add pathway</span></button>
            </div>

            <section class="cms-card new-slide-card" x-show="adding" x-transition x-cloak>
                <div class="editor-card-heading"><div><span class="material-symbols-outlined">add_link</span><div><h2>Create a new pathway</h2><p>Add a focused entry point to an important page or homepage section.</p></div></div></div>
                <form method="POST" action="<?php echo e(route('admin.home-pathways.store',$page)); ?>"><?php echo csrf_field(); ?>
                    <?php echo $__env->make('admin.home-pathways.fields', ['pathway'=>null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">add</span> Add pathway</button></div>
                </form>
            </section>

            <div class="slide-editor-list">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pathways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pathway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="cms-card slide-editor-card" x-data="{ editing:false }">
                    <div class="slide-card-summary pathway-admin-summary">
                        <div class="pathway-admin-icon"><span class="material-symbols-outlined"><?php echo e($pathway->icon); ?></span><small><?php echo e(str_pad($loop->iteration,2,'0',STR_PAD_LEFT)); ?></small></div>
                        <div class="slide-summary-copy"><div><span class="status-pill <?php echo e($pathway->is_active ? 'published' : 'draft'); ?>"><?php echo e($pathway->is_active ? 'Visible' : 'Hidden'); ?></span><span class="slide-order">Order <?php echo e($pathway->sort_order); ?></span></div><h2><?php echo e($pathway->title); ?></h2><p><?php echo e($pathway->description); ?></p><small><?php echo e($pathway->link_url); ?></small></div>
                        <button class="secondary-action" type="button" x-on:click="editing=!editing"><span class="material-symbols-outlined">edit</span><span x-text="editing ? 'Close' : 'Edit pathway'">Edit pathway</span></button>
                    </div>
                    <div class="slide-edit-panel" x-show="editing" x-transition x-cloak>
                        <form method="POST" action="<?php echo e(route('admin.home-pathways.update',[$page,$pathway])); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <?php echo $__env->make('admin.home-pathways.fields', ['pathway'=>$pathway], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <div class="slide-form-actions"><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save pathway</button></div>
                        </form>
                        <form class="delete-slide-form" method="POST" action="<?php echo e(route('admin.home-pathways.destroy',[$page,$pathway])); ?>" onsubmit="return confirm('Remove this pathway permanently?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit"><span class="material-symbols-outlined">delete</span> Remove pathway</button></form>
                    </div>
                </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="cms-card empty-carousel"><span class="material-symbols-outlined">route</span><h2>No pathways yet</h2><p>Add the first card to create the homepage quick-access section.</p></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\home-pathways\index.blade.php ENDPATH**/ ?>