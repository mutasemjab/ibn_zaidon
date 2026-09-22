
<?php $__env->startSection('title', __('messages.contact_messages_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.contact_messages_title')); ?></h1><p class="page-sub"><?php echo e(__('messages.manage_contact_desc')); ?></p></div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>


<div class="row g-3 mb-3">
    <?php $statusConfig = ['new'=>['pill-warning','new_status'],'read'=>['pill-info','read_status'],'replied'=>['pill-success','replied_status'],'closed'=>['pill-neutral','closed_status']]; ?>
    <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-value"><?php echo e($count); ?></div>
            <div class="stat-label"><span class="pill <?php echo e($statusConfig[$s][0]); ?>"><?php echo e(__('messages.'.$statusConfig[$s][1])); ?></span></div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_contact_ph')); ?>">
            </div>
            <div class="col-6 col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.All Status')); ?></option>
                    <?php $__currentLoopData = ['new','read','replied','closed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php if(request('status') === $s): echo 'selected'; endif; ?>><?php echo e(__('messages.'.$statusConfig[$s][1])); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <tr><th><?php echo e(__('messages.sender')); ?></th><th><?php echo e(__('messages.subject_label')); ?></th><th><?php echo e(__('messages.message_label')); ?></th><th><?php echo e(__('messages.date')); ?></th><th><?php echo e(__('messages.Status')); ?></th><th><?php echo e(__('messages.Actions')); ?></th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="font-weight:500"><?php echo e($msg->first_name); ?> <?php echo e($msg->last_name); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e($msg->email); ?></div>
                        <?php if($msg->phone): ?><div style="font-size:.75rem;color:var(--muted)"><?php echo e($msg->phone); ?></div><?php endif; ?>
                    </td>
                    <td><?php echo e(Str::limit($msg->subject, 35)); ?></td>
                    <td style="color:var(--muted);font-size:.83rem"><?php echo e(Str::limit($msg->message, 60)); ?></td>
                    <td style="color:var(--muted)"><?php echo e($msg->created_at->format('M d, Y')); ?></td>
                    <td><span class="pill <?php echo e($statusConfig[$msg->status][0]); ?>"><?php echo e(__('messages.'.$statusConfig[$msg->status][1])); ?></span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.contact_messages.show', $msg->id)); ?>" class="btn-outline-sm" style="padding:4px 8px" title="<?php echo e(__('messages.view_reply')); ?>">
                                <i class="bi bi-envelope-open"></i>
                            </a>
                            <form action="<?php echo e(route('admin.contact_messages.destroy', $msg->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.close_message_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca" title="<?php echo e(__('messages.close_message')); ?>"><i class="bi bi-x-circle"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_messages_found')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($messages->withQueryString()->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\contact_us.blade.php ENDPATH**/ ?>