<?php $__env->startSection('panel'); ?>
    <div class="campaigns__wrapper">
        <div class="row">
            <?php if(!auth()->user()->ts): ?>
                <div class="col-md-6">
                    <div class="card custom--card contact__form__wrapper">
                        <div class="card-header">
                            <h5 class="card-title">
                                <?php echo app('translator')->get('Add Your Account'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">
                                <?php echo app('translator')->get('Use the QR code or setup key on your Google Authenticator app to add your account.'); ?>
                            </h6>
                            <div class="form-group mx-auto text-center">
                                <img class="mx-auto" src="<?php echo e($qrCodeUrl); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Setup Key'); ?></label>
                                <div class="input-group">
                                    <input type="text" name="key" value="<?php echo e($secret); ?>"
                                        class="form-control form--control referralURL" readonly>
                                    <button type="button" class="input-group-text bg--base border-0 text--white copytext"
                                        id="copyBoard">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <label><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('Help'); ?></label>
                            <p><?php echo app('translator')->get('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.'); ?> <a class="text--base"
                                    href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2"
                                    target="_blank"><?php echo app('translator')->get('Download'); ?></a></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if(auth()->user()->ts): ?>
                <div class="col-md-6  offset-md-3 ">
                    <div class="card custom--card contact__form__wrapper">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo app('translator')->get('Disable 2FA Security'); ?></h5>
                        </div>
                        <form action="<?php echo e(route('user.twofactor.disable')); ?>" method="POST">
                            <div class="card-body">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="key" value="<?php echo e($secret); ?>">
                                <div class="form-group mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('Google Authenticatior OTP'); ?></label>
                                    <input type="text" class="form-control form--control" name="code" required>
                                </div>
                                <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-6">
                    <div class="card custom--card contact__form__wrapper">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo app('translator')->get('Enable 2FA Security'); ?></h5>
                        </div>
                        <form action="<?php echo e(route('user.twofactor.enable')); ?>" method="POST">
                            <div class="card-body">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="key" value="<?php echo e($secret); ?>">
                                <div class="form-group mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('Google Authenticatior OTP'); ?></label>
                                    <input type="text" class="form-control form--control" name="code" required>
                                </div>
                                <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
      .copied::after {
        background-color: #<?php echo e($general->base_color); ?>;
    }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($){
            "use strict";
            $('#copyBoard').click(function(){
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/user/twofactor.blade.php ENDPATH**/ ?>