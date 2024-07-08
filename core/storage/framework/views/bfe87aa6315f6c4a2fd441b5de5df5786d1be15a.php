<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content ">
        <div class="finished__jobs__header d-flex flex-wrap justify-content-between align-items-center mb-2">
        <h4 class="pe-4 mb-2"><?php echo app('translator')->get('Referral Link'); ?></h4>
        <div style="width:100%;">
        <?php echo e($refLink); ?>

        </div>
        </div>


    </div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/referral/index.blade.php ENDPATH**/ ?>