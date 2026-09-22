
<?php $__env->startSection('title', __('messages.edit_admin_account')); ?>

<?php $__env->startSection('content'); ?>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"><?php echo e(__('messages.edit_admin_account')); ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting-table')): ?>
      <form action="<?php echo e(route('admin.login.update',$data['id'])); ?>" method="post" >
        <div class="row">
        <?php echo csrf_field(); ?>



        <div class="col-md-6">
<div class="form-group">
  <label><?php echo e(__('messages.username_label')); ?></label>
  <input name="username" id="name" class="form-control" value="<?php echo e(old('username',$data['username'])); ?>"    >
  <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="text-danger"><?php echo e($message); ?></span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
</div>





<div class="col-md-6">
  <div class="form-group">
    <label><?php echo e(__('messages.password_label')); ?></label>
    <input name="password" id="email" class="form-control" value=""    >
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
  </div>







      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"><?php echo e(__('messages.update')); ?></button>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-sm btn-danger"><?php echo e(__('messages.Cancel')); ?></a>

      </div>
    </div>

  </div>
            </form>
            <?php endif; ?>


            </div>




        </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\auth\edit.blade.php ENDPATH**/ ?>