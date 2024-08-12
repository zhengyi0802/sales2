    <div class="row col-12">
      <div class="card-group col-md-12">
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('catagories.table_name')).'','icon' => 'fas fa-lg fa-cog text-primary','theme' => 'primary']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['icon-theme' => 'white','fgroup-class' => 'col-md-6']); ?>
          <ul id="tree1">
            <?php $__currentLoopData = $catagories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                 <a href="<?php echo e(route('catagories.edit', $category->id)); ?>"><?php echo e($category->name); ?></a>
                 <?php if(count($category->products)): ?>
                   <?php echo $__env->make('catagories.manageChild', ['products' => $category->products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Widget\Card::class, ['title' => ''.e(__('tables.new').__('catagories.table_name')).'','icon' => 'fas fa-lg fa-cog text-primary','theme' => 'teal']); ?>
<?php $component->withName('adminlte-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['icon-theme' => 'white','fgroup-class' => 'col-md-6']); ?>
            <?php echo $__env->make('catagories.createform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127)): ?>
<?php $component = $__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127; ?>
<?php unset($__componentOriginal0016fe8f62f0dc60d54a606049e169e1ae7c8127); ?>
<?php endif; ?>
      </div>
    </div>
<link href="/css/treeview.css" rel="stylesheet">
<script src="/js/treeview.js"></script>
<?php /**PATH /files/www/sales2/resources/views/catagories/treeview.blade.php ENDPATH**/ ?>