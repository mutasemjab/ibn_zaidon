
<?php $__env->startSection('title', __('messages.exams_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.exams_title')); ?></h1><p class="page-sub"><?php echo e(__('messages.manage_exams_desc')); ?></p></div>
    <a href="<?php echo e(route('admin.exams.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_exam')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_exam_title_ph')); ?>">
            </div>
            <div class="col-6 col-md-2">
                <select name="exam_type" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_types')); ?></option>
                    <?php $__currentLoopData = ['mock','unit','final','practice','previous_years','placement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php if(request('exam_type') === $type): echo 'selected'; endif; ?>><?php echo e(__('messages.'.$type)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="is_published" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.All Status')); ?></option>
                    <option value="1" <?php if(request('is_published') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.published')); ?></option>
                    <option value="0" <?php if(request('is_published') === '0'): echo 'selected'; endif; ?>><?php echo e(__('messages.draft')); ?></option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="course_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_courses')); ?></option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>" <?php if(request('course_id') == $c->id): echo 'selected'; endif; ?>><?php echo e(Str::limit($c->title_en ?: $c->title_ar, 25)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <tr><th>#</th><th><?php echo e(__('messages.exam')); ?></th><th><?php echo e(__('messages.type_label')); ?></th><th><?php echo e(__('messages.questions')); ?></th><th><?php echo e(__('messages.duration')); ?></th><th><?php echo e(__('messages.attempts')); ?></th><th><?php echo e(__('messages.Status')); ?></th><th><?php echo e(__('messages.Actions')); ?></th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($exam->id); ?></td>
                    <td>
                        <div style="font-weight:500"><?php echo e(Str::limit($exam->title_en ?: $exam->title_ar, 35)); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e($exam->course->title_en ?? __('messages.standalone')); ?></div>
                    </td>
                    <td><span class="pill pill-info"><?php echo e(__('messages.'.$exam->exam_type)); ?></span></td>
                    <td><?php echo e($exam->questions_count); ?></td>
                    <td><?php echo e($exam->duration_minutes); ?> <?php echo e(__('messages.min_label')); ?></td>
                    <td><?php echo e($exam->total_attempts); ?></td>
                    <td><span class="pill <?php echo e($exam->is_published ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($exam->is_published ? __('messages.published') : __('messages.draft')); ?></span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.exams.show', $exam->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo e(route('admin.exams.edit', $exam->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('admin.exams.destroy', $exam->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.delete_exam_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_exams_found')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($exams->withQueryString()->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\exams\index.blade.php ENDPATH**/ ?>