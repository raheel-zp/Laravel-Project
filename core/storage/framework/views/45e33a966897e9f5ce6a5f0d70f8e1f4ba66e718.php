<?php
    $counterElement = getContent('counter.element', orderById: true);
?>
<section class="counter-section padding-top padding-bottom">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = $counterElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="counter__item">
                        <div class="counter__item-icon">
                            <?php echo @$counter->data_values->icon ?>
                        </div>
                        <div class="counter__item-content">
                            <h2 class="title"><span class="odometer" data-odometer-final="<?php echo e(@$counter->data_values->digit); ?>"></span><?php echo e(@$counter->data_values->digit_postfix); ?>

                            </h2>
                            <p class="info"><?php echo e(__(@$counter->data_values->title)); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/sections/counter.blade.php ENDPATH**/ ?>