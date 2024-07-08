<?php $__env->startSection('content'); ?>
    <section class="blog-section padding-top padding-bottom ">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-8 col-md-12">
                    <div class="announcement__details">
                        <div class="announcement__details__thumb">
                            <img alt="blog" src="<?php echo e(getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '800x600')); ?>">
                        </div>
                        <h3 class="blog-title"><?php echo e(__($blog->data_values->title)); ?></h3>
                        <ul class="announcement__meta d-flex flex-wrap mt-2 mb-3 align-items-center">
                            <li>
                                <a href="#">
                                    <i class="far fa-calendar"></i>
                                    <?php echo e(showDateTime($blog->created_at, 'j F Y H:i')); ?>

                                </a>
                            </li>
                        </ul>
                        <div class="announcement__details__content">
                            <p><?php echo $blog->data_values->description ?></p>

                            <ul class="social-links m-0 me-3">

                                <li><strong class="me-3"><?php echo app('translator')->get('Share'); ?>:</strong> </li>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>">
                                        <span class="lab la-facebook-f"></span>
                                    </a>
                                </li>
                                <li><a href="https://twitter.com/intent/tweet?text=<?php echo e(__($blog->data_values->title)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>">
                                        <span class="lab la-twitter"></span>
                                    </a>
                                </li>
                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__($blog->data_values->title)); ?>&amp;summary=dit is de linkedin summary">
                                        <span class="lab la-linkedin-in"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="mt-3">
                            <div class="fb-comments" data-href="<?php echo e(url()->current()); ?>" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
                    <div class="widget-box post-widget">
                        <h4 class="pro-title"><?php echo app('translator')->get('Latest Blogs'); ?></h4>
                        <ul class="latest-posts m-0">
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="post-thumb">
                                        <a href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>">
                                            <img class="img-fluid" src="<?php echo e(getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '410x300')); ?>" alt="<?php echo app('translator')->get('image'); ?>">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h6>
                                            <a href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>">
                                                <?php echo e(shortDescription($blog->data_values->title)); ?>

                                            </a>
                                        </h6>
                                        <a href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>" class="posts-date"><i class="far fa-calendar-alt"></i>
                                            <?php echo e(showDateTime($blog->created_at, 'j F Y')); ?></a>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('fbComment'); ?>
    <?php echo loadExtension('fb-comment') ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/blog_details.blade.php ENDPATH**/ ?>