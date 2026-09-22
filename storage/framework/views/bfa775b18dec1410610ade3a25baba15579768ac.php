
<?php $__env->startSection('title', $contactMessage->first_name); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.message_details')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.from_label')); ?> <?php echo e($contactMessage->first_name); ?> <?php echo e($contactMessage->last_name); ?></p>
    </div>
    <a href="<?php echo e(route('admin.contact_messages.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-3">

    <div class="col-12 col-xl-8">

        
        <div class="panel-card mb-3">
            <div class="panel-card-header d-flex justify-content-between align-items-center">
                <h2 class="panel-card-title"><?php echo e($contactMessage->subject); ?></h2>
                <?php $statusConfig = ['new'=>['pill-warning','new_status'],'read'=>['pill-info','read_status'],'replied'=>['pill-success','replied_status'],'closed'=>['pill-neutral','closed_status']]; ?>
                <span class="pill <?php echo e($statusConfig[$contactMessage->status][0]); ?>"><?php echo e(__('messages.'.$statusConfig[$contactMessage->status][1])); ?></span>
            </div>
            <div class="panel-card-body">
                <div style="font-size:.87rem;line-height:1.8;white-space:pre-wrap;color:var(--text)"><?php echo e($contactMessage->message); ?></div>
            </div>
        </div>

        
        <?php if($contactMessage->status !== 'closed'): ?>
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.reply_label')); ?></h2></div>
            <div class="panel-card-body">
                <?php if($contactMessage->admin_reply): ?>
                <div class="p-3 mb-3" style="background:rgba(124,58,237,.05);border-radius:8px;border-left:3px solid var(--primary)">
                    <div style="font-size:.75rem;font-weight:600;color:var(--primary);margin-bottom:6px"><?php echo e(__('messages.previous_reply')); ?> · <?php echo e($contactMessage->replied_at?->format('M d, Y H:i')); ?></div>
                    <div style="font-size:.87rem;white-space:pre-wrap"><?php echo e($contactMessage->admin_reply); ?></div>
                </div>
                <?php endif; ?>
                <form action="<?php echo e(route('admin.contact_messages.reply', $contactMessage->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <textarea name="admin_reply" rows="5" class="form-control <?php $__errorArgs = ['admin_reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo e(__('messages.write_reply_ph')); ?>" required><?php echo e(old('admin_reply', $contactMessage->admin_reply)); ?></textarea>
                        <?php $__errorArgs = ['admin_reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn-primary-sm"><i class="bi bi-send"></i> <?php echo e(__('messages.send_reply')); ?></button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="panel-card mb-3">
            <div class="panel-card-body" style="color:var(--muted);text-align:center;padding:24px">
                <i class="bi bi-x-circle" style="font-size:1.5rem;display:block;margin-bottom:8px"></i>
                <?php echo e(__('messages.message_closed_notice')); ?>

            </div>
        </div>
        <?php endif; ?>

    </div>

    
    <div class="col-12 col-xl-4">
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.sender')); ?></h2></div>
            <div class="panel-card-body">
                <div style="font-size:.87rem">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:var(--muted)"><?php echo e(__('messages.name_field')); ?></span>
                        <strong><?php echo e($contactMessage->first_name); ?> <?php echo e($contactMessage->last_name); ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:var(--muted)"><?php echo e(__('messages.email_label')); ?></span>
                        <a href="mailto:<?php echo e($contactMessage->email); ?>" style="color:var(--primary)"><?php echo e($contactMessage->email); ?></a>
                    </div>
                    <?php if($contactMessage->phone): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:var(--muted)"><?php echo e(__('messages.phone_label')); ?></span>
                        <span><?php echo e($contactMessage->phone); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color:var(--muted)"><?php echo e(__('messages.received_label')); ?></span>
                        <span><?php echo e($contactMessage->created_at->format('M d, Y H:i')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span style="color:var(--muted)"><?php echo e(__('messages.Status')); ?></span>
                        <span class="pill <?php echo e($statusConfig[$contactMessage->status][0]); ?>"><?php echo e(__('messages.'.$statusConfig[$contactMessage->status][1])); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.Actions')); ?></h2></div>
            <div class="panel-card-body d-flex flex-column gap-2">
                <a href="mailto:<?php echo e($contactMessage->email); ?>?subject=Re: <?php echo e($contactMessage->subject); ?>" class="btn-outline-sm justify-content-center">
                    <i class="bi bi-envelope"></i> <?php echo e(__('messages.email_directly')); ?>

                </a>
                <?php if($contactMessage->status !== 'closed'): ?>
                <form action="<?php echo e(route('admin.contact_messages.destroy', $contactMessage->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.close_message_confirm')); ?>')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn-outline-sm w-100 justify-content-center" style="color:#dc2626;border-color:#fecaca">
                        <i class="bi bi-x-circle"></i> <?php echo e(__('messages.close_message')); ?>

                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\contact_show.blade.php ENDPATH**/ ?>