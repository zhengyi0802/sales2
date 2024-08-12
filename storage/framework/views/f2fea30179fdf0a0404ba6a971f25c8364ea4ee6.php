<?php $__env->startSection('title', __('saleses.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('saleses.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><?php echo e(__('tables.new')); ?></h1>
        </div>
        <?php echo $__env->make('layouts.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<style>
   .error {
      color       : red;
      margin-left : 5px;
      font-size   : 12px;
   }
   label.error {
      display     : inline;
   }
   span.must {
      color     : red;
      font-size : 12px;
   }
</style>
<form id="sales-form" action="<?php echo e(route('saleses.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.name')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.account')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="account" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.password')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.company')); ?> :</strong>
                <input type="text" name="company" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.phone')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('saleses.job')); ?> :</strong>
                <input type="text" name="job" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#sales-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               phone: {
                  required: true
               },
               account: {
                  required: true
               },
               password: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               account: {
                  required: '帳號必填'
               },
               password: {
                  required: '密碼必填'
               },
               phone: {
                  required: '電話ㄜ必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/saleses/create.blade.php ENDPATH**/ ?>