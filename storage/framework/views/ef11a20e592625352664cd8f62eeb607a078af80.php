
<?php $__env->startSection('title', __('messages.add_subject')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.add_subject')); ?></h1>
        <?php if($parentPreset): ?>
            <p class="page-sub"><?php echo e(__('messages.under')); ?>: <strong><?php echo e($parentPreset->name_ar); ?></strong></p>
        <?php endif; ?>
    </div>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?>

    </a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    </div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-7">
<form action="<?php echo e(route('admin.subjects.store')); ?>" method="POST">
<?php echo csrf_field(); ?>
<input type="hidden" name="redirect_to_tree" value="<?php echo e(request('redirect_to_tree', 0)); ?>">

<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.subject_info')); ?></h2></div>
    <div class="panel-card-body">
        <div class="row g-3">

            
            <div class="col-12">
                <label class="form-label"><?php echo e(__('messages.category')); ?> <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">— <?php echo e(__('messages.select_option')); ?> —</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>"
                            <?php echo e(old('category_id', $parentPreset?->id) == $cat->id ? 'selected' : ''); ?>>
                            <?php echo e($cat->full_path); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.subject_ar')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" value="<?php echo e(old('name_ar')); ?>"
                       class="form-control <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" dir="rtl" required>
                <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.subject_en')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name_en" value="<?php echo e(old('name_en')); ?>"
                       class="form-control <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.icon_class')); ?></label>
                <div class="input-group">
                    <span class="input-group-text"><i id="subIconPreview" class="bi bi-journal-bookmark"></i></span>
                    <input type="text" name="icon" value="<?php echo e(old('icon')); ?>" class="form-control"
                           placeholder="bi-book"
                           oninput="document.getElementById('subIconPreview').className='bi '+this.value">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.color_class')); ?></label>
                <input type="text" name="color_class" value="<?php echo e(old('color_class')); ?>" class="form-control"
                       placeholder="text-primary">
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.order_index')); ?></label>
                <input type="number" name="order_index" value="<?php echo e(old('order_index', 0)); ?>" min="0" class="form-control">
            </div>

            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                           id="is_active" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active"><?php echo e(__('messages.Active')); ?></label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn-primary-sm">
                    <i class="bi bi-save"></i> <?php echo e(__('messages.save')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\subjects\create.blade.php ENDPATH**/ ?>