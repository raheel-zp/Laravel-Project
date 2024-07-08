<?php
    $contacElement = getContent('contact_us.element', false, 2, true);
    $socialElement = getContent('social_icon.element', orderById: true);
?>
<div class="header-top">
    <div class="container">
        <div
            class="header__top__wrapper d-flex flex-wrap justify-content-center justify-content-lg-between align-items-center">
            <div class="header__top__wrapper-left">
                <ul class="contacts  d-flex flex-wrap justify-content-center m-0">
                    <?php $__currentLoopData = $contacElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(@$contact->data_values->attribute); ?><?php echo e($contact->data_values->content); ?>">
                                <?php echo $contact->data_values->icon ?>
                                <?php echo e(__($contact->data_values->content)); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="header__top__wrapper-right d-flex align-items-center">
                <ul class="social-links m-0 me-3">
                    <?php $__currentLoopData = $socialElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(@$social->data_values->url); ?>" target="__blank">
                                <?php echo @$social->data_values->icon ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php if($general->multi_language): ?>
                    <select class="language langSel nice-select">
                        <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->code); ?>" <?php if(session('lang') == $item->code): echo 'selected'; endif; ?>>
                                <?php echo e(__($item->name)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/partials/topbar.blade.php ENDPATH**/ ?>