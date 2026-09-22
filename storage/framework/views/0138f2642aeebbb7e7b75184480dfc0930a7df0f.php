<?php
    $u = auth('admin')->user();
?>

<aside class="sidebar" id="sidebar">

    
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <span class="brand-text"><?php echo e(__('messages.edu_platform')); ?></span>
    </div>

    <nav class="sidebar-nav">

        
        <div class="nav-label"><?php echo e(__('messages.main')); ?></div>
        <ul>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <span><?php echo e(__('messages.dashboard')); ?></span>
                </a>
            </li>
        </ul>

        
        <?php if($u?->canAny(['student-table','teacher-table','enrollment-table'])): ?>
        <div class="nav-label"><?php echo e(__('messages.users')); ?></div>
        <ul>
            <?php if($u?->can('student-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.students.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.students.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-mortarboard"></i>
                    <span><?php echo e(__('messages.students')); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('teacher-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.teachers.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.teachers.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-person-workspace"></i>
                    <span><?php echo e(__('messages.teachers')); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('enrollment-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.enrollments.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.enrollments.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-journal-check"></i>
                    <span><?php echo e(__('messages.enrollments')); ?></span>
                </a>
            </li>
            <?php endif; ?>

           
        </ul>
        <?php endif; ?>

        
        <?php
            $showAcademic = $u?->canAny([
                'course-table','category-table','subject-table','exam-table',
                'question-bank-table','previous-exam-table','worksheet-table',
                'banner-table','notification-send',
            ]) || $u?->is_super;
        ?>
        <?php if($showAcademic): ?>
        <div class="nav-label"><?php echo e(__('messages.academic')); ?></div>
        <ul>

            
            <?php if($u?->canAny(['course-table','course-add','category-table'])): ?>
            <li class="nav-item">
                <a href="#courses-menu" class="nav-link" data-submenu="courses-menu"
                   aria-expanded="<?php echo e(request()->routeIs('admin.courses.*','admin.categories.*') ? 'true' : 'false'); ?>">
                    <i class="nav-icon bi bi-book"></i>
                    <span><?php echo e(__('messages.courses')); ?></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </a>
                <ul class="nav-submenu <?php echo e(request()->routeIs('admin.courses.*','admin.categories.*') ? 'show' : ''); ?>" id="courses-menu">
                    <?php if($u?->can('course-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.courses.index')); ?>" class="nav-link">
                            <span><?php echo e(__('messages.all_courses')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($u?->can('course-add')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.courses.create')); ?>" class="nav-link">
                            <span><?php echo e(__('messages.add_course')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($u?->can('category-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="nav-link">
                            <span><?php echo e(__('messages.categories')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            
            <?php if($u?->can('subject-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.subjects.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.subjects.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-journals"></i>
                    <span><?php echo e(__('messages.subjects')); ?></span>
                </a>
            </li>
            <?php endif; ?>

            
            <?php if($u?->canAny(['exam-table','exam-add'])): ?>
            <li class="nav-item">
                <a href="#exams-menu" class="nav-link" data-submenu="exams-menu"
                   aria-expanded="<?php echo e(request()->routeIs('admin.exams.*') ? 'true' : 'false'); ?>">
                    <i class="nav-icon bi bi-clipboard-check"></i>
                    <span><?php echo e(__('messages.exams')); ?></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </a>
                <ul class="nav-submenu <?php echo e(request()->routeIs('admin.exams.*') ? 'show' : ''); ?>" id="exams-menu">
                    <?php if($u?->can('exam-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.exams.index')); ?>" class="nav-link">
                            <span><?php echo e(__('messages.all_exams')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($u?->can('exam-add')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.exams.create')); ?>" class="nav-link">
                            <span><?php echo e(__('messages.add_exam')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            
            <?php if($u?->canAny(['question-bank-table','previous-exam-table','worksheet-table'])): ?>
            <li class="nav-item">
                <a href="#pdf-menu" class="nav-link" data-submenu="pdf-menu"
                   aria-expanded="<?php echo e(request()->routeIs('admin.question-banks.*','admin.previous-year-exams.*','admin.worksheets.*') ? 'true' : 'false'); ?>">
                    <i class="nav-icon bi bi-file-earmark-pdf"></i>
                    <span><?php echo e(__('messages.pdf_files')); ?></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </a>
                <ul class="nav-submenu <?php echo e(request()->routeIs('admin.question-banks.*','admin.previous-year-exams.*','admin.worksheets.*') ? 'show' : ''); ?>" id="pdf-menu">
                    <?php if($u?->can('question-bank-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.question-banks.index')); ?>"
                           class="nav-link <?php echo e(request()->routeIs('admin.question-banks.*') ? 'active' : ''); ?>">
                            <span><?php echo e(__('messages.question_banks')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($u?->can('previous-exam-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.previous-year-exams.index')); ?>"
                           class="nav-link <?php echo e(request()->routeIs('admin.previous-year-exams.*') ? 'active' : ''); ?>">
                            <span><?php echo e(__('messages.previous_year_exams')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if($u?->can('worksheet-table')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.worksheets.index')); ?>"
                           class="nav-link <?php echo e(request()->routeIs('admin.worksheets.*') ? 'active' : ''); ?>">
                            <span><?php echo e(__('messages.worksheets')); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>


            
            <?php if($u?->can('banner-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.banners.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.banners.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-images"></i>
                    <span><?php echo e(__('messages.banners')); ?></span>
                </a>
            </li>
            <?php endif; ?>


            
            <?php if($u?->can('notification-send')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.notifications.send')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.notifications.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-bell"></i>
                    <span><?php echo e(__('messages.notifications')); ?></span>
                </a>
            </li>
            <?php endif; ?>



        </ul>
        <?php endif; ?>

        
        <?php if($u?->can('card-table')): ?>
        <div class="nav-label"><?php echo e(__('messages.cards_management')); ?></div>
        <ul>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.cards.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.cards.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-credit-card"></i>
                    <span><?php echo e(__('messages.cards')); ?></span>
                </a>
            </li>
        </ul>
        <?php endif; ?>

        
        <?php if($u?->canAny(['role-table','employee-table','activity-log-table','contact-message-table','setting-edit'])): ?>
        <div class="nav-label"><?php echo e(__('messages.system')); ?></div>
        <ul>
            <?php if($u?->can('role-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.role.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.role.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-shield-check"></i>
                    <span><?php echo e(__('messages.roles_permissions')); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('employee-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.employee.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.employee.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-people"></i>
                    <span>الموظفون</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('activity-log-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.activity-log.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.activity-log.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-clock-history"></i>
                    <span>سجل النشاطات</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('contact-message-table')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.contact_messages.index')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.contact_messages.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-envelope"></i>
                    <span><?php echo e(__('messages.contact_messages')); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if($u?->can('setting-edit')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.site-settings.edit')); ?>"
                   class="nav-link <?php echo e(request()->routeIs('admin.site-settings.*') ? 'active' : ''); ?>">
                    <i class="nav-icon bi bi-gear"></i>
                    <span><?php echo e(__('messages.site_settings')); ?></span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

    </nav>

    
    <div class="sidebar-footer">
        <ul>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.login.edit', auth('admin')->id())); ?>" class="nav-link">
                    <i class="nav-icon bi bi-gear"></i>
                    <span><?php echo e(__('messages.settings')); ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <span><?php echo e(__('messages.sign_out')); ?></span>
                </a>
            </li>
        </ul>
        <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" title="<?php echo e(__('messages.collapse_sidebar')); ?>">
            <i class="bi bi-arrow-bar-left"></i>
        </button>
    </div>

</aside>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\includes\sidebar.blade.php ENDPATH**/ ?>