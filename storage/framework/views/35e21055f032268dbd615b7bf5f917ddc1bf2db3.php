<?php $__env->startSection('title', __('currencies.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('currencies.header')); ?></h1>
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
      <table>
        <tr>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('currencies.name')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($currency->currency_name); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
            <td><?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('currencies.rate')).'','theme' => 'warning','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <?php echo e($currency->currency_rate); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?></td>
        </tr>
      </table>
      </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/currencies/show.blade.php ENDPATH**/ ?>