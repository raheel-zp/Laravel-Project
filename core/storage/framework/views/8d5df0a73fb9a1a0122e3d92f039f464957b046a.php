<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Email-Phone'); ?></th>
                                    <th><?php echo app('translator')->get('Country'); ?></th>
                                    <th><?php echo app('translator')->get('Submited Date'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Balance'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $job->proves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobProve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold d-block"><?php echo e($jobProve->user->fullname); ?></span>
                                            <span class="small">
                                                <a href="<?php echo e(route('admin.users.detail', $jobProve->user->id)); ?>"><span>@</span><?php echo e($jobProve->user->username); ?>

                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            <?php echo e($jobProve->user->email); ?><br><?php echo e($jobProve->user->mobile); ?>

                                        </td>
                                        <td> <span class="fw-bold"><?php echo e($jobProve->user->address->country); ?></span></td>
                                        <td>
                                            <span class="d-block"><?php echo e(showDateTime($jobProve->created_at)); ?></span>
                                            <?php echo e(diffForHumans($jobProve->created_at)); ?>

                                        </td>
                                        <td>
                                            <?php if($jobProve->status == 0): ?>
                                                <span class="badge  badge--warning">
                                                    <?php echo app('translator')->get('Pending'); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge  badge--success">
                                                    <?php echo app('translator')->get('Approved'); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="fw-bold">
                                                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/admin/jobs/details.blade.php ENDPATH**/ ?>