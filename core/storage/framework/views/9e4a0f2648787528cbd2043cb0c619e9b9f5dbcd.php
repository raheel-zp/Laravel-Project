<?php
    $startedContent = getContent('get_started.content', true);
?>
<div class="<?php if(request()->routeIs('home')): ?> section-bg <?php endif; ?>">
    <div class="container">
        <div class="get-started d-flex flex-wrap align-items-center justify-content-between">
            <div class="section__header m-0">
                <h3 class="section__header-title"><?php echo e(__(@$startedContent->data_values->heading)); ?></h3>
                <p><?php echo e(__(@$startedContent->data_values->subheading)); ?></p>
            </div>
            <a href="<?php echo e(url('/')); ?>/<?php echo e(@$startedContent->data_values->button_link); ?>" class="cmn--btn"><?php echo e(__(@$startedContent->data_values->button_text)); ?></a>
        </div>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/partials/get_started.blade.php ENDPATH**/ ?>