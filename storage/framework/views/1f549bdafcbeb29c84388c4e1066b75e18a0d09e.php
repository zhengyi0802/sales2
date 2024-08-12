<?php $__env->startSection('title', __('orders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('orders.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
      <?php echo $__env->make('orders.table2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('orders.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/orders/index.blade.php ENDPATH**/ ?>