<?php $__env->startSection('title', __('front.shopping_cart')); ?>

<?php $__env->startSection('content'); ?>
<?php $isRtl = app()->getLocale() === 'ar'; ?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(__('front.shopping_cart')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,1.9rem);margin:0">
            <i class="bi bi-cart3 me-2"></i><?php echo e(__('front.shopping_cart')); ?>

        </h1>
    </div>
</div>

<div class="container py-5">

    <?php if(session('cart_removed')): ?>
    <div class="z-flash flash-info"><i class="bi bi-info-circle-fill fs-5"></i><span><?php echo e(__('front.cart_removed_msg')); ?></span></div>
    <?php endif; ?>

    <?php if($courses->isEmpty()): ?>
    
    <div class="text-center py-5">
        <div style="font-size:5rem;color:var(--z-border);margin-bottom:1.5rem">🛒</div>
        <h4 style="color:var(--z-primary);font-weight:700"><?php echo e(__('front.cart_empty_title')); ?></h4>
        <p style="color:var(--z-text-muted);max-width:360px;margin:.75rem auto 1.75rem"><?php echo e(__('front.cart_empty_desc')); ?></p>
        <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-primary btn-z-lg">
            <i class="bi bi-search"></i> <?php echo e(__('front.browse_courses')); ?>

        </a>
    </div>
    <?php else: ?>
    <div class="row g-4">

        
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                <?php echo e(trans_choice('front.cart_items', $courses->count(), ['count' => $courses->count()])); ?>

            </h5>

            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cart-item">
                <div class="cart-thumb" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:8px">
                    <i class="bi bi-play-circle" style="color:rgba(255,255,255,.4);font-size:1.5rem"></i>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="cart-title"><?php echo e($course->title); ?></div>
                    <div class="cart-sub">
                        <i class="bi bi-person-fill me-1"></i><?php echo e($course->teacher->name ?? __('front.teacher_fallback')); ?>

                        <?php if($course->category): ?>
                        &nbsp;·&nbsp;<i class="bi bi-tag me-1"></i><?php echo e($course->category->name); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="cart-price">
                        <?php echo e(($course->price??0)>0 ? number_format($course->price,2).' '.__('front.currency') : __('front.courses_free')); ?>

                    </span>
                    <form method="POST" action="<?php echo e(route('cart.remove', $course->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-rm" title="<?php echo e(__('front.cart_remove')); ?>">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="col-lg-4">
            <div class="cart-summary">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem"><?php echo e(__('front.order_summary')); ?></h5>
                <div class="sum-row"><span><?php echo e(__('front.subtotal')); ?></span><span><?php echo e(number_format($subtotal, 2)); ?> <?php echo e(__('front.currency')); ?></span></div>
                <?php if($discount > 0): ?>
                <div class="sum-row" style="color:var(--z-success)"><span><?php echo e(__('front.discount')); ?></span><span>- <?php echo e(number_format($discount, 2)); ?> <?php echo e(__('front.currency')); ?></span></div>
                <?php endif; ?>
                <div class="sum-row sum-total"><span><?php echo e(__('front.total')); ?></span><span><?php echo e(number_format($total, 2)); ?> <?php echo e(__('front.currency')); ?></span></div>
                <div class="mt-4">
                    <?php if(auth()->guard('student')->check()): ?>
                    <a href="<?php echo e(route('cart.checkout')); ?>" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-credit-card-fill"></i> <?php echo e(__('front.checkout_pay')); ?>

                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('student.login')); ?>" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-person-fill"></i> <?php echo e(__('front.cart_login_continue')); ?>

                    </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-outline btn-z-block mt-2">
                        <i class="bi bi-arrow-<?php echo e($isRtl ? 'right' : 'left'); ?>"></i> <?php echo e(__('front.continue_shopping')); ?>

                    </a>
                </div>
                <div class="mt-3 text-center" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-shield-check-fill me-1" style="color:var(--z-success)"></i>
                    <?php echo e(__('front.cart_secure_note')); ?>

                </div>
            </div>
        </div>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\cart.blade.php ENDPATH**/ ?>