
<?php $__env->startSection('title', __('messages.teachers_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.teachers_title')); ?></h1><p class="page-sub"><?php echo e(__('messages.manage_teachers_desc')); ?></p></div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="<?php echo e(route('admin.teachers.export')); ?>?<?php echo e(http_build_query(request()->all())); ?>" class="btn-outline-sm">
            <i class="bi bi-file-earmark-arrow-down"></i> تصدير Excel
        </a>
        <button class="btn-outline-sm" type="button" data-bs-toggle="collapse" data-bs-target="#import-panel">
            <i class="bi bi-file-earmark-arrow-up"></i> استيراد Excel
        </button>
        <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_teacher')); ?></a>
    </div>
</div>


<div class="collapse mb-3" id="import-panel">
    <div class="panel-card">
        <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-file-earmark-arrow-up"></i> استيراد المعلمين من Excel</h2></div>
        <div class="panel-card-body">
            <p class="text-muted small mb-2">الأعمدة المطلوبة: <strong>الاسم</strong> (إلزامي)، البريد_الإلكتروني، الهاتف، التخصص، كلمة_المرور (افتراضي: Pass@1234)</p>
            <form action="<?php echo e(route('admin.teachers.import')); ?>" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-end flex-wrap">
                <?php echo csrf_field(); ?>
                <div>
                    <input type="file" name="file" class="form-control form-control-sm" accept=".xlsx,.xls,.csv" required>
                </div>
                <button type="submit" class="btn-primary-sm"><i class="bi bi-upload"></i> استيراد</button>
            </form>
        </div>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3"><?php echo e(session('error')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="بحث بالاسم أو البريد الإلكتروني أو الرقم الوطني">
            </div>
            <div class="col-6 col-md-3">
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
                <tr><th>#</th><th><?php echo e(__('messages.teacher')); ?></th><th><?php echo e(__('messages.specialization')); ?></th><th><?php echo e(__('messages.courses')); ?></th><th><?php echo e(__('messages.rating')); ?></th><th><?php echo e(__('messages.Status')); ?></th><th><?php echo e(__('messages.Actions')); ?></th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($teacher->id); ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <?php if($teacher->avatar): ?>
                                <img src="<?php echo e(asset('assets/uploads/teachers/'.$teacher->avatar)); ?>" class="avatar avatar-sm" alt="">
                            <?php else: ?>
                                <div class="avatar avatar-sm" style="background:#ecfdf5;color:#059669"><?php echo e(strtoupper(substr($teacher->name,0,1))); ?></div>
                            <?php endif; ?>
                            <div>
                                <div style="font-weight:500"><?php echo e($teacher->name); ?></div>
                                <div style="font-size:.75rem;color:var(--muted)"><?php echo e($teacher->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--muted)"><?php echo e($teacher->specialization_en ?: $teacher->specialization_ar ?: '—'); ?></td>
                    <td><?php echo e($teacher->courses_count); ?></td>
                    <td>
                        <span style="color:#ea580c;font-weight:600">
                            <i class="bi bi-star-fill" style="font-size:.75rem"></i> <?php echo e(number_format($teacher->average_rating, 1)); ?>

                        </span>
                    </td>
                    <td>
                        <span class="pill <?php echo e($teacher->is_active ? 'pill-success' : 'pill-neutral'); ?>">
                            <?php echo e($teacher->is_active ? __('messages.Active') : __('messages.Inactive')); ?>

                        </span>
                        <?php if($teacher->is_verified): ?><span class="pill pill-info"><?php echo e(__('messages.verified')); ?></span><?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.teachers.show', $teacher->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-eye"></i></a>
                            <a href="<?php echo e(route('admin.teachers.edit', $teacher->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('admin.teachers.destroy', $teacher->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.delete_teacher_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_teachers_found')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($teachers->withQueryString()->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\teachers\index.blade.php ENDPATH**/ ?>