<?php $__env->startSection('title', __('massorders.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('massorders.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><?php echo e(__('tables.edit')); ?></h1>
        </div>
        <?php echo $__env->make('layouts.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<style>
   .error {
      color       : red;
      margin-left : 5px;
      font-size   : 12px;
   }
   label.error {
      display     : inline;
   }
   span.must {
      color     : red;
      font-size : 12px;
   }
</style>
<form id="massOrder-form" action="<?php echo e(route('massOrders.update', $massOrder->id)); ?>" method="POST">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'cname','label' => ''.e(__('massorders.cname')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->cname).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'order_date','label' => ''.e(__('massorders.order_date')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'date','value' => ''.e($massOrder->order_date).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'phone','label' => ''.e(__('massorders.phone')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->phone).'','disabled' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'cid','label' => ''.e(__('massorders.cid')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->cid).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'email','label' => ''.e(__('massorders.email')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->email).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'line_id','label' => ''.e(__('massorders.line_id')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->line_id).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'address','label' => ''.e(__('massorders.address')).'','fgroupClass' => 'col-md-12']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->address).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'invoice','label' => ''.e(__('massorders.invoice')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => ''.e($massOrder->invoice).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal325d3d6934803fba81e0289d299b9960546803c2 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Select::class, ['name' => 'flow','label' => ''.e(__('massorders.flow')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
              <option value="1" <?php echo e(($massOrder->flow == 1) ? "selected" : null); ?>><?php echo e(trans_choice('massorders.flows', 1)); ?></option>
              <option value="2" <?php echo e(($massOrder->flow == 2) ? "selected" : null); ?>><?php echo e(trans_choice('massorders.flows', 2)); ?></option>
              <option value="3" <?php echo e(($massOrder->flow == 3) ? "selected" : null); ?>><?php echo e(trans_choice('massorders.flows', 3)); ?></option>
              <option value="4" <?php echo e(($massOrder->flow == 4) ? "selected" : null); ?>><?php echo e(trans_choice('massorders.flows', 4)); ?></option>
            <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal325d3d6934803fba81e0289d299b9960546803c2)): ?>
<?php $component = $__componentOriginal325d3d6934803fba81e0289d299b9960546803c2; ?>
<?php unset($__componentOriginal325d3d6934803fba81e0289d299b9960546803c2); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'outbound_date','label' => ''.e(__('massorders.outbound_date')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'date','value' => ''.e($massOrder->outbound_date).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Form\Input::class, ['name' => 'arrived_date','label' => ''.e(__('massorders.arrived_date')).'','fgroupClass' => 'col-md-6']); ?>
<?php $component->withName('adminlte-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'date','value' => ''.e($massOrder->arrived_date).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff)): ?>
<?php $component = $__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff; ?>
<?php unset($__componentOriginal7d1474369c7a69c75ad2fc0edfd903b7880af2ff); ?>
<?php endif; ?>
        </div>
        <div class="raw card-group">
          <p><strong><?php echo e(__('massorders.orderitems')); ?></strong></p>
          <?php echo $__env->make('massOrders.edit.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
        </div>
</form>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#massOrder-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               cname: {
                  required: true
               },
               order_date: {
                  required: true
               },
               phone: {
                  required: true
               },
               address: {
                  required: true
               },
           },
           messages: {
               cname: {
                  required: '訂購單位必填'
               },
               order_date: {
                  required: '訂購日期必填'
               },
               phone: {
                  required: '電話必填'
               },
               address: {
                  required: '送貨地址必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
<?php $__env->startSection('plugins.jqueryValidation', true); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/massOrders/edit.blade.php ENDPATH**/ ?>