
<?php $__env->startSection('title', __('messages.students_title')); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="page-title"><?php echo e(__('messages.students_title')); ?></h1>
            <p class="page-sub"><?php echo e(__('messages.manage_students_desc')); ?></p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?php echo e(route('admin.students.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i>
                <?php echo e(__('messages.add_student')); ?></a>
        </div>
    </div>


    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>

    <div class="panel-card mb-3">
        <div class="panel-card-body">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_name_email_ph')); ?>">
                </div>

                <div class="col-6 col-md-3">
                    <select name="is_active" class="form-select form-select-sm">
                        <option value=""><?php echo e(__('messages.All Status')); ?></option>
                        <option value="1" <?php if(request('is_active') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.Active')); ?></option>
                        <option value="0" <?php if(request('is_active') === '0'): echo 'selected'; endif; ?>><?php echo e(__('messages.Inactive')); ?></option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel-card">
        <div class="panel-card-body p-0">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__('messages.student')); ?></th>
                        <th><?php echo e(__('messages.phone_label')); ?></th>
                        <th><?php echo e(__('messages.courses')); ?></th>
                        <th><?php echo e(__('messages.Status')); ?></th>
                        <th><?php echo e(__('messages.joined')); ?></th>
                        <th><?php echo e(__('messages.Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td style="color:var(--muted)"><?php echo e($student->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if($student->avatar): ?>
                                        <img src="<?php echo e(asset('assets/uploads/students/' . $student->avatar)); ?>"
                                            class="avatar avatar-sm" alt="">
                                    <?php else: ?>
                                        <div class="avatar avatar-sm" style="background:#f5f3ff;color:#7c3aed">
                                            <?php echo e(strtoupper(substr($student->name, 0, 1))); ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <div style="font-weight:500"><?php echo e($student->name); ?></div>
                                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e($student->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td style="color:var(--muted)"><?php echo e($student->phone ?: '—'); ?></td>

                            <td><?php echo e($student->enrollments_count); ?></td>
                            <td><span
                                    class="pill <?php echo e($student->is_active ? 'pill-success' : 'pill-neutral'); ?>"><?php echo e($student->is_active ? __('messages.Active') : __('messages.Inactive')); ?></span>
                            </td>
                            <td style="color:var(--muted)"><?php echo e($student->created_at->format('M d, Y')); ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('admin.students.show', $student->id)); ?>" class="btn-outline-sm"
                                        style="padding:4px 8px"><i class="bi bi-eye"></i></a>
                                    <a href="<?php echo e(route('admin.students.edit', $student->id)); ?>" class="btn-outline-sm"
                                        style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                                    <form action="<?php echo e(route('admin.students.destroy', $student->id)); ?>" method="POST"
                                        onsubmit="return confirm('<?php echo e(__('messages.Delete')); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn-outline-sm"
                                            style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4" style="color:var(--muted)">
                                <?php echo e(__('messages.no_students_found')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="p-3"><?php echo e($students->withQueryString()->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\students\index.blade.php ENDPATH**/ ?>