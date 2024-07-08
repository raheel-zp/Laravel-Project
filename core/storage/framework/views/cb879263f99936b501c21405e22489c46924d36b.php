<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content">
        <div class="finished__jobs__wrapper">
            <div class="finished__jobs__header d-flex flex-wrap justify-content-between align-items-center mb-2">
                <h4 class="pe-4 mb-2">
                    <?php echo app('translator')->get('Job ID :'); ?> <?php echo e(__($job->job_code)); ?>

                </h4>
                <h4 class="pe-4 mb-2">
                    <?php echo app('translator')->get('Budget :'); ?> <?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->total)); ?>

                </h4>
                <h4 class="pe-4 mb-2">
                    
                </h4>
                <a href="<?php echo e(route('user.job.history')); ?>" class="btn btn--sm btn--base mb-2">
                    <?php echo app('translator')->get('Go Back'); ?>
                </a>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $job->proves->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prove): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="finished__job__item ">
                    <div class="row w-100 justify-content-between g-0 gy-3">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="job__header me-3">
                                <h5 class="job__header-title">
                                    <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                                        <?php echo e(__($job->title)); ?>

                                    </a>
                                </h5>
                                <p class="job-post-date">
                                    <?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?>

                                </p>
                                <h3 class="job__price d-inline-block">
                                    <sub><?php echo e($general->cur_sym); ?></sub>
                                    <?php echo e(showAmount($job->rate)); ?>

                                </h3>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class=" job__body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="employer__wrapper d-inline-flex flex-wrap align-items-center">
                                    <div class="employer__thumb me-3">
                                        <?php if(@$prove->user->image): ?>
                                            <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $prove->user->image, getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <h6 class="employer__name"><?php echo e($prove->user->username); ?></h6>
                                        <?php if($prove->status == Status::JOB_PROVE_PENDING): ?>
                                            <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                        <?php elseif($prove->status == Status::JOB_PROVE_APPROVE): ?>
                                            <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="job__footer">
                                    <a href="<?php echo e(route('user.job.attachment', encrypt($prove->id))); ?>" class="cmn--btn btn--sm"><?php echo app('translator')->get('Detail'); ?></a>
                                    <p class="take-on"><?php echo app('translator')->get('Project take on'); ?></p>
                                    <p class="take-on-date"><?php echo e(showDateTime($prove->created_at, 'd-m-Y H:i:s')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="finished__job__item">
                    <div class="row w-100 justify-content-between g-0 gy-3">
                        <h3 class="text--base text-center"><?php echo e(__($emptyMessage)); ?></h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/user/job/details.blade.php ENDPATH**/ ?>