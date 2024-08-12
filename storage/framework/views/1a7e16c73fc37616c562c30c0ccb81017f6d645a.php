<?php $__env->startSection('title', __('customers.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('customers.header')); ?></h1>
<?php $__env->stopSection(); ?>
<style>
    div.upgrade {
        margin-bottom : 20px;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1><?php echo e(__('tables.details')); ?></h1>
            </div>
            <?php echo $__env->make('layouts.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.name')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->name); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.phone')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->phone); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.line_id')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->line_id); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.email')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->email); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.address')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->address); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.pid')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->pid); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.sales')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->sales->name); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.creator')).'','theme' => 'warning','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($customer->creator->name); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('customers.orders')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo $__env->make('customers.orders.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
     </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/customers/show.blade.php ENDPATH**/ ?>