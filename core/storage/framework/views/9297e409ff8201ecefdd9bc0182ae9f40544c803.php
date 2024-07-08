<?php
    $breadcrumbContent = getContent('breadcrumb.content', true);
?>
<div class="banner-inner bg_img" style="background: url(<?php echo e(asset($activeTemplateTrue . 'images/bg/banner.png')); ?>);">
    <div class="container">
        <div class="banner__inner__content">
            <h2 class="banner__inner__content-title"><?php echo e(__($pageTitle)); ?></h2>
            <ul class="breadcums d-flex justify-content-center">
                <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                <li>/</li>
                <li><?php echo e(__($pageTitle)); ?></li>
            </ul>
        </div>
    </div>
    <div class="shapes">
        <img src="<?php echo e(getImage('assets/images/frontend/breadcrumb/' . $breadcrumbContent->data_values->image, '1920x1080')); ?>"
            alt="<?php echo app('translator')->get('overview'); ?>" class="shape1">
    </div>
      
</div>




<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/partials/breadcrumb.blade.php ENDPATH**/ ?>