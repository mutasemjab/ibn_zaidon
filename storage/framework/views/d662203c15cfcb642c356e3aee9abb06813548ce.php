
<?php $__env->startSection('title', 'تعديل بانر'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">تعديل بانر</h1></div>
    <a href="<?php echo e(route('admin.banners.index')); ?>" class="btn-outline-sm">
        <i class="bi bi-arrow-left"></i> رجوع
    </a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    </div>
<?php endif; ?>
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-7">
<form action="<?php echo e(route('admin.banners.update', $banner->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title">بيانات البانر</h2></div>
    <div class="panel-card-body">
        <div class="row g-3">

            <div class="col-12">
                <label class="form-label">الصورة الحالية</label><br>
                <img src="<?php echo e(asset('assets/uploads/banners/' . $banner->image)); ?>"
                     id="previewImg"
                     style="width:100%;max-height:220px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0">
            </div>

            <div class="col-12">
                <label class="form-label">تغيير الصورة (اتركه فارغاً للإبقاء على الحالية)</label>
                <input type="file" name="image" accept="image/*"
                       class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       onchange="previewNew(this)">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">الأبعاد الموصى بها: 1200 × 450 بكسل — JPG, PNG, WEBP — بحد أقصى 4MB</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">الترتيب</label>
                <input type="number" name="order_index"
                       value="<?php echo e(old('order_index', $banner->order_index)); ?>"
                       min="0" class="form-control">
                <small class="text-muted">الأصغر يظهر أولاً</small>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                           id="is_active" <?php if(old('is_active', $banner->is_active)): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="is_active">نشط</label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn-primary-sm">
                    <i class="bi bi-save"></i> حفظ التغييرات
                </button>
            </div>

        </div>
    </div>
</div>
</form>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewNew(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('previewImg').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\banners\edit.blade.php ENDPATH**/ ?>