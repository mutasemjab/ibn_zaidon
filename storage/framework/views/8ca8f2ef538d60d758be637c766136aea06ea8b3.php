<?php
    $key   = $f['key'];
    $label = $f['label'][$loc] ?? $f['label']['en'];
    $hint  = $f['hint'][$loc] ?? null;
    $row   = $settings->get($key);
    $type  = $f['type'];
?>

<?php if($f['bilingual']): ?>
    <?php $__currentLoopData = ['ar', 'en']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $name = "{$key}_{$lang}";
            $val  = old($name, $lang === 'ar' ? $row?->value_ar : $row?->value_en);
            $dir  = $lang === 'ar' ? 'rtl' : 'ltr';
        ?>
        <div class="col-md-6">
            <label class="form-label"><?php echo e($label); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
            <?php if($type === 'textarea'): ?>
                <textarea name="<?php echo e($name); ?>" dir="<?php echo e($dir); ?>" rows="<?php echo e($f['rows'] ?? 3); ?>"
                          class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e($val); ?></textarea>
            <?php else: ?>
                <input type="text" name="<?php echo e($name); ?>" dir="<?php echo e($dir); ?>" value="<?php echo e($val); ?>"
                       class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php endif; ?>
            <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php if($hint): ?><small class="text-muted"><?php echo e($hint); ?></small><?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="col-md-<?php echo e($f['col'] ?? 6); ?>">
        <label class="form-label">
            <?php if(!empty($f['icon'])): ?><i class="bi <?php echo e($f['icon']); ?>"></i><?php endif; ?>
            <?php echo e($label); ?>

        </label>

        <?php if($type === 'image'): ?>
            <input type="file" name="<?php echo e($key); ?>" accept="image/*"
                   class="form-control <?php $__errorArgs = [$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <?php if($row?->value_ar): ?>
                <img src="<?php echo e(asset('assets/uploads/site/' . $row->value_ar)); ?>" alt=""
                     class="mt-2" style="height:80px;border-radius:6px;object-fit:cover">
            <?php endif; ?>
            <small class="text-muted d-block"><?php echo e(__('messages.leave_empty_keep_file')); ?></small>
        <?php else: ?>
            <?php
                $htmlType = match ($type) { 'url' => 'url', 'email' => 'email', 'number' => 'number', default => 'text' };
                $val      = old($key, $row?->value_ar);
            ?>
            <input type="<?php echo e($htmlType); ?>" name="<?php echo e($key); ?>" value="<?php echo e($val); ?>"
                   <?php if($type === 'number'): ?> min="0" <?php endif; ?>
                   <?php if(!empty($f['placeholder'])): ?> placeholder="<?php echo e($f['placeholder']); ?>" <?php elseif($type === 'url'): ?> placeholder="https://..." <?php endif; ?>
                   <?php if(in_array($type, ['url', 'email', 'number', 'icon'], true)): ?> dir="ltr" <?php endif; ?>
                   class="form-control <?php $__errorArgs = [$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <?php endif; ?>

        <?php $__errorArgs = [$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php if($hint): ?><small class="text-muted d-block"><?php echo e($hint); ?></small><?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\site-settings\_field.blade.php ENDPATH**/ ?>