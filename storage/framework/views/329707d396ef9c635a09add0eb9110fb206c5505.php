<?php $__env->startSection('title', __('orders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('orders.header')); ?></h1>
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
       option:checked {
          background-color: yellow;
       }
    </style>
    <form id="order-form" action="<?php echo e(route('orders.update',$order->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.name')); ?> :</strong>
                    <input type="text" name="name" value="<?php echo e($order->name); ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.phone')); ?> :</strong>
                    <input type="text" name="phone" value="<?php echo e($order->phone); ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($order->address); ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.order_date')); ?> :</strong>
                    <input type="date" name="order_date" value="<?php echo e(($order->order_date) ? $order->order_date : date('Y-m-d', strtotime($order->created_at))); ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.installer')); ?> :</strong>
                    <select id="installer_id" name="installer_id" >
                        <?php $__currentLoopData = $installers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($installer->id); ?>" ><?php echo e($installer->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.sales')); ?> :</strong>
                    <select id="sales_id" name="sales_id" >
                        <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($s->id); ?>" <?php echo e(($s->id == $order->sales_id) ? "selected" : null); ?> ><?php echo e($s->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <?php echo $__env->make('orders.eproduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
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
               phone: {
                  required: true
               },
               address: {
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
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/orders/edit.blade.php ENDPATH**/ ?>