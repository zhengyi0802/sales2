<?php $__env->startSection('title', __('orders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('orders.header')); ?></h1>
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

<form id="order-form" action="<?php echo e(route('orders.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('orders.name')); ?> : <?php echo e($customer->name); ?></strong>
                <input type="text" name="customer_id" class="form-control" value="<?php echo e($customer->id); ?>" hidden  />
                <input type="text" name="name" class="form-control" value="<?php echo e($customer->name); ?>" hidden  />
            </div>
            <div class="form-group col-md-4">
                <strong><?php echo e(__('orders.phone')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="phone" class="form-control" value="<?php echo e($customer->phone); ?>">
            </div>
            <div class="form-group col-md-4">
                <strong><?php echo e(__('orders.address')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="address" class="form-control" value="<?php echo e($customer->address); ?>">
            </div>
            <table>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.project')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><select id="project_id" name="project_id" >
                      <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($project->id); ?>" ><?php echo e($project->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.product')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><select id="product_id" name="product_id" >
                      <?php $__currentLoopData = $productModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($product->id); ?>" ><?php echo e($product->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.price')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><input type="number" name="price" value="0">
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.installation_fee')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><input type="number" name="installation_fee" value="0">
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.extras')); ?> :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10">
                      <option value="0">----------</option>
                      <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($extra->id); ?>" ><?php echo e($extra->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.order_date')); ?> :</strong></td>
                <td><input type="date" name="order_date" value="<?php echo e(date('Y-m-d')); ?>" ></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.sales')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><select id="sales_id" name="sales_id" >
                      <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($s->id); ?>" ><?php echo e($s->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.extraprice')); ?> :</strong></td>
                <td><input type="number" name="extra_price" class="form-control" value="0"></td>
            </tr>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#order-form').validate({
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
               address: {
                  required: true
               },
               project_id: {
                  required: true
               },
               product_id: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               phone: {
                  required: '電話必填'
               },
               address: {
                  required: '地址必填'
               },
               product_id: {
                  required: '產品型號必選'
               },
               project_id: {
                  required: '行銷方案必選'
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/orders/create2.blade.php ENDPATH**/ ?>