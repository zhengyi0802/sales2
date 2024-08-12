<?php $__env->startSection('title', __('customers.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('customers.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('messages'); ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e(__('customers.success')); ?></p>
        </div>
    <?php endif; ?>
    <?php if($message = Session::get('insert-error')): ?>
        <div class="alert alert-danger">
            <p><?php echo e(__('customers.phone-error')); ?></p>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(auth()->user()->role == App\Enums\UserRole::Administrator ||
         auth()->user()->role == App\Enums\UserRole::Operator ||
         auth()->user()->role == App\Enums\UserRole::Reseller): ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('customers.create')); ?>"><?php echo e(__('tables.new')); ?></a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row col-md-12">
        <?php echo $__env->yieldContent('messages'); ?>
    </div>

    <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
        <?php echo $__env->make('customers.table2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('customers.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/customers/index.blade.php ENDPATH**/ ?>