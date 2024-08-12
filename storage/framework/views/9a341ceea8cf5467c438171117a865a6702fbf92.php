

<div class="<?php echo e($makeFormGroupClass()); ?>">

    
    <?php if(isset($label)): ?>
        <label for="<?php echo e($id); ?>" <?php if(isset($labelClass)): ?> class="<?php echo e($labelClass); ?>" <?php endif; ?>>
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>

    
    <div class="<?php echo e($makeInputGroupClass()); ?>">

        
        <?php if(isset($prependSlot)): ?>
            <div class="input-group-prepend"><?php echo e($prependSlot); ?></div>
        <?php endif; ?>

        
        <?php echo $__env->yieldContent('input_group_item'); ?>

        
        <?php if(isset($appendSlot)): ?>
            <div class="input-group-append"><?php echo e($appendSlot); ?></div>
        <?php endif; ?>

    </div>

    
    <?php if($isInvalid()): ?>
        <span class="invalid-feedback d-block" role="alert">
            <strong><?php echo e($errors->first($errorKey)); ?></strong>
        </span>
    <?php endif; ?>

    
    <?php if(isset($bottomSlot)): ?>
        <?php echo e($bottomSlot); ?>

    <?php endif; ?>

</div>



<?php if (! $__env->hasRenderedOnce('343c5faf-6b3b-4b1c-a19a-0912daa250f0')): $__env->markAsRenderedOnce('343c5faf-6b3b-4b1c-a19a-0912daa250f0'); ?>
<?php $__env->startPush('css'); ?>
<style type="text/css">

    

    .adminlte-invalid-igroup {
        box-shadow: 0 .25rem 0.5rem rgba(0,0,0,.1);
    }

    

    .adminlte-invalid-igroup > .input-group-prepend > *,
    .adminlte-invalid-igroup > .input-group-append > * {
        border-color: #dc3545 !important;
    }

</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /files/www/sales2/resources/views/vendor/adminlte/components/form/input-group-component.blade.php ENDPATH**/ ?>