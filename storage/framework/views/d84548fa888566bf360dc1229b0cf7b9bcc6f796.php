<?php $__env->startSection('title', __('vendors.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('vendors.header')); ?></h1>
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
    <form id="vendor-form" action="<?php echo e(route('vendors.update',$vendor->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('vendors.company')); ?> :</strong>
                    <input type="text" name="company" value="<?php echo e($vendor->company); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('vendors.country')); ?> :</strong>
                    <input type="text" name="country" value="<?php echo e($vendor->country); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('vendors.memo')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <textarea name="memo" class="form-control" rows="10"><?php echo e($vendor->memo); ?> </textarea>
                </div>
           </div>
           <?php if(auth()->user()->role == App\Enums\UserRole::Administrator): ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('vendors.status')); ?> :</strong>
                    <input type="checkbox" name="status" value="1" <?php echo e($vendor->status ? "checked" : null); ?>>
                    <label for="status"><?php echo e(__('tables.enabled')); ?></label>
                </div>
              <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
           </div>
           <?php endif; ?>
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
               company: {
                  required: true
               },
           },
           messages: {
               company: {
                  required: '公司名稱必填'
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


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/vendors/edit.blade.php ENDPATH**/ ?>