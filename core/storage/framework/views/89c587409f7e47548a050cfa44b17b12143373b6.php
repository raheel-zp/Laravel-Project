
<?php $__env->startSection('content'); ?>
    <section class="blog-section padding-top padding-bottom ">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="post__item">
                            <div class="post__item-thumb">
                                <img src="<?php echo e(getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '410x300')); ?>"
                                    alt="<?php echo app('translator')->get('announcement'); ?>">
                            </div>
                            <div class="post__item-content">
                                <h5 class="title"><a
                                        href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>">
                                        <?php echo e(__($blog->data_values->title)); ?>

                                    </a>
                                </h5>
                                <ul class="post-meta">
                                    <li>
                                        <span class="date">
                                            <i class="fas fa-calendar"></i>
                                            <?php echo e(showDateTime($blog->created_at, 'j F Y H:i')); ?>

                                        </span>
                                    </li>
                                </ul>
                                <p><?php echo e(shortDescription($blog->data_values->description, 100)); ?></p>
                                <a href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>"
                                    class="read-more">
                                    <?php echo app('translator')->get('Read More'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($blogs->hasPages()): ?>
                <?php echo e(paginateLinks($blogs)); ?>

            <?php endif; ?>
        </div>
    </section>
    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/blogs.blade.php ENDPATH**/ ?>