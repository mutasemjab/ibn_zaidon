
<?php $__env->startSection('title', 'تعديل الموظف: ' . $employee->name); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">تعديل الموظف</h1>
        <p class="page-sub"><?php echo e($employee->name); ?></p>
    </div>
    <a href="<?php echo e(route('admin.employee.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-right"></i> العودة للقائمة
    </a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admin.employee.update', $employee->id)); ?>" method="POST">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

<div class="row g-4">

    
    <div class="col-12 col-xl-7">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-person-badge"></i> بيانات الحساب</h2>
            </div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="<?php echo e(old('name', $employee->name)); ?>"
                               class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">اسم المستخدم <span class="text-danger">*</span></label>
                        <input type="text" name="username" value="<?php echo e(old('username', $employee->username)); ?>"
                               class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $employee->email)); ?>"
                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            كلمة المرور الجديدة
                            <small class="text-muted">(اتركها فارغة للإبقاء على الحالية)</small>
                        </label>
                        <input type="password" name="password"
                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               autocomplete="new-password">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation"
                               class="form-control" autocomplete="new-password">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-xl-5">
        <div class="panel-card h-100">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><i class="bi bi-shield-lock"></i> الأدوار الوظيفية</h2>
            </div>
            <div class="panel-card-body">
                <?php if($roles->isEmpty()): ?>
                    <p class="text-muted small mb-0">
                        لا توجد أدوار مضافة بعد.
                        <a href="<?php echo e(route('admin.role.create')); ?>">أنشئ دوراً الآن</a>
                    </p>
                <?php else: ?>
                <?php $checked = old('roles') !== null ? array_map('intval', old('roles', [])) : $assignedRoles; ?>
                <div class="d-flex flex-column gap-2">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isChecked = in_array($role->id, $checked); ?>
                    <label class="d-flex align-items-center gap-2 p-2 rounded border cursor-pointer role-item
                           <?php echo e($isChecked ? 'selected' : ''); ?>">
                        <input type="checkbox" name="roles[]" value="<?php echo e($role->id); ?>"
                               class="role-checkbox"
                               <?php echo e($isChecked ? 'checked' : ''); ?>>
                        <span class="fw-semibold"><?php echo e($role->name); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> حفظ التغييرات</button>
    <a href="<?php echo e(route('admin.employee.index')); ?>" class="btn-outline-sm">إلغاء</a>
</div>

</form>

<?php $__env->startPush('styles'); ?>
<style>
.cursor-pointer { cursor: pointer; }
.role-item { cursor: pointer; transition: background .15s, border-color .15s; }
.role-item:hover, .role-item.selected { background: var(--primary-50, #eff6ff); border-color: var(--primary-400, #60a5fa) !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.querySelectorAll('.role-checkbox').forEach(function (cb) {
    cb.addEventListener('change', function () {
        this.closest('.role-item').classList.toggle('selected', this.checked);
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\employee\edit.blade.php ENDPATH**/ ?>