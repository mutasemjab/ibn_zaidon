
<?php $__env->startSection('title', 'إرسال إشعار'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <h1 class="page-title">إرسال إشعار للطلاب</h1>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-7">
<form action="<?php echo e(route('admin.notifications.send')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title">محتوى الإشعار</h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">العنوان <span class="text-danger">*</span></label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-12">
                <label class="form-label">نص الإشعار <span class="text-danger">*</span></label>
                <textarea name="body" rows="4" class="form-control <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('body')); ?></textarea>
                <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
                <label class="form-label">إرسال إلى <span class="text-danger">*</span></label>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="target" id="t_all" value="all"
                               <?php if(old('target', 'all') === 'all'): echo 'checked'; endif; ?> onchange="showTarget(this.value)">
                        <label class="form-check-label" for="t_all">كل الطلاب</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="target" id="t_student" value="student"
                               <?php if(old('target') === 'student'): echo 'checked'; endif; ?> onchange="showTarget(this.value)">
                        <label class="form-check-label" for="t_student">طالب محدد</label>
                    </div>
                </div>
            </div>


            <div class="col-12" id="student_select" style="<?php echo e(old('target') === 'student' ? '' : 'display:none'); ?>">
                <label class="form-label">اختر الطالب</label>
                <select name="student_id" class="form-select <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">— اختر —</option>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($student->id); ?>" <?php if(old('student_id') == $student->id): echo 'selected'; endif; ?>>
                            <?php echo e($student->name); ?> <?php if($student->national_id): ?>(<?php echo e($student->national_id); ?>)<?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-send"></i> إرسال الإشعار</button>
            </div>
        </div>
    </div>
</div>
</form>
</div>

<div class="col-12 col-xl-5">
    <div class="panel-card">
        <div class="panel-card-header"><h2 class="panel-card-title">ملاحظات</h2></div>
        <div class="panel-card-body">
            <ul class="mb-0" style="line-height:2">
                <li>الإشعار يُخزَّن في قاعدة البيانات للطلاب ويمكنهم رؤيته في التطبيق</li>
                <li>الإشعار يُرسل عبر FCM فقط للطلاب الذين فعّلوا التطبيق ومنحوا إذن الإشعارات</li>
                <li>إرسال "كل الطلاب" قد يستغرق وقتاً إذا كان العدد كبيراً</li>
            </ul>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function showTarget(val) {
    document.getElementById('student_select').style.display = val === 'student' ? '' : 'none';
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\notifications\send.blade.php ENDPATH**/ ?>