<?php $__env->startSection('title', 'Analytics & Tracking | MAA Administration'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-shell" x-data="{ navOpen:false }"><?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><main class="admin-main"><?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><div class="admin-content">
<div class="module-heading"><div><p class="eyebrow">Measurement</p><h1>Analytics & tracking</h1><p>Connect Meta Pixel, Google Analytics 4, Google Tag Manager and Search Console verification.</p></div></div>
<?php echo $__env->make('admin.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<form class="cms-form" method="POST" action="<?php echo e(route('admin.tracking.update')); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<section class="cms-card"><div class="cms-grid"><label class="toggle-card cms-full"><input type="hidden" name="tracking_enabled" value="0"><input type="checkbox" name="tracking_enabled" value="1" <?php if(old('tracking_enabled',$values->get('tracking_enabled',false))): echo 'checked'; endif; ?>><span><strong>Enable tracking scripts</strong><small>Scripts are added to public pages only when this is enabled.</small></span></label>
<label><span>Meta Pixel ID</span><input name="meta_pixel_id" value="<?php echo e(old('meta_pixel_id',$values->get('meta_pixel_id'))); ?>" placeholder="123456789012345"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['meta_pixel_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
<label><span>GA4 Measurement ID</span><input name="ga4_measurement_id" value="<?php echo e(old('ga4_measurement_id',$values->get('ga4_measurement_id'))); ?>" placeholder="G-XXXXXXXXXX"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['ga4_measurement_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
<label><span>Google Tag Manager container</span><input name="gtm_container_id" value="<?php echo e(old('gtm_container_id',$values->get('gtm_container_id'))); ?>" placeholder="GTM-XXXXXXX"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['gtm_container_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
<label><span>Google site verification token</span><input name="google_site_verification" value="<?php echo e(old('google_site_verification',$values->get('google_site_verification'))); ?>"></label></div></section>
<aside class="admin-recommendation"><strong>Recommended setup</strong><p>Use Google Tag Manager as the primary container, then manage GA4 and other marketing tags inside GTM. If GA4 is already configured in GTM, leave the direct GA4 field empty to avoid duplicate page views. Add a consent banner before enabling advertising cookies in production.</p></aside>
<div class="cms-save"><span>Only validated IDs are accepted; arbitrary scripts cannot be injected.</span><button class="module-action" type="submit">Save tracking settings</button></div></form>
</div></main></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\tracking\edit.blade.php ENDPATH**/ ?>