
<?php $__env->startSection('title', __('messages.courses_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.courses_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_courses_desc')); ?></p>
    </div>
    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_course')); ?>

    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>


<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_title_ph')); ?>">
            </div>
            <div class="col-6 col-md-3">
                <select name="category_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_categories')); ?></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php if(request('category_id') == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name_en); ?></option>
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
                <select name="teacher_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_teachers')); ?></option>
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t->id); ?>" <?php if(request('teacher_id') == $t->id): echo 'selected'; endif; ?>><?php echo e($t->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-1">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="panel-card">
    <div class="panel-card-body p-0">
        <div style="overflow-x:auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__('messages.course')); ?></th>
                        <th><?php echo e(__('messages.teacher')); ?></th>
                        <th><?php echo e(__('messages.category')); ?></th>
                        <th><?php echo e(__('messages.price')); ?></th>
                        <th><?php echo e(__('messages.students')); ?></th>
                        <th><?php echo e(__('messages.Status')); ?></th>
                        <th><?php echo e(__('messages.Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:var(--muted)"><?php echo e($course->id); ?></td>
                        <td>
                            <div style="font-weight:500"><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 35)); ?></div>
                            <div style="font-size:.72rem;color:var(--muted)"><?php echo e($course->title_ar); ?></div>
                        </td>
                        <td style="color:var(--muted)"><?php echo e($course->teacher->name ?? '—'); ?></td>
                        <td><span class="pill pill-info"><?php echo e($course->category->name_en ?? '—'); ?></span></td>
                        <td>
                            <?php if($course->is_free): ?>
                                <span class="pill pill-success"><?php echo e(__('messages.free')); ?></span>
                            <?php else: ?>
                                <span style="font-weight:600">$<?php echo e(number_format($course->price, 0)); ?></span>
                                <?php if($course->old_price): ?>
                                    <span style="text-decoration:line-through;color:var(--muted);font-size:.78rem">$<?php echo e(number_format($course->old_price, 0)); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($course->class_students_count ?? $course->enrollments_count); ?></td>
                        <td>
                            <span class="pill <?php echo e($course->is_published ? 'pill-success' : 'pill-neutral'); ?>">
                                <?php echo e($course->is_published ? __('messages.published') : __('messages.draft')); ?>

                            </span>
                            <?php if($course->is_featured): ?>
                                <span class="pill pill-warning"><?php echo e(__('messages.featured')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('admin.courses.show', $course->id)); ?>" class="btn-outline-sm" style="padding:4px 8px" title="<?php echo e(__('messages.View')); ?>">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.courses.progress', $course->id)); ?>" class="btn-outline-sm" style="padding:4px 8px" title="تقدم الطلاب">
                                    <i class="bi bi-bar-chart-line"></i>
                                </a>
                                <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>" class="btn-outline-sm" style="padding:4px 8px" title="<?php echo e(__('messages.Edit')); ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST"
                                      onsubmit="return confirm('<?php echo e(__('messages.delete_course_confirm')); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca" title="<?php echo e(__('messages.Delete')); ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_courses_found')); ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3"><?php echo e($courses->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\courses\index.blade.php ENDPATH**/ ?>