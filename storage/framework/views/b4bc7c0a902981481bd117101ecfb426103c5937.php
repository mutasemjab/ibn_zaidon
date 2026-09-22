
<?php $__env->startSection('title', $student->name); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e($student->name); ?></h1>
        <p class="page-sub"><?php echo e($student->email); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.students.edit', $student->id)); ?>" class="btn-outline-sm"><i class="bi bi-pencil"></i> <?php echo e(__('messages.Edit')); ?></a>
        <a href="<?php echo e(route('admin.students.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
    </div>
</div>

<div class="row g-3">

    
    <div class="col-12 col-xl-4">
        <div class="panel-card mb-3">
            <div class="panel-card-body text-center">
                <?php if($student->avatar): ?>
                    <img src="<?php echo e(asset('assets/uploads/students/'.$student->avatar)); ?>" class="rounded-circle mb-3" style="width:90px;height:90px;object-fit:cover">
                <?php else: ?>
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:90px;height:90px;background:linear-gradient(135deg,#7c3aed,#6d28d9)">
                        <span style="color:#fff;font-size:1.8rem;font-weight:700"><?php echo e(strtoupper(substr($student->name, 0, 1))); ?></span>
                    </div>
                <?php endif; ?>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:4px"><?php echo e($student->name); ?></h3>
                <p style="font-size:.82rem;color:var(--muted);margin-bottom:12px"><?php echo e($student->email); ?></p>
                <div class="d-flex justify-content-center gap-2">
                    <span class="pill <?php echo e($student->is_active ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($student->is_active ? __('messages.Active') : __('messages.Inactive')); ?></span>
                </div>
            </div>
        </div>

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.info')); ?></h2></div>
            <div class="panel-card-body">
                <div style="font-size:.85rem">
                    <?php if($student->phone): ?><div class="d-flex justify-content-between mb-2"><span style="color:var(--muted)"><?php echo e(__('messages.phone_label')); ?></span><span><?php echo e($student->phone); ?></span></div><?php endif; ?>
                    <?php if($student->gender): ?><div class="d-flex justify-content-between mb-2"><span style="color:var(--muted)"><?php echo e(__('messages.gender_label')); ?></span><span><?php echo e($student->gender === 'male' ? __('messages.male') : __('messages.female')); ?></span></div><?php endif; ?>
                    <?php if($student->nationality): ?><div class="d-flex justify-content-between mb-2"><span style="color:var(--muted)"><?php echo e(__('messages.nationality')); ?></span><span><?php echo e($student->nationality); ?></span></div><?php endif; ?>
                    <div class="d-flex justify-content-between"><span style="color:var(--muted)"><?php echo e(__('messages.joined')); ?></span><span><?php echo e($student->created_at->format('M d, Y')); ?></span></div>
                </div>
            </div>
        </div>

     
    </div>

    
    <div class="col-12 col-xl-8">

        
        <div class="panel-card mb-3">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.enrolled_courses')); ?> (<?php echo e($student->enrollments->count()); ?>)</h2>
            </div>
            <div class="panel-card-body p-0">
                <table class="data-table">
                    <thead>
                        <tr><th><?php echo e(__('messages.course')); ?></th><th><?php echo e(__('messages.progress')); ?></th><th><?php echo e(__('messages.joined')); ?></th><th><?php echo e(__('messages.Status')); ?></th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $student->enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div style="font-size:.87rem;font-weight:500"><?php echo e(Str::limit($enrollment->course->title_en ?: $enrollment->course->title_ar, 40)); ?></div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="flex:1;height:6px;background:#e5e7eb;border-radius:3px;overflow:hidden">
                                        <div style="height:100%;width:<?php echo e($enrollment->progress_percentage); ?>%;background:var(--primary);border-radius:3px"></div>
                                    </div>
                                    <span style="font-size:.75rem;color:var(--muted);white-space:nowrap"><?php echo e($enrollment->progress_percentage); ?>%</span>
                                </div>
                            </td>
                            <td style="font-size:.8rem;color:var(--muted)"><?php echo e($enrollment->created_at->format('M d, Y')); ?></td>
                            <td><span class="pill <?php echo e($enrollment->is_completed ? 'pill-success' : 'pill-info'); ?>"><?php echo e($enrollment->is_completed ? __('messages.done') : __('messages.Active')); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center py-3" style="color:var(--muted)"><?php echo e(__('messages.no_enrollments_yet')); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="panel-card">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.exam_attempts')); ?> (<?php echo e($student->examAttempts->count()); ?>)</h2>
            </div>
            <div class="panel-card-body p-0">
                <table class="data-table">
                    <thead>
                        <tr><th><?php echo e(__('messages.exam')); ?></th><th><?php echo e(__('messages.score')); ?></th><th>%</th><th><?php echo e(__('messages.result')); ?></th><th><?php echo e(__('messages.date')); ?></th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $student->examAttempts->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="font-size:.85rem"><?php echo e(Str::limit($attempt->exam?->title_en ?: $attempt->exam?->title_ar ?? '—', 35)); ?></td>
                            <td style="font-size:.85rem"><?php echo e($attempt->score); ?>/<?php echo e($attempt->total_marks); ?></td>
                            <td style="font-size:.85rem"><?php echo e($attempt->percentage); ?>%</td>
                            <td><span class="pill <?php echo e($attempt->is_passed ? 'pill-success' : 'pill-warning'); ?>"><?php echo e($attempt->is_passed ? __('messages.passed') : __('messages.failed')); ?></span></td>
                            <td style="font-size:.8rem;color:var(--muted)"><?php echo e($attempt->submitted_at?->format('M d, Y') ?? '—'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-3" style="color:var(--muted)"><?php echo e(__('messages.no_attempts')); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\students\show.blade.php ENDPATH**/ ?>