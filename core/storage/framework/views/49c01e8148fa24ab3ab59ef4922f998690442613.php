<div class="row g-3 justify-content-center">
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-wallet"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Balance'); ?></p>
            <h2 class="title"><?php echo e($general->cur_sym); ?><span class="odometer" data-odometer-final="<?php echo e(showAmount($data['balance'])); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.transactions')); ?>"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-dollar-sign"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Deposit'); ?></p>
            <h2 class="title"><?php echo e($general->cur_sym); ?><span class="odometer" data-odometer-final="<?php echo e(showAmount($data['deposit_balance'])); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.deposit.history')); ?>"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-hand-holding-usd"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Withdraw'); ?></p>
            <h2 class="title"><?php echo e($general->cur_sym); ?><span class="odometer" data-odometer-final="<?php echo e(showAmount($data['withdraw_balance'])); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-check"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Completed Job'); ?></p>
            <h2 class="title"><span class="odometer" data-odometer-final="<?php echo e($data['complete_job']); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.transactions')); ?>?remark=payment_receive"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-list-ul"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Jobs Created'); ?></p>
            <h2 class="title"><span class="odometer" data-odometer-final="<?php echo e($data['created_job']); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.job.history')); ?>"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="dashboard__card__item">
            <div class="dashboard__card__item-icon">
                <i class="las la-tasks"></i>
            </div>
            <p class="info"><?php echo app('translator')->get('Transactions'); ?></p>
            <h2 class="title"><span class="odometer" data-odometer-final="<?php echo e($data['transaction']); ?>">0</span></h2>
            <div class="dashboard__card__item-footer">
                <a href="<?php echo e(route('user.transactions')); ?>"><?php echo app('translator')->get('View Details'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/srv31316/domains/nowy.zlecenio.eu/public_html/core/resources/views/templates/basic/partials/user_history.blade.php ENDPATH**/ ?>