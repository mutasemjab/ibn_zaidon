

<?php $__env->startSection('title', __('messages.page_dashboard')); ?>

<?php $__env->startSection('content'); ?>


<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.page_dashboard')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.welcome_back')); ?></p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><?php echo e(__('messages.page_dashboard')); ?></li>
        </ol>
    </nav>
</div>


<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>


<div class="row g-3 mb-4">

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#2563eb">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($stats['total_students'])); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_students')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-people trend-up"></i>
                <span style="color:var(--muted)"><?php echo e(__('messages.registered')); ?></span>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;color:#059669">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($stats['total_teachers'])); ?></div>
            <div class="stat-label"><?php echo e(__('messages.active_teachers')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-check-circle trend-up"></i>
                <span style="color:var(--muted)"><?php echo e(__('messages.active')); ?></span>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed">
                <i class="bi bi-book-fill"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($stats['total_courses'])); ?></div>
            <div class="stat-label"><?php echo e(__('messages.published_courses')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-right trend-up"></i>
                <span class="trend-up"><?php echo e(number_format($stats['total_enrollments'])); ?></span>
                <span style="color:var(--muted)"><?php echo e(__('messages.enrollments')); ?></span>
            </div>
        </div>
    </div>


</div>


<div class="row g-3 mb-3">

    
    <div class="col-12 col-xl-8">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.recent_enrollments')); ?></h2>
                <a href="<?php echo e(route('admin.students.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.view_all')); ?></a>
            </div>
            <div class="panel-card-body p-0">
                <div style="overflow-x:auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('messages.student')); ?></th>
                                <th><?php echo e(__('messages.course')); ?></th>
                                <th><?php echo e(__('messages.teacher')); ?></th>
                                <th><?php echo e(__('messages.date')); ?></th>
                                <th><?php echo e(__('messages.progress')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentEnrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm" style="background:#eff6ff;color:#2563eb">
                                            <?php echo e(strtoupper(substr($enrollment->student->name ?? 'U', 0, 1))); ?>

                                        </div>
                                        <span style="font-weight:500"><?php echo e($enrollment->student->name ?? '—'); ?></span>
                                    </div>
                                </td>
                                <td><?php echo e($enrollment->course->title_en ?? $enrollment->course->title_ar ?? '—'); ?></td>
                                <td style="color:var(--muted)"><?php echo e($enrollment->course->teacher->name ?? '—'); ?></td>
                                <td style="color:var(--muted)"><?php echo e($enrollment->enrolled_at->format('M d, Y')); ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="prog-track" style="width:60px">
                                            <div class="prog-fill" style="width:<?php echo e($enrollment->progress_percentage); ?>%"></div>
                                        </div>
                                        <span style="font-size:.75rem"><?php echo e($enrollment->progress_percentage); ?>%</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_enrollments_yet')); ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-xl-4">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.new_messages')); ?></h2>
                <a href="<?php echo e(route('admin.contact_messages.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.view_all')); ?></a>
            </div>
            <div class="panel-card-body">
                <?php $__empty_1 = true; $__currentLoopData = $recentContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#eff6ff;color:#2563eb">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title"><?php echo e($msg->first_name); ?> <?php echo e($msg->last_name); ?></div>
                        <div class="activity-time"><?php echo e(Str::limit($msg->subject, 40)); ?> · <?php echo e($msg->created_at->diffForHumans()); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center py-3" style="color:var(--muted);font-size:.85rem"><?php echo e(__('messages.no_new_messages')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<div class="row g-3">

    
    <div class="col-12 col-md-6 col-xl-4">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.top_courses')); ?></h2>
                <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.see_all')); ?></a>
            </div>
            <div class="panel-card-body">
                <?php $colors = ['#2563eb','#059669','#7c3aed','#ea580c','#dc2626']; ?>
                <?php $__empty_1 = true; $__currentLoopData = $topCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $max = $topCourses->first()->enrollments_count ?: 1;
                    $pct = (int) round(($course->enrollments_count / $max) * 100);
                ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-baseline mb-1">
                        <span style="font-size:.845rem;font-weight:500"><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 28)); ?></span>
                        <span style="font-size:.75rem;color:var(--muted)"><?php echo e($course->enrollments_count); ?> <?php echo e(__('messages.students_count')); ?></span>
                    </div>
                    <div class="prog-track">
                        <div class="prog-fill" style="width:<?php echo e($pct); ?>%;background:<?php echo e($colors[$i % 5]); ?>"></div>
                    </div>
                    <div style="font-size:.72rem;color:var(--muted);margin-top:3px"><?php echo e($course->teacher->name ?? '—'); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center py-3" style="color:var(--muted);font-size:.85rem"><?php echo e(__('messages.no_courses_yet')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-md-6 col-xl-4">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.platform_overview')); ?></h2>
            </div>
            <div class="panel-card-body">
                <?php
                    $metrics = [
                        ['bi-check-circle','#f0fdf4','#059669',__('messages.courses_completed'), number_format($stats['courses_completed'])],
                        ['bi-star-fill',   '#fff7ed','#ea580c',__('messages.avg_rating'),       number_format($stats['avg_rating'], 1) . ' / 5'],
                        ['bi-book',        '#eff6ff','#2563eb',__('messages.total_enrollments'), number_format($stats['total_enrollments'])],
                        ['bi-envelope',    '#fef2f2','#dc2626',__('messages.unread_messages'),   number_format($stats['unread_messages'])],
                    ];
                ?>
                <?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon mb-0" style="width:42px;height:42px;border-radius:10px;background:<?php echo e($m[1]); ?>;color:<?php echo e($m[2]); ?>;font-size:1.1rem">
                        <i class="bi <?php echo e($m[0]); ?>"></i>
                    </div>
                    <div>
                        <div style="font-size:.78rem;color:var(--muted)"><?php echo e($m[3]); ?></div>
                        <div style="font-size:1rem;font-weight:700"><?php echo e($m[4]); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-xl-4">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.quick_actions')); ?></h2>
            </div>
            <div class="panel-card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('admin.students.create')); ?>" class="btn-primary-sm justify-content-center" style="padding:12px">
                        <i class="bi bi-person-plus"></i> <?php echo e(__('messages.add_new_student')); ?>

                    </a>
                    <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn-outline-sm justify-content-center" style="padding:12px">
                        <i class="bi bi-person-workspace"></i> <?php echo e(__('messages.add_new_teacher')); ?>

                    </a>
                    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn-outline-sm justify-content-center" style="padding:12px">
                        <i class="bi bi-book"></i> <?php echo e(__('messages.create_course')); ?>

                    </a>
                    <a href="<?php echo e(route('admin.contact_messages.index')); ?>" class="btn-outline-sm justify-content-center" style="padding:12px">
                        <i class="bi bi-envelope"></i> <?php echo e(__('messages.view_messages')); ?>

                        <?php if($stats['unread_messages'] > 0): ?>
                            <span class="pill pill-warning ms-1"><?php echo e($stats['unread_messages']); ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>