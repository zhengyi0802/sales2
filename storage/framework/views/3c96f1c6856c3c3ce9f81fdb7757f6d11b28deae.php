<?php $__env->startSection('title', __('shippings.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('shippings.header')); ?></h1>
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
       .cell {
          border:solid 1px;
          padding-left:10px;
          padding-right:10px;
          text-align:center;
       }
       .cell2 {
          border:solid 1px;
          padding-left:10px;
          padding-right:10px;
          text-align:left;
       }
    </style>
    <form id="shipping-form" action="<?php echo e(route('shippings.update',$shipping->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.order_id')); ?> :</strong>
                    <input type="text" name="order_id" value="<?php echo e($shipping->order_id); ?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.name')); ?> :</strong>
                    <input type="text" name="name" value="<?php echo e($shipping->order->name); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.phone')); ?> :</strong>
                    <input type="text" name="phone" value="<?php echo e($shipping->order->phone); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($shipping->order->address); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.flow')); ?> :</strong>
                    <select id="flow" name="flow" onchange="checkflow(this)">
                      <option value="4" <?php echo e(($shipping->order->flow == 4) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 4)); ?></option>
                      <option value="5" <?php echo e(($shipping->order->flow == 5) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 5)); ?></option>
                      <option value="6" <?php echo e(($shipping->order->flow == 6) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 6)); ?></option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.installer')); ?> :</strong>
                    <select id="installer_id" name="installer_id">
                       <?php $__currentLoopData = $installers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $installer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($installer->id); ?>" <?php echo e(($shipping->installer_id == $installer->id) ? "selected" : null); ?>><?php echo e($installer->name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('shippings.shipping_date')); ?> :</strong>
                    <input type="datetime-local" name="shipping_date" value="<?php echo e($shipping->shipping_date); ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong><?php echo e(__('orders.product')); ?></strong>
                  <table style="border:solid 2px">
                    <tr>
                      <td class="cell"><?php echo e(__('shippings.id')); ?></td>
                      <td class="cell"><?php echo e(__('shippings.product')); ?></td>
                      <td class="cell"><?php echo e(__('shippings.amount')); ?></td>
                      <td class="cell"><?php echo e(__('shippings.includes')); ?></td>
                    </tr>
                    <tr>
                       <td class="cell">1</td>
                       <td class="cell2">
                         <?php echo e($shipping->order->product->name.'('.$shipping->order->product->model.')'); ?>

                       </td>
                       <td class="cell">1</td>
                       <td class="cell"><?php echo e(__('tables.yes')); ?></td>
                    </tr>
                    <tr>
                       <td class="cell">2</td>
                       <td class="cell2">
                          <?php if($shipping->order->product->accessories > 0): ?>
                             <?php echo e($shipping->order->product->accessory->name.'('.$shipping->order->product->accessory->model.')'); ?>

                          <?php endif; ?>
                       </td>
                       <td class="cell"><?php echo e(($shipping->order->product->accessories > 0) ? "1" : null); ?></td>
                       <td class="cell"><?php echo e(($shipping->order->product->accessories > 0) ? __('tables.yes') : null); ?></td>
                    </tr>
                    <tr>
                       <td class="cell">3</td>
                       <td class="cell2">
                           <?php if(isset($shipping->order->extras[0])): ?>
                               <?php echo e($shipping->order->extras[0]->product->name.'('.$shipping->order->extras[0]->product->model.')'); ?>

                           <?php endif; ?>
                       </td>
                       <td class="cell"><?php echo e(isset($shipping->order->extras[0]) ? "1" : null); ?></td>
                       <td class="cell">
                           <?php if(isset($shipping->order->extras[0])): ?>
                               <input type="checkbox" name="includes[0]" value="1"
                                  <?php echo e(($shipping->order->extras[0]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null); ?>>
                               <label for="include[0]"><?php echo e(__('tables.yes')); ?></label>
                           <?php endif; ?>
                       </td>
                    </tr>
                    <tr>
                       <td class="cell">4</td>
                       <td class="cell2">
                           <?php if(isset($shipping->order->extras[1])): ?>
                               <?php echo e($shipping->order->extras[1]->product->name.'('.$shipping->order->extras[1]->product->model.')'); ?>

                           <?php endif; ?>
                       </td>
                       <td class="cell"><?php echo e(isset($shipping->order->extras[1]) ? "1" : null); ?></td>
                       <td class="cell">
                           <?php if(isset($shipping->order->extras[1])): ?>
                               <input type="checkbox" name="includes[1]" value="1"
                                  <?php echo e(($shipping->order->extras[1]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null); ?>>
                               <label for="include[1]"><?php echo e(__('tables.yes')); ?></label>
                           <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                       <td class="cell">5</td>
                       <td class="cell2">
                           <?php if(isset($shipping->order->extras[2])): ?>
                               <?php echo e($shipping->order->extras[2]->product->name.'('.$shipping->order->extras[2]->product->model.')'); ?>

                           <?php endif; ?>
                       </td>
                       <td class="cell"><?php echo e(isset($shipping->order->extras[2]) ? "1" : null); ?></td>
                       <td class="cell">
                           <?php if(isset($shipping->order->extras[2])): ?>
                               <input type="checkbox" name="includes[2]" value="1"
                                  <?php echo e(($shipping->order->extras[2]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null); ?> >
                               <label for="include[2]"><?php echo e(__('tables.yes')); ?></label>
                           <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                       <td class="cell">6</td>
                       <td class="cell2">
                           <?php if(isset($shipping->order->extras[3])): ?>
                               <?php echo e($shipping->order->extras[3]->product->name.'('.$shipping->order->extras[3]->product->model.')'); ?>

                           <?php endif; ?>
                       </td>
                       <td class="cell"><?php echo e(isset($shipping->order->extras[3]) ? "1" : null); ?></td>
                       <td class="cell">
                           <?php if(isset($shipping->order->extras[3])): ?>
                               <input type="checkbox" name="includes[3]" value="1"
                                  <?php echo e(($shipping->order->extras[0]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null); ?>>
                               <label for="include[3]"><?php echo e(__('tables.yes')); ?></label>
                           <?php endif; ?>
                        </td>
                    </tr>
                </table>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
           </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/shippings/edit.blade.php ENDPATH**/ ?>