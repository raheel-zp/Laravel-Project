<?php $__env->startSection('content'); ?>
    <section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job__details__wrapper">
                        <h3 class="job__details__wrapper-title">
                            <?php echo e(__($job->title)); ?>

                        </h3>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title"><?php echo app('translator')->get('Job Description :'); ?></h4>
                            <?php
                                echo $job->description;
                            ?>
                        </div>

                        <?php if(@$job->proves->where('user_id', auth()->id())->count() < 1): ?>
                            <?php if($job->user_id != auth()->id()): ?>
                                <div class="job__details__widget">
                                    <h4 class="job__details__widget-title">
                                        <?php echo app('translator')->get('Enter The Required Proof Of Job Finished:'); ?>
                                    </h4>
                                    <form class="job__finished__form" action="<?php echo e(route('user.job.prove', $job->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="input-group">
                                            <textarea name="detail" class="form--control w-100"><?php echo e(old('detail')); ?></textarea>
                                        </div>
                                        <?php if($job->job_proof == 2): ?>
                                            <div class="input-group mt-3">
                                                <input type="file" name="attachment" class="form-control form--control w-100" <?php if($job->job_proof == 2): echo 'required'; endif; ?>>
                                                <span class="info fs--14 mt-2">
                                                    <?php echo app('translator')->get('Allowed File Extensions:'); ?> <?php echo e(__($job->file_name)); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                            <?php echo app('translator')->get('Request for Complete'); ?>
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="job__details__widget">
                                <h4 class="job__details__widget-title text-center text--base">
                                    <?php echo app('translator')->get('You are already submitted job prove please wait until review complete'); ?>
                                </h4>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="job__details__sidebar">
                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title"><?php echo app('translator')->get('Job Information'); ?></h5>
                            <div class="info__wrapper">
                                <div class="info__item">
                                    <div class="icon">
                                        <img src="<?php echo e(getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster'))); ?>" alt="<?php echo app('translator')->get('freelancer'); ?>" class="img-fluid">
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><?php echo app('translator')->get('Job ID :'); ?> <?php echo e(__(@$job->job_code)); ?></h6>
                                        <p><?php echo app('translator')->get('Job posted by'); ?> <?php echo e(__(@$job->user->fullname)); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-money-bill-wave-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?></h4>
                                        <p><?php echo app('translator')->get('You will Earn in this job'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-calendar"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?></h4>
                                        <p><?php echo app('translator')->get('Published Date'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-users"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(__($job->quantity)); ?></h4>
                                        <p><?php echo app('translator')->get('This Job Vacancy'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-user"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(__($job->vacancy_available)); ?></h4>
                                        <p><?php echo app('translator')->get('Available Job Vacancy'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title"><?php echo app('translator')->get('Share this Post on:'); ?></h5>
                            <ul class="social-links">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo e(__($job->title)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                                <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo e(urlencode(url()->current())); ?>&description=<?php echo e(__($job->title)); ?>&media=<?php echo e(getImage('assets/admin/images/job/' . $job->attachment)); ?>">
                                        <i class="lab la-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__($job->title)); ?>&amp;summary=dit is de linkedin summary">
                                        <i class="lab la-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/job/details.blade.php ENDPATH**/ ?>