<?php
    $faqElement = getContent('faq.element', false, null, false);
?>
<section class="faq-section padding-top padding-bottom">
    <div class="container">
        <div class="faq-content">
            <div class="custom--accordion accordion" id="accordionExample">
                <?php $__currentLoopData = $faqElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne-<?php echo e($loop->index); ?>">
                            <button class="accordion-button <?php echo e($loop->index == 0 ? '' : 'collapsed'); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($loop->index); ?>" aria-expanded="<?php echo e($loop->index == 0 ? 'true' : 'false'); ?>" aria-controls="collapseOne">
                                <?php echo e(__(@$faq->data_values->question)); ?>

                            </button>
                        </h3>
                        <div id="collapse-<?php echo e($loop->index); ?>" class="accordion-collapse collapse <?php echo e($loop->index == 0 ? 'show' : ''); ?>" aria-labelledby="headingOne-<?php echo e($loop->index); ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo @$faq->data_values->answer ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>