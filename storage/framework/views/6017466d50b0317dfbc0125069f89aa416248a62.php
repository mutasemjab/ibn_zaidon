
<?php $__env->startSection('title', 'إضافة دور جديد'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">إضافة دور جديد</h1>
        <p class="page-sub">حدد اسم الدور وخصص صلاحياته</p>
    </div>
    <a href="<?php echo e(route('admin.role.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-right"></i> العودة للقائمة
    </a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admin.role.store')); ?>" method="POST">
<?php echo csrf_field(); ?>


<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title"><i class="bi bi-tag"></i> بيانات الدور</h2>
    </div>
    <div class="panel-card-body">
        <div class="col-12 col-md-5">
            <label class="form-label">اسم الدور <span class="text-danger">*</span></label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="مثال: محرر المحتوى" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div>


<div class="panel-card mb-4">
    <div class="panel-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h2 class="panel-card-title"><i class="bi bi-shield-check"></i> الصلاحيات</h2>
        <div class="d-flex gap-2">
            <button type="button" class="btn-outline-sm" id="btn-select-all">
                <i class="bi bi-check2-all"></i> تحديد الكل
            </button>
            <button type="button" class="btn-outline-sm" id="btn-deselect-all">
                <i class="bi bi-x-circle"></i> إلغاء الكل
            </button>
        </div>
    </div>
    <div class="panel-card-body">
        <?php
            $permLabels = ['table' => 'عرض', 'add' => 'إضافة', 'edit' => 'تعديل', 'delete' => 'حذف', 'send' => 'إرسال'];
        ?>
        <div class="row g-3">
            <?php $__currentLoopData = $permGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupPerms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="perm-card">
                    <div class="perm-card-head d-flex align-items-center justify-content-between">
                        <span class="fw-semibold small"><?php echo e($groupName); ?></span>
                        <label class="d-flex align-items-center gap-1 mb-0 cursor-pointer">
                            <input type="checkbox" class="group-toggle" data-group="<?php echo e(Str::slug($groupName)); ?>">
                            <span class="small text-muted">الكل</span>
                        </label>
                    </div>
                    <div class="perm-card-body">
                        <?php $__currentLoopData = $groupPerms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($allPerms[$perm])): ?>
                            <?php
                                $suffix = last(explode('-', $perm));
                                $label  = $permLabels[$suffix] ?? $perm;
                            ?>
                            <label class="perm-item">
                                <input type="checkbox" name="perms[]"
                                       value="<?php echo e($allPerms[$perm]); ?>"
                                       class="perm-checkbox group-<?php echo e(Str::slug($groupName)); ?>"
                                       <?php echo e(in_array($allPerms[$perm], old('perms', [])) ? 'checked' : ''); ?>>
                                <span><?php echo e($label); ?></span>
                            </label>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div class="d-flex gap-2 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> حفظ الدور</button>
    <a href="<?php echo e(route('admin.role.index')); ?>" class="btn-outline-sm">إلغاء</a>
</div>

</form>

<?php $__env->startPush('styles'); ?>
<style>
.perm-card {
    border: 1px solid var(--border-color, #e5e7eb);
    border-radius: 8px;
    overflow: hidden;
    height: 100%;
}
.perm-card-head {
    background: var(--surface-2, #f8fafc);
    padding: 8px 12px;
    border-bottom: 1px solid var(--border-color, #e5e7eb);
}
.perm-card-body {
    padding: 10px 12px;
    display: flex;
    flex-wrap: wrap;
    gap: 6px 12px;
}
.perm-item {
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    font-size: .875rem;
    white-space: nowrap;
}
.perm-item input[type=checkbox] {
    cursor: pointer;
}
.cursor-pointer { cursor: pointer; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Group toggles
    document.querySelectorAll('.group-toggle').forEach(function (toggle) {
        var group = toggle.dataset.group;
        var checkboxes = document.querySelectorAll('.group-' + group);

        toggle.addEventListener('change', function () {
            checkboxes.forEach(function (cb) { cb.checked = toggle.checked; });
        });

        checkboxes.forEach(function (cb) {
            cb.addEventListener('change', function () {
                toggle.checked = Array.from(checkboxes).every(function (c) { return c.checked; });
                toggle.indeterminate = !toggle.checked && Array.from(checkboxes).some(function (c) { return c.checked; });
            });
        });
    });

    // Select/Deselect all
    document.getElementById('btn-select-all').addEventListener('click', function () {
        document.querySelectorAll('.perm-checkbox').forEach(function (cb) { cb.checked = true; });
        document.querySelectorAll('.group-toggle').forEach(function (t) { t.checked = true; t.indeterminate = false; });
    });
    document.getElementById('btn-deselect-all').addEventListener('click', function () {
        document.querySelectorAll('.perm-checkbox').forEach(function (cb) { cb.checked = false; });
        document.querySelectorAll('.group-toggle').forEach(function (t) { t.checked = false; t.indeterminate = false; });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\roles\create.blade.php ENDPATH**/ ?>