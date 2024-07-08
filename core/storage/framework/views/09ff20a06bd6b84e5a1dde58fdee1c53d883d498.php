<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="d-flex justify-content-center">
                    <div class="verification-code-wrapper ">
                        <div class="verification-area">
                            <form action="<?php echo e(route('user.verify.email')); ?>" method="POST" class="submit-form">
                                <?php echo csrf_field(); ?>
                                <p class="verification-text"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?>: <?php echo e(showEmailAddress(auth()->user()->email)); ?>

                                </p>

                                <?php echo $__env->make($activeTemplate . 'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <div class=" mb-3">
                                    <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                                </div>

                                <div>
                                    <p>
                                        <?php echo app('translator')->get('If you don\'t get any code'); ?>,
                                        <a href="<?php echo e(route('user.send.verify.code', 'email')); ?>" class="text--base">
                                            <?php echo app('translator')->get('Try again'); ?>
                                        </a>
                                    </p>

                                    <?php if($errors->has('resend')): ?>
                                        <small class="text--danger d-block"><?php echo e($errors->first('resend')); ?></small>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/auth/authorization/email.blade.php ENDPATH**/ ?>