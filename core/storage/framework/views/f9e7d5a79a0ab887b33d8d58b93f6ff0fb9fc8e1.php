<?php $__env->startSection('content'); ?>
    <section class="py-5">
        <div class="container">
            <?php

                echo $cookie->data_values->description;
            ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/cookie.blade.php ENDPATH**/ ?>