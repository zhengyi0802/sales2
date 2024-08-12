<ul>
  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
      <a href="<?php echo e(route('productModels.edit', $productModel->id)); ?>"><?php echo e($productModel->model.'('.$productModel->name.')'); ?></a>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH /files/www/sales2/resources/views/catagories/manageChild.blade.php ENDPATH**/ ?>