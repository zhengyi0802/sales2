<?php $__env->startSection('title', __('warranties.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('warranties.header')); ?></h1>
<?php $__env->stopSection(); ?>
<style>
    div.upgrade {
        margin-bottom : 20px;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="row">
      <table>
         <tr>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.name')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->order->name ?? ''); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.phone')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->order->phone ?? ''); ?>

              <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
         </tr>
         <tr>
            <td colspan="2"><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.address')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->order->address ?? ''); ?>

              <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
         </tr>
         <tr>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.model_id')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->product->model ?? ''); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.order_id')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->order_id ?? ''); ?>

              <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
         </tr>
         <tr>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.warranties_time')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->register_time); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('warranties.warranty_date')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <?php echo e($warranty->warranty_date); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
         </tr>
         <tr>
            <td colspan="2"><h2><?php echo e(__('warranties.company')); ?></h3></td>
         </td>
         <tr>
            <td colspan="2"><h3><?php echo e(__('warranties.caddress')); ?></h3></td>
         </td>
         <tr>
            <td colspan="2"><h3><?php echo e(__('warranties.cphone')); ?></h3></td>
         </td>
      </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/warranties/show.blade.php ENDPATH**/ ?>