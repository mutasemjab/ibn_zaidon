
<?php $__env->startSection('title', __('messages.t_my_exams')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.t_my_exams')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.t_exams_sub')); ?></p>
    </div>
    <a href="<?php echo e(route('teacher.exams.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.t_new_exam')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.t_search')); ?>...">
            </div>
            <div class="col-6 col-md-3">
                <select name="course_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.t_all_courses')); ?></option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($course->id); ?>" <?php if(request('course_id') == $course->id): echo 'selected'; endif; ?>><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 30)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-3">
                <select name="exam_type" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.t_all_types')); ?></option>
                    <?php $__currentLoopData = ['mock','unit','final','practice','previous_years','placement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php if(request('exam_type') === $t): echo 'selected'; endif; ?>><?php echo e(ucfirst(str_replace('_',' ',$t))); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-2">
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
                    <th><?php echo e(__('messages.t_exam')); ?></th>
                    <th><?php echo e(__('messages.t_type')); ?></th>
                    <th><?php echo e(__('messages.t_course')); ?></th>
                    <th><?php echo e(__('messages.t_questions')); ?></th>
                    <th><?php echo e(__('messages.t_duration')); ?></th>
                    <th><?php echo e(__('messages.t_status')); ?></th>
                    <th><?php echo e(__('messages.t_actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="font-weight:500"><?php echo e(Str::limit($exam->title_en ?: $exam->title_ar, 40)); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(__('messages.t_pass')); ?>: <?php echo e($exam->pass_marks); ?>/<?php echo e($exam->total_marks); ?></div>
                    </td>
                    <td><span class="pill pill-neutral"><?php echo e(ucfirst(str_replace('_',' ',$exam->exam_type))); ?></span></td>
                    <td style="font-size:.83rem;color:var(--muted)"><?php echo e($exam->course ? Str::limit($exam->course->title_en ?: $exam->course->title_ar, 25) : '—'); ?></td>
                    <td><?php echo e($exam->questions->count()); ?></td>
                    <td><?php echo e($exam->duration_minutes); ?> <?php echo e(__('messages.t_min')); ?></td>
                    <td><span class="pill <?php echo e($exam->is_published ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($exam->is_published ? __('messages.t_live') : __('messages.t_draft')); ?></span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('teacher.exams.show', $exam->id)); ?>" class="btn-primary-sm" style="padding:4px 10px" title="<?php echo e(__('messages.t_manage_questions')); ?>"><i class="bi bi-list-check"></i></a>
                            <a href="<?php echo e(route('teacher.exams.edit', $exam->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('teacher.exams.destroy', $exam->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.t_confirm_delete_exam')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.t_no_exams_found')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if($exams->hasPages()): ?>
        <div class="p-3"><?php echo e($exams->withQueryString()->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\exams\index.blade.php ENDPATH**/ ?>