<nav class="navbar" id="navbar">

    <button class="navbar-toggler" id="sidebarToggler" aria-label="<?php echo e(__('messages.t_toggle_sidebar')); ?>">
        <i class="bi bi-list"></i>
    </button>

    <div class="navbar-search">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="<?php echo e(__('messages.t_search_placeholder')); ?>" aria-label="<?php echo e(__('messages.t_search')); ?>">
        </div>
    </div>

    <div class="navbar-end">

       <a href="#"
           class="icon-btn"
           title="<?php echo e(__('messages.notifications')); ?>">
            <i class="bi bi-bell"></i>
            <span class="dot"></span>
        </a>

        <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($locale !== app()->getLocale()): ?>
                <a href="<?php echo e(LaravelLocalization::getLocalizedURL($locale, null, [], true)); ?>"
                   class="icon-btn"
                   hreflang="<?php echo e($locale); ?>">
                    <?php echo e(strtoupper($locale)); ?>

                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="nav-divider"></div>

        <div class="dropdown">
            <div class="user-menu" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar"><?php echo e(strtoupper(substr(auth('teacher')->user()->name ?? 'T', 0, 1))); ?></div>
                <div class="user-info">
                    <span class="user-name"><?php echo e(auth('teacher')->user()->name ?? ''); ?></span>
                    <span class="user-role"><?php echo e(__('messages.teacher')); ?></span>
                </div>
                <i class="bi bi-chevron-down ms-1" style="font-size:.65rem;color:var(--muted)"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border" style="border-radius:12px;min-width:180px;font-size:.845rem;">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?php echo e(route('teacher.profile')); ?>">
                        <i class="bi bi-person-circle" style="color:var(--muted)"></i> <?php echo e(__('messages.t_my_profile')); ?>

                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger" href="#"
                       onclick="event.preventDefault(); document.getElementById('teacher-logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> <?php echo e(__('messages.t_sign_out')); ?>

                    </a>
                    <form id="teacher-logout-form" action="<?php echo e(route('teacher.logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\includes\navbar.blade.php ENDPATH**/ ?>