
<?php $__env->startSection('title', __('messages.t_previous_year_exams')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.t_previous_year_exams')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.previous_year_exams_sub')); ?></p>
    </div>
    <a href="<?php echo e(route('teacher.previous-year-exams.create')); ?>" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_new')); ?>

    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__('messages.subject')); ?></th>
                        <th><?php echo e(__('messages.title_ar_short')); ?></th>
                        <th><?php echo e(__('messages.year_label')); ?></th>
                        <th><?php echo e(__('messages.pdf_file_label')); ?></th>
                        <th><?php echo e(__('messages.Status')); ?></th>
                        <th width="150"><?php echo e(__('messages.Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($exam->id); ?></td>
                        <td><?php echo e($exam->subject?->name_ar ?? '—'); ?></td>
                        <td><?php echo e($exam->title_ar); ?></td>
                        <td><?php echo e($exam->year ?? '—'); ?></td>
                        <td>
                            <a href="<?php echo e(asset('assets/uploads/previousYearExam/'.$exam->pdf_file)); ?>" target="_blank">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> <?php echo e(__('messages.view_pdf')); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo $exam->status
                                ? '<span class="pill pill-success">'.__('messages.Active').'</span>'
                                : '<span class="pill pill-neutral">'.__('messages.Inactive').'</span>'; ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('teacher.previous-year-exams.edit', $exam->id)); ?>" class="btn btn-warning btn-sm">
                                <?php echo e(__('messages.Edit')); ?>

                            </a>
                            <form method="POST" action="<?php echo e(route('teacher.previous-year-exams.destroy', $exam->id)); ?>" style="display:inline-block">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(__('messages.delete_confirm')); ?>')">
                                    <?php echo e(__('messages.Delete')); ?>

                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_records')); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="p-3"><?php echo e($exams->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\previous_year_exams\index.blade.php ENDPATH**/ ?>