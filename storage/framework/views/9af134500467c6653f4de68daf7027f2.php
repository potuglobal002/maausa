<?php $__env->startSection('title', 'Gallery | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="gallery-page" x-data="galleryExperience(<?php echo \Illuminate\Support\Js::from($images->map(fn($item) => ['image'=>$item->image,'alt'=>$item->alt_text ?: $item->title,'title'=>$item->title,'caption'=>$item->caption,'category'=>$item->category])->values())->toHtml() ?>)">
    <div class="container gallery-shell">
        <header class="gallery-heading">
            <div><p class="eyebrow">Community in focus</p><h2>Real moments.<br><span>Shared purpose.</span></h2></div>
            <p>Explore photographs from MAA programs, celebrations, advocacy initiatives and the families who make our community stronger.</p>
        </header>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($images->isNotEmpty()): ?>
        <div class="gallery-toolbar">
            <div class="gallery-filters" aria-label="Filter gallery"><button type="button" :class="{ 'active': filter === 'All' }" x-on:click="filter='All'">All</button><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><button type="button" :class="{ 'active': filter === <?php echo \Illuminate\Support\Js::from($category)->toHtml() ?> }" x-on:click="filter=<?php echo \Illuminate\Support\Js::from($category)->toHtml() ?>"><?php echo e($category); ?></button><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></div>
            <span><?php echo e($images->count()); ?> photographs</span>
        </div>

        <div class="editorial-gallery">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <article class="gallery-tile gallery-tile--<?php echo e(($loop->index % 7) + 1); ?>" x-show="filter === 'All' || filter === <?php echo \Illuminate\Support\Js::from($image->category)->toHtml() ?>" x-transition.opacity>
                <button type="button" x-on:click="open(<?php echo e($loop->index); ?>)" aria-label="View <?php echo e($image->title ?: 'gallery photograph'); ?>">
                    <img src="<?php echo e($image->image); ?>" alt="<?php echo e($image->alt_text ?: $image->title ?: 'MAA community photograph'); ?>" loading="lazy">
                    <span class="gallery-tile-overlay"><span><small><?php echo e($image->category); ?></small><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image->title): ?><strong><?php echo e($image->title); ?></strong><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></span><i class="material-symbols-outlined">open_in_full</i></span>
                </button>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <?php else: ?>
        <div class="gallery-empty"><span class="material-symbols-outlined">photo_library</span><h2>New photographs are coming soon.</h2><p>MAA is preparing moments from recent programs and community gatherings.</p></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="gallery-lightbox" x-show="selected !== null" x-cloak x-on:click.self="close()" x-on:keydown.escape.window="close()" role="dialog" aria-modal="true" aria-label="Gallery photograph viewer">
        <button class="gallery-lightbox-close" type="button" x-on:click="close()" aria-label="Close image"><span class="material-symbols-outlined">close</span></button>
        <button class="gallery-lightbox-nav previous" type="button" x-on:click="previous()" aria-label="Previous image"><span class="material-symbols-outlined">arrow_back</span></button>
        <figure><img :src="current()?.image" :alt="current()?.alt || ''"><figcaption><small x-text="current()?.category"></small><strong x-text="current()?.title"></strong><p x-show="current()?.caption" x-text="current()?.caption"></p></figcaption></figure>
        <button class="gallery-lightbox-nav next" type="button" x-on:click="next()" aria-label="Next image"><span class="material-symbols-outlined">arrow_forward</span></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\gallery.blade.php ENDPATH**/ ?>