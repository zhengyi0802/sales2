<form action="<?php echo e(route('csv.imports')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="file" name="file" accept=".csv">
    <button type="submit">Import CSV</button>
</form>
<?php /**PATH /files/www/sales2/resources/views/csvs/imports.blade.php ENDPATH**/ ?>