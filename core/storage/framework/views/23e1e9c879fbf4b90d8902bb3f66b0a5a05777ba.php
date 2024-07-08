<?php $dash.='-- '; ?>
<?php $__currentLoopData = $parentsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentsubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($parentsubcategory->id); ?>"><?php echo e($dash); ?><?php echo e($parentsubcategory->name); ?></option>
    <?php if(count($parentsubcategory->parentsubcategory)): ?>
        <?php echo $__env->make('admin.subcategory.subCategoryList-option',['parentsubcategories' => $parentsubcategory->parentsubcategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/admin/subcategory/subCategoryList-option.blade.php ENDPATH**/ ?>