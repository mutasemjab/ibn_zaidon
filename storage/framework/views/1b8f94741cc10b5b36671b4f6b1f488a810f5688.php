
<?php $__env->startSection('title', $teacher->name); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e($teacher->name); ?></h1>
        <p class="page-sub"><?php echo e($teacher->specialization_en ?: $teacher->specialization_ar); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.teachers.edit', $teacher->id)); ?>" class="btn-outline-sm"><i class="bi bi-pencil"></i> <?php echo e(__('messages.Edit')); ?></a>
        <a href="<?php echo e(route('admin.teachers.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <?php echo e(session('error')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-3">

    
    <div class="col-12 col-xl-4">
        <div class="panel-card mb-3">
            <div class="panel-card-body text-center">
                <?php if($teacher->avatar): ?>
                    <img src="<?php echo e(asset('assets/uploads/teachers/'.$teacher->avatar)); ?>" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover">
                <?php else: ?>
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:100px;height:100px;background:linear-gradient(135deg,#7c3aed,#6d28d9)">
                        <span style="color:#fff;font-size:2rem;font-weight:700"><?php echo e(strtoupper(substr($teacher->name, 0, 1))); ?></span>
                    </div>
                <?php endif; ?>
                <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:4px"><?php echo e($teacher->name); ?></h3>
                <p style="font-size:.83rem;color:var(--muted);margin-bottom:12px"><?php echo e($teacher->specialization_en ?: $teacher->specialization_ar); ?></p>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="pill <?php echo e($teacher->is_active ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($teacher->is_active ? __('messages.Active') : __('messages.Inactive')); ?></span>
                    <?php if($teacher->is_verified): ?><span class="pill pill-info"><?php echo e(__('messages.verified')); ?></span><?php endif; ?>
                </div>
                <div style="font-size:.82rem;color:var(--muted)">
                    <div class="mb-1"><i class="bi bi-envelope"></i> <?php echo e($teacher->email); ?></div>
                    <?php if($teacher->phone): ?><div class="mb-1"><i class="bi bi-telephone"></i> <?php echo e($teacher->phone); ?></div><?php endif; ?>
                    <?php if($teacher->years_of_experience): ?><div><i class="bi bi-calendar3"></i> <?php echo e($teacher->years_of_experience); ?> <?php echo e(__('messages.years_experience_suffix')); ?></div><?php endif; ?>
                </div>
            </div>
        </div>

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.stats')); ?></h2></div>
            <div class="panel-card-body">
                <div class="row g-2 text-center">
                    <div class="col-6">
                        <div style="font-size:1.5rem;font-weight:700;color:var(--primary)"><?php echo e($teacher->total_courses ?? 0); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(__('messages.courses')); ?></div>
                    </div>
                    <div class="col-6">
                        <div style="font-size:1.5rem;font-weight:700;color:#059669"><?php echo e($teacher->total_students ?? 0); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(__('messages.students')); ?></div>
                    </div>
                    <div class="col-6">
                        <div style="font-size:1.5rem;font-weight:700;color:#ea580c"><?php echo e(number_format($teacher->average_rating ?? 0, 1)); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(__('messages.rating')); ?></div>
                    </div>
                    <div class="col-6">
                        <div style="font-size:1.5rem;font-weight:700;color:var(--text)"><?php echo e($teacher->created_at->format('Y')); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e(__('messages.joined')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($teacher->bio_en || $teacher->bio_ar): ?>
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.about')); ?></h2></div>
            <div class="panel-card-body">
                <p style="font-size:.85rem;line-height:1.7;color:var(--text)"><?php echo e($teacher->bio_en ?: $teacher->bio_ar); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="col-12 col-xl-8">


        
        <div class="panel-card">
            <div class="panel-card-header d-flex justify-content-between align-items-center">
                <h2 class="panel-card-title"><?php echo e(__('messages.courses')); ?> (<?php echo e($teacher->courses->count()); ?>)</h2>
                <a href="<?php echo e(route('admin.courses.index')); ?>?teacher_id=<?php echo e($teacher->id); ?>" class="btn-outline-sm" style="font-size:.78rem"><?php echo e(__('messages.view_all')); ?></a>
            </div>
            <div class="panel-card-body p-0">
                <table class="data-table">
                    <thead>
                        <tr><th><?php echo e(__('messages.course')); ?></th><th><?php echo e(__('messages.students')); ?></th><th><?php echo e(__('messages.price')); ?></th><th><?php echo e(__('messages.Status')); ?></th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $teacher->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div style="font-weight:500;font-size:.87rem"><?php echo e(Str::limit($course->title_en ?: $course->title_ar, 40)); ?></div>
                                <div style="font-size:.75rem;color:var(--muted)"><?php echo e(ucfirst($course->difficulty_level ?? 'beginner')); ?></div>
                            </td>
                            <td><?php echo e($course->enrollments_count); ?></td>
                            <td><?php echo e($course->is_free ? __('messages.free') : '$'.number_format($course->price, 2)); ?></td>
                            <td><span class="pill <?php echo e($course->is_published ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($course->is_published ? __('messages.live') : __('messages.draft')); ?></span></td>
                            <td>
                                <a href="<?php echo e(route('admin.courses.show', $course->id)); ?>" class="btn-outline-sm" style="padding:3px 8px;font-size:.78rem"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_courses_yet')); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\teachers\show.blade.php ENDPATH**/ ?>