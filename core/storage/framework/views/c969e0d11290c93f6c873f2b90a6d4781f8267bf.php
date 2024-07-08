<?php $__env->startSection('content'); ?>
    <section class="dashboard-section padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <?php echo $__env->make($activeTemplate . 'partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-lg-8 col-xl-9">
                    <?php echo $__env->make($activeTemplate . 'partials.responsive_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->yieldContent('panel'); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/nowy.zlecenio.eu/public_html/core/resources/views/templates/basic/layouts/master.blade.php ENDPATH**/ ?>