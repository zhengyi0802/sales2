<?php $__env->startSection('title', __('users.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e(__('users.header')); ?></h1>
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
    <form id="user-form" action="<?php echo e(route('users.update',$user->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.account')); ?> :</strong>
                    <input type="text" name="account" value="<?php echo e($user->account); ?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.name')); ?> :</strong>
                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.phone')); ?> :</strong>
                    <input type="text" name="phone" value="<?php echo e($user->phone); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.line_id')); ?> :</strong>
                    <input type="text" name="line_id" value="<?php echo e($user->line_id); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.email')); ?> :</strong>
                    <input type="text" name="email" value="<?php echo e($user->email); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.address')); ?> :</strong>
                    <input type="text" name="address" value="<?php echo e($user->address); ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.password')); ?> :</strong>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.role')); ?> :</strong>
                    <select id="role" name="role">
                       <option value="2" <?php echo e(($user->role == 2) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 2)); ?></option>
                       <option value="3" <?php echo e(($user->role == 3) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 3)); ?></option>
                       <option value="4" <?php echo e(($user->role == 4) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 4)); ?></option>
                       <option value="5" <?php echo e(($user->role == 5) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 5)); ?></option>
                       <option value="6" <?php echo e(($user->role == 6) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 6)); ?></option>
                       <option value="7" <?php echo e(($user->role == 7) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 7)); ?></option>
                       <option value="8" <?php echo e(($user->role == 8) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 8)); ?></option>
                       <option value="9" <?php echo e(($user->role == 9) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 9)); ?></option>
                       <option value="10" <?php echo e(($user->role == 10) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 10)); ?></option>
                       <option value="11" <?php echo e(($user->role == 11) ? "selected" : null); ?>><?php echo e(trans_choice('users.roles', 11)); ?></optio>
                    </select>
                </div>
           </div>
           <?php if(auth()->user()->role == App\Enums\UserRole::Administrator): ?>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong><?php echo e(__('users.status')); ?> :</strong>
                    <input type="checkbox" name="status" value="1" <?php echo e($user->status ? "checked" : null); ?>>
                    <label for="status"><?php echo e(__('tables.enabled')); ?></label>
                </div>
              <button type="submit" class="btn btn-primary"><?php echo e(__('tables.submit')); ?></button>
           </div>
           <?php endif; ?>
        </div>
    </form>

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
           },
           messages: {
               name: {
                  required: '姓名必填'
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


<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/users/edit.blade.php ENDPATH**/ ?>