
<?php $__env->startSection('title'); ?>
test view title
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader'); ?>
test heade1
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderlink'); ?>
<a href="#"> link </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
this is test
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
test view 
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\test.blade.php ENDPATH**/ ?>