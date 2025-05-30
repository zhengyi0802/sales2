<?php $__env->startSection('title', __('productModels.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('productModels.header')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1><?php echo e(__('tables.new')); ?></h1>
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
<form id="productModel-form" action="<?php echo e(route('productModels.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.model')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="model" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.name')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <?php if(auth()->user()->role == App\Enums\UserRole::Administrator): ?>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.purchase_cost')); ?> :</strong>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('currencies')->html();
} elseif ($_instance->childHasBeenRendered('I8qGjNf')) {
    $componentId = $_instance->getRenderedChildComponentId('I8qGjNf');
    $componentTag = $_instance->getRenderedChildComponentTagName('I8qGjNf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('I8qGjNf');
} else {
    $response = \Livewire\Livewire::mount('currencies');
    $html = $response->html();
    $_instance->logRenderedChild('I8qGjNf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <input type="number" name="purchase_cost" step="0.01" placeholder="1.00">
            </div>
            <?php endif; ?>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.price')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.vendor')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('vendors')->html();
} elseif ($_instance->childHasBeenRendered('lz1GCub')) {
    $componentId = $_instance->getRenderedChildComponentId('lz1GCub');
    $componentTag = $_instance->getRenderedChildComponentTagName('lz1GCub');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lz1GCub');
} else {
    $response = \Livewire\Livewire::mount('vendors');
    $html = $response->html();
    $_instance->logRenderedChild('lz1GCub', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.catagory')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('catagories')->html();
} elseif ($_instance->childHasBeenRendered('ehlUsQR')) {
    $componentId = $_instance->getRenderedChildComponentId('ehlUsQR');
    $componentTag = $_instance->getRenderedChildComponentTagName('ehlUsQR');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ehlUsQR');
} else {
    $response = \Livewire\Livewire::mount('catagories');
    $html = $response->html();
    $_instance->logRenderedChild('ehlUsQR', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.accessories')); ?> :</strong>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('accessories')->html();
} elseif ($_instance->childHasBeenRendered('C4bDKjw')) {
    $componentId = $_instance->getRenderedChildComponentId('C4bDKjw');
    $componentTag = $_instance->getRenderedChildComponentTagName('C4bDKjw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('C4bDKjw');
} else {
    $response = \Livewire\Livewire::mount('accessories');
    $html = $response->html();
    $_instance->logRenderedChild('C4bDKjw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="form-group col-md-6">
              <table class="table table-bordered" id="briefsTable">
                <tr>
                    <th><?php echo e(__('productModels.briefs')); ?></th>
                    <th><?php echo e(__('tables.action')); ?></th>
                </tr>
                <tr>
                    <td><input type="text" name="briefs[0]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="briefAdd" class="btn btn-outline-primary"><?php echo e(__('tables.new')); ?></button></td>
                </tr>
              </table>
            </div>
            <div class="form-group col-md-6">
              <table class="table table-bordered" id="specTable">
                <tr>
                    <th><?php echo e(__('productModels.specifications')); ?></th>
                    <th><?php echo e(__('tables.action')); ?></th>
                </tr>
                <tr>
                    <td><input type="text" name="specifications[0]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="specAdd" class="btn btn-outline-primary"><?php echo e(__('tables.new')); ?></button></td>
                </tr>
              </table>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.descriptions')); ?> :</strong>
                <textarea name="descriptions" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.is_accessories')); ?> :</strong>
                <input type="checkbox" name="is_accessories" value="1" />
                <label for="is_accessories"><?php echo e(__('tables.yes')); ?></label>
            </div>
            <div class="form-group col-md-6">
                <strong><?php echo e(__('productModels.extras')); ?> :</strong>
                <input type="checkbox" name="extra" value="1" />
                <label for="extras"><?php echo e(__('tables.yes')); ?></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#briefAdd").click(function () {
        ++i;
        $("#briefsTable").append('<tr><td><input type="text" name="briefs[' + i +
            ']" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger removeBrief">刪除</button></td></tr>'
            );
    });
    $(document).on('click', '.removeBrief', function () {
        $(this).parents('tr').remove();
    });

    var j=0;
    $("#specAdd").click(function () {
        ++j;
        $("#specTable").append('<tr><td><input type="text" name="specifications[' + j +
            ']" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger specBrief">刪除</button></td></tr>'
            );
    });
    $(document).on('click', '.specBrief', function () {
        $(this).parents('tr').remove();
    });

</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#productModel-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               model: {
                  required: true
               },
               name: {
                  required: true
               },
               vendor_id: {
                  required: true
               },
               catagory_id: {
                  required: true
               },
           },
           messages: {
               model: {
                  required: '產品型號必填'
               },
               name: {
                  required: '產品品名必填'
               },
               vendor_id: {
                  required: '廠商必填'
               },
               catagory_id: {
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/productModels/create.blade.php ENDPATH**/ ?>