

<?php $__env->startSection('title', __('messages.t_dashboard')); ?>

<?php $__env->startSection('content'); ?>


<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.t_dashboard')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.t_welcome_back')); ?>, <?php echo e($teacher->name); ?>!</p>
    </div>
    <a href="<?php echo e(route('teacher.courses.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.t_create_course')); ?>

    </a>
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
            <div class="stat-icon" style="background:#ecfdf5;color:#059669">
                <i class="bi bi-book-fill"></i>
            </div>
            <div class="stat-value"><?php echo e($stats['total_courses']); ?></div>
            <div class="stat-label"><?php echo e(__('messages.t_my_courses')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-book trend-up"></i>
                <span style="color:var(--muted)"><?php echo e(__('messages.t_published')); ?></span>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff;color:#2563eb">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($stats['total_students'])); ?></div>
            <div class="stat-label"><?php echo e(__('messages.t_total_students')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up-right trend-up"></i>
                <span style="color:var(--muted)"><?php echo e(__('messages.t_enrolled')); ?></span>
            </div>
        </div>
    </div>



    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#faf5ff;color:#7c3aed">
                <i class="bi bi-star-fill"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($stats['avg_rating'], 1)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.t_avg_rating')); ?></div>
            <div class="stat-trend">
                <i class="bi bi-star" style="color:#ea580c"></i>
                <span style="color:var(--muted)"><?php echo e(__('messages.t_out_of_5')); ?></span>
            </div>
        </div>
    </div>

</div>

<div class="row g-3 mb-3">

    
    <div class="col-12 col-xl-7">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.t_my_courses')); ?></h2>
                <a href="<?php echo e(route('teacher.courses.index')); ?>" class="btn-outline-sm"><?php echo e(__('messages.t_all_courses')); ?></a>
            </div>
            <div class="panel-card-body p-0">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><?php echo e(__('messages.t_course')); ?></th>
                            <th><?php echo e(__('messages.t_students')); ?></th>
                            <th><?php echo e(__('messages.t_rating')); ?></th>
                            <th><?php echo e(__('messages.t_status')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $myCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-weight:500"><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 32)); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-people" style="color:var(--muted);font-size:.8rem"></i>
                                    <span><?php echo e($course->enrollments_count); ?></span>
                                </div>
                            </td>
                            <td>
                                <span style="color:#ea580c;font-weight:600">
                                    <i class="bi bi-star-fill" style="font-size:.75rem"></i> <?php echo e(number_format($course->average_rating, 1)); ?>

                                </span>
                            </td>
                            <td>
                                <span class="pill <?php echo e($course->is_published ? 'pill-success' : 'pill-neutral'); ?>">
                                    <?php echo e($course->is_published ? __('messages.t_published') : __('messages.t_draft')); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('teacher.courses.show', $course->id)); ?>" class="btn-outline-sm" style="padding:4px 10px;font-size:.75rem">
                                    <?php echo e(__('messages.t_manage')); ?>

                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4" style="color:var(--muted)">
                                <?php echo e(__('messages.t_no_courses_yet')); ?>. <a href="<?php echo e(route('teacher.courses.create')); ?>"><?php echo e(__('messages.t_create_first_course')); ?></a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-xl-5">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.t_recent_enrollments')); ?></h2>
            </div>
            <div class="panel-card-body">
                <?php $__empty_1 = true; $__currentLoopData = $recentEnrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="d-flex align-items-center gap-3 mb-3 pb-3" style="border-bottom:1px solid var(--border)">
                    <div class="avatar avatar-sm" style="background:var(--primary-light);color:var(--primary)">
                        <?php echo e(strtoupper(substr($enrollment->student->name ?? 'U', 0, 1))); ?>

                    </div>
                    <div style="flex:1">
                        <div style="font-size:.845rem;font-weight:500"><?php echo e($enrollment->student->name ?? '—'); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(Str::limit($enrollment->course->title_en ?: $enrollment->course->title_ar, 30)); ?></div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:.72rem;color:var(--muted)"><?php echo e($enrollment->enrolled_at->diffForHumans()); ?></div>
                        <div style="font-size:.78rem;font-weight:600;color:var(--primary)"><?php echo e($enrollment->progress_percentage); ?>%</div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-center py-3" style="color:var(--muted);font-size:.85rem"><?php echo e(__('messages.t_no_enrollments_yet')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<div class="row g-3">

    
    <div class="col-12 col-md-6">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.t_my_profile')); ?></h2>
                <a href="<?php echo e(route('teacher.profile')); ?>" class="btn-outline-sm"><?php echo e(__('messages.t_edit_profile')); ?></a>
            </div>
            <div class="panel-card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <?php if($teacher->avatar): ?>
                        <img src="<?php echo e(asset('uploads/teachers/' . $teacher->avatar)); ?>" class="avatar" style="width:56px;height:56px" alt="">
                    <?php else: ?>
                        <div class="avatar" style="width:56px;height:56px;background:var(--primary-light);color:var(--primary);font-size:1.4rem">
                            <?php echo e(strtoupper(substr($teacher->name, 0, 1))); ?>

                        </div>
                    <?php endif; ?>
                    <div>
                        <div style="font-weight:600;font-size:1rem"><?php echo e($teacher->name); ?></div>
                        <div style="color:var(--muted);font-size:.83rem"><?php echo e($teacher->specialization_en ?: $teacher->specialization_ar ?: __('messages.teacher')); ?></div>
                    </div>
                </div>
                <?php if($teacher->bio_en ?: $teacher->bio_ar): ?>
                <p style="font-size:.83rem;color:var(--muted)"><?php echo e(Str::limit($teacher->bio_en ?: $teacher->bio_ar, 120)); ?></p>
                <?php endif; ?>
                <div class="d-flex gap-2 flex-wrap">

                    <?php if($teacher->is_verified): ?>
                    <span class="pill pill-success"><i class="bi bi-patch-check"></i> <?php echo e(__('messages.t_verified')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\dashboard.blade.php ENDPATH**/ ?>