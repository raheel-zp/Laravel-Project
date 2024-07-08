<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="d-flex justify-content-center">
            <div class="verification-code-wrapper">
                <div class="verification-area">
                    <form action="<?php echo e(route('user.password.verify.code')); ?>" method="POST" class="submit-form">
                        <?php echo csrf_field(); ?>
                        <p class="verification-text"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?> : <?php echo e(showEmailAddress($email)); ?></p>
                        <input type="hidden" name="email" value="<?php echo e($email); ?>">

                        <?php echo $__env->make($activeTemplate . 'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="mb-3">
                            <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>

                        <div>
                            <?php echo app('translator')->get('Please check including your Junk/Spam Folder. if not found, you can'); ?>
                            <a href="<?php echo e(route('user.password.request')); ?>" class="text--base">
                                <?php echo app('translator')->get('Try to send again'); ?>
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/auth/passwords/code_verify.blade.php ENDPATH**/ ?>