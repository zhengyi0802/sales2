<?php $__env->startSection('title', __('checkorders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('checkorders.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('messages'); ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e(__('checkorders.success')); ?></p>
        </div>
    <?php endif; ?>
    <?php if($message = Session::get('insert-error')): ?>
        <div class="alert alert-danger">
            <p><?php echo e(__('checkorders.phone-error')); ?></p>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row col-md-12">
        <?php echo $__env->yieldContent('messages'); ?>
    </div>

    <?php echo $__env->make('checkOrders.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/checkOrders/index.blade.php ENDPATH**/ ?>