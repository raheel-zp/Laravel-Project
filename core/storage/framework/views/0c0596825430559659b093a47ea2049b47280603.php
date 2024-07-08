<?php
    $user = auth()->user();
?>
<div class="col-lg-4 col-xl-3">
    <div class="dashboard__sidebar">
        <div class="user__profile">
            <div class="user__profile-thumb">
                <?php if($user->image): ?>
                    <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>">
                <?php else: ?>
                    <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>">
                <?php endif; ?>
            </div>
            <div class="user__profile-content">
                <h4 class="user__profile-title"><?php echo e($user->fullname); ?></h4>
                <span class="designation d-block">
                    <?php echo app('translator')->get('Balance'); ?>: <?php echo e(showAmount($user->balance)); ?> <?php echo e($general->cur_text); ?>

                </span>
                <h6 class="text--base d-block">
                    <?php echo app('translator')->get('Username:'); ?> <?php echo e($user->username); ?>

                </h6>

            </div>
        </div>
        <ul class="dashboard__sidebar__menu">
            <li>
                <a href="<?php echo e(route('user.home')); ?>" class="<?php echo e(menuActive('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a>
            </li>
            <li class="has__submenu">
                <a href="javascript:void(0)"><?php echo app('translator')->get('Job'); ?></a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="<?php echo e(route('user.job.create')); ?>" class="<?php echo e(menuActive(['user.job.create', 'user.job.edit'])); ?>">
                            <?php echo app('translator')->get('Create Job'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('user.job.history')); ?>" class="<?php echo e(menuActive(['user.job.history', 'user.job.details'])); ?>">
                            <?php echo app('translator')->get('Job History'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('user.job.finished')); ?>" class="<?php echo e(menuActive('user.job.finished')); ?>">
                            <?php echo app('translator')->get('Finished Jobs'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('user.job.apply')); ?>" class="<?php echo e(menuActive('user.job.apply')); ?>">
                            <?php echo app('translator')->get('Applied Jobs'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="javascript:void(0)"><?php echo app('translator')->get('Deposit'); ?></a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="<?php echo e(route('user.deposit.index')); ?>" class="<?php echo e(menuActive(['user.deposit.index', 'user.deposit.confirm'])); ?>">
                            <?php echo app('translator')->get('Deposit Now'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('user.deposit.history')); ?>" class="<?php echo e(menuActive('user.deposit.history')); ?>">
                            <?php echo app('translator')->get('Deposit History'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="javascript:void(0)"><?php echo app('translator')->get('Withdraw'); ?></a>
                <ul class="sidebar__submenu">
                    <li>
                        <a href="<?php echo e(route('user.withdraw')); ?>" class="<?php echo e(menuActive(['user.withdraw', 'user.withdraw.preview'])); ?>">
                            <?php echo app('translator')->get('Withdraw Now'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('user.withdraw.history')); ?>" class="<?php echo e(menuActive(['user.withdraw.history'])); ?>">
                            <?php echo app('translator')->get('Withdraw History'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo e(route('user.transactions')); ?>" class="<?php echo e(menuActive('user.transactions')); ?>">
                    <?php echo app('translator')->get('Transactions'); ?>
                </a>
            </li>

            <li><a href="javascript:void(0)"><?php echo app('translator')->get('Support Ticket'); ?></a>
                <ul class="sidebar__submenu">
                    <li><a href="<?php echo e(route('ticket.open')); ?>" class="<?php echo e(menuActive('ticket.open')); ?>"><?php echo app('translator')->get('Create Ticket'); ?></a></li>
                    <li><a href="<?php echo e(route('ticket.index')); ?>" class="<?php echo e(menuActive(['ticket.index', 'ticket.view'])); ?>"><?php echo app('translator')->get('Ticket History'); ?></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo e(route('user.profile.setting')); ?>"class="<?php echo e(menuActive('user.profile.setting')); ?>"><?php echo app('translator')->get('Profile'); ?></a>
            </li>

            <li>
                <a href="<?php echo e(route('user.change.password')); ?>" class="<?php echo e(menuActive('user.change.password')); ?>">
                    <?php echo app('translator')->get('Change Password'); ?>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('user.twofactor')); ?>" class="<?php echo e(menuActive('user.twofactor')); ?>">
                    <?php echo app('translator')->get('2FA Security'); ?>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('user.logout')); ?>">
                    <?php echo app('translator')->get('Sign Out'); ?>
                </a>
            </li>
        </ul>
        <span class="btn btn-close dashboard__sidebar__close d-lg-none"></span>
    </div>
</div>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/partials/sidebar.blade.php ENDPATH**/ ?>