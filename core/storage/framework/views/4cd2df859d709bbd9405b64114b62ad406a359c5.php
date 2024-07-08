<?php $__env->startSection('content'); ?>
<?php
$bannerContent = getContent('banner.content', true);
?>
<section class="banner-section bg_img overflow-hidden" style="background: url(<?php echo e(getImage('assets/images/frontend/banner/' . @$bannerContent->data_values->background_image, '1920x1080')); ?>);">
    <div class="container">
        <div class="banner__wrapper d-flex align-items-center">
            <div class="banner__content">
                <span class="subtitle"><?php echo e(__(@$bannerContent->data_values->heading)); ?></span>
                <h1 class="banner__content-title"><?php echo e(__(@$bannerContent->data_values->subheading)); ?></h1>
                <p><?php echo e(__(@$bannerContent->data_values->description)); ?></p>
                
                <!-- NIEZALOGOWANY -->
                <?php if(auth()->guard()->guest()): ?>
				<?php else: ?>
				<!-- NIEZALOGOWANY -->
				<!-- ZALOGOWANY -->
                <form class="job__search" action="<?php echo e(route('job.search')); ?>">
                    <div class="form--group d-flex align-items-center">
                        <select class="form-select form--control border-0" name="category">
                            <option value="" selected disabled><?php echo app('translator')->get('Select Category'); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e(__($category->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="text" class="form-control form--control" name="search" autocomplete="off" placeholder="<?php echo app('translator')->get('Search jobs...'); ?>">
                        <button class="btn btn--base btn--round px-md-5" type="submit"><?php echo e(__(@$bannerContent->data_values->button_text)); ?></button>
                    </div>
                </form>
                <div class="popular__tags">
                    <h6 class="title d-inline-block"><?php echo app('translator')->get('Popular Jobs Category'); ?></h6>
                    <ul class="tags-list">
                        <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('category.jobs', [@$keyword->category->id, slug(@$keyword->category->name)])); ?>">
                                <?php echo e(__(@$keyword->category->name)); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <!-- ZALOGOWANY -->
            </div>
            <div class="banner__thumb d-none d-lg-block">
                <img src="<?php echo e(getImage('assets/images/frontend/banner/' . @$bannerContent->data_values->banner_image, '750x600')); ?>">
            </div>
        </div>
    </div>
</section>
<?php if($sections->secs != null): ?>
<?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/home.blade.php ENDPATH**/ ?>