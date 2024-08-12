<?php
$heads = [
    ['label' =>__('warranties.id'), 'width' => 10],
    __('warranties.order_id'),
    __('warranties.name'),
    __('warranties.phone'),
    __('warranties.register_date'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
?>
<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'warranty-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
        <?php $__currentLoopData = $warranties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warranty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($warranty->id); ?></td>
            <td><?php echo e($warranty->order_id); ?></td>
            <td><?php echo e(($warranty->order) ? $warranty->order->name : null); ?></td>
            <?php if(auth()->user()->role == App\Enums\UserRole::ShareHolder): ?>
               <td><?php echo e(str_split($warranty->phone, 5)[0].'****'); ?></td>
            <?php else: ?>
               <td><?php echo e($warranty->phone); ?></td>
            <?php endif; ?>
            <td><?php echo e($warranty->register_time); ?></td>
            <td>
                <?php if($warranty->order()): ?>
                <form action="<?php echo e(route('warranties.destroy',$warranty->id)); ?>" method="POST">
                    <a class="btn btn-info" href="<?php echo e(route('warranties.show', $warranty->id)); ?>"><?php echo e(__('tables.details')); ?></a>
                </form>
                <?php endif; ?>
            </td>
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

<?php /**PATH /files/www/sales2/resources/views/warranties/table2.blade.php ENDPATH**/ ?>