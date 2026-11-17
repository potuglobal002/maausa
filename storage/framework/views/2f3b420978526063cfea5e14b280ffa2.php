<?php $__env->startSection('title', 'Dashboard | MAA Administration'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-shell" x-data="{ navOpen: false }">
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="admin-main">
        <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="admin-content">
            <div class="admin-heading"><div><p class="eyebrow">Administration</p><h1>Good to see you, <?php echo e(str(auth()->user()->name)->before(' ')); ?>.</h1><p>Here is an overview of the MAA website and community activity.</p></div><span><?php echo e(now()->format('F j, Y')); ?></span></div>

            <section class="admin-stats" aria-label="Website statistics">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                    ['Pages', $stats['pages'], 'Published and draft content'],
                    ['Programs', $stats['programs'], 'Support programs'],
                    ['Events', $stats['events'], 'Upcoming and past events'],
                    ['New inquiries', $stats['inquiries'], 'Waiting for attention'],
                    ['Active staff', $stats['staff'], 'Authorized accounts'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value, $description]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <article><span><?php echo e($loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration); ?></span><strong><?php echo e($value); ?></strong><h2><?php echo e($label); ?></h2><p><?php echo e($description); ?></p></article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </section>

            <section class="admin-welcome-card">
                <div><p class="eyebrow eyebrow--light">Website control center</p><h2>Your MAA content and configuration workspace is connected.</h2><p>Manage pages, navigation, branding, SEO, analytics, social links and community content from this dashboard.</p></div>
                <a class="button button--light" href="<?php echo e(route('home')); ?>" target="_blank">Review homepage <span>→</span></a>
            </section>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>