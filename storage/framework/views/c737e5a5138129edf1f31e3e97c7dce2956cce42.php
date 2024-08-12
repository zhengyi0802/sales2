<?php $__env->startSection('title', __('projects.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('projects.header')); ?></h1>
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
<form id="project-form" action="<?php echo e(route('projects.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong><?php echo e(__('projects.name')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('projects.details')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <textarea name="details" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group col-md-6">
                <string><?php echo e(__('projects.salesing')); ?> :</strong>
                <input type="checkbox" name="salesing" value="1" >
                <label for="salesing"><?php echo e(__('tables.enabled')); ?></label>
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
        $('#project-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               details: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '方案必填'
               },
               details: {
                  required: '方案內容必填'
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/projects/create.blade.php ENDPATH**/ ?>