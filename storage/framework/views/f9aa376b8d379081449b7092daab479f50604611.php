
<?php $__env->startSection('title', __('messages.edit_student')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.edit_student')); ?></h1><p class="page-sub"><?php echo e($student->name); ?></p></div>
    <a href="<?php echo e(route('admin.students.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-8">
<form action="<?php echo e(route('admin.students.update', $student->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.student_info')); ?></h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.full_name')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name" value="<?php echo e(old('name', $student->name)); ?>" class="form-control <?php $__errorArgs = ['name'];
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
                <label class="form-label">الرقم الوطني</label>
                <input type="text" name="national_id" value="<?php echo e(old('national_id', $student->national_id)); ?>" class="form-control <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="مثال: 9876543210">
                <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.email_label')); ?></label>
                <input type="email" name="email" value="<?php echo e(old('email', $student->email)); ?>" class="form-control <?php $__errorArgs = ['email'];
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
                <label class="form-label"><?php echo e(__('messages.new_password')); ?></label>
                <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('messages.leave_blank_password')); ?>">
            </div>
         
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.phone_label')); ?></label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $student->phone)); ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.gender_label')); ?></label>
                <select name="gender" class="form-select">
                    <option value=""><?php echo e(__('messages.select_option')); ?></option>
                    <option value="male" <?php if(old('gender', $student->gender) === 'male'): echo 'selected'; endif; ?>><?php echo e(__('messages.male')); ?></option>
                    <option value="female" <?php if(old('gender', $student->gender) === 'female'): echo 'selected'; endif; ?>><?php echo e(__('messages.female')); ?></option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.nationality')); ?></label>
                <input type="text" name="nationality" value="<?php echo e(old('nationality', $student->nationality)); ?>" class="form-control">
            </div>
       
            <div class="col-md-6">
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php if(old('is_active', $student->is_active)): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="is_active"><?php echo e(__('messages.active_account')); ?></label>
                </div>
            </div>
            <div class="col-md-6">
                <?php if($student->avatar): ?>
                <img src="<?php echo e(asset('assets/uploads/students/'.$student->avatar)); ?>" class="rounded-circle mb-2" style="width:60px;height:60px;object-fit:cover">
                <?php endif; ?>
                <label class="form-label d-block"><?php echo e(__('messages.avatar_label')); ?></label>
                <input type="file" name="avatar" accept="image/*" class="form-control">
            </div>
            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.save_changes')); ?></button>
            </div>
        </div>
    </div>
</div>
</form>
</div>

<div class="col-12 col-xl-4">
    <div class="panel-card">
        <div class="panel-card-header"><h2 class="panel-card-title">معلومات الجهاز</h2></div>
        <div class="panel-card-body">
            <?php if($student->deviceId): ?>
                <p class="text-muted mb-1" style="font-size:13px">الجهاز المسجّل:</p>
                <code class="d-block mb-3" style="font-size:11px;word-break:break-all"><?php echo e($student->deviceId); ?></code>
                <form action="<?php echo e(route('admin.students.reset-device', $student->id)); ?>" method="POST"
                      onsubmit="return confirm('هل أنت متأكد؟ سيتمكن الطالب من تسجيل الدخول من أي جهاز.')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-danger-sm w-100">
                        <i class="bi bi-phone-vibrate"></i> إعادة تعيين الجهاز
                    </button>
                </form>
            <?php else: ?>
                <p class="text-muted mb-0" style="font-size:13px">
                    <i class="bi bi-phone-x"></i> لم يُسجَّل جهاز بعد
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\students\edit.blade.php ENDPATH**/ ?>