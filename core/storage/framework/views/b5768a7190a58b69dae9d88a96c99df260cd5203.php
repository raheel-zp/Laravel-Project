<div class="row g-3 justify-content-center">
    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
            <div class="job__item">
                <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                    <div class="job__item-thumb">
                        <img src="<?php echo e(getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster'))); ?>"
                            alt="job">
                    </div>
                </a>
                <div class="job__item-content">
                    <div class="wrapper d-flex justify-content-between align-items-center">
                        <span class="tag btn btn--sm">
                            <i class="las la-tag"></i>
                            <?php echo app('translator')->get('Vacancy Available'); ?>
                        </span>
                        <span class="job-author text--primary tag btn btn--sm">
                            <?php echo e($job->vacancy_available); ?>

                        </span>
                    </div>
                    <h5 class="title">
                        <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                            <?php echo e(__($job->title)); ?>

                        </a>
                    </h5>
                    <ul class="job__info">
                        <li>
                            <h6 class="job__info-title"><?php echo app('translator')->get('published'); ?></h6>
                            <span class="text--primary">
								<?php echo e(showDateTime($job->created_at, 'd M Y')); ?>

								</span>
                        </li>
                    </ul>
                    <div class="content__footer d-flex align-items-center justify-content-between">
                        <h3 class="price"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?></h3>
                        <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>"
                            class="btn btn--base btn--sm"><?php echo app('translator')->get('APPLY'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10">
            <h3 class="text--base text-center"><?php echo e(__($emptyMessage)); ?></h3>
        </div>
    <?php endif; ?>
</div>

<?php if($jobs->hasPages()): ?>
    <?php echo e(paginateLinks($jobs)); ?>

<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/partials/jobs.blade.php ENDPATH**/ ?>