<?php $__env->startSection('content'); ?>
    <div class="py-5 container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="card custom--card  contact__form__wrapper">
                    <div class="card-body">
                        <div class="mb-4">
                            <p><?php echo app('translator')->get('To recover your account please provide your email or username to find your account.'); ?></p>
                        </div>
                        <form method="POST" action="<?php echo e(route('user.password.email')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group ">
                                <label class="form-label"><?php echo app('translator')->get('Email or Username'); ?></label>
                                <input type="text" class="form-control form--control" name="value"
                                    value="<?php echo e(old('value')); ?>" required autofocus="off">
                            </div>

                                <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/user/auth/passwords/email.blade.php ENDPATH**/ ?>