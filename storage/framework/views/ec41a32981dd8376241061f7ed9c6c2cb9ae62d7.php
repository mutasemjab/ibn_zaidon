
<?php $__env->startSection('title', __('messages.enrollments_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.enrollments_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.enrollments_desc')); ?></p>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_student_ph')); ?>">
            </div>
            <div class="col-12 col-md-3">
                <select name="course_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_courses')); ?></option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($course->id); ?>" <?php if(request('course_id') == $course->id): echo 'selected'; endif; ?>>
                        <?php echo e($course->title_en ?: $course->title_ar); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="is_active" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.All Status')); ?></option>
                    <option value="1" <?php if(request('is_active') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.Active')); ?></option>
                    <option value="0" <?php if(request('is_active') === '0'): echo 'selected'; endif; ?>><?php echo e(__('messages.Inactive')); ?></option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('messages.student')); ?></th>
                    <th><?php echo e(__('messages.course')); ?></th>
                    <th><?php echo e(__('messages.progress')); ?></th>
                    <th><?php echo e(__('messages.enrolled_at')); ?></th>
                    <th><?php echo e(__('messages.Status')); ?></th>
                    <th><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $en): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($en->id); ?></td>
                    <td>
                        <div style="font-weight:500"><?php echo e($en->student->name ?? '—'); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e($en->student->email ?? ''); ?></div>
                    </td>
                    <td>
                        <div style="font-size:.85rem;font-weight:500"><?php echo e($en->course->title_en ?? $en->course->title_ar ?? '—'); ?></div>
                        <?php if($en->course && !$en->course->is_free): ?>
                            <span class="pill pill-info" style="font-size:.65rem"><?php echo e(__('messages.paid')); ?></span>
                        <?php else: ?>
                            <span class="pill pill-success" style="font-size:.65rem"><?php echo e(__('messages.free')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="flex:1;height:6px;background:#e2e8f0;border-radius:4px;overflow:hidden">
                                <div style="height:6px;background:var(--primary);border-radius:4px;width:<?php echo e($en->progress_percentage ?? 0); ?>%"></div>
                            </div>
                            <span style="font-size:.75rem;color:var(--muted)"><?php echo e($en->progress_percentage ?? 0); ?>%</span>
                        </div>
                        <?php if($en->is_completed): ?>
                            <span class="pill pill-success" style="font-size:.65rem"><?php echo e(__('messages.completed')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td style="color:var(--muted);font-size:.83rem"><?php echo e($en->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <span class="pill <?php echo e($en->is_active ? 'pill-success' : 'pill-neutral'); ?>">
                            <?php echo e($en->is_active ? __('messages.Active') : __('messages.Inactive')); ?>

                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <form action="<?php echo e(route('admin.enrollments.toggle', $en->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px" title="<?php echo e($en->is_active ? __('messages.deactivate') : __('messages.activate')); ?>">
                                    <i class="bi bi-<?php echo e($en->is_active ? 'pause-circle' : 'play-circle'); ?>"></i>
                                </button>
                            </form>
                            <form action="<?php echo e(route('admin.enrollments.destroy', $en->id)); ?>" method="POST"
                                  onsubmit="return confirm('<?php echo e(__('messages.delete_enrollment_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_enrollments_yet')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($enrollments->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\enrollments\index.blade.php ENDPATH**/ ?>