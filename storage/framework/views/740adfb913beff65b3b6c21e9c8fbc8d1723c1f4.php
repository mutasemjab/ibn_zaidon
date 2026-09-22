<?php $__env->startSection('title', __('front.auth_register_title')); ?>

<?php $__env->startSection('content'); ?>
<?php $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name'); ?>
<div class="auth-wrap">
    <div class="auth-card" style="max-width:520px">
        <div class="auth-logo">
            <a href="<?php echo e(route('home')); ?>" style="text-decoration:none">
                <div style="width:56px;height:56px;background:var(--z-primary);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.5rem;font-weight:900;color:#fff"><?php echo e(mb_substr($siteName, 0, 1)); ?></div>
                <h2><?php echo e(__('front.auth_create_account')); ?></h2>
            </a>
            <p><?php echo e(__('front.auth_register_subtitle', ['site' => $siteName])); ?></p>
        </div>

        <?php if($errors->any()): ?>
        <div class="z-flash flash-error mb-4">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span><?php echo e(__('front.auth_form_errors')); ?></span>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('student.register.post')); ?>" novalidate>
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="z-label"><?php echo e(__('front.auth_full_name')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name"
                       class="z-input <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                       value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('front.auth_full_name_ph')); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="z-label"><?php echo e(__('front.auth_phone_label')); ?> <span class="text-danger">*</span></label>
                    <input type="tel" name="phone"
                           class="z-input <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>"
                           value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('front.auth_phone_ph')); ?>" dir="ltr" required>
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="z-label"><?php echo e(__('front.auth_national_id')); ?></label>
                    <input type="text" name="national_id"
                           class="z-input <?php echo e($errors->has('national_id') ? 'is-invalid' : ''); ?>"
                           value="<?php echo e(old('national_id')); ?>" placeholder="<?php echo e(__('front.auth_national_id_ph')); ?>" dir="ltr">
                    <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="z-label"><?php echo e(__('front.auth_email_label')); ?></label>
                <input type="email" name="email"
                       class="z-input <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                       value="<?php echo e(old('email')); ?>" placeholder="example@email.com" dir="ltr">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="z-label"><?php echo e(__('front.auth_password_label')); ?> <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="z-input <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                           placeholder="<?php echo e(__('front.auth_password_ph')); ?>" dir="ltr" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="z-label"><?php echo e(__('front.auth_confirm_password')); ?> <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="z-input"
                           placeholder="<?php echo e(__('front.auth_confirm_ph')); ?>" dir="ltr" required>
                </div>
            </div>

            <div class="d-flex align-items-start gap-2 mb-4">
                <input type="checkbox" name="terms" id="terms"
                       class="form-check-input mt-1 <?php echo e($errors->has('terms') ? 'is-invalid' : ''); ?>"
                       style="width:18px;height:18px;flex-shrink:0" required>
                <label for="terms" style="font-size:.86rem;color:var(--z-text-muted);cursor:pointer;line-height:1.5">
                    <?php echo e(__('front.auth_agree')); ?>

                    <a href="#" style="color:var(--z-accent)"><?php echo e(__('front.auth_terms_link')); ?></a>
                    <?php echo e(__('front.auth_and')); ?>

                    <a href="#" style="color:var(--z-accent)"><?php echo e(__('front.auth_privacy_link')); ?></a>
                    <?php echo e(__('front.auth_agree_suffix', ['site' => $siteName])); ?>

                </label>
                <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error w-100"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                <i class="bi bi-person-check-fill"></i>
                <?php echo e(__('front.auth_register_btn')); ?>

            </button>
        </form>

        <div class="divider-text mt-4"><span><?php echo e(__('front.auth_have_account')); ?></span></div>

        <a href="<?php echo e(route('student.login')); ?>" class="btn-z btn-z-outline btn-z-block">
            <i class="bi bi-box-arrow-in-right"></i>
            <?php echo e(__('front.auth_sign_in_link')); ?>

        </a>

        <div class="text-center mt-3">
            <a href="<?php echo e(route('home')); ?>" style="font-size:.85rem;color:var(--z-text-muted)">
                <i class="bi bi-arrow-<?php echo e(app()->getLocale() === 'ar' ? 'right' : 'left'); ?> me-1"></i><?php echo e(__('front.auth_back_home')); ?>

            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\register.blade.php ENDPATH**/ ?>