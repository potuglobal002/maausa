<?php $__env->startSection('title', 'Staff Login | MAA'); ?>

<?php $__env->startSection('content'); ?>
<main class="admin-login-shell">
    <section class="admin-login-brand">
        <a class="brand" href="<?php echo e(route('home')); ?>"><img class="brand-logo" src="<?php echo e(asset(ltrim($settings['logo_path'],'/'))); ?>" alt="<?php echo e($settings['site_name']); ?>"></a>
        <div>
            <p class="eyebrow eyebrow--light">Staff administration</p>
            <h1>Manage support with clarity and care.</h1>
            <p>Secure access for MAA staff to manage website content, programs, events and community inquiries.</p>
        </div>
        <small>Authorized staff access only</small>
    </section>

    <section class="admin-login-form-wrap">
        <div class="admin-login-form">
            <p class="eyebrow">Welcome back</p>
            <h2>Sign in to MAA</h2>
            <p class="form-intro">Use your staff account to continue to the dashboard.</p>

            <form method="POST" action="<?php echo e(route('admin.login.store')); ?>">
                <?php echo csrf_field(); ?>
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" autocomplete="email" required autofocus>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="label-row"><label for="password">Password</label></div>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <label class="remember-row"><input type="checkbox" name="remember" value="1"><span>Keep me signed in on this device</span></label>
                <button class="admin-submit" type="submit">Sign in <span>→</span></button>
            </form>

            <a class="back-link" href="<?php echo e(route('home')); ?>">← Return to website</a>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\auth\login.blade.php ENDPATH**/ ?>