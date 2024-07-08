<?php
    $registerContent = getContent('register.content', true);
    $policyPages     = getContent('policy_pages.element', false, null, true);
?>

<?php $__env->startSection('app'); ?>
    <section class="account-section ">
        <div class="account__right bg_img" style="background: url(<?php echo e(getImage('assets/images/frontend/register/' . @$registerContent->data_values->image, '1920x1080')); ?>) center;">
        </div>
        <div class="account-left sign-up">
            <div class="account__header">
                <a href="<?php echo e(route('home')); ?>" class="logo">
                    <img src="<?php echo e(getImage('assets/images/logoIcon/logo.png')); ?>" alt="<?php echo app('translator')->get('logo'); ?>">
                </a>
                <h2 class="account__header-title"><?php echo e(__($registerContent->data_values->heading)); ?></h2>
                <p><?php echo e(__($registerContent->data_values->subheading)); ?></p>
            </div>
            <form action="<?php echo e(route('user.register')); ?>" method="POST" class="verify-gcaptcha">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('Username'); ?></label>
                            <input type="text" class="form-control form--control checkUser" name="username" value="<?php echo e(old('username')); ?>" required>
                            <small class="text--danger usernameExist"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('E-Mail Address'); ?></label>
                            <input type="email" class="form-control form--control checkUser" name="email" value="<?php echo e(old('email')); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('Country'); ?></label>
                            <select name="country" class=" form-select form-control form--control" required>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-mobile_code="<?php echo e($country->dial_code); ?>" value="<?php echo e($country->country); ?>" data-code="<?php echo e($key); ?>">
                                        <?php echo e(__($country->country)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('Mobile'); ?></label>
                            <div class="input-group ">
                                <span class="input-group-text mobile-code bg--base text--white border-0"></span>
                                <input type="hidden" name="mobile_code">
                                <input type="hidden" name="country_code">
                                <input type="number" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control form--control checkUser" required>
                            </div>
                            <small class="text--danger mobileExist"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('Password'); ?></label>
                            <input type="password" class="form-control form--control" name="password" required>
                            <?php if($general->secure_password): ?>
                                <div class="input-popup">
                                    <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                    <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                    <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                    <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                    <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="form-label"><?php echo app('translator')->get('Confirm Password'); ?></label>
                            <input type="password" class="form-control form--control" name="password_confirmation" required>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>
                </div>
                <?php if($general->agree): ?>
                    <div class="form-group">
                        <input type="checkbox" id="agree" <?php if(old('agree')): echo 'checked'; endif; ?> name="agree" required>
                        <label for="agree" class="agree"><?php echo app('translator')->get('I agree with'); ?></label>
                            <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('policy.pages', [slug($policy->data_values->title), $policy->id])); ?>" class="text--base">
                                    <?php echo e(__($policy->data_values->title)); ?>

                                </a>
                                <?php if(!$loop->last): ?>
                                    ,
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" id="recaptcha" class="btn btn--base w-100"><?php echo app('translator')->get('Register'); ?></button>
                <p class="mb-0"><?php echo app('translator')->get('Already have an account?'); ?>
                    <a href="<?php echo e(route('user.login')); ?>" class="text--base"><?php echo app('translator')->get('Login'); ?></a>
                </p>
            </form>
        </div>
    </section>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle"><?php echo app('translator')->get('You are with us'); ?></h5>
                    <button class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center"><?php echo app('translator')->get('You already have an account please Login '); ?></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn--sm" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <a href="<?php echo e(route('user.login')); ?>" class="btn btn--base  btn--sm"><?php echo app('translator')->get('Login'); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if($general->secure_password): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            <?php if($mobileCode): ?>
                $(`option[data-code=<?php echo e($mobileCode); ?>]`).attr('selected', '');
            <?php endif; ?>






            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            <?php if($general->secure_password): ?>
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });
                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });
                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            <?php endif; ?>



            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .agree::after {
            display: none
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>