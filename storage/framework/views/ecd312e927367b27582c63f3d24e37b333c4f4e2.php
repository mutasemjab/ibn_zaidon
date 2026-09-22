
<?php $__env->startSection('title', __('messages.t_my_courses')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.t_my_courses')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.t_courses_sub')); ?></p>
    </div>
    <a href="<?php echo e(route('teacher.courses.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.t_new_course')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.t_search')); ?>...">
            </div>
            <div class="col-6 col-md-3">
                <select name="is_published" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.t_all')); ?></option>
                    <option value="1" <?php if(request('is_published') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.t_published')); ?></option>
                    <option value="0" <?php if(request('is_published') === '0'): echo 'selected'; endif; ?>><?php echo e(__('messages.t_draft')); ?></option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="panel-card h-100">
            <?php if($course->thumbnail): ?>
                <img src="<?php echo e(asset('uploads/courses/'.$course->thumbnail)); ?>" class="w-100" style="height:150px;object-fit:cover;border-radius:12px 12px 0 0" alt="">
            <?php else: ?>
                <div style="height:80px;background:linear-gradient(135deg,#7c3aed,#6d28d9);border-radius:12px 12px 0 0;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-book" style="color:#fff;font-size:2rem"></i>
                </div>
            <?php endif; ?>
            <div class="panel-card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h3 style="font-size:.95rem;font-weight:600;flex:1"><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 45)); ?></h3>
                    <span class="pill <?php echo e($course->is_published ? 'pill-success' : 'pill-neutral'); ?> ms-2">
                        <?php echo e($course->is_published ? __('messages.t_live') : __('messages.t_draft')); ?>

                    </span>
                </div>
                <div class="d-flex gap-3 mb-3" style="font-size:.8rem;color:var(--muted)">
                    <span><i class="bi bi-people"></i> <?php echo e($course->class_students_count ?? $course->enrollments_count); ?> <?php echo e(__('messages.t_students_enrolled')); ?></span>
                    <span><i class="bi bi-star-fill" style="color:#ea580c"></i> <?php echo e(number_format($course->average_rating, 1)); ?></span>
                    <span><i class="bi bi-currency-dollar"></i> <?php echo e($course->is_free ? __('messages.t_free') : number_format($course->price)); ?></span>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?php echo e(route('teacher.courses.show', $course->id)); ?>" class="btn-primary-sm flex-1 justify-content-center">
                        <i class="bi bi-layout-text-sidebar"></i> <?php echo e(__('messages.t_manage')); ?>

                    </a>
                    <a href="<?php echo e(route('teacher.courses.progress', $course->id)); ?>" class="btn-outline-sm" style="padding:6px 10px" title="تقدم الطلاب"><i class="bi bi-bar-chart-line"></i></a>
                    <a href="<?php echo e(route('teacher.courses.edit', $course->id)); ?>" class="btn-outline-sm" style="padding:6px 10px"><i class="bi bi-pencil"></i></a>
                    <form action="<?php echo e(route('teacher.courses.destroy', $course->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.t_confirm_delete')); ?>')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn-outline-sm" style="padding:6px 10px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12">
        <div class="panel-card text-center py-5" style="color:var(--muted)">
            <i class="bi bi-book" style="font-size:3rem;display:block;margin-bottom:12px"></i>
            <p><?php echo e(__('messages.t_no_courses_yet')); ?></p>
            <a href="<?php echo e(route('teacher.courses.create')); ?>" class="btn-primary-sm"><?php echo e(__('messages.t_create_first_course')); ?></a>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if($courses->hasPages()): ?>
<div class="mt-3"><?php echo e($courses->withQueryString()->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\courses\index.blade.php ENDPATH**/ ?>