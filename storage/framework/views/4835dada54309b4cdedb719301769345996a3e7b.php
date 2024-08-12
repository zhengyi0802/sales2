<?php $__env->startSection('title', __('profiles.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('profiles.header')); ?></h1>
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
    <?php if($user->role == App\Enums\UserRole::Sales ||
         $user->role == App\Enums\UserRole::Reseller ): ?>
         <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('saleses.sales_link')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <span id="url"><?php echo e(__('saleses.sales_http').$user->sales->id); ?></span>
                <a href="#" onclick="CopyToClipboard('url');return false;"><?php echo e(__('tables.copylink')); ?></a><br>
          <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
    <?php endif; ?>
    <form id="user-form" action="<?php echo e(route('users.saveProfile',$user->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.name')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.account')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="account" value="<?php echo e($user->account); ?>" class="form-control" disabled>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.password')); ?> :</strong>
                    <input type="password" name="password" value="" class="form-control" >
                </div>
           </div>
           <?php if($user->role == App\Enums\UserRole::Sales ||
                $user->role == App\Enums\UserRole::Reseller): ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.company')); ?> :</strong>
                    <input type="text" name="company" value="<?php echo e($user->company); ?>" class="form-control">
                </div>
           </div>
           <?php endif; ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.phone')); ?> :<span class="must"><?php echo e(__('tables.must')); ?></span></strong>
                    <input type="text" name="phone" value="<?php echo e($user->phone); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.line_id')); ?> :</strong>
                    <input type="text" name="line_id" value="<?php echo e($user->line_id); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.email')); ?> :</strong>
                    <input type="text" name="email" value="<?php echo e($user->email); ?>" class="form-control">
                </div>
           </div>
           <?php if($user->role == App\Enums\UserRole::Sales ||
                $user->role == App\Enums\UserRole::Reseller): ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.job')); ?> :</strong>
                    <input type="text" name="job" value="<?php echo e($user->job); ?>" class="form-control">
                </div>
           </div>
           <?php endif; ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($user->address); ?>" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('profiles.role')); ?> : <?php echo e(trans_choice('users.roles', $user->role)); ?></strong>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                  <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
                </div>
           </div>
        </div>
    </form>
<script>
    function CopyToClipboard(id)
    {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
    }
</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#member-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               account: {
                  required: true
               },
               phone: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               account: {
                  required: '帳號必填'
               },
               phone: {
                  required: '電話必填'
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


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/users/profiles.blade.php ENDPATH**/ ?>