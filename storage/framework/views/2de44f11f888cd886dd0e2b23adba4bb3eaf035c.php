
<?php $__env->startSection('title', 'سجل النشاطات'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><i class="bi bi-clock-history me-2"></i>سجل النشاطات</h1>
        <p class="page-sub">كل إجراء يقوم به الأدمن مسجّل هنا</p>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>


<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-3">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="ابحث في الوصف...">
            </div>
            <div class="col-6 col-md-2">
                <select name="admin_id" class="form-select form-select-sm">
                    <option value="">كل الأدمن</option>
                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($a->id); ?>" <?php if(request('admin_id') == $a->id): echo 'selected'; endif; ?>><?php echo e($a->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="action" class="form-select form-select-sm">
                    <option value="">كل الإجراءات</option>
                    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($act); ?>" <?php if(request('action') === $act): echo 'selected'; endif; ?>><?php echo e($act); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="form-control form-control-sm" placeholder="من تاريخ">
            </div>
            <div class="col-6 col-md-2">
                <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="form-control form-control-sm" placeholder="إلى تاريخ">
            </div>
            <div class="col-12 col-md-1">
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
                    <th>الأدمن</th>
                    <th>الإجراء</th>
                    <th>القسم</th>
                    <th>الوصف</th>
                    <th>IP</th>
                    <th>الوقت</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($log->id); ?></td>
                    <td>
                        <div style="font-weight:500;font-size:.85rem"><?php echo e($log->admin_name); ?></div>
                    </td>
                    <td>
                        <?php
                            $badge = match($log->action) {
                                'create' => 'pill-success',
                                'update' => 'pill-info',
                                'delete' => 'pill-warning',
                                'login'  => 'pill-neutral',
                                default  => 'pill-neutral',
                            };
                            $label = match($log->action) {
                                'create' => 'إضافة',
                                'update' => 'تعديل',
                                'delete' => 'حذف',
                                'login'  => 'دخول',
                                'logout' => 'خروج',
                                default  => $log->action,
                            };
                        ?>
                        <span class="pill <?php echo e($badge); ?>"><?php echo e($label); ?></span>
                    </td>
                    <td style="color:var(--muted);font-size:.82rem"><?php echo e($log->module ?: '—'); ?></td>
                    <td style="font-size:.85rem;max-width:320px"><?php echo e($log->description); ?></td>
                    <td style="color:var(--muted);font-size:.78rem;font-family:monospace"><?php echo e($log->ip_address); ?></td>
                    <td style="color:var(--muted);font-size:.78rem;white-space:nowrap"><?php echo e($log->created_at?->format('Y-m-d H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)">لا توجد سجلات</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3 d-flex justify-content-between align-items-center">
            <div><?php echo e($logs->withQueryString()->links()); ?></div>
            <?php if($logs->total() > 0): ?>
            <form action="<?php echo e(route('admin.activity-log.destroy', $logs->last()?->id ?? 0)); ?>" method="POST"
                  onsubmit="return confirm('حذف كل السجلات الأقدم من الصفحة الحالية؟')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-outline-sm" style="color:#dc2626;border-color:#fecaca;font-size:.78rem">
                    <i class="bi bi-trash"></i> حذف القديم
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\activity-log\index.blade.php ENDPATH**/ ?>