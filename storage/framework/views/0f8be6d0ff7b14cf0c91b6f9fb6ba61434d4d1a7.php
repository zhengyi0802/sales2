<?php $__env->startSection('title', __('saleses.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('saleses.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1><?php echo e(__('tables.edit')); ?></h1>
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
    <form id="sales-form" action="<?php echo e(route('sales.update',$sales->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.name')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="name" value="<?php echo e($sales->name); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.account')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="account" value="<?php echo e($sales->user->account); ?>" class="form-control" disabled>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.password')); ?> :</strong>
                    <input type="password" name="password" class="form-control" >
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.company')); ?> :</strong>
                    <input type="text" name="company" value="<?php echo e($sales->company); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.phone')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="phone" value="<?php echo e($sales->phone); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.line_id')); ?> :</strong>
                    <input type="text" name="line_id" value="<?php echo e($sales->line_id); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.email')); ?> :</strong>
                    <input type="text" name="email" value="<?php echo e($sales->email); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.job')); ?> :</strong>
                    <input type="text" name="job" value="<?php echo e($sales->job); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($sales->address); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.reseller')); ?> :</strong>
                    <input type="checkbox" name="reseller" value="1" <?php echo e(($sales->user->role == App\Enums\UserRole::Reseller) ? "checked" : null); ?>>
                    <label for="reseller"><?php echo e(__('tables.enabled')); ?></label>
                </div>
           </div>
           <?php if(auth()->user()->role == App\Enums\UserRole::Administrator): ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('saleses.status')); ?> :</strong>
                    <input type="checkbox" name="status" value="1" <?php echo e($sales->status ? "checked" : null); ?>>
                    <label for="status"><?php echo e(__('tables.enabled')); ?></label>
                </div>
           </div>
           <?php endif; ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                  <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
                </div>
           </div>
        </div>
    </form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#member-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               account: {
                  required: true
               },
               phone: {
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
               phone: {
                  required: '電話必填'
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


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/sales/edit.blade.php ENDPATH**/ ?>