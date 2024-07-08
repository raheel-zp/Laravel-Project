<?php $__env->startSection('panel'); ?>

    <div class="row mb-none-30">
        <div class="col-lg-3 col-md-3 mb-30">

            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary">
                        <div class="avatar avatar--lg">
                            <img src="<?php echo e(getImage(getFilePath('adminProfile').'/'. $admin->image,getFileSize('adminProfile'))); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white"><?php echo e(__($admin->name)); ?></h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Name'); ?>
                            <span class="fw-bold"><?php echo e(__($admin->name)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Username'); ?>
                            <span  class="fw-bold"><?php echo e(__($admin->username)); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo app('translator')->get('Email'); ?>
                            <span  class="fw-bold"><?php echo e($admin->email); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 border-bottom pb-2"><?php echo app('translator')->get('Change Password'); ?></h5>

                    <form action="<?php echo e(route('admin.password.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Password'); ?></label>
                            <input class="form-control" type="password" name="old_password" required>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('New Password'); ?></label>
                            <input class="form-control" type="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Confirm Password'); ?></label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn--primary w-100 btn-lg h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-sm btn-outline--primary" ><i class="las la-user"></i><?php echo app('translator')->get('Profile Setting'); ?></a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/nowy.zlecenio.eu/public_html/core/resources/views/admin/password.blade.php ENDPATH**/ ?>