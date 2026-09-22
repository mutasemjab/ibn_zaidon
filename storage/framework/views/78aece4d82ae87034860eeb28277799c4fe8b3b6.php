
<?php $__env->startSection('title', 'البانرات'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">البانرات</h1>
        <p class="page-sub">صور السلايدر التي تظهر في التطبيق</p>
    </div>
    <a href="<?php echo e(route('admin.banners.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-lg"></i> إضافة بانر
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <?php if($banners->isEmpty()): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-image" style="font-size:2.5rem;opacity:.3"></i>
                <p class="mt-2">لا توجد بانرات بعد</p>
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:60px">#</th>
                        <th>الصورة</th>
                        <th style="width:120px">الترتيب</th>
                        <th style="width:110px">الحالة</th>
                        <th style="width:160px">تاريخ الإضافة</th>
                        <th style="width:130px">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($banner->id); ?></td>
                        <td>
                            <img src="<?php echo e(asset('assets/uploads/banners/' . $banner->image)); ?>"
                                 alt="banner"
                                 style="height:60px;width:160px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0">
                        </td>
                        <td>
                            <span class="badge bg-secondary"><?php echo e($banner->order_index); ?></span>
                        </td>
                        <td>
                            <form action="<?php echo e(route('admin.banners.toggle', $banner->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="badge border-0 <?php echo e($banner->is_active ? 'bg-success' : 'bg-secondary'); ?>"
                                        style="cursor:pointer;font-size:12px;padding:5px 10px">
                                    <?php echo e($banner->is_active ? 'نشط' : 'معطل'); ?>

                                </button>
                            </form>
                        </td>
                        <td><?php echo e($banner->created_at->format('Y-m-d')); ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('admin.banners.edit', $banner->id)); ?>" class="btn-outline-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.banners.destroy', $banner->id)); ?>" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا البانر؟')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-danger-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\banners\index.blade.php ENDPATH**/ ?>