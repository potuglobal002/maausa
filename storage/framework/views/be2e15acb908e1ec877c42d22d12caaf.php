<aside class="admin-sidebar" :class="{ 'is-open': navOpen }">
    <a class="admin-brand" href="<?php echo e(route('admin.dashboard')); ?>"><img src="<?php echo e(asset(ltrim($settings['logo_path'],'/'))); ?>" alt="MAA"><small>Administration</small></a>
    <nav aria-label="Administration">
        <a class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>"><span class="material-symbols-outlined">dashboard</span> Overview</a>
        <a class="<?php echo e(request()->routeIs('admin.pages.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.pages.index')); ?>"><span class="material-symbols-outlined">article</span> Pages</a>
        <a class="<?php echo e(request()->routeIs('admin.navigation.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.navigation.index')); ?>"><span class="material-symbols-outlined">account_tree</span> Navigation</a>
        <a class="<?php echo e(request()->route('module') === 'programs' ? 'active' : ''); ?>" href="<?php echo e(route('admin.module', 'programs')); ?>"><span class="material-symbols-outlined">diversity_3</span> Programs</a>
        <a class="<?php echo e(request()->route('module') === 'events' ? 'active' : ''); ?>" href="<?php echo e(route('admin.module', 'events')); ?>"><span class="material-symbols-outlined">calendar_month</span> Events</a>
        <a class="<?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.gallery.index')); ?>"><span class="material-symbols-outlined">photo_library</span> Gallery</a>
        <a class="<?php echo e(request()->routeIs('admin.news.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.news.index')); ?>"><span class="material-symbols-outlined">newspaper</span> News & PR</a>
        <a class="<?php echo e(request()->route('module') === 'media' ? 'active' : ''); ?>" href="<?php echo e(route('admin.module', 'media')); ?>"><span class="material-symbols-outlined">perm_media</span> Media</a>
        <a class="<?php echo e(request()->route('module') === 'inquiries' ? 'active' : ''); ?>" href="<?php echo e(route('admin.module', 'inquiries')); ?>"><span class="material-symbols-outlined">mail</span> Inquiries</a>
        <span class="admin-nav-label">Configuration</span>
        <a class="<?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.settings.edit')); ?>"><span class="material-symbols-outlined">settings</span> Site settings</a>
        <a class="<?php echo e(request()->routeIs('admin.seo.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.seo.edit')); ?>"><span class="material-symbols-outlined">search</span> SEO</a>
        <a class="<?php echo e(request()->routeIs('admin.tracking.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.tracking.edit')); ?>"><span class="material-symbols-outlined">monitoring</span> Analytics & tracking</a>
        <a class="<?php echo e(request()->routeIs('admin.social.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.social.edit')); ?>"><span class="material-symbols-outlined">share</span> Social media</a>
    </nav>
    <form method="POST" action="<?php echo e(route('admin.logout')); ?>"><?php echo csrf_field(); ?><button type="submit"><span class="material-symbols-outlined">logout</span> Sign out</button></form>
</aside>
<?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\partials\sidebar.blade.php ENDPATH**/ ?>