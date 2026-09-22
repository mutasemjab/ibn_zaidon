<?php $__env->startSection('title', __('front.checkout_pay')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $cur        = __('front.currency');
    $cartTotal  = number_format(collect($courses)->sum('price'), 2);
    $cliqAlias  = \App\Models\SiteSetting::raw('cliq_alias');
?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo e(route('cart.index')); ?>"><?php echo e(__('front.shopping_cart')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(__('front.checkout_pay')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,1.9rem);margin:0">
            <i class="bi bi-credit-card-fill me-2"></i><?php echo e(__('front.checkout_pay')); ?>

        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 justify-content-center">

        
        <div class="col-lg-7">
            <div class="contact-card">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.5rem">
                    <i class="bi bi-wallet2 me-2"></i><?php echo e(__('front.checkout_choose_method')); ?>

                </h5>

                
                <?php if(session('activation_error')): ?>
                <div class="z-flash flash-error"><i class="bi bi-exclamation-circle-fill fs-5"></i><span><?php echo e(session('activation_error')); ?></span></div>
                <?php endif; ?>

                
                <div class="pay-tabs">
                    <button class="pay-tab active" data-target="pay-cash">
                        <i class="bi bi-cash-stack me-1"></i><?php echo e(__('front.pay_tab_cash')); ?>

                    </button>
                    <button class="pay-tab" data-target="pay-cliq">
                        <i class="bi bi-phone me-1"></i><?php echo e(__('front.pay_cliq')); ?>

                    </button>
                    <button class="pay-tab" data-target="pay-card">
                        <i class="bi bi-credit-card-2-front me-1"></i><?php echo e(__('front.pay_tab_card')); ?>

                    </button>
                </div>

                
                <div class="pay-panel active" id="pay-cash">
                    <div style="background:var(--z-section-bg);border-radius:var(--z-radius);padding:1.5rem;text-align:center;margin-bottom:1.25rem">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">💵</div>
                        <h6 style="color:var(--z-primary);font-weight:700"><?php echo e(__('front.pay_cash_title')); ?></h6>
                        <p style="color:var(--z-text-muted);font-size:.88rem;max-width:380px;margin:.5rem auto 0">
                            <?php echo e(__('front.pay_cash_desc')); ?>

                        </p>
                    </div>
                    <a href="<?php echo e(route('home')); ?>#contact" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-pin-map-fill"></i> <?php echo e(__('front.pay_cash_btn')); ?>

                    </a>
                </div>

                
                <div class="pay-panel" id="pay-cliq">
                    <div class="cliq-box mb-4">
                        <div style="font-size:.85rem;color:var(--z-text-muted);margin-bottom:.5rem"><?php echo e(__('front.pay_cliq_id')); ?></div>
                        <?php if($cliqAlias): ?>
                        <div class="cliq-alias"><?php echo e($cliqAlias); ?></div>
                        <?php endif; ?>
                        <div class="cliq-qr"><i class="bi bi-qr-code" style="font-size:2.5rem;opacity:.4"></i></div>
                        <p style="font-size:.82rem;color:var(--z-text-muted);margin:0">
                            <?php echo e(__('front.pay_cliq_steps')); ?><br>
                            <?php echo e(__('front.amount')); ?>: <strong style="color:var(--z-primary)"><?php echo e($cartTotal); ?> <?php echo e($cur); ?></strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="z-label"><?php echo e(__('front.pay_cliq_ref_label')); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="z-input" placeholder="<?php echo e(__('front.pay_cliq_ref_ph')); ?>" dir="ltr">
                        <span style="font-size:.8rem;color:var(--z-text-muted);margin-top:.35rem;display:block">
                            <?php echo e(__('front.pay_cliq_ref_hint')); ?>

                        </span>
                    </div>
                    <p style="font-size:.82rem;color:var(--z-text-muted);background:rgba(245,166,35,.07);border:1px solid rgba(245,166,35,.2);border-radius:8px;padding:.75rem">
                        <i class="bi bi-info-circle-fill me-1" style="color:var(--z-highlight)"></i>
                        <?php echo e(__('front.pay_cliq_note')); ?>

                    </p>
                    <button type="button" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-send-fill"></i> <?php echo e(__('front.pay_cliq_btn')); ?>

                    </button>
                </div>

                
                <div class="pay-panel" id="pay-card">
                    <form method="POST" action="<?php echo e(route('cart.activate')); ?>">
                        <?php echo csrf_field(); ?>
                        <div style="text-align:center;margin-bottom:1.5rem">
                            <div style="font-size:3rem;margin-bottom:.75rem">🎫</div>
                            <h6 style="color:var(--z-primary);font-weight:700"><?php echo e(__('front.pay_card_title')); ?></h6>
                            <p style="color:var(--z-text-muted);font-size:.87rem;max-width:360px;margin:.35rem auto 0">
                                <?php echo e(__('front.pay_card_desc')); ?>

                            </p>
                        </div>

                        <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="z-flash flash-error mb-3">
                            <i class="bi bi-exclamation-circle-fill"></i><span><?php echo e($message); ?></span>
                        </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="mb-4">
                            <label class="z-label"><?php echo e(__('front.pay_card_label')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="card_number"
                                   class="z-input code-input <?php echo e($errors->has('card_number') ? 'is-invalid' : ''); ?>"
                                   placeholder="XXXX-XXXX-XXXX-XXXX"
                                   value="<?php echo e(old('card_number')); ?>"
                                   autocomplete="off" dir="ltr" required>
                            <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <span style="font-size:.8rem;color:var(--z-text-muted);margin-top:.35rem;display:block">
                                <i class="bi bi-info-circle me-1"></i>
                                <?php echo e(__('front.pay_card_hint')); ?>

                            </span>
                        </div>

                        <button type="submit" class="btn-z btn-z-success btn-z-lg btn-z-block">
                            <i class="bi bi-key-fill"></i> <?php echo e(__('front.pay_card_btn')); ?>

                        </button>
                    </form>
                </div>

            </div>
        </div>

        
        <div class="col-lg-5">
            <div class="cart-summary">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem"><?php echo e(__('front.order_summary')); ?></h5>

                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="display:flex;align-items:center;gap:.75rem;padding:.6rem 0;border-bottom:1px solid var(--z-border)">
                    <div style="width:40px;height:30px;background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-play-fill" style="color:rgba(255,255,255,.5);font-size:.7rem"></i>
                    </div>
                    <span style="flex:1;font-size:.87rem;font-weight:600"><?php echo e(Str::limit($course->title, 35)); ?></span>
                    <span style="font-weight:700;color:var(--z-primary);font-size:.9rem;white-space:nowrap">
                        <?php echo e(($course->price??0)>0 ? number_format($course->price,2).' '.$cur : __('front.courses_free')); ?>

                    </span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="sum-row mt-2"><span><?php echo e(__('front.subtotal')); ?></span><span><?php echo e($cartTotal); ?> <?php echo e($cur); ?></span></div>
                <div class="sum-row sum-total"><span><?php echo e(__('front.total')); ?></span><span><?php echo e($cartTotal); ?> <?php echo e($cur); ?></span></div>

                <div class="mt-3 d-flex align-items-center gap-2" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-shield-fill-check" style="color:var(--z-success)"></i>
                    <?php echo e(__('front.pay_secure_note')); ?>

                </div>
                <div class="mt-2 d-flex align-items-center gap-2" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-infinity" style="color:var(--z-accent)"></i>
                    <?php echo e(__('front.pay_unlimited_note')); ?>

                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\checkout.blade.php ENDPATH**/ ?>