
<?php $__env->startSection('title', __('messages.edit_course')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.edit_course')); ?></h1>
        <p class="page-sub"><?php echo e($course->title_en ?: $course->title_ar); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.courses.show', $course->id)); ?>" class="btn-outline-sm">
            <i class="bi bi-eye"></i> <?php echo e(__('messages.View')); ?>

        </a>
        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn-outline-sm">
            <i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?>

        </a>
    </div>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admin.courses.update', $course->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

<div class="row g-3">

    <div class="col-12 col-xl-8">
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.course_info')); ?></h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.title_ar')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" value="<?php echo e(old('title_ar', $course->title_ar)); ?>" class="form-control <?php $__errorArgs = ['title_ar'];
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
                        <label class="form-label"><?php echo e(__('messages.title_en')); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" value="<?php echo e(old('title_en', $course->title_en)); ?>" class="form-control <?php $__errorArgs = ['title_en'];
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
                        <label class="form-label"><?php echo e(__('messages.description_ar')); ?></label>
                        <textarea name="description_ar" rows="3" class="form-control" dir="rtl"><?php echo e(old('description_ar', $course->description_ar)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.description_en')); ?></label>
                        <textarea name="description_en" rows="3" class="form-control"><?php echo e(old('description_en', $course->description_en)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.what_you_learn_ar')); ?></label>
                        <textarea name="what_you_learn_ar" rows="3" class="form-control" dir="rtl"><?php echo e(old('what_you_learn_ar', $course->what_you_learn_ar)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.what_you_learn_en')); ?></label>
                        <textarea name="what_you_learn_en" rows="3" class="form-control"><?php echo e(old('what_you_learn_en', $course->what_you_learn_en)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.requirements_ar')); ?></label>
                        <textarea name="requirements_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('requirements_ar', $course->requirements_ar)); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?php echo e(__('messages.requirements_en')); ?></label>
                        <textarea name="requirements_en" rows="2" class="form-control"><?php echo e(old('requirements_en', $course->requirements_en)); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4">

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.publish')); ?></h2></div>
            <div class="panel-card-body">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" <?php echo e(old('is_published', $course->is_published) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_published"><?php echo e(__('messages.published')); ?></label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" <?php echo e(old('is_featured', $course->is_featured) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_featured"><?php echo e(__('messages.featured')); ?></label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_free" value="1" id="is_free" <?php echo e(old('is_free', $course->is_free) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_free"><?php echo e(__('messages.free_course')); ?></label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="sequential_videos" value="1" id="sequential_videos" <?php echo e(old('sequential_videos', $course->sequential_videos) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="sequential_videos">
                        <?php echo e(__('messages.sequential_videos')); ?>

                        <small class="d-block text-muted" style="font-size:.75rem"><?php echo e(__('messages.sequential_videos_desc')); ?></small>
                    </label>
                </div>
                <button type="submit" class="btn-primary-sm w-100 mt-3 justify-content-center">
                    <i class="bi bi-save"></i> <?php echo e(__('messages.update_course')); ?>

                </button>
            </div>
        </div>

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.details')); ?></h2></div>
            <div class="panel-card-body">
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.teacher')); ?> <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select" required>
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t->id); ?>" <?php if(old('teacher_id', $course->teacher_id) == $t->id): echo 'selected'; endif; ?>><?php echo e($t->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.subject')); ?></label>
                    <select name="subject_id" class="form-select" id="subjectSelect" onchange="syncCategoryFromSubject(this)">
                        <option value="">— <?php echo e(__('messages.none')); ?> —</option>
                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub->id); ?>"
                                    data-cat="<?php echo e($sub->category?->id ?? ''); ?>"
                                    <?php if(old('subject_id', $course->subject_id) == $sub->id): echo 'selected'; endif; ?>>
                                <?php echo e($sub->full_path); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.main_category')); ?></label>
                    <select name="category_id" class="form-select" id="categorySelect">
                        <option value="">— <?php echo e(__('messages.select_option')); ?> —</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id', $course->category_id) == $cat->id): echo 'selected'; endif; ?>>
                                <?php echo e($cat->name_ar); ?> (<?php echo e($cat->name_en); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <small class="text-muted"><?php echo e(__('messages.category_auto_hint')); ?></small>
                </div>
              
                <div class="mb-3">
                    <label class="form-label"><?php echo e(__('messages.difficulty')); ?></label>
                    <select name="difficulty_level" class="form-select">
                        <?php $__currentLoopData = ['beginner','intermediate','advanced']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($level); ?>" <?php if(old('difficulty_level', $course->difficulty_level) === $level): echo 'selected'; endif; ?>><?php echo e(__('messages.'.$level)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label"><?php echo e(__('messages.price_usd')); ?></label>
                        <input type="number" name="price" value="<?php echo e(old('price', $course->price)); ?>" min="0" step="0.01" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label"><?php echo e(__('messages.old_price_usd')); ?></label>
                        <input type="number" name="old_price" value="<?php echo e(old('old_price', $course->old_price)); ?>" min="0" step="0.01" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label"><?php echo e(__('messages.duration_hours')); ?></label>
                        <input type="number" name="duration_hours" value="<?php echo e(old('duration_hours', $course->duration_hours)); ?>" min="0" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.thumbnail')); ?></h2></div>
            <div class="panel-card-body">
                <?php if($course->thumbnail): ?>
                    <img src="<?php echo e(asset('assets/uploads/courses/' . $course->thumbnail)); ?>" class="img-fluid rounded mb-2" alt="">
                <?php endif; ?>
                <input type="file" name="thumbnail" accept="image/*" class="form-control">
                <small class="text-muted"><?php echo e(__('messages.leave_empty_keep_image')); ?></small>
            </div>
        </div>

    </div>
</div>

</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function syncCategoryFromSubject(sel) {
    const catId = sel.options[sel.selectedIndex]?.dataset.cat;
    if (catId) {
        const catSel = document.getElementById('categorySelect');
        if (catSel) catSel.value = catId;
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\courses\edit.blade.php ENDPATH**/ ?>