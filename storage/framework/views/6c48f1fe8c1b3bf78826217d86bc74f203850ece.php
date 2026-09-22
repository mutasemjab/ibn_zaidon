
<?php $__env->startSection('title', 'الأدوار الوظيفية'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">الأدوار الوظيفية</h1>
        <p class="page-sub">إدارة الأدوار وصلاحياتها</p>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-add')): ?>
    <a href="<?php echo e(route('admin.role.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> إضافة دور جديد
    </a>
    <?php endif; ?>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                    class="form-control form-control-sm" placeholder="ابحث باسم الدور...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-search"></i></button>
            </div>
            <?php if(request('search')): ?>
            <div class="col-auto">
                <a href="<?php echo e(route('admin.role.index')); ?>" class="btn-outline-sm"><i class="bi bi-x"></i> مسح</a>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-shield-lock"></i> قائمة الأدوار</h2>
        <span class="pill pill-info"><?php echo e($roles->total()); ?> دور</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الدور</th>
                        <th>عدد الصلاحيات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration + ($roles->currentPage() - 1) * $roles->perPage()); ?></td>
                        <td><span class="fw-semibold"><?php echo e($role->name); ?></span></td>
                        <td>
                            <span class="pill pill-<?php echo e($role->permissions_count > 0 ? 'success' : 'neutral'); ?>">
                                <?php echo e($role->permissions_count); ?> صلاحية
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
                                <a href="<?php echo e(route('admin.role.edit', $role->id)); ?>"
                                   class="btn-icon-sm btn-edit" title="تعديل">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
                                <form action="<?php echo e(route('admin.role.destroy', $role->id)); ?>" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('هل أنت متأكد من حذف دور «<?php echo e($role->name); ?>»؟')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-icon-sm btn-delete" title="حذف">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                            لا توجد أدوار مسجلة
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($roles->hasPages()): ?>
    <div class="panel-card-body border-top pt-3">
        <?php echo e($roles->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\roles\index.blade.php ENDPATH**/ ?>