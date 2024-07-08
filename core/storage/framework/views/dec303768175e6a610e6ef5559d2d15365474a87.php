<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">


        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted"><?php echo app('translator')->get('Withdraw Via'); ?> <?php echo e(__(@$withdrawal->method->name)); ?></h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Date'); ?>
                            <span class="fw-bold"><?php echo e(showDateTime($withdrawal->created_at)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Trx Number'); ?>
                            <span class="fw-bold"><?php echo e($withdrawal->trx); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span class="fw-bold">
                                <a href="<?php echo e(route('admin.users.detail', $withdrawal->user_id)); ?>"><?php echo e(@$withdrawal->user->username); ?></a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Method'); ?>
                            <span class="fw-bold"><?php echo e(__($withdrawal->method->name)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Amount'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($withdrawal->amount )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Charge'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($withdrawal->charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('After Charge'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($withdrawal->after_charge )); ?> <?php echo e(__($general->cur_text)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Rate'); ?>
                            <span class="fw-bold">1 <?php echo e(__($general->cur_text)); ?>

                                = <?php echo e(showAmount($withdrawal->rate )); ?> <?php echo e(__($withdrawal->currency)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Payable'); ?>
                            <span class="fw-bold"><?php echo e(showAmount($withdrawal->final_amount)); ?> <?php echo e(__($withdrawal->currency)); ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Status'); ?>
                            <?php echo $withdrawal->statusBadge ?>
                        </li>

                        <?php if($withdrawal->admin_feedback): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Admin Response'); ?>
                           <p><?php echo e($withdrawal->admin_feedback); ?></p>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2"><?php echo app('translator')->get('User Withdraw Information'); ?></h5>


                    <?php if($details != null): ?>
                        <?php $__currentLoopData = json_decode($details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6><?php echo e(__($val->name)); ?></h6>
                                    <?php if($val->type == 'checkbox'): ?>
                                        <?php echo e(implode(',',$val->value)); ?>

                                    <?php elseif($val->type == 'file'): ?>
                                        <?php if($val->value): ?>
                                            <a href="<?php echo e(route('admin.download.attachment',encrypt(getFilePath('verify').'/'.$val->value))); ?>" class="me-3"><i class="fa fa-file"></i>  <?php echo app('translator')->get('Attachment'); ?> </a>
                                        <?php else: ?>
                                            <?php echo app('translator')->get('No File'); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <p><?php echo e(__($val->value)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                    <?php if($withdrawal->status == Status::PAYMENT_PENDING): ?>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-outline--success ms-1 approveBtn" data-id="<?php echo e($withdrawal->id); ?>" data-amount="<?php echo e(showAmount($withdrawal->final_amount)); ?> <?php echo e($withdrawal->currency); ?>">
                                    <i class="fas la-check"></i> <?php echo app('translator')->get('Approve'); ?>
                                </button>

                                <button class="btn btn-outline--danger ms-1 rejectBtn" data-id="<?php echo e($withdrawal->id); ?>">
                                    <i class="fas fa-ban"></i> <?php echo app('translator')->get('Reject'); ?>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>



    
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Approve Withdrawal Confirmation'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.withdraw.approve')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Have you sent'); ?> <span class="fw-bold withdraw-amount text--success"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" value="<?php echo e(old('details')); ?>" rows="3" placeholder="<?php echo app('translator')->get('Provide the details. eg: transaction number'); ?>" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Reject Withdrawal Confirmation'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.withdraw.reject')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Reason of Rejection'); ?></label>
                            <textarea name="details" class="form-control pt-3" rows="3" value="<?php echo e(old('details')); ?>" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/withdraw/detail.blade.php ENDPATH**/ ?>