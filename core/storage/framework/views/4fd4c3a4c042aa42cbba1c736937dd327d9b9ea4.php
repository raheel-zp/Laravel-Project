<?php $__env->startSection('app'); ?>
    <section class="maintenance-page flex-column justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text--danger mb-2"><?php echo e(__(@$maintenance->data_values->heading)); ?></h4>
                        </div>
                        <div class="col-sm-6 col-8 col-lg-12">
                            <img class="img-fluid mx-auto mb-5"
                                src="<?php echo e(getImage($activeTemplateTrue . 'images/maintenance.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                        </div>
                    </div>
                    <p class="mx-auto text-center"><?php echo $maintenance->data_values->description ?></p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .maintenance-page {
            display: grid;
            place-content: center;
            width: 100vw;
            height: 100vh;
        }

        .maintenance-icon {
            width: 60px;
            height: 60px;
            display: grid;
            place-items: center;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #fff;
            font-size: 26px;
            color: #e73d3e;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/maintenance.blade.php ENDPATH**/ ?>