    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.project')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><select id="project_id" name="project_id">
                      <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($project->id); ?>" <?php echo e(($customer->order->project_id == $project->id) ? "selected" : null); ?> ><?php echo e($project->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.product')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong></td>
                <td><select id="product_id" name="product_id" >
                      <?php $__currentLoopData = $productModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($model->id); ?>" <?php echo e(($customer->order->product_id == $model->id) ? "selected" : null); ?> ><?php echo e($model->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong><?php echo e(__('orders.extras')); ?> :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10">
                      <option value="0">----------</option>
                      <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($extra->id); ?>" <?php echo e(in_array($extra->id, $extras2) ? "selected" : null); ?> ><?php echo e($extra->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
            </tr>
          </table>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#customer-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               project_id: {
                  required: true
               },
               product_id: {
                  required: true
               },
           },
           messages: {
               project_id: {
                  required: '行銷方案必選'
               },
               product_id: {
                  required: '產品型號必選'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>
<?php /**PATH /files/www/sales2/resources/views/checkOrders/orders/create.blade.php ENDPATH**/ ?>