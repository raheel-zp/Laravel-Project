<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content ">
        <form action="" class="mb-3">
            <div class="d-flex flex-wrap gap-4">
                <div class="flex-grow-1">
                    <label><?php echo app('translator')->get('Transaction Number'); ?></label>
                    <input type="text" name="search" value="<?php echo e(request()->search); ?>" class="form-control form--control">
                </div>
                <div class="flex-grow-1">
                    <label><?php echo app('translator')->get('Type'); ?></label>
                    <select name="trx_type" class="form-select form--control">
                        <option value=""><?php echo app('translator')->get('All'); ?></option>
                        <option value="+" <?php if(request()->trx_type == '+'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Plus'); ?></option>
                        <option value="-" <?php if(request()->trx_type == '-'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Minus'); ?></option>
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label><?php echo app('translator')->get('Remark'); ?></label>
                    <select class="form-select form--control" name="remark">
                        <option value=""><?php echo app('translator')->get('Any'); ?></option>
                        <?php $__currentLoopData = $remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($remark->remark); ?>" <?php if(request()->remark == $remark->remark): echo 'selected'; endif; ?>>
                                <?php echo e(__(keyToTitle($remark->remark))); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex-grow-1 align-self-end">
                    <button class="btn btn--base  w-100"><i class="las la-filter"></i>
                        <?php echo app('translator')->get('Filter'); ?>
                    </button>
                </div>
            </div>
        </form>

        <table class="table transection__table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('Trx'); ?></th>
                    <th><?php echo app('translator')->get('Transacted'); ?></th>
                    <th><?php echo app('translator')->get('Amount'); ?></th>
                    <th><?php echo app('translator')->get('Post Balance'); ?></th>
                    <th><?php echo app('translator')->get('Detail'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <strong><?php echo e($trx->trx); ?></strong>
                        </td>

                        <td class="transacted">
                            <div class="text--end">
                                <span class="d-block">
                                    <?php echo e(showDateTime($trx->created_at)); ?>

                                </span>
                                <?php echo e(diffForHumans($trx->created_at)); ?>

                            </div>
                        </td>

                        <td class="budget">
                            <span class="fw-bold <?php if($trx->trx_type == '+'): ?> text--success <?php else: ?> text--danger <?php endif; ?>">
                                <?php echo e($trx->trx_type); ?> <?php echo e(showAmount($trx->amount)); ?>

                                <?php echo e($general->cur_text); ?>

                            </span>
                        </td>
                        <td class="budget">
                            <?php echo e(showAmount($trx->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

                        </td>
                        <td>
                            <div class="text--end">
                                <?php echo e($trx->details); ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?>

                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


        <?php if($transactions->hasPages()): ?>
            <div class="justify-content-center">
                <?php echo e($transactions->links()); ?>

            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .break_line {
            white-space: initial !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/transactions.blade.php ENDPATH**/ ?>