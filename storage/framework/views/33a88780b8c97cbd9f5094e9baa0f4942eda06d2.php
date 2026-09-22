
<?php $__env->startSection('title', __('messages.edit_teacher')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.edit_teacher')); ?></h1><p class="page-sub"><?php echo e($teacher->name); ?></p></div>
    <a href="<?php echo e(route('admin.teachers.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<form action="<?php echo e(route('admin.teachers.update', $teacher->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<div class="row g-3">

    <div class="col-12 col-xl-8">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.teacher_info')); ?></h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.full_name')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="<?php echo e(old('name', $teacher->name)); ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">الرقم الوطني <span class="text-danger">*</span></label>
                        <input type="text" name="national_id" value="<?php echo e(old('national_id', $teacher->national_id)); ?>" class="form-control <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
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
                        <input type="email" name="email" value="<?php echo e(old('email', $teacher->email)); ?>" class="form-control <?php $__errorArgs = ['email'];
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
               
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.phone_label')); ?></label>
                        <input type="text" name="phone" value="<?php echo e(old('phone', $teacher->phone)); ?>" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo e(__('messages.gender_label')); ?></label>
                        <select name="gender" class="form-select">
                            <option value=""><?php echo e(__('messages.select_option')); ?></option>
                            <option value="male" <?php if(old('gender', $teacher->gender) === 'male'): echo 'selected'; endif; ?>><?php echo e(__('messages.male')); ?></option>
                            <option value="female" <?php if(old('gender', $teacher->gender) === 'female'): echo 'selected'; endif; ?>><?php echo e(__('messages.female')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo e(__('messages.experience_years')); ?></label>
                        <input type="number" name="years_of_experience" value="<?php echo e(old('years_of_experience', $teacher->years_of_experience)); ?>" min="0" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.specialization_ar')); ?></label>
                        <input type="text" name="specialization_ar" value="<?php echo e(old('specialization_ar', $teacher->specialization_ar)); ?>" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.specialization_en')); ?></label>
                        <input type="text" name="specialization_en" value="<?php echo e(old('specialization_en', $teacher->specialization_en)); ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.qualification_ar')); ?></label>
                        <input type="text" name="qualification_ar" value="<?php echo e(old('qualification_ar', $teacher->qualification_ar)); ?>" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.qualification_en')); ?></label>
                        <input type="text" name="qualification_en" value="<?php echo e(old('qualification_en', $teacher->qualification_en)); ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.bio_ar')); ?></label>
                        <textarea name="bio_ar" rows="3" class="form-control" dir="rtl"><?php echo e(old('bio_ar', $teacher->bio_ar)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.bio_en')); ?></label>
                        <textarea name="bio_en" rows="3" class="form-control"><?php echo e(old('bio_en', $teacher->bio_en)); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.settings')); ?></h2></div>
            <div class="panel-card-body">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php echo e(old('is_active', $teacher->is_active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active"><?php echo e(__('messages.Active')); ?></label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_verified" value="1" id="is_verified" <?php echo e(old('is_verified', $teacher->is_verified) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_verified"><?php echo e(__('messages.verified')); ?></label>
                </div>
            
                <hr>
                <?php if($teacher->avatar): ?>
                    <img src="<?php echo e(asset('assets/uploads/teachers/'.$teacher->avatar)); ?>" class="img-fluid rounded mb-2" alt="">
                <?php endif; ?>
                <label class="form-label"><?php echo e(__('messages.profile_photo')); ?></label>
                <input type="file" name="avatar" accept="image/*" class="form-control mb-3">
                <button type="submit" class="btn-primary-sm w-100 justify-content-center">
                    <i class="bi bi-save"></i> <?php echo e(__('messages.update_teacher')); ?>

                </button>
            </div>
        </div>
    </div>

</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\teachers\edit.blade.php ENDPATH**/ ?>