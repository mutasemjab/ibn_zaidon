<?php $__env->startSection('title', __('messages.site_settings')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.site_settings')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.site_settings_sub')); ?></p>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><?php echo e($errors->first()); ?></div>
<?php endif; ?>

<?php $loc = app()->getLocale(); ?>



<?php
    $showPrice = \App\Models\SiteSetting::raw('show_price') ?: '1';
?>
<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title"><i class="bi bi-phone me-2"></i>إعدادات تطبيق الجوال</h2>
    </div>
    <div class="panel-card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="fw-semibold">إظهار / إخفاء السعر في App Store</div>
                <small class="text-muted">التطبيق سيُخفي أسعار الدورات عند إيقاف هذا الخيار</small>
            </div>
            <form action="<?php echo e(route('admin.site-settings.toggle-price')); ?>" method="POST" class="m-0">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-<?php echo e($showPrice === '1' ? 'success' : 'secondary'); ?> d-flex align-items-center gap-2">
                    <i class="bi bi-<?php echo e($showPrice === '1' ? 'eye' : 'eye-slash'); ?>"></i>
                    <?php echo e($showPrice === '1' ? 'مفعّل — السعر ظاهر' : 'معطّل — السعر مخفي'); ?>

                </button>
            </form>
        </div>
    </div>
</div>

<form action="<?php echo e(route('admin.site-settings.update')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    
    <ul class="nav nav-tabs mb-4" id="settingsTabs">
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" data-bs-toggle="tab" href="#tab-<?php echo e($tabKey); ?>">
                    <i class="bi <?php echo e($tab['icon']); ?>"></i> <?php echo e($tab['title'][$loc] ?? $tab['title']['en']); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="tab-content">
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="tab-<?php echo e($tabKey); ?>">
                <?php $__currentLoopData = $tab['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="panel-card mb-3">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title"><?php echo e($section['title'][$loc] ?? $section['title']['en']); ?></h2>
                        </div>
                        <div class="panel-card-body">
                            <div class="row g-3">
                                <?php $__currentLoopData = $section['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('admin.site-settings._field', ['f' => $f, 'settings' => $settings, 'loc' => $loc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn-primary-sm" style="padding:12px 32px">
            <i class="bi bi-save"></i> <?php echo e(__('messages.save_changes')); ?>

        </button>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\site-settings\edit.blade.php ENDPATH**/ ?>