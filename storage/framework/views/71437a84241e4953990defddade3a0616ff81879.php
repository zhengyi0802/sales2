<form name="catagory-new-form" action="<?php echo e(route('catagories.store')); ?>" method="POST" enctype="multipart/form-data" >
  <?php echo csrf_field(); ?>
    <div class="card-group">
      <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'name','label' => ''.e(__('catagories.name')).'','fgroupClass' => 'col-md-12']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
    </div>
    <div class="card-group">
      <?php if (isset($component)) { $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Button::class, ['theme' => 'success','label' => ''.e(__('tables.accept')).'','type' => 'submit']); ?>
<?php $component->withName('adminlte-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mr-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806)): ?>
<?php $component = $__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806; ?>
<?php unset($__componentOriginale79ddb0df6378beefa1143d3ec5f549fbb0da806); ?>
<?php endif; ?>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#catagory-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '產品類別必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>
<?php /**PATH /files/www/sales2/resources/views/catagories/createform.blade.php ENDPATH**/ ?>