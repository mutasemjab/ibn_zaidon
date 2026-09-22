
<?php $__env->startSection('title', __('messages.edit_card')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.edit_card')); ?></h1></div>
    <a href="<?php echo e(route('admin.cards.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-7">
<form action="<?php echo e(route('admin.cards.update', $card->id)); ?>" method="POST" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.card_details')); ?></h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.name_ar')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" value="<?php echo e(old('name_ar', $card->name_ar)); ?>"
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
                <label class="form-label"><?php echo e(__('messages.name_en')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="name_en" value="<?php echo e(old('name_en', $card->name_en)); ?>"
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
            <div class="col-12">
                <label class="form-label"><?php echo e(__('messages.pos_optional')); ?></label>
                <select name="pos_id" class="form-select <?php $__errorArgs = ['pos_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value=""><?php echo e(__('messages.no_pos_option')); ?></option>
                    <?php $__currentLoopData = $posList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pos->id); ?>" <?php if(old('pos_id', $card->pos_id) == $pos->id): echo 'selected'; endif; ?>>
                        <?php echo e($pos->name_en); ?> — <?php echo e($pos->city->name_en ?? ''); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['pos_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.selling_price')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="selling_price" value="<?php echo e(old('selling_price', $card->selling_price)); ?>"
                       step="0.01" min="0" class="form-control <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.number_of_cards')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="number_of_cards" value="<?php echo e(old('number_of_cards', $card->number_of_cards)); ?>"
                       min="0" class="form-control <?php $__errorArgs = ['number_of_cards'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['number_of_cards'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-12">
                <?php if($card->photo): ?>
                    <img src="<?php echo e(asset('assets/uploads/cards/'.$card->photo)); ?>" class="mb-2"
                         style="width:70px;height:70px;object-fit:cover;border-radius:8px">
                <?php endif; ?>
                <label class="form-label d-block"><?php echo e(__('messages.photo_label')); ?></label>
                <input type="file" name="photo" accept="image/*" class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="col-12"><hr class="my-1"></div>
            <div class="col-12">
                <label class="form-label fw-semibold">نوع تفعيل البطاقة <span class="text-danger">*</span></label>
                <?php $currentType = old('activation_type', $card->activation_type ?? 'price'); ?>
                <div class="d-flex flex-wrap gap-3 mt-1">
                    <label class="d-flex align-items-center gap-2 p-3 rounded border cursor-pointer activation-option <?php echo e($currentType === 'course'  ? 'border-primary' : ''); ?>" style="min-width:160px">
                        <input type="radio" name="activation_type" value="course"
                               <?php echo e($currentType === 'course' ? 'checked' : ''); ?>

                               class="activation-radio" style="accent-color:var(--primary)">
                        <div>
                            <div style="font-weight:600;font-size:.9rem">دورة محددة</div>
                            <div style="font-size:.75rem;color:var(--muted)">تفعّل دورة واحدة فقط</div>
                        </div>
                    </label>
                    <label class="d-flex align-items-center gap-2 p-3 rounded border cursor-pointer activation-option <?php echo e($currentType === 'teacher' ? 'border-primary' : ''); ?>" style="min-width:160px">
                        <input type="radio" name="activation_type" value="teacher"
                               <?php echo e($currentType === 'teacher' ? 'checked' : ''); ?>

                               class="activation-radio" style="accent-color:var(--primary)">
                        <div>
                            <div style="font-weight:600;font-size:.9rem">معلم محدد</div>
                            <div style="font-size:.75rem;color:var(--muted)">تفعّل أي دورة لهذا المعلم</div>
                        </div>
                    </label>
                    <label class="d-flex align-items-center gap-2 p-3 rounded border cursor-pointer activation-option <?php echo e($currentType === 'price'   ? 'border-primary' : ''); ?>" style="min-width:160px">
                        <input type="radio" name="activation_type" value="price"
                               <?php echo e($currentType === 'price'   ? 'checked' : ''); ?>

                               class="activation-radio" style="accent-color:var(--primary)">
                        <div>
                            <div style="font-weight:600;font-size:.9rem">حسب السعر</div>
                            <div style="font-size:.75rem;color:var(--muted)">تفعّل أي دورة بنفس سعر البيع</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="col-12" id="pick-course" style="<?php echo e($currentType === 'course' ? '' : 'display:none'); ?>">
                <label class="form-label">اختر الدورة <span class="text-danger">*</span></label>
                <select name="linked_course_id" class="form-select <?php $__errorArgs = ['linked_course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">— اختر دورة —</option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>" <?php if(old('linked_course_id', $card->linked_course_id) == $c->id): echo 'selected'; endif; ?>>
                            <?php echo e($c->title_ar); ?> — <?php echo e($c->teacher?->name ?? ''); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['linked_course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12" id="pick-teacher" style="<?php echo e($currentType === 'teacher' ? '' : 'display:none'); ?>">
                <label class="form-label">اختر المعلم <span class="text-danger">*</span></label>
                <select name="linked_teacher_id" class="form-select <?php $__errorArgs = ['linked_teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">— اختر معلماً —</option>
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t->id); ?>" <?php if(old('linked_teacher_id', $card->linked_teacher_id) == $t->id): echo 'selected'; endif; ?>>
                            <?php echo e($t->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['linked_teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.save_changes')); ?></button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.querySelectorAll('.activation-radio').forEach(radio => {
    radio.addEventListener('change', function () {
        document.getElementById('pick-course').style.display  = this.value === 'course'  ? '' : 'none';
        document.getElementById('pick-teacher').style.display = this.value === 'teacher' ? '' : 'none';
        document.querySelectorAll('.activation-option').forEach(el => el.classList.remove('border-primary'));
        this.closest('.activation-option').classList.add('border-primary');
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\cards\edit.blade.php ENDPATH**/ ?>