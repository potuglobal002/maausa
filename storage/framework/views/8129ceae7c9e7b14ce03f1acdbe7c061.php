<?php $__env->startSection('title', 'Who We Are | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description'], 'heroClass' => 'inner-hero--about'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
    $founderParagraphs = collect(!empty($content['founder_paragraphs']) && is_array($content['founder_paragraphs'])
        ? $content['founder_paragraphs']
        : collect(range(1, 4))->map(fn($paragraph) => $content['founder_intro_'.$paragraph] ?? null)->all())
        ->filter()->values();
    $founderLead = $founderParagraphs->shift();
?>
<section class="section founder-section">
    <div class="container founder-shell">
        <div class="founder-feature">
            <div class="founder-portrait">
                <figure><img src="<?php echo e($content['founder_image']); ?>" alt="<?php echo e($content['founder_name']); ?>, founder of MAA"></figure>
            </div>
            <div class="founder-profile">
                <div class="founder-heading"><p class="eyebrow">Our founder</p><span aria-hidden="true"></span></div>
                <h2>Turning a personal journey into shared support.</h2>
                <div class="founder-identity">
                    <div><h3><?php echo e($content['founder_name']); ?></h3><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content['founder_credentials'])): ?><p class="founder-credentials"><?php echo e($content['founder_credentials']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content['founder_role'])): ?><p class="founder-role"><?php echo e($content['founder_role']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($founderLead): ?><p class="founder-lead"><?php echo e($founderLead); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($founderParagraphs->isNotEmpty()): ?>
                    <div class="founder-narrative" aria-label="Founder biography" x-data="{ expanded: false }">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $founderParagraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <p <?php if($loop->iteration > 2): ?> x-show="expanded" x-cloak x-transition.opacity <?php endif; ?>><?php echo e($paragraph); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($founderParagraphs->count() > 2): ?>
                            <button class="founder-story-toggle" type="button" x-on:click="expanded = !expanded" :aria-expanded="expanded.toString()"><span x-text="expanded ? 'Show less' : 'Read full story'">Read full story</span><span class="material-symbols-outlined" x-text="expanded ? 'arrow_upward' : 'arrow_downward'">arrow_downward</span></button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="impact-section" aria-labelledby="impact-title">
    <div class="container impact-shell">
        <div class="impact-intro">
            <p class="eyebrow eyebrow--light"><?php echo e($content['stats_eyebrow'] ?? 'Our impact'); ?></p>
            <h2 id="impact-title"><?php echo e($content['stats_title'] ?? 'A growing village of support.'); ?></h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content['stats_intro'])): ?><p><?php echo e($content['stats_intro']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="impact-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <article class="impact-stat">
                    <span class="impact-index"><?php echo e(str_pad((string) $stat, 2, '0', STR_PAD_LEFT)); ?></span>
                    <p class="impact-number">
                        <strong x-data="animatedCounter(<?php echo e((int) ($content['stat_'.$stat.'_value'] ?? 0)); ?>)" x-text="display"><?php echo e($content['stat_'.$stat.'_value'] ?? 0); ?></strong><sup><?php echo e($content['stat_'.$stat.'_suffix'] ?? '+'); ?></sup>
                    </p>
                    <h3><?php echo e($content['stat_'.$stat.'_label'] ?? ''); ?></h3>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>

<section class="section story-section">
    <div class="container story-layout">
        <div><p class="eyebrow">Our story</p><h2><?php echo e($content['story_title']); ?></h2></div>
        <div class="story-copy">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($content['story_'.$paragraph])): ?><p><?php echo e($content['story_'.$paragraph]); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <blockquote><?php echo e($content['quote']); ?></blockquote>
        </div>
    </div>
</section>

<section class="section values-section">
    <div class="container"><div class="section-title-row"><div><p class="eyebrow">What guides us</p><h2>Understanding, advocacy and belonging.</h2></div></div>
        <div class="value-grid">
            <article><span>01</span><h3>Our mission</h3><p><?php echo e($content['mission']); ?></p></article>
            <article><span>02</span><h3>Our vision</h3><p><?php echo e($content['vision']); ?></p></article>
            <article><span>03</span><h3>501(c)(3) Tax-Exempt</h3><p><?php echo e($content['nonprofit']); ?></p></article>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\about.blade.php ENDPATH**/ ?>