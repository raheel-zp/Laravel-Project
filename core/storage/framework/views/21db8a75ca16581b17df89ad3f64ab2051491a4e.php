<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content  ">
        <div class="text-end">
            <a href="<?php echo e(route('ticket.open')); ?>" class="btn btn--sm btn--base mb-2"> <i class="fa fa-plus"></i>
                <?php echo app('translator')->get('New Ticket'); ?></a>
        </div>
        <div class="table-responsive">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('Subject'); ?></th>
                        <th><?php echo app('translator')->get('Status'); ?></th>
                        <th><?php echo app('translator')->get('Priority'); ?></th>
                        <th><?php echo app('translator')->get('Last Reply'); ?></th>
                        <th><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('ticket.view', $support->ticket)); ?>" class="fw-bold">
                                    [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($support->ticket); ?>] <?php echo e(__($support->subject)); ?> </a>
                            </td>
                            <td>
                                <?php echo $support->statusBadge; ?>
                            </td>
                            <td>
                                <?php if($support->priority == Status::PRIORITY_LOW): ?>
                                    <span class="badge badge--dark"><?php echo app('translator')->get('Low'); ?></span>
                                <?php elseif($support->priority == Status::PRIORITY_MEDIUM): ?>
                                    <span class="badge  badge--warning"><?php echo app('translator')->get('Medium'); ?></span>
                                <?php elseif($support->priority == Status::PRIORITY_HIGH): ?>
                                    <span class="badge badge--danger"><?php echo app('translator')->get('High'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div>
                                    <span class="d-block"><?php echo e(showDateTime($support->last_reply)); ?></span>
                                    <span><?php echo e(diffForHumans($support->last_reply)); ?></span>
                                </div>
                            </td>

                            <td>
                                <a href="<?php echo e(route('ticket.view', $support->ticket)); ?>" class="btn btn--base btn--sm">
                                    <i class="fa fa-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($supports->links()); ?>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/support/index.blade.php ENDPATH**/ ?>