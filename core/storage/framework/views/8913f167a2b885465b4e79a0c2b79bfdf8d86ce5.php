<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-7">
                <div class="alert alert-primary mb-3" role="alert">
                    <strong>
                        <?php echo app('translator')->get('Complete your profile'); ?>
                    </strong>
                    <p><?php echo app('translator')->get('You need to complete your profile by providing below information.'); ?></p>
                </div>
                <div class="card custom--card  contact__form__wrapper p-2">
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('user.data.submit')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('First Name'); ?></label>
                                    <input type="text" class="form-control form--control" name="firstname" value="<?php echo e(old('firstname')); ?>" required>
                                </div>

                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Last Name'); ?></label>
                                    <input type="text" class="form-control form--control" name="lastname" value="<?php echo e(old('lastname')); ?>" required>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Address'); ?></label>
                                    <input type="text" class="form-control form--control" name="address" value="<?php echo e(old('address')); ?>">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('State'); ?></label>
                                    <input type="text" class="form-control form--control" name="state" value="<?php echo e(old('state')); ?>">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Zip Code'); ?></label>
                                    <input type="text" class="form-control form--control" name="zip" value="<?php echo e(old('zip')); ?>">
                                </div>

                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('City'); ?></label>
                                    <input type="text" class="form-control form--control" name="city" value="<?php echo e(old('city')); ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn--base w-100">
                                <?php echo app('translator')->get('Submit'); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/user_data.blade.php ENDPATH**/ ?>