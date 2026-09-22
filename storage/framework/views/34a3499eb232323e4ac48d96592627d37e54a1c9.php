<?php $__env->startSection('title', __('front.auth_login_title')); ?>

<?php $__env->startSection('content'); ?>
<?php $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name'); ?>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-logo">
            <a href="<?php echo e(route('home')); ?>" style="text-decoration:none">
                <div style="width:56px;height:56px;background:var(--z-primary);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.5rem;font-weight:900;color:#fff"><?php echo e(mb_substr($siteName, 0, 1)); ?></div>
                <h2><?php echo e($siteName); ?></h2>
            </a>
            <p><?php echo e(__('front.auth_login_subtitle')); ?></p>
        </div>

        <?php if($errors->any()): ?>
        <div class="z-flash flash-error mb-4">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span><?php echo e($errors->first()); ?></span>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('student.login.post')); ?>" novalidate>
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="z-label"><?php echo e(__('front.auth_phone_label')); ?></label>
                <input type="tel" name="phone"
                       class="z-input <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>"
                       value="<?php echo e(old('phone')); ?>"
                       placeholder="<?php echo e(__('front.auth_phone_ph')); ?>" required autofocus dir="ltr">
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="z-label mb-0"><?php echo e(__('front.auth_password_label')); ?></label>
                </div>
                <input type="password" name="password"
                       class="z-input <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                       placeholder="••••••••" required dir="ltr">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="d-flex align-items-center gap-2 mb-4">
                <input type="checkbox" name="remember" id="remember" class="form-check-input mt-0" style="width:18px;height:18px">
                <label for="remember" style="font-size:.88rem;color:var(--z-text-muted);cursor:pointer"><?php echo e(__('front.auth_remember')); ?></label>
            </div>
            <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                <i class="bi bi-box-arrow-in-right"></i>
                <?php echo e(__('front.auth_login_title')); ?>

            </button>
        </form>

        <div class="divider-text mt-4">
            <span><?php echo e(__('front.auth_no_account')); ?></span>
        </div>

        <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-outline btn-z-block">
            <i class="bi bi-person-plus"></i>
            <?php echo e(__('front.auth_create_account')); ?>

        </a>

        <div class="text-center mt-3">
            <a href="<?php echo e(route('home')); ?>" style="font-size:.85rem;color:var(--z-text-muted)">
                <i class="bi bi-arrow-<?php echo e(app()->getLocale() === 'ar' ? 'right' : 'left'); ?> me-1"></i><?php echo e(__('front.auth_back_home')); ?>

            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\login.blade.php ENDPATH**/ ?>