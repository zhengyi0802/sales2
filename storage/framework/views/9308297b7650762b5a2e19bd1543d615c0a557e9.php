<?php ( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') ); ?>

<?php if(config('adminlte.use_route_url', false)): ?>
    <?php ( $password_email_url = $password_email_url ? route($password_email_url) : '' ); ?>
<?php else: ?>
    <?php ( $password_email_url = $password_email_url ? url($password_email_url) : '' ); ?>
<?php endif; ?>

<?php $__env->startSection('auth_header', __('adminlte::adminlte.password_reset_message')); ?>

<?php $__env->startSection('auth_body'); ?>

    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e($password_email_url); ?>" method="post">
        <?php echo csrf_field(); ?>

        
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('adminlte::adminlte.email')); ?>" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                </div>
            </div>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <button type="submit" class="btn btn-block <?php echo e(config('adminlte.classes_auth_btn', 'btn-flat btn-primary')); ?>">
            <span class="fas fa-share-square"></span>
            <?php echo e(__('adminlte::adminlte.send_password_reset_link')); ?>

        </button>

    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::auth.auth-page', ['auth_type' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/vendor/adminlte/auth/passwords/email.blade.php ENDPATH**/ ?>