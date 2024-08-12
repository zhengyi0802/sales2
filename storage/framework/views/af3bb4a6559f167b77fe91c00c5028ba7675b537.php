<?php if (isset($component)) { $__componentOriginal4f1d0be2a7bf6df59a120ed70bd9af7b4f92508e = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Modal::class, ['id' => 'productsModal','title' => ''.e(__('massorders.product').__('')).'','theme' => 'teal','size' => 'lg','icon' => 'fas fa-bell','vCentered' => true,'staticBackdrop' => true,'scrollable' => true]); ?>
<?php $component->withName('adminlte-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
   <input type="text" id="productItem" hidden />
   <select id="product_id" class="col-md-6">
     <option value="">--------</option>
     <?php $__currentLoopData = $productModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <option value="<?php echo e($product->name.'('.$product->model.')'); ?>" ><?php echo e($product->name.'('.$product->model.')'); ?></option>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </select>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4f1d0be2a7bf6df59a120ed70bd9af7b4f92508e)): ?>
<?php $component = $__componentOriginal4f1d0be2a7bf6df59a120ed70bd9af7b4f92508e; ?>
<?php unset($__componentOriginal4f1d0be2a7bf6df59a120ed70bd9af7b4f92508e); ?>
<?php endif; ?>

<?php /**PATH /files/www/sales2/resources/views/massOrders/products.blade.php ENDPATH**/ ?>