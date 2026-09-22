
<?php $__env->startSection('title', __('messages.previous_year_exam_singular')); ?>


<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('admin.previous-year-exams.update',$previousYearExam->id)); ?>"
      method="POST"
      enctype="multipart/form-data">

    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card">

    <div class="card-header">
        <h4><?php echo e(__('messages.previous_year_exam_singular')); ?></h4>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label><?php echo e(__('messages.subject')); ?> <span class="text-danger">*</span></label>

            <select name="subject_id" class="form-control" required>
                <option value="">— اختر المادة —</option>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subject->id); ?>"
                        <?php echo e(old('subject_id', $previousYearExam->subject_id ?? '') == $subject->id ? 'selected' : ''); ?>>
                        <?php echo e($subject->full_path); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.year_label')); ?> <span class="text-danger">*</span></label>

            <input type="number"
                   name="year"
                   class="form-control"
                   value="<?php echo e(old('year',$previousYearExam->year ?? '')); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.title_ar_short')); ?> <span class="text-danger">*</span></label>

            <input type="text"
                   name="title_ar"
                   class="form-control"
                   value="<?php echo e(old('title_ar',$previousYearExam->title_ar ?? '')); ?>"
                   required>
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.title_en_short')); ?></label>

            <input type="text"
                   name="title_en"
                   class="form-control"
                   value="<?php echo e(old('title_en',$previousYearExam->title_en ?? '')); ?>">
            <small class="text-muted">اتركه فارغاً ليأخذ نفس العنوان بالعربي</small>
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.tag_ar')); ?></label>

            <input type="text"
                   name="tag_ar"
                   class="form-control"
                   value="<?php echo e(old('tag_ar',$previousYearExam->tag_ar ?? '')); ?>">
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.tag_en')); ?></label>

            <input type="text"
                   name="tag_en"
                   class="form-control"
                   value="<?php echo e(old('tag_en',$previousYearExam->tag_en ?? '')); ?>">
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.pages_label')); ?></label>

            <input type="number"
                   name="pages"
                   class="form-control"
                   value="<?php echo e(old('pages',$previousYearExam->pages ?? 0)); ?>">
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.file_size_mb')); ?></label>

            <input type="number"
                   step="0.01"
                   name="file_size"
                   class="form-control"
                   value="<?php echo e(old('file_size',$previousYearExam->file_size ?? '')); ?>">
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.sort_order_label')); ?></label>

            <input type="number"
                   name="sort_order"
                   class="form-control"
                   value="<?php echo e(old('sort_order',$previousYearExam->sort_order ?? 0)); ?>">
        </div>

        <div class="mb-3">
            <label><?php echo e(__('messages.pdf_file_label')); ?></label>

            <input type="file"
                   name="pdf_file"
                   class="form-control">

            <?php if(isset($previousYearExam)): ?>
                <br>
                <a href="<?php echo e(asset('assets/uploads/previousYearExam/'.$previousYearExam->pdf_file)); ?>"
                   target="_blank">
                    <?php echo e(__('messages.current_pdf')); ?>

                </a>
            <?php endif; ?>
        </div>

        <div class="mb-3">

            <label><?php echo e(__('messages.Status')); ?></label>

            <select name="status" class="form-control">

                <option value="1"
                    <?php echo e(old('status',$previousYearExam->status ?? 1) == 1 ? 'selected' : ''); ?>>
                    <?php echo e(__('messages.Active')); ?>

                </option>

                <option value="0"
                    <?php echo e(old('status',$previousYearExam->status ?? 1) == 0 ? 'selected' : ''); ?>>
                    <?php echo e(__('messages.Inactive')); ?>

                </option>

            </select>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-success">
            <?php echo e(__('messages.Save')); ?>

        </button>

    </div>

</div>

</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\previous_year_exams\edit.blade.php ENDPATH**/ ?>