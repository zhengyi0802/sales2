<?php
$heads = [
    ['label' =>__('checkorders.id'), 'width' => 10],
    __('orders.order_date'),
    __('checkorders.name'),
    __('checkorders.phone'),
    __('checkorders.project'),
    __('orders.product'),
    __('checkorders.sales'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'customer-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e($customer->status ? null : "bg-gray"); ?>">
      <td><?php echo e($customer->id); ?></td>
      <td><?php echo e($customer->order->order_date); ?></td>
      <td><?php echo e($customer->name); ?></td>
      <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
           <td><?php echo e(str_split($customer->phone, 5)[0].'****'); ?></td>
      <?php else: ?>
           <td><?php echo e($customer->phone); ?></td>
      <?php endif; ?>
      <td><?php echo e($customer->order->project->name); ?></td>
       <td><?php echo e($customer->order->product->model); ?></td>
      <td><?php echo e($customer->sales->name ?? ''); ?></td>
      <td><nobr>
          <form name="customer-delete-form" action="<?php echo e(route('checkOrders.destroy', $customer->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'primary','icon' => 'fa fa-lg fa-fw fa-pen']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.edit')).'','onClick' => 'window.location=\''.e(route('checkOrders.edit', $customer->id)).'\'']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'danger','icon' => 'fa fa-lg fa-fw fa-trash','type' => 'submit']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.delete')).'','onclick' => 'return confirm(\''.e(__('tables.confirm_delete')).'\');']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
            </form>
      </nobr></td>
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

<?php /**PATH /files/www/sales2/resources/views/checkOrders/table.blade.php ENDPATH**/ ?>