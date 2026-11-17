<?php $__env->startSection('title', 'Contact Us | MAA'); ?>

<?php $__env->startSection('page-content'); ?>
<?php echo $__env->make('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="section contact-page">
    <div class="container contact-layout">
        <aside><p class="eyebrow">Contact information</p><h2>We’re here to help.</h2><div class="contact-detail"><span>01</span><div><small>Address</small><strong><?php echo nl2br(e($settings['address'])); ?></strong></div></div><div class="contact-detail"><span>02</span><div><small>Phone</small><a href="tel:<?php echo e($settings['phone_link']); ?>"><?php echo e($settings['phone']); ?></a></div></div><div class="contact-detail"><span>03</span><div><small>Email</small><a href="mailto:<?php echo e($settings['email']); ?>"><?php echo e($settings['email']); ?></a></div></div></aside>

        <div class="contact-form-card">
            <p class="eyebrow">Send a message</p><h2><?php echo e($content['form_title']); ?></h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?><div class="form-success" role="status"><?php echo e(session('success')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <form method="POST" action="<?php echo e(route('contact.submit')); ?>"><?php echo csrf_field(); ?>
                <div class="form-grid"><label><span>Your name</span><input name="name" value="<?php echo e(old('name')); ?>" required></label><label><span>Email address</span><input name="email" type="email" value="<?php echo e(old('email')); ?>" required></label></div>
                <div class="form-grid"><label><span>Phone number <em>Optional</em></span><input name="phone" value="<?php echo e(old('phone')); ?>"></label><label><span>Subject</span><input name="subject" value="<?php echo e(old('subject')); ?>" required></label></div>
                <label><span>Your message</span><textarea name="message" rows="6" required><?php echo e(old('message')); ?></textarea></label>
                <label class="consent-row"><input type="checkbox" name="consent" value="1" required><span>I agree that MAA may use this information to respond to my inquiry.</span></label>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?><div class="field-error">Please check the highlighted fields and try again.</div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <button class="button button--primary button--large" type="submit">Send message <span>→</span></button>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\pages\contact.blade.php ENDPATH**/ ?>