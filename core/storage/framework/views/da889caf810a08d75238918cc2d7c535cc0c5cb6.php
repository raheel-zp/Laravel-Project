<?php $__env->startSection('content'); ?>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo $policy->data_values->details;
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/policy.blade.php ENDPATH**/ ?>