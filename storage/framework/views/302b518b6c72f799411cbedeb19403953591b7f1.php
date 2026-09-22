<?php
    $cartCount   = count(session('cart', []));
    $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
    $switchUrl   = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
?>

<nav class="z-navbar">
    <div class="container z-nav-wrap">

        
        <?php
            $brandName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
            $brandLogo = \App\Models\SiteSetting::raw('site_logo');
        ?>
        <a href="<?php echo e(route('home')); ?>" class="z-brand">
            <?php if($brandLogo): ?>
                <span class="z-brand-logo-wrap">
                    <img src="<?php echo e(asset('assets/uploads/site/' . $brandLogo)); ?>" alt="<?php echo e($brandName); ?>" class="z-brand-logo">
                </span>
            <?php else: ?>
                <span class="z-brand-icon"><?php echo e(mb_substr($brandName, 0, 1)); ?></span>
                <span><?php echo e($brandName); ?></span>
            <?php endif; ?>
        </a>

        
        <ul class="z-nav-links">
            <li><a href="<?php echo e(route('home')); ?>#hero"
                   class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"><?php echo e(__('front.nav_home')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('front.nav_about')); ?></a></li>
            <li><a href="<?php echo e(route('courses.index')); ?>"
                   class="<?php echo e(request()->routeIs('courses.*') ? 'active' : ''); ?>"><?php echo e(__('front.nav_courses')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#services"><?php echo e(__('front.nav_services')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#teachers"><?php echo e(__('front.nav_teachers')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#contact"><?php echo e(__('front.nav_contact')); ?></a></li>
            <li class="exam-link">
                <a href="<?php echo e(route('exams.index')); ?>"
                   class="<?php echo e(request()->routeIs('exams.*') ? 'active' : ''); ?>">
                    <i class="bi bi-clipboard-check me-1"></i><?php echo e(__('front.nav_exams')); ?>

                </a>
            </li>
        </ul>

        
        <div class="z-nav-actions">

            
            <a href="<?php echo e($switchUrl); ?>" class="btn-z btn-z-ghost btn-z-sm" hreflang="<?php echo e($otherLocale); ?>" lang="<?php echo e($otherLocale); ?>">
                <i class="bi bi-translate"></i> <?php echo e(__('front.switch_to_' . $otherLocale)); ?>

            </a>

            
            <a href="<?php echo e(route('cart.index')); ?>" class="cart-btn" title="<?php echo e(__('front.nav_cart')); ?>">
                <i class="bi bi-cart3"></i>
                <?php if($cartCount > 0): ?>
                    <span class="cart-count"><?php echo e($cartCount); ?></span>
                <?php endif; ?>
            </a>

            
            <?php if(auth()->guard('student')->check()): ?>
                <div class="dropdown">
                    <button class="btn-z btn-z-ghost btn-z-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-md-inline"><?php echo e(auth('student')->user()->name); ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo e(route('home')); ?>">
                            <i class="bi bi-house me-2"></i><?php echo e(__('front.nav_profile')); ?>

                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('student.logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i><?php echo e(__('front.nav_logout')); ?>

                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('student.login')); ?>" class="btn-z btn-z-ghost btn-z-sm">
                    <i class="bi bi-person"></i>
                    <span class="d-none d-sm-inline"><?php echo e(__('front.nav_login')); ?></span>
                </a>
                <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-accent btn-z-sm">
                    <i class="bi bi-person-plus"></i>
                    <span class="d-none d-sm-inline"><?php echo e(__('front.nav_register')); ?></span>
                </a>
            <?php endif; ?>

            
            <button class="z-mobile-toggle" id="mobileToggle" aria-label="<?php echo e(__('front.nav_open_menu')); ?>">
                <span></span><span></span><span></span>
            </button>

        </div>
    </div>

    
    <div class="z-mobile-menu" id="mobileMenu">
        <ul class="z-nav-links mb-3">
            <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.nav_home')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#about"><?php echo e(__('front.nav_about')); ?></a></li>
            <li><a href="<?php echo e(route('courses.index')); ?>"><?php echo e(__('front.nav_courses')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#services"><?php echo e(__('front.nav_services')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#teachers"><?php echo e(__('front.nav_teachers')); ?></a></li>
            <li><a href="<?php echo e(route('home')); ?>#contact"><?php echo e(__('front.nav_contact')); ?></a></li>
            <li class="exam-link"><a href="<?php echo e(route('exams.index')); ?>"><?php echo e(__('front.nav_exams')); ?></a></li>
        </ul>
        <div class="z-nav-actions border-top border-white border-opacity-10 pt-3 mt-2">
            <a href="<?php echo e($switchUrl); ?>" class="btn-z btn-z-ghost btn-z-sm me-1" hreflang="<?php echo e($otherLocale); ?>" lang="<?php echo e($otherLocale); ?>">
                <i class="bi bi-translate"></i> <?php echo e(__('front.switch_to_' . $otherLocale)); ?>

            </a>
            <?php if(auth()->guard('student')->check()): ?>
                <span class="text-white-50 small me-2"><?php echo e(auth('student')->user()->name); ?></span>
                <form method="POST" action="<?php echo e(route('student.logout')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-z btn-z-danger btn-z-sm"><?php echo e(__('front.nav_logout')); ?></button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('student.login')); ?>" class="btn-z btn-z-ghost btn-z-sm me-1"><?php echo e(__('front.nav_login')); ?></a>
                <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-accent btn-z-sm"><?php echo e(__('front.nav_register')); ?></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\includes\navbar.blade.php ENDPATH**/ ?>