<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content ">
        <form action="" class="float-end">
            <div class="mb-3 d-flex justify-content-end  table-form ">
                <div class="input-group table_data_search">
                    <input type="text" name="search" class="form-control form--control" value="<?php echo e(request()->search); ?>" placeholder="<?php echo app('translator')->get('Search here ...'); ?>">
                    <button class="input-group-text btn btn--base text-white">
                        <i class="las la-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <table class="table transection__table job__history">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('Job Code'); ?></th>
                    <th><?php echo app('translator')->get('Job Title'); ?></th>
                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                    <th><?php echo app('translator')->get('Rate'); ?></th>
                    <th><?php echo app('translator')->get('Total'); ?></th>
                    <th><?php echo app('translator')->get('Status'); ?></th>
                    <th><?php echo app('translator')->get('Date'); ?></th>
                    <th><?php echo app('translator')->get('More'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <span><?php echo e(__($job->job_code)); ?></span>
                        </td>
                        <td>
                            <?php echo e(__(strLimit($job->title, 20))); ?>

                            <?php if(strlen($job->title) > 20): ?>
                            <br>
                            <small class="jobTitle text--base " data-title_details="<?php echo e(__($job->title)); ?>"><?php echo app('translator')->get('Read More'); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span><?php echo e($job->quantity); ?> </span>
                        </td>
                        <td>
                            <span>
                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?>

                            </span>
                        </td>
                        <td>
                            <span>
                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->total)); ?>

                            </span>
                        </td>
                        <td>
                            <?php
                                echo $job->statusJob;
                            ?>
                        </td>
                        <td>
                            <div class="text--end">
                                <span class="time"><?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?><br><?php echo e(diffForHumans($job->created_at)); ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap table-icon">
                                <a href="<?php echo e(!($job->status == Status::JOB_REJECTED || $job->status == Status::JOB_COMPLETED) ? route('user.job.edit', $job->id) : 'javascript:void(0)'); ?>" class="text--success me-2 <?php echo e($job->status == Status::JOB_REJECTED || $job->status == Status::JOB_COMPLETED ? 'disabled' : ''); ?> " data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                    <i class="lar la-edit"></i>
                                </a>
                                <?php if($job->status == Status::JOB_PAUSE): ?>
                                    <a href="JavaScript:void(0)" class="text--base statusBtn me-2 confirmationBtn" data-bs-toggle="tooltip" data-action="<?php echo e(route('user.job.status', $job->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to approve this job'); ?>" title="<?php echo app('translator')->get('Approve'); ?>">
                                        <i class="las la-check-circle"></i>
                                    </a>
                                <?php elseif($job->status == Status::JOB_APPROVED): ?>
                                    <a href="JavaScript:void(0)" class="text--warning statusBtn me-2 confirmationBtn" data-bs-toggle="tooltip" data-action="<?php echo e(route('user.job.status', $job->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to paused this job'); ?>" title="<?php echo app('translator')->get('Paused'); ?>">
                                        <i class="las la-pause-circle"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('user.job.details', $job->id)); ?>" class="text--info notification-holder" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('Job prove'); ?>">
                                    <i class="las la-desktop"></i>
                                    <?php if(@$job->proves->where('notification', 0)->count() > 0): ?>
                                        <span class="notification-count">
                                            <?php echo e(@$job->proves->where('notification', 0)->count()); ?>

                                        </span>
                                    <?php endif; ?>

                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="justify-content-center text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if($jobs->hasPages()): ?>
            <?php echo e(paginateLinks($jobs)); ?>

        <?php endif; ?>
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

    <div class="modal TitleModal fade " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Job Title'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            $('.modal-footer').find('button').addClass('btn--sm');
            $('.modal-header').find('button').replaceWith(
                '<span class="las la-times" data-bs-dismiss="modal" ></span>');


            $('.jobTitle').on('click', function() {
                let details = $(this).data('title_details');
                let modal = $('.TitleModal');
                modal.find('.modal-body p').html(details)
                modal.modal('show');
            })

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/nowy.zlecenio.eu/public_html/core/resources/views/templates/basic/user/job/history.blade.php ENDPATH**/ ?>