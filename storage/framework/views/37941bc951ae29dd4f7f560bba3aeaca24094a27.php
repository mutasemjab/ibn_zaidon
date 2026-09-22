
<?php $__env->startSection('title', __('messages.t_create_exam')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.t_create_exam')); ?></h1></div>
    <a href="<?php echo e(route('teacher.exams.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.t_back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-8">
<form action="<?php echo e(route('teacher.exams.store')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.t_exam_info')); ?></h2></div>
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
                <textarea name="description_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('description_ar')); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.t_description_en')); ?></label>
                <textarea name="description_en" rows="2" class="form-control"><?php echo e(old('description_en')); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_exam_type')); ?> <span class="text-danger">*</span></label>
                <select name="exam_type" class="form-select <?php $__errorArgs = ['exam_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <?php $__currentLoopData = ['mock','unit','final','practice','previous_years','placement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php if(old('exam_type') === $type): echo 'selected'; endif; ?>><?php echo e(ucfirst(str_replace('_',' ',$type))); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['exam_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_difficulty')); ?></label>
                <select name="difficulty_level" class="form-select">
                    <?php $__currentLoopData = ['easy','medium','hard','mixed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d); ?>" <?php if(old('difficulty_level','mixed') === $d): echo 'selected'; endif; ?>><?php echo e(ucfirst($d)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_course')); ?></label>
                <select name="course_id" class="form-select">
                    <option value=""><?php echo e(__('messages.t_standalone')); ?></option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>" <?php if(old('course_id', request('course_id')) == $c->id): echo 'selected'; endif; ?>><?php echo e(Str::limit($c->title_en ?: $c->title_ar, 30)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.subject')); ?></label>
                <select name="subject_id" class="form-select">
                    <option value="">— <?php echo e(__('messages.t_none')); ?> —</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($sub->id); ?>" <?php if(old('subject_id') == $sub->id): echo 'selected'; endif; ?>><?php echo e($sub->full_path); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_duration_minutes')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="duration_minutes" value="<?php echo e(old('duration_minutes', 60)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_total_marks')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="total_marks" value="<?php echo e(old('total_marks', 100)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.t_pass_marks')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="pass_marks" value="<?php echo e(old('pass_marks', 50)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-12">
                <div class="d-flex gap-4 flex-wrap">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published">
                        <label class="form-check-label" for="is_published"><?php echo e(__('messages.t_published')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="shuffle_questions" value="1" id="shuffle_q">
                        <label class="form-check-label" for="shuffle_q"><?php echo e(__('messages.t_shuffle_questions')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="shuffle_options" value="1" id="shuffle_o">
                        <label class="form-check-label" for="shuffle_o"><?php echo e(__('messages.t_shuffle_options')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="show_result_immediately" value="1" id="show_result" checked>
                        <label class="form-check-label" for="show_result"><?php echo e(__('messages.t_show_result_immediately')); ?></label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.t_create_exam_add_questions')); ?></button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\exams\create.blade.php ENDPATH**/ ?>