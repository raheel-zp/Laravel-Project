

<?php $__env->startSection('content'); ?>
    <section class="job-category padding-top padding-bottom">
        <div class="container">
            <div class="row g-3 g-xl-4 justify-content-center">
                <?php $__empty_1 = true; $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 col-xl-3 col-md-4 col-sm-6">
                        <div class="category__item">
                            <div class="category__item-icon">
                                <img src="<?php echo e(getImage(getFilePath('subcategory') . '/' . $subcategory->image, getFileSize('subcategory'))); ?>" alt="<?php echo app('translator')->get('icon'); ?>">
                            </div>
                            <div class="category__item-content">
                                <h5 class="title"><?php echo e(__($subcategory->name)); ?></h5>
                                <p class="mt-2"><?php echo e(__($subcategory->description)); ?></p>
                            </div>
                            <span class="job-count bg--base p-2 text--white rounded-3"><?php echo e($subcategory->jobApprove); ?></span>

                            <a class="job_cate" href="<?php echo e(route('subcategory.jobs', [$subcategory->id, slug($subcategory->name)])); ?>"></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 text-center">
                        <h2 class="section__header-title text--base"><?php echo e(__($emptyMessage)); ?></h2>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($subCategories->hasPages()): ?>
                <?php echo e(paginateLinks($subCategories)); ?>

            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/subcategories.blade.php ENDPATH**/ ?>