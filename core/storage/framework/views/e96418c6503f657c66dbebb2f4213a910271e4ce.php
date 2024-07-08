<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card custom--card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('Job posted by'); ?>
                        <?php echo e(__(@$job->user->fullname)); ?>

                    </h5>
                    <div class="p-3 bg--white">
                        <div class="side_Image text-center">
                            <?php if($job->user->image): ?>
                                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $job->user->image, getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('Image'); ?>" class="b-radius--10 withdraw-detailImage">
                            <?php else: ?>
                                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>" class="w-50 h-50">
                            <?php endif; ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Job Code'); ?>
                            <span class="fw-bold"><?php echo e($job->job_code); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="fw-bold">
                                <a href="<?php echo e(route('admin.users.detail', $job->user->id)); ?>"><?php echo e(@$job->user->username); ?></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Quantity'); ?>
                            <span class="fw-bold"><?php echo e(__($job->quantity)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Amount'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($job->rate)); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Total Amount'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($job->total)); ?>  <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Status'); ?>
                            <?php echo $job->statusJob; ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            <?php echo app('translator')->get('Date'); ?>
                            <span class="fw-bold"><?php echo e(showDateTime($job->created_at)); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-30">
            <div class="card custom--card  overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2"><?php echo app('translator')->get('Job More Information'); ?></h5>
                    <div class="row gy-3">
                        <div class="col-md-8">
                            <h6><?php echo app('translator')->get('Job Title'); ?></h6>
                            <p><?php echo e(__($job->title)); ?></p>
                        </div>
                        <div class="col-md-8">
                            <h6><?php echo app('translator')->get('Job Description'); ?></h6>
                            <p> <?php echo $job->description; ?></p>
                        </div>
                        <div class="col-md-8">
                            <h6><?php echo app('translator')->get('Job Attachment'); ?></h6>
                            <img src="<?php echo e(getImage(getFilePath('jobPoster') . '/' . $job->attachment, getFileSize('jobPoster'))); ?>" class="w-50">
                        </div>
                        <?php if($job->status == Status::JOB_PENDING): ?>
                            <div class="col-md-12">
                                <button class="btn btn-outline--success ms-1 confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to approve this job?'); ?>" data-action="<?php echo e(route('admin.jobs.approve', $job->id)); ?>">
                                    <i class="fas la-check"></i> <?php echo app('translator')->get('Approve'); ?>
                                </button>
                                <button class="btn btn-outline--danger ms-1 confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to rejected this job?'); ?>" data-action="<?php echo e(route('admin.jobs.reject', $job->id)); ?>">
                                    <i class="fas la-times-circle"></i> <?php echo app('translator')->get('Reject'); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/jobs/view.blade.php ENDPATH**/ ?>