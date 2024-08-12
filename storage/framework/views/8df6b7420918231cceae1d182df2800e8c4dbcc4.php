<?php
$heads = [
    ['label' =>__('orders.id'), 'width' => 10],
    __('orders.flow'),
    __('orders.name'),
    __('orders.phone'),
    __('orders.project'),
    __('orders.product'),
    __('orders.order_date'),
    __('orders.sales'),
    __('orders.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'order-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true,'withButtons' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e(($order->status || $order->flow == 6) ? null : "bg-gray"); ?>">
      <td><?php echo e($order->id); ?></td>
      <td><?php echo e(trans_choice('orders.flows', $order->flow)); ?></td>
      <td><?php echo e($order->name); ?></td>
      <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
            <td><?php echo e(str_split($order->phone, 5)[0].'****'); ?></td>
      <?php else: ?>
            <td><?php echo e($order->phone); ?></td>
      <?php endif; ?>
      <td><?php echo e($order->project->name); ?></td>
      <td><?php echo e($order->product->model); ?></td>
      <td><?php echo e(($order->order_date) ? $order->order_date : date('Y-m-d', strtotime($order->created_at))); ?></td>
      <td><?php echo e($order->sales->name); ?></td>
      <td><?php echo e($order->creator->name); ?></td>
      <td><nobr>
          <form name="order-delete-form" action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <?php if(auth()->user()->id == $order->creator->id ||
                 auth()->user()->role == App\Enums\UserRole::Operator ||
                 auth()->user()->role == App\Enums\UserRole::Administrator): ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'primary','icon' => 'fa fa-lg fa-fw fa-pen']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.edit')).'','onClick' => 'window.location=\''.e(route('orders.edit', $order->id)).'\'']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if((auth()->user()->id == $order->creator->id ||
                  auth()->user()->role == App\Enums\UserRole::Operator ||
                  auth()->user()->role == App\Enums\UserRole::Administrator) &&
                 $order->status): ?>
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
             <?php endif; ?>
             <?php if(auth()->user()->role != App\Enums\UserRole::ShareHolder): ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'info','icon' => 'fa fa-lg fa-fw fa-eye']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.detail')).'','onClick' => 'window.location=\''.e(route('orders.show', $order->id)).'\'']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
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

<?php /**PATH /files/www/sales2/resources/views/orders/table.blade.php ENDPATH**/ ?>