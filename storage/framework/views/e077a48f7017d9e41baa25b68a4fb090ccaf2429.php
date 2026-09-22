
<?php $__env->startSection('title', __('messages.add_number')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.add_number')); ?></h1></div>
    <a href="<?php echo e(route('admin.card-numbers.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-6">
<form action="<?php echo e(route('admin.card-numbers.store')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.card_number_info')); ?></h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label"><?php echo e(__('messages.card_label')); ?> <span class="text-danger">*</span></label>
                <select name="card_id" class="form-select <?php $__errorArgs = ['card_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value=""><?php echo e(__('messages.select_card_ph')); ?></option>
                    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($card->id); ?>" <?php if(old('card_id') == $card->id): echo 'selected'; endif; ?>><?php echo e($card->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['card_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-12">
                <label class="form-label"><?php echo e(__('messages.card_number_field')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="number" value="<?php echo e(old('number')); ?>"
                       class="form-control font-monospace <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="<?php echo e(__('messages.enter_unique_number_ph')); ?>" required>
                <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.activate_label')); ?> <span class="text-danger">*</span></label>
                <select name="activate" class="form-select <?php $__errorArgs = ['activate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="1" <?php if(old('activate', '1') == '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.Active')); ?></option>
                    <option value="2" <?php if(old('activate') == '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.Inactive')); ?></option>
                </select>
                <?php $__errorArgs = ['activate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.Status')); ?> <span class="text-danger">*</span></label>
                <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="2" <?php if(old('status', '2') == '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.not_used')); ?></option>
                    <option value="1" <?php if(old('status') == '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.used')); ?></option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.sell_label')); ?> <span class="text-danger">*</span></label>
                <select name="sell" class="form-select <?php $__errorArgs = ['sell'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="2" <?php if(old('sell', '2') == '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.not_sold')); ?></option>
                    <option value="1" <?php if(old('sell') == '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.sold')); ?></option>
                </select>
                <?php $__errorArgs = ['sell'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.save_number')); ?></button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\card_numbers\create.blade.php ENDPATH**/ ?>