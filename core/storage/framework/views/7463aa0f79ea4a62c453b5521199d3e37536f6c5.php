
<?php $__env->startSection('panel'); ?>
    <div class="row gy-5">
        <div class="col-lg-7 col-xl-8 col-md-12">
            <div class="announcement__details">
                <h3 class="blog-title"><?php echo e(__($prove->job->title)); ?></h3>
                <ul class="announcement__meta d-flex flex-wrap mt-2 mb-3 align-items-center">
                    <li><i class="far fa-calendar"></i>
                        <?php echo e(showDateTime($prove->job->created_at, 'd-m-Y H:i:s')); ?>

                    </li>
                </ul>
                <div class="announcement__details__content">
                    <h6 class="mb-2"><?php echo app('translator')->get('Details'); ?> :</h6>
                    <p><?php echo e($prove->detail); ?></p>
                </div>
                <?php if($prove->attachment != null): ?>
                    <div class="announcement__details__content">
                        <h6 class="my-2"><?php echo app('translator')->get('Attachment :'); ?></h6>
                        <a href="<?php echo e(route('user.job.download.attachment', encrypt($prove->id))); ?>" class="mr-3 text--base"><i class="las la-file"></i>
                            <?php echo app('translator')->get('Attachment'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-12 sidebar-right theiaStickySidebar">
            <div class="widget-box post-widget attachment-widget">
                <h4 class="pro-title"><?php echo app('translator')->get('Job Request'); ?></h4>
                <ul class="latest-posts m-0">
                    <li class="flex-wrap">
                        <div class="post-thumb">
                            <?php if(@$prove->user->image): ?>
                                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $prove->user->image, getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="post-info attachment-info">
                            <h6><?php echo e($prove->user->username); ?></h6>
                            <p><?php echo app('translator')->get('Rate :'); ?><?php echo e($general->cur_sym); ?><?php echo e(showAmount($prove->job->rate)); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex flex-wrap w-100" style="gap:7px">
                            <?php if($prove->status == Status::JOB_PROVE_PENDING): ?>
                                <button href="javascript:void(0)" class="btn btn--base btn--sm confirmationBtn" data-action="<?php echo e(route('user.job.approve', encrypt($prove->id))); ?>" data-question="<?php echo app('translator')->get('Are you sure to approve job?'); ?>">
                                    <i class="las la-check"></i>
                                    <?php echo app('translator')->get('Approve'); ?>
                                </button>
                                <button href="javascript:void(0)" class="btn btn--danger btn--sm confirmationBtn" data-action="<?php echo e(route('user.job.rejected', encrypt($prove->id))); ?>" data-question="<?php echo app('translator')->get('Are you sure to rejected this job?'); ?>">
                                    <i class="las la-times"></i>
                                    <?php echo app('translator')->get('Reject'); ?>
                                </button>
                            <?php elseif($prove->status == Status::JOB_PROVE_APPROVE): ?>
                                <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                            <?php else: ?>
                                <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
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

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            let modal = $('#confirmationModal')
            modal.find('.modal-footer').find('button').addClass('btn--sm');
            modal.find('.modal-header').find('button').replaceWith(
                '<span class="las la-times" data-bs-dismiss="modal"><span>');
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/job/attachment.blade.php ENDPATH**/ ?>