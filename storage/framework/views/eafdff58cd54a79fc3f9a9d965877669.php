<header class="admin-topbar">
    <button type="button" class="admin-menu" x-on:click="navOpen = !navOpen" aria-label="Toggle sidebar"><span class="material-symbols-outlined">menu</span></button>
    <div><small>Signed in as</small><strong><?php echo e(auth()->user()->name); ?></strong></div>
    <a href="<?php echo e(route('home')); ?>" target="_blank">View website <span aria-hidden="true">↗</span></a>
</header>
<?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\partials\topbar.blade.php ENDPATH**/ ?>