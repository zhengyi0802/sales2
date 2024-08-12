<?php
$heads = [
     $keynames[0],
     $keynames[1],
     $keynames[2],
     $keynames[3],
     $keynames[4],
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'col-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $csvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($col[0]); ?></td>
      <td><?php echo e($col[1]); ?></td>
      <td><?php echo e($col[2]); ?></td>
      <td><?php echo e($col[3]); ?></td>
      <td><?php echo e($col[4]); ?></td>
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

<?php /**PATH /files/www/sales2/resources/views/csvs/table.blade.php ENDPATH**/ ?>