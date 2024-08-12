<?php
$heads = [
    ['label' =>__('shippings.order_id'), 'width' => 14],
    __('shippings.phone'),
    __('shippings.flow'),
    __('shippings.shipping_date'),
    __('shippings.completion_time'),
    __('shippings.installer'),
    __('shippings.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'shipping-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e($shipping->status ? null : "bg-gray"); ?>">
      <td><?php echo e($shipping->order_id); ?></td>
      <td><?php echo e($shipping->order->phone); ?></td>
      <td><?php echo e(trans_choice('orders.flows', $shipping->order->flow)); ?></td>
      <td><?php echo e($shipping->shipping_date); ?></td>
      <td><?php echo e($shipping->completion_time); ?></td>
      <td><?php echo e(($shipping->installer) ? $shipping->installer->name : null); ?></td>
      <td><?php echo e($shipping->creator->name); ?></td>
      <td><nobr>
          <form name="shipping-delete-form" action="<?php echo e(route('shippings.destroy', $shipping->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <?php if(auth()->user()->role == App\Enums\UserRole::Administrator ||
                 auth()->user()->role <= App\Enums\UserRole::Operator ||
                 auth()->user()->role == App\Enums\UserRole::Installer): ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'primary','icon' => 'fa fa-lg fa-fw fa-pen']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.edit')).'','onClick' => 'window.location=\''.e(route('shippings.edit', $shipping->id)).'\'']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->user()->role <= App\Enums\UserRole::Administrator): ?>
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
<?php $component->withAttributes(['title' => ''.e(__('tables.detail')).'','onClick' => 'window.location=\''.e(route('shippings.show', $shipping->id)).'\'']); ?>
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

<?php /**PATH /files/www/sales2/resources/views/shippings/table2.blade.php ENDPATH**/ ?>