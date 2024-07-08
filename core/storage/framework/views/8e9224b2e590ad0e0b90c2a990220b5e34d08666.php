<?php
    $blogContent = getContent('blog.content', true);
    $blogElement = getContent('blog.element', false, 6, false);
?>
<section class="blog-section padding-top padding-bottom section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title"><?php echo e(__(@$blogContent->data_values->heading)); ?></h2>
                    <p><?php echo e(__(@$blogContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = $blogElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post__item">
                        <div class="post__item-thumb">
                            <img src="<?php echo e(getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '410x300')); ?>" alt="<?php echo e(__($blog->data_values->title)); ?>">
                        </div>
                        <div class="post__item-content">
                            <h5 class="title">
                                <a href="<?php echo e(route('blog.details', [slug(@$blog->data_values->title), $blog->id])); ?>">
                                    <?php echo e(__($blog->data_values->title)); ?>

                                </a>
                            </h5>
                            <ul class="post-meta">
                                <li>
                                    <span class="date">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo e(showDateTime($blog->created_at, 'j F Y')); ?>

                                    </span>
                                </li>
                            </ul>
                            <p><?php echo e(shortDescription(@$blog->data_values->description, 100)); ?></p>
                            <a href="<?php echo e(route('blog.details', [slug(@$blog->data_values->title), $blog->id])); ?>" class="read-more">
                                <?php echo app('translator')->get('Read More'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/sections/blog.blade.php ENDPATH**/ ?>