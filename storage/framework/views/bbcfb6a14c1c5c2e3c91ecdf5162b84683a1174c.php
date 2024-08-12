<?php $layoutHelper = app('JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper'); ?>

<?php if($layoutHelper->isLayoutTopnavEnabled()): ?>
    <?php ( $def_container_class = 'container' ); ?>
<?php else: ?>
    <?php ( $def_container_class = 'container-fluid' ); ?>
<?php endif; ?>


<div class="content-wrapper <?php echo e(config('adminlte.classes_content_wrapper', '')); ?>">

    
    <?php if (! empty(trim($__env->yieldContent('content_header')))): ?>
        <div class="content-header">
            <div class="<?php echo e(config('adminlte.classes_content_header') ?: $def_container_class); ?>">
                <?php echo $__env->yieldContent('content_header'); ?>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="content">
        <div class="<?php echo e(config('adminlte.classes_content') ?: $def_container_class); ?>">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

</div>
<?php /**PATH /files/www/sales2/resources/views/vendor/adminlte/partials/cwrapper/cwrapper-default.blade.php ENDPATH**/ ?>