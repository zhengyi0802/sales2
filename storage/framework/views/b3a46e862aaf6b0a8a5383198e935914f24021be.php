<?php
$heads = [
    ['label' =>__('massorders.index'), 'width' => 10],
    __('massorders.product'),
    __('massorders.amount'),
    __('massorders.single_price'),
    __('massorders.price'),
];
$config = [
    'order' => [[0, 'asc']],
    'columns' => [],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
?>

<?php if (isset($component)) { $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24 = $component; } ?>
<?php $component = $__env->getContainer()->make(JeroenNoten\LaravelAdminLte\View\Components\Tool\Datatable::class, ['id' => 'orderlist-table','heads' => $heads,'config' => $config,'theme' => 'info','headTheme' => 'dark','striped' => true,'hoverable' => true,'bordered' => true]); ?>
<?php $component->withName('adminlte-datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php
  $i = 0;
?>
  <?php $__currentLoopData = $massOrder->items(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item['index']); ?></td>
      <td><input type="text" name="products[<?php echo e($i); ?>][product_id]" value="<?php echo e($item['product_id']); ?>" hidden><?php echo e($item['product']); ?></td>
      <td><input type="number" id="i_amount[<?php echo e($i); ?>]" name="products[<?php echo e($i); ?>][amount]" value="<?php echo e($item['amount']); ?>"
             onchange="calc(<?php echo e($i); ?>)" style="text-align:right"/></td>
      <?php if(auth()->user()->role <= App\Enums\UserRole::Manager ||
           auth()->user()->role == App\Enums\UserRole::Accounter ||
           auth()->user()->role == App\Enums\UserRole::Operator): ?>
      <td><input type="number" id="i_single_price[<?php echo e($i); ?>]"  name="products[<?php echo e($i); ?>][single_price]]" value="<?php echo e($item['single_price']); ?>"
             onchange="calc(<?php echo e($i); ?>)"  style="text-align:right"/></td>
      <?php else: ?>
      <td><input type="number" id="i_single_price[<?php echo e($i); ?>]"  name="products[<?php echo e($i); ?>][single_price]" value="<?php echo e($item['single_price']); ?>"
             onchange="calc(<?php echo e($i); ?>)"  style="text-align:right" disabled /></td>
      <?php endif; ?>
      <td><input type="number" id="i_price[<?php echo e($i); ?>]"  name="products[<?php echo e($i); ?>][price]"
             value="<?php echo e($item['price']); ?>" style="text-align:right" disabled/></td>
    </tr>
  <?php
    $i++;
  ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr><td colspan="4" style="text-align:right"><?php echo e(__('massorders.price')); ?></td>
        <td><input type="number" id="sum"  name="sum"  value="<?php echo e($massOrder->price); ?>" style="text-align:right" disabled /></td>
    </tr>
    <tr><td colspan="4" style="text-align:right"><?php echo e(__('massorders.tax')); ?></td>
        <td><input type="number" id="tax"  name="tax"  value="<?php echo e($massOrder->tax); ?>" style="text-align:right" disabled /></td>
    </tr>
    <tr><td colspan="4" style="text-align:right"><?php echo e(__('massorders.total')); ?></td>
        <td><input type="number" id="total_price"  name="total"  value="<?php echo e($massOrder->total); ?>"
              style="text-align:right" disabled /></td>
    </tr>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24)): ?>
<?php $component = $__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24; ?>
<?php unset($__componentOriginal07fd598d67a9f344ba4b0a77ed63c2052b910f24); ?>
<?php endif; ?>
<?php $__env->startSection('plugins.Datatables', true); ?>
<?php $__env->startSection('plugins.DatatablesPlugin', true); ?>
<script>
   function calc(i) {
       sp = 'i_single_price[' + i + ']';
       am = 'i_amount[' + i + ']';
       pr = 'i_price[' + i + ']';
       s = document.getElementById(sp).value;
       a = document.getElementById(am).value;
       val = s * a;
       document.getElementById(pr).value = val;
       sum();
   };

   function sum() {
       i = 0;
       sum = 0;
       pr = 'i_price[' + i + ']';
       dpr = document.getElementById(pr);
       while(dpr != null) {
           sum += Number(dpr.value);
           i++;
           pr = 'i_price[' + i + ']';
           dpr = document.getElementById(pr);
       }
       document.getElementById('sum').value = sum;
       document.getElementById('tax').value = parseInt(sum * 0.05);
       document.getElementById('total_price').value = parseInt(sum * 1.05);
   }
</script>
<?php /**PATH /files/www/sales2/resources/views/massOrders/edit/items.blade.php ENDPATH**/ ?>