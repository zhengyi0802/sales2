<?php $__env->startSection('title', __('home.title')); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark">Dashboard</h1>
<?php $__env->stopSection(); ?>
<style>
   .num {
          font-size:24pt;
        }
  .cell {
          text-align:center;
        }
  .btnd {
          border-radius: 8px;
        }
</style>
<?php $__env->startSection('content'); ?>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
    <?php if(auth()->user()->role == App\Enums\UserRole::Sales ||
         auth()->user()->role == App\Enums\UserRole::Reseller): ?>
         <?php if(false): ?>
         <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('saleses.sales_link')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <span id="url"><?php echo e(__('saleses.sales_http').auth()->user()->sales->id); ?></span>
                <a href="#" onclick="CopyToClipboard('url');return false;"><?php echo e(__('tables.copylink')); ?></a><br>
          <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
         <?php else: ?>
         <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('saleses.apply_link')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <span id="url"><?php echo e(__('saleses.apply_http').auth()->user()->sales->id); ?></span>
                <a href="#" onclick="CopyToClipboard('url');return false;"><?php echo e(__('tables.copylink')); ?></a><br>
          <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
         <?php endif; ?>
    <?php endif; ?>
        <table class="col-xs-12 col-sm-12 col-md-12">
         <?php if(auth()->user()->role != App\Enums\UserRole::Installer &&
             auth()->user()->role != App\Enums\UserRole::Accounter): ?>
         <tr>
            <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.unhandled')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['unhandled']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '1'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
            </td>
            <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.contacted')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['contacted']); ?></span><br>
                  <button class="btnd btn-info"onClick="window.location='<?php echo e(route('orders.index', ['flow' => '2'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
            </td>
            <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.confirmed')).'','theme' => 'info','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['confirmed']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '3'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
            </td>
         </tr>
         <?php endif; ?>
         <tr>
            <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.shippings')).'','theme' => 'primary','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['shippings']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '4'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
             </td>
             <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.completions')).'','theme' => 'success','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['completions']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '5'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
             </td>
             <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.finished')).'','theme' => 'success','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['finished']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '6'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
             </td>
         </tr>
         <tr>
             <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.chargebacks')).'','theme' => 'danger','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['chargebacks']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '7'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
             </td>
          <?php if(auth()->user()->role == App\Enums\UserRole::Administrator): ?>
            <td class="cell">
               <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('home.disabled')).'','theme' => 'warning','icon' => 'fas fa-lg']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                  <span class="num"><?php echo e($data['disabled']); ?></span><br>
                  <button class="btnd btn-info" onClick="window.location='<?php echo e(route('orders.index', ['flow' => '-1'])); ?>'" >
                     <?php echo e(__('tables.details')); ?>

                  </button>
                <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
            </td>
         <?php endif; ?>
         </tr>
      </table>
     </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /files/www/sales2/resources/views/home.blade.php ENDPATH**/ ?>