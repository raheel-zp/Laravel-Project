<?php
    $jobContent = getContent('job_category.content', true);
    $categories = App\Models\Category::featured()
        ->active()
        ->with('jobPosts')
        ->withCount([
            'jobPosts as approveJob' => function ($jobPost) {
                $jobPost->approved();
            },
        ])
        ->orderBy('approveJob','DESC')
        ->take(8)
        ->get();
?>

<!-- NIEZALOGOWANY -->
<?php if(auth()->guard()->guest()): ?>
<?php else: ?>
<!-- NIEZALOGOWANY -->
<!-- ZALOGOWANY -->
<section class="job-category padding-top padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title"><?php echo e(__($jobContent->data_values->heading)); ?></h2>
                    <p><?php echo e(__($jobContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        <div class="row g-3 g-xl-4 justify-content-center">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-xl-3 col-md-4 col-sm-6">
                    <div class="category__item">
                        <div class="category__item-icon">
                            <img src="<?php echo e(getImage(getFilePath('category') . '/' . $category->image, getFileSize('category'))); ?>">
                        </div>
                        <div class="category__item-content">
                            <h5 class="title"><?php echo e(__($category->name)); ?></h5>
                            <p class="mt-2"><?php echo e(__($category->description)); ?></p>
                        </div>
                        <span class="job-count bg--base p-2 rounded-3 text--white">
                            <?php echo e(@$category->approveJob); ?>

                        </span>
                        <a class="job_cate" href="<?php echo e(route('subcategory.list', [$category->id, slug($category->name)])); ?>"></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 mt-4">
                <div class="section__header text-center">
                    <a href="<?php echo e(route('category.list')); ?>" class="btn btn--base"><?php echo app('translator')->get('View all'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
<!-- ZALOGOWANY -->
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/sections/job_category.blade.php ENDPATH**/ ?>