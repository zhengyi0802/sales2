         <table>
            <tr class="form-group col-md-6">
                <td><strong><?php echo e(__('orders.project')); ?> :</strong></td>
                <td><select id="project_id" name="project_id" onchange="proj()">
                      <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($project->id); ?>" <?php echo e(($order->project_id == $project->id) ? "selected" : null); ?>><?php echo e($project->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong><?php echo e(__('orders.product')); ?> :</strong></td>
                <td><select id="product_id" name="product_id" >
                      <?php $__currentLoopData = $productModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($model->id); ?>" <?php echo e(($order->product_id == $model->id) ? "selected" : null); ?>><?php echo e($model->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.price')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><input type="number" name="price" value="<?php echo e($order->price); ?>">
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.installation_fee')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><input type="number" name="installation_fee" value="<?php echo e($order->installation_fee); ?>">
            </tr>
            <tr class="form-group col-md-6">
                <td><strong><?php echo e(__('orders.extras')); ?> :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10" >
                     <option value="0">----------</option>
                  <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($extra->id); ?>" <?php echo e(in_array($extra->id, $gifts) ? "selected" : null); ?> ><?php echo e($extra->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.extraprice')); ?> :</strong></td>
                <td><input type="number" name="extra_price" class="form-control" value="<?php echo e($order->extra_price); ?>"></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong><?php echo e(__('orders.flow')); ?> :</strong></td>
                <td><select id="flow" name="flow" onchange="checkflow(this)">
                  <option value="1" <?php echo e(($order->flow == 1) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 1)); ?></option>
                  <option value="2" <?php echo e(($order->flow == 2) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 2)); ?></option>
                  <option value="3" <?php echo e(($order->flow == 3) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 3)); ?></option>
                  <option value="4" <?php echo e(($order->flow == 4) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 4)); ?></option>
                  <option value="5" <?php echo e(($order->flow == 5) ? "selected" : null); ?> disabled><?php echo e(trans_choice('orders.flows', 5)); ?></option>
                  <option value="6" <?php echo e(($order->flow == 6) ? "selected" : null); ?> disabled><?php echo e(trans_choice('orders.flows', 6)); ?></option>
                  <option value="7" <?php echo e(($order->flow == 7) ? "selected" : null); ?>><?php echo e(trans_choice('orders.flows', 7)); ?></option>
                </select></td>
            </tr>
            <tr class="form-group col-md-6" id="shipdate" >

            </tr>
            <tr class="form-group col-md-6" id="shipdate" >
                <td><strong><?php echo e(__('orders.shipping_date')); ?> :</strong></td>
                <td><input type="datetime-local"  name="shipping_date" value="<?php echo e($order->shipping ? $order->shipping->shipping_date : null); ?>" /></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong><?php echo e(__('orders.memo')); ?> :</strong></td>
                <td><textarea name="memo" rows="10"><?php echo e($order->memo); ?></textarea></td>
            </tr>
         </table>
<script>
    function checkflow(event) {
       var val = event.value;
       if (val > 2 && val < 5) {
           document.getElementById('shipdate').style.display="";
       } else {
           document.getElementById('shipdate').style.display="none";
       }
    }
</script>
<?php /**PATH /files/www/sales2/resources/views/orders/eproduct.blade.php ENDPATH**/ ?>