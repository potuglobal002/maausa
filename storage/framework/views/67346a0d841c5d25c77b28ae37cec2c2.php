<?php $__env->startSection('title', 'Video Gallery | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="section video-page" x-data="videoModal" x-on:keydown.escape.window="close()">
    <div class="container">
        <div class="video-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <article class="video-card">
                <div class="video-poster">
                    <img src="<?php echo e($collection['image']); ?>" alt="<?php echo e($collection['title']); ?>" loading="lazy">
                    <button type="button" x-on:click="play(<?php echo \Illuminate\Support\Js::from($collection['url'])->toHtml() ?>, <?php echo \Illuminate\Support\Js::from($collection['title'])->toHtml() ?>)" aria-label="Play <?php echo e($collection['title']); ?>"><span class="material-symbols-outlined">play_arrow</span></button>
                </div>
                <h2><?php echo e($collection['title']); ?></h2>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    <template x-teleport="body">
        <div class="video-modal" x-show="open" x-transition.opacity x-cloak x-on:click.self="close()" role="dialog" aria-modal="true" :aria-label="title">
            <div class="video-modal-panel" x-show="open" x-transition.scale.origin.center>
                <div class="video-modal-head"><div><span>MAA video</span><h2 x-text="title"></h2></div><button type="button" x-on:click="close()" aria-label="Close video"><span class="material-symbols-outlined">close</span></button></div>
                <div class="video-modal-player">
                    <template x-if="type === 'video'"><video :src="url" controls autoplay playsinline></video></template>
                    <template x-if="type === 'iframe'"><iframe :src="url" :title="title" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe></template>
                </div>
            </div>
        </div>
    </template>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\videos.blade.php ENDPATH**/ ?>