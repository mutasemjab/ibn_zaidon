
<?php $__env->startSection('title', __('messages.t_create_course')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.t_create_course')); ?></h1></div>
    <a href="<?php echo e(route('teacher.courses.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.t_back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<form action="<?php echo e(route('teacher.courses.store')); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="row g-3">

    <div class="col-12 col-xl-8">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.t_course_details')); ?></h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_title_ar')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" value="<?php echo e(old('title_ar')); ?>" class="form-control <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" dir="rtl" required>
                        <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_title_en')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" value="<?php echo e(old('title_en')); ?>" class="form-control <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_description_ar')); ?></label>
                        <textarea name="description_ar" rows="3" class="form-control" dir="rtl"><?php echo e(old('description_ar')); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_description_en')); ?></label>
                        <textarea name="description_en" rows="3" class="form-control"><?php echo e(old('description_en')); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_what_you_learn_ar')); ?></label>
                        <textarea name="what_you_learn_ar" rows="3" class="form-control" dir="rtl"><?php echo e(old('what_you_learn_ar')); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_what_you_learn_en')); ?></label>
                        <textarea name="what_you_learn_en" rows="3" class="form-control"><?php echo e(old('what_you_learn_en')); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_requirements_ar')); ?></label>
                        <textarea name="requirements_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('requirements_ar')); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.t_requirements_en')); ?></label>
                        <textarea name="requirements_en" rows="2" class="form-control"><?php echo e(old('requirements_en')); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.t_settings')); ?></h2></div>
            <div class="panel-card-body">
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.t_category')); ?> <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value=""><?php echo e(__('messages.t_select')); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id') == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->full_path); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.t_subject')); ?></label>
                    <select name="subject_id" class="form-select">
                        <option value=""><?php echo e(__('messages.t_none')); ?></option>
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub->id); ?>" <?php if(old('subject_id') == $sub->id): echo 'selected'; endif; ?>><?php echo e($sub->full_path); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.t_difficulty')); ?></label>
                    <select name="difficulty_level" class="form-select">
                        <?php $__currentLoopData = ['beginner','intermediate','advanced']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($l); ?>" <?php if(old('difficulty_level') === $l): echo 'selected'; endif; ?>><?php echo e(ucfirst($l)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label"><?php echo e(__('messages.t_price')); ?></label>
                        <input type="number" name="price" value="<?php echo e(old('price', 0)); ?>" min="0" step="0.01" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label"><?php echo e(__('messages.t_old_price')); ?></label>
                        <input type="number" name="old_price" value="<?php echo e(old('old_price')); ?>" min="0" step="0.01" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label"><?php echo e(__('messages.t_duration_hours')); ?></label>
                        <input type="number" name="duration_hours" value="<?php echo e(old('duration_hours', 0)); ?>" min="0" class="form-control">
                    </div>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published">
                    <label class="form-check-label" for="is_published"><?php echo e(__('messages.t_publish_immediately')); ?></label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_free" value="1" id="is_free">
                    <label class="form-check-label" for="is_free"><?php echo e(__('messages.t_free_course')); ?></label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="sequential_videos" value="1" id="sequential_videos">
                    <label class="form-check-label" for="sequential_videos">
                        <?php echo e(__('messages.t_sequential_videos')); ?>

                        <small class="d-block text-muted" style="font-size:.75rem"><?php echo e(__('messages.t_sequential_videos_hint')); ?></small>
                    </label>
                </div>
                <label class="form-label"><?php echo e(__('messages.t_thumbnail')); ?></label>
                <input type="file" name="thumbnail" accept="image/*" class="form-control mb-3">
                <button type="submit" class="btn-primary-sm w-100 justify-content-center">
                    <i class="bi bi-save"></i> <?php echo e(__('messages.t_create_course')); ?>

                </button>
            </div>
        </div>
    </div>

</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\courses\create.blade.php ENDPATH**/ ?>