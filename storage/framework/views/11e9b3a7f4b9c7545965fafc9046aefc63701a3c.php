<?php $__env->startSection('title', __('massorders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('massorders.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(auth()->user()->role != App\Enums\UserRole::ShareHolder && auth()->user()->role != App\Enums\UserRole::CSR): ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('massOrders.create')); ?>"><?php echo e(__('tables.new')); ?></a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
      <?php echo $__env->make('massOrders.table2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('massOrders.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/massOrders/index.blade.php ENDPATH**/ ?>