<?php
$heads = [
    ['label' =>__('massorders.index'), 'width' => 10],
    __('massorders.product'),
    __('massorders.amount'),
    __('massorders.single_price'),
    __('massorders.price'),
];
$config = [
    'order' => [[0, 'asc']],
    'columns' => [],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'orderlist-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $massOrder->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item['index']); ?></td>
      <td><?php echo e($item['product']); ?></td>
      <td><?php echo e($item['amount']); ?></td>
      <td><?php echo e($item['single_price']); ?></td>
      <td><?php echo e($item['price']); ?></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24)): ?>
<?php $component = $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24; ?>
<?php unset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24); ?>
<?php endif; ?>
<?php $__env->startSection('plugins.Datatables', true); ?>
<?php $__env->startSection('plugins.DatatablesPlugin', true); ?>

<?php /**PATH /files/www/sales2/resources/views/massOrders/show/items.blade.php ENDPATH**/ ?>