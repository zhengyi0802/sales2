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
</head>
<body>
    <p><h3 class="m-0 text-dark"><?php echo e(__('inventories.product')); ?> : <?php echo e($product->model.'('.$product->name.')' ?? ''); ?></h3></p>
    <?php if(auth()->user()->role == App\Enums\UserRole::Stocker || auth()->user()->role == App\Enums\UserRole::Administrator): ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="<?php echo e(route('test.create', ['product_id' =>  $product->id])); ?>"><?php echo e(__('tables.newperiod')); ?></a>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php
$heads = [
    __('inventories.serial'),
    __('inventories.start_amount'),
    __('inventories.inbound'),
    __('inventories.outbound'),
    __('inventories.defective'),
    __('inventories.stock'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null,  ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'inventory-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e($inventory->status ? null : "bg-gray"); ?>">
      <td><?php echo e($inventory->serial); ?></td>
      <td><?php echo e($inventory->start_amount); ?></td>
      <td><?php echo e($inventory->inbound); ?></td>
      <td><?php echo e($inventory->outbound); ?></td>
      <td><?php echo e($inventory->defective); ?></td>
      <td><?php echo e($inventory->stock); ?></td>
      <td><nobr>
          <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'primary','icon' => 'fa fa-lg fa-fw fa-pen']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.edit')).'','onClick' => 'window.location=\''.e(route('test.edit', $inventory->id)).'\'']); ?>
           <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
      </nobr></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24)): ?>
<?php $component = $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24; ?>
<?php unset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24); ?>
<?php endif; ?>
    <script src="https://sales2.mdo.tw/vendor/jquery/jquery.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/adminlte/dist/js/adminlte.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>
<script>

    $(() => {
        $('#inventory-table').DataTable( {"order":[[0,"desc"]],"columns":[null,null,null,null,null,null,{"orderable":false}],"language":{"url":"\/\/cdn.datatables.net\/plug-ins\/1.13.4\/i18n\/zh-HANT.json"}} );
    })
</script>
</body>
</html>
<?php /**PATH /files/www/sales2/resources/views/test/table.blade.php ENDPATH**/ ?>