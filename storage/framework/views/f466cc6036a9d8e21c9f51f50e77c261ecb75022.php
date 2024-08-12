            <div class="form-group col-md-6">
                <strong><?php echo e(__('orders.project')); ?> :</strong>
                <select id="project_id" name="project_id" onchange="proj()">
                      <option value="" selected>--------</option>
                      <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($project->id); ?>" ><?php echo e($project->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('orders.product')); ?> :</strong>
                <select id="product_id" name="product_id" >
                      <?php $__currentLoopData = $productModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($model->id); ?>" ><?php echo e($model->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('orders.extras')); ?> :</strong>
                <select id="extra_id" name="extra_id[]" multiple="multiple" size="10" >
                  <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($extra->id); ?>" ><?php echo e($extra->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
<script>
    function proj() {
      d = document.getElementById("project_id").value;
    }
</script>
<?php /**PATH /files/www/sales2/resources/views/orders/product.blade.php ENDPATH**/ ?>