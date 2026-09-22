
<?php $__env->startSection('title', __('messages.cities_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.cities_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_cities_desc')); ?></p>
    </div>
    <a href="<?php echo e(route('admin.cities.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_city')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2">
            <div class="col-12 col-md-9">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_cities_ph')); ?>">
            </div>
            <div class="col-12 col-md-3">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i> <?php echo e(__('messages.Search')); ?></button>
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
                    <th><?php echo e(__('messages.city_en')); ?></th>
                    <th><?php echo e(__('messages.city_ar')); ?></th>
                    <th><?php echo e(__('messages.pos_count')); ?></th>
                    <th><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($city->id); ?></td>
                    <td style="font-weight:500"><?php echo e($city->name_en); ?></td>
                    <td dir="rtl"><?php echo e($city->name_ar); ?></td>
                    <td><?php echo e($city->pos_count); ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.cities.edit', $city->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('admin.cities.destroy', $city->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.delete_city_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_cities_yet')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($cities->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\cities\index.blade.php ENDPATH**/ ?>