<?php $__env->startSection('title', __('inventories.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('inventories.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <div class="row">
        <form action="<?php echo e(url('inventories/table')); ?>" method="GET" target="table">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong><?php echo e(__('inventories.product')); ?> :</strong>
                <select id="producr_id" name="product_id" onchange="this.form.submit()">
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($product->id); ?>" ><?php echo e($product->model.'('.$product->name.')'); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="row md-12">
      <iframe name="table" src="<?php echo e(url('inventories/table')); ?>" frameborder="0" width="100%" onload='resizeIframe(this)'>Your browser isn't compatible</iframe>
    </div>
<script type="text/javascript">
  function resizeIframe(obj) {
     obj.style.height = 0;
     obj.style.height = obj.contentWindow.document.body.scrollHeight + 200 + 'px';
  }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/inventories/index.blade.php ENDPATH**/ ?>