<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content ">
        <table class="table transection__table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('Job Code'); ?></th>
                    <th><?php echo app('translator')->get('Amount'); ?></th>
                    <th><?php echo app('translator')->get('Status'); ?></th>
                    <th><?php echo app('translator')->get('Date'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <span class="invoice-id"><?php echo e(__(@$job->job->job_code)); ?></span>
                        </td>
                        <td>
                            <span class="amount">
                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount(@$job->job->rate)); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($job->status == Status::JOB_PROVE_PENDING): ?>
                                <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                            <?php elseif($job->status == Status::JOB_PROVE_APPROVE): ?>
                                <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                            <?php else: ?>
                                <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="time"><?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?></span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="justify-content-center text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($jobs->hasPages($jobs)): ?>
        <?php echo e(paginateLinks($jobs)); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/job/finished.blade.php ENDPATH**/ ?>