<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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
</head>
<body>
<p><h3 class="m-0 text-dark"><?php echo e(__('inventories.product')); ?> : <?php echo e($product->model.'('.$product->name.')' ?? ''); ?></h3></p>
<form id="inventory-form" action="<?php echo e(route('inventories.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
     <input name="product_id" value="<?php echo e($product->id); ?>" hidden>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('inventories.serial')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="serial" class="form-control" value="<?php echo e($period); ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('inventories.product')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="product" class="form-control" value="<?php echo e($product->model.'('.$product->name.')'); ?>" disabled>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('inventories.inbound')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="number" name="inbound" class="form-control" value="0">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('inventories.outbound')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="number" name="outbound" class="form-control" value="0">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong><?php echo e(__('inventories.defective')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="number" name="defective" class="form-control" value="0">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
        </div>
    </div>
</form>
    <script src="https://sales2.mdo.tw/vendor/jquery/jquery.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/adminlte/dist/js/adminlte.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#inventory-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               serial: {
                  required: true
               },
               product_id: {
                  required: true
               },
               inbound: {
                  required: true
               },
               outbound: {
                  required: true
               },
               defective: {
                  required: true
               },
           },
           messages: {
               serial: {
                  required: '本期期號必填'
               },
               product_id: {
                  required: '產品型號必填'
               },
               inbound: {
                  required: '本期入庫數量必填'
               },
               outbound: {
                  required: '本期出貨數量必填'
               },
               defective: {
                  required: '本期不良品數量必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>

</body>
</html>

<?php /**PATH /files/www/sales2/resources/views/inventories/create.blade.php ENDPATH**/ ?>