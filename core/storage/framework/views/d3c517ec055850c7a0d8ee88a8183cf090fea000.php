<?php
    $socialElement = getContent('social_icon.element', orderById: true);
    $policyPages   = getContent('policy_pages.element', orderById: true);
    $footerContent = getContent('footer.content', true);
?>
<footer class="footer-section bg_img bg_fixed" style="background: url(<?php echo e(getImage('assets/images/frontend/footer/' . @$footerContent->data_values->image, '1920x1080')); ?>);">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-10">
                    <div class="footer__widget widget-about">
                        <div class="logo">
                            <a href="<?php echo e(route('home')); ?>">
                                <img src="<?php echo e(getImage('assets/images/logoIcon/logo.png')); ?>" alt="<?php echo app('translator')->get('logo'); ?>">
                            </a>
                        </div>
                        <p><?php echo e(__(@$footerContent->data_values->description)); ?></p>
                        <ul class="social-links mt-4">
                            <?php $__currentLoopData = $socialElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($social->data_values->url); ?>" target="__blank">
                                        <?php echo $social->data_values->icon ?>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5">
                    <div class="footer__widget">
                        <h4 class="widget-title"><?php echo app('translator')->get('About Company'); ?></h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo e(route('job.list')); ?>"><?php echo app('translator')->get('Jobs'); ?></a></li>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('pages', [$page->slug])); ?>">
                                        <?php echo e(__($page->name)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('blogs')); ?>"><?php echo app('translator')->get('Blogs'); ?></a></li>
                            <li><a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact Us'); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5">
                    <div class="footer__widget">
                        <h4 class="widget-title"><?php echo app('translator')->get('Policy Pages'); ?></h4>
                        <ul class="footer-links">
                            <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('policy.pages', [slug($page->data_values->title), $page->id])); ?>">
                                        <?php echo e(__($page->data_values->title)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer__bottom__wrapper d-flex flex-wrap justify-content-center">
                <p class="copyright text--white"><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?> <?php echo app('translator')->get('All Rights Reserved'); ?></p>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>