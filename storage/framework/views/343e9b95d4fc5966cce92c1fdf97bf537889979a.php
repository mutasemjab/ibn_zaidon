
<?php $__env->startSection('title', __('messages.subjects_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.subjects_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_subjects_desc')); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-outline-sm">
            <i class="bi bi-diagram-3"></i> <?php echo e(__('messages.categories_title')); ?>

        </a>
        <a href="<?php echo e(route('admin.subjects.create')); ?>" class="btn-primary-sm">
            <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_subject')); ?>

        </a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                       class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_subject_ph')); ?>">
            </div>
            <div class="col-12 col-md-5">
                <select name="category_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_categories')); ?></option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php if(request('category_id') == $cat->id): echo 'selected'; endif; ?>>
                            <?php echo e(str_repeat('— ', $cat->level)); ?><?php echo e($cat->name_ar); ?> (<?php echo e($cat->name_en); ?>)
                        </option>
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
                    <th>#</th>
                    <th><?php echo e(__('messages.subject_ar')); ?></th>
                    <th><?php echo e(__('messages.subject_en')); ?></th>
                    <th><?php echo e(__('messages.full_path')); ?></th>
                    <th><?php echo e(__('messages.Status')); ?></th>
                    <th><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($subject->id); ?></td>
                    <td>
                        <div style="font-weight:600" dir="rtl"><?php echo e($subject->name_ar); ?></div>
                    </td>
                    <td><?php echo e($subject->name_en ?: '—'); ?></td>
                    <td style="color:var(--muted);font-size:.8rem"><?php echo e($subject->full_path); ?></td>
                    <td>
                        <span class="pill <?php echo e($subject->is_active ? 'pill-success' : 'pill-neutral'); ?>">
                            <?php echo e($subject->is_active ? __('messages.Active') : __('messages.Inactive')); ?>

                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.subjects.edit', $subject->id)); ?>"
                               class="btn-outline-sm" style="padding:4px 8px">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.subjects.destroy', $subject->id)); ?>" method="POST"
                                  onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-4" style="color:var(--muted)">
                        <?php echo e(__('messages.no_subjects_yet')); ?>

                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($subjects->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\subjects\index.blade.php ENDPATH**/ ?>