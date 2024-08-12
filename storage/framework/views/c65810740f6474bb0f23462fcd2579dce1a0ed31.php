<?php
$heads = [
    ['label' =>__('vendors.id'), 'width' => 10],
    __('vendors.company'),
    __('vendors.country'),
    __('vendors.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'vendor-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
  <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e($vendor->status ? null : "bg-gray"); ?>">
      <td><?php echo e($vendor->id); ?></td>
      <td><?php echo e($vendor->company); ?></td>
      <td><?php echo e($vendor->country); ?></td>
      <td><?php echo e($vendor->creator->name); ?></td>
      <td><nobr>
          <form name="vendor-delete-form" action="<?php echo e(route('vendors.destroy', $vendor->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <?php if(auth()->user()->role <= App\Enums\UserRole::Manager): ?>
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'primary','icon' => 'fa fa-lg fa-fw fa-pen']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.edit')).'','onClick' => 'window.location=\''.e(route('vendors.edit', $vendor->id)).'\'']); ?>
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->user()->role <= App\Enums\UserRole::Manager && $vendor->status): ?>
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
              <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'info','icon' => 'fa fa-lg fa-fw fa-eye']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('tables.detail')).'','onClick' => 'window.location=\''.e(route('vendors.show', $vendor->id)).'\'']); ?>
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

<?php /**PATH /files/www/sales2/resources/views/vendors/table.blade.php ENDPATH**/ ?>