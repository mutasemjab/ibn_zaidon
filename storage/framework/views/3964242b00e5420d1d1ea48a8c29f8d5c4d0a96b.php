
<?php $__env->startSection('title', __('messages.categories_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.categories_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_categories_tree_desc')); ?></p>
    </div>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_main_category')); ?>

    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>


<div class="d-flex gap-3 flex-wrap mb-3 small text-muted">
    <span><i class="bi bi-diagram-3 text-primary"></i> <?php echo e(__('messages.main_category')); ?></span>
    <span><i class="bi bi-folder2 text-success"></i> <?php echo e(__('messages.sub_category')); ?></span>
    <span><i class="bi bi-folder2-open text-info"></i> <?php echo e(__('messages.sub_sub_category')); ?></span>
    <span><i class="bi bi-journal-bookmark text-danger"></i> <?php echo e(__('messages.subject')); ?></span>
    <span class="ms-auto">
        <button class="btn btn-link btn-sm p-0" onclick="expandAll()"><?php echo e(__('messages.expand_all')); ?></button>
        |
        <button class="btn btn-link btn-sm p-0" onclick="collapseAll()"><?php echo e(__('messages.collapse_all')); ?></button>
    </span>
</div>

<div class="panel-card">
    <div class="panel-card-body p-3" id="categoryTree">
        <?php $__empty_1 = true; $__currentLoopData = $roots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $root): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php echo $__env->make('admin.categories._node', ['nodes' => collect([$root])], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-diagram-3 fs-1 d-block mb-2"></i>
                <?php echo e(__('messages.no_categories_yet')); ?>

                <br>
                <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn-primary-sm mt-3 d-inline-block">
                    <?php echo e(__('messages.add_main_category')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function expandAll() {
    document.querySelectorAll('#categoryTree .collapse').forEach(el => {
        bootstrap.Collapse.getOrCreateInstance(el).show();
    });
}
function collapseAll() {
    document.querySelectorAll('#categoryTree .collapse').forEach(el => {
        bootstrap.Collapse.getOrCreateInstance(el).hide();
    });
}

// Rotate chevron on collapse toggle
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
        const target = document.querySelector(btn.dataset.bsTarget);
        if (!target) return;
        target.addEventListener('show.bs.collapse',  () => btn.querySelector('.toggle-icon').style.transform = 'rotate(90deg)');
        target.addEventListener('hide.bs.collapse',  () => btn.querySelector('.toggle-icon').style.transform = 'rotate(0deg)');
    });
});
</script>
<style>
.tree-node { transition: background .15s; }
.tree-node:hover > .d-flex { background: #f8f9fa; }
.toggle-icon { transition: transform .2s ease; display: inline-block; }
.btn-xs { padding: 2px 6px !important; font-size: .7rem !important; }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\categories\index.blade.php ENDPATH**/ ?>