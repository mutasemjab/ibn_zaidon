
<?php $__env->startSection('title', __('messages.t_previous_year_exams')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.edit_previous_year_exam')); ?></h1></div>
    <a href="<?php echo e(route('teacher.previous-year-exams.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?>

    </a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><?php echo e($errors->first()); ?></div>
<?php endif; ?>

<form action="<?php echo e(route('teacher.previous-year-exams.update', $previousYearExam->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="panel-card">
                <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.basic_info')); ?></h2></div>
                <div class="panel-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.title_ar_short')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" class="form-control" value="<?php echo e(old('title_ar', $previousYearExam->title_ar)); ?>" dir="rtl" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.title_en_short')); ?></label>
                            <input type="text" name="title_en" class="form-control" value="<?php echo e(old('title_en', $previousYearExam->title_en)); ?>">
                            <small class="text-muted">اتركه فارغاً ليأخذ نفس العنوان بالعربي</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.tag_ar')); ?></label>
                            <input type="text" name="tag_ar" class="form-control" value="<?php echo e(old('tag_ar', $previousYearExam->tag_ar)); ?>" dir="rtl">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.tag_en')); ?></label>
                            <input type="text" name="tag_en" class="form-control" value="<?php echo e(old('tag_en', $previousYearExam->tag_en)); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label"><?php echo e(__('messages.subject')); ?></label>
                            <select name="subject_id" class="form-control">
                                <option value="">— <?php echo e(__('messages.select_subject')); ?> —</option>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subject->id); ?>" <?php echo e(old('subject_id', $previousYearExam->subject_id) == $subject->id ? 'selected' : ''); ?>>
                                        <?php echo e($subject->full_path); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="panel-card mb-3">
                <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.file_details')); ?></h2></div>
                <div class="panel-card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label"><?php echo e(__('messages.pdf_file_label')); ?></label>
                            <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                            <?php if($previousYearExam->pdf_file): ?>
                                <div class="mt-1" style="font-size:.8rem">
                                    <?php echo e(__('messages.current_file')); ?>:
                                    <a href="<?php echo e(asset('assets/uploads/previousYearExam/'.$previousYearExam->pdf_file)); ?>" target="_blank" class="text-danger">
                                        <i class="bi bi-file-earmark-pdf"></i> <?php echo e($previousYearExam->pdf_file); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                            <small class="text-muted" style="font-size:.75rem"><?php echo e(__('messages.leave_empty_keep_file')); ?></small>
                        </div>
                        <div class="col-6">
                            <label class="form-label"><?php echo e(__('messages.year_label')); ?></label>
                            <input type="number" name="year" class="form-control" value="<?php echo e(old('year', $previousYearExam->year)); ?>" min="1900" max="2100">
                        </div>
                        <div class="col-6">
                            <label class="form-label"><?php echo e(__('messages.pages_label')); ?></label>
                            <input type="number" name="pages" class="form-control" value="<?php echo e(old('pages', $previousYearExam->pages)); ?>" min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label"><?php echo e(__('messages.file_size_mb')); ?></label>
                            <input type="number" name="file_size" class="form-control" value="<?php echo e(old('file_size', $previousYearExam->file_size)); ?>" step="0.01">
                        </div>
                        <div class="col-6">
                            <label class="form-label"><?php echo e(__('messages.sort_order_label')); ?></label>
                            <input type="number" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', $previousYearExam->sort_order)); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label"><?php echo e(__('messages.Status')); ?></label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo e(old('status', $previousYearExam->status) == 1 ? 'selected' : ''); ?>><?php echo e(__('messages.Active')); ?></option>
                                <option value="0" <?php echo e(old('status', $previousYearExam->status) == 0 ? 'selected' : ''); ?>><?php echo e(__('messages.Inactive')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-primary-sm w-100 justify-content-center" style="padding:12px">
                <i class="bi bi-save"></i> <?php echo e(__('messages.Save')); ?>

            </button>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\previous_year_exams\edit.blade.php ENDPATH**/ ?>