<?php $__env->startSection('title', __('checkorders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('checkorders.header')); ?></h1>
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
    <form id="customer-form" action="<?php echo e(route('checkOrders.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="text" name="eid" value="<?php echo e($customer->id); ?>" hidden>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.name')); ?> :</strong>
                    <input type="text" name="name" value="<?php echo e($customer->name); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.phone')); ?> :</strong>
                    <input type="text" name="phone" value="<?php echo e($customer->phone); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.line_id')); ?> :</strong>
                    <input type="text" name="line_id" value="<?php echo e($customer->line_id); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.email')); ?> :</strong>
                    <input type="text" name="email" value="<?php echo e($customer->email); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.pid')); ?> :</strong>
                    <input type="text" name="pid" value="<?php echo e($customer->pid); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($customer->address); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.sales')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <select id="sales_id" name="sales_id" >
                        <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($s->id); ?>" <?php echo e(($s->id == $customer->sales_id) ? "selected" : null); ?> ><?php echo e($s->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.payment')); ?> :</strong>
                    <input type="radio" name="payment" value="1" <?php echo e(($customer->order->payment == 1) ? "checked" : null); ?>><?php echo e(__('checkorders.payment_credit')); ?>

                    <input type="radio" name="payment" value="2" <?php echo e(($customer->order->payment == 2) ? "checked" : null); ?>><?php echo e(__('checkorders.payment_cash')); ?>

                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('checkorders.memo')); ?> :</strong>
                    <textarea name="memo" class="form-control" rows="10"><?php echo e($customer->order->memo); ?></textarea>
                </div>
           </div>
           <?php echo $__env->make('checkOrders.orders.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
           },
           messages: {
               name: {
                  required: '姓名必填'
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


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/checkOrders/edit.blade.php ENDPATH**/ ?>