
<?php $__env->startSection('title', __('messages.previous_year_exams_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4><?php echo e(__('messages.previous_year_exams_title')); ?></h4>

        <a href="<?php echo e(route('admin.previous-year-exams.create')); ?>"
           class="btn btn-primary">
            <?php echo e(__('messages.add_new')); ?>

        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('messages.year_label')); ?></th>
                    <th><?php echo e(__('messages.subject')); ?></th>
                    <th><?php echo e(__('messages.title_ar_short')); ?></th>
                    <th><?php echo e(__('messages.title_en_short')); ?></th>
                    <th><?php echo e(__('messages.pdf_file_label')); ?></th>
                    <th><?php echo e(__('messages.Status')); ?></th>
                    <th width="180"><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>

            <tbody>

                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td><?php echo e($exam->id); ?></td>

                        <td><?php echo e($exam->year); ?></td>

                        <td>
                            <?php echo e($exam->subject?->name_ar); ?>

                        </td>

                        <td><?php echo e($exam->title_ar); ?></td>

                        <td><?php echo e($exam->title_en); ?></td>

                        <td>
                            <a href="<?php echo e(asset('assets/uploads/previousYearExam/'.$exam->pdf_file)); ?>"
                               target="_blank">
                                <?php echo e(__('messages.view_pdf')); ?>

                            </a>
                        </td>

                        <td>
                            <?php echo $exam->status
                                ? '<span class="badge bg-success">'.__('messages.Active').'</span>'
                                : '<span class="badge bg-danger">'.__('messages.Inactive').'</span>'; ?>

                        </td>

                        <td>

                            <a href="<?php echo e(route('admin.previous-year-exams.edit',$exam->id)); ?>"
                               class="btn btn-warning btn-sm">
                                <?php echo e(__('messages.Edit')); ?>

                            </a>

                            <form method="POST"
                                  action="<?php echo e(route('admin.previous-year-exams.destroy',$exam->id)); ?>"
                                  style="display:inline-block">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('<?php echo e(__('messages.delete_confirm')); ?>')">
                                    <?php echo e(__('messages.Delete')); ?>

                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>

        </table>

        <?php echo e($exams->links()); ?>


    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\previous_year_exams\index.blade.php ENDPATH**/ ?>