<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="<?php echo e(route('admin.users.notification.single', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><?php echo app('translator')->get('Subject'); ?> </label>
                                <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Email subject'); ?>" name="subject"  required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo app('translator')->get('Message'); ?> </label>
                                <textarea name="message" rows="10" class="form-control nicEdit"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn w-100 h-45 btn--primary"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <span class="text--primary"><?php echo app('translator')->get('Notification will send via '); ?> <?php if($general->en): ?> <span class="badge badge--warning"><?php echo app('translator')->get('Email'); ?></span> <?php endif; ?> <?php if($general->sn): ?> <span class="badge badge--warning"><?php echo app('translator')->get('SMS'); ?></span> <?php endif; ?></span>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/users/notification_single.blade.php ENDPATH**/ ?>