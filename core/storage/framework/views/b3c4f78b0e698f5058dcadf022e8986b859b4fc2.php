<?php
    $loginContent = getContent('login.content', true);
?>
<?php $__env->startSection('app'); ?>
    <section class="account-section">
        <div class="account-left">
            <div class="account__header">
                <a href="<?php echo e(route('home')); ?>" class="logo">
                    <img src="<?php echo e(getImage('assets/images/logoIcon/logo.png')); ?>" alt="<?php echo app('translator')->get('logo'); ?>">
                </a>
                <h2 class="account__header-title"><?php echo e(__($loginContent->data_values->heading)); ?></h2>
                <p><?php echo e(__($loginContent->data_values->subheading)); ?></p>
            </div>
            <form method="POST" action="<?php echo e(route('user.login')); ?>" class="verify-gcaptcha account-form">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email" class="form-label"><?php echo app('translator')->get('Username or Email'); ?></label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" class="form-control form--control" required>
                </div>

                <div class="form-group">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <label for="password" class="form-label mb-0"><?php echo app('translator')->get('Password'); ?></label>
                        <a class="fw-bold forgot-pass text--base" href="<?php echo e(route('user.password.request')); ?>">
                            <?php echo app('translator')->get('Forgot your password?'); ?>
                        </a>
                    </div>
                    <input id="password" type="password" class="form-control form--control" name="password" required>
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
                <div class="form-group  ">
                    <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">
                        <?php echo app('translator')->get('Remember Me'); ?>
                    </label>
                </div>

                <div class="  mb-3">
                    <button type="submit" id="recaptcha" class="btn btn--base w-100">
                        <?php echo app('translator')->get('Login'); ?>
                    </button>
                </div>
                <p class="mb-0"><?php echo app('translator')->get('Don\'t have any account?'); ?>
                    <a href="<?php echo e(route('user.register')); ?>" class="text--base"><?php echo app('translator')->get('Register'); ?></a>
                </p>
            </form>
        </div>
        <div class="account__right bg_img" style="background: url(<?php echo e(getImage('assets/images/frontend/login/' . $loginContent->data_values->image, '1920x1080')); ?>)">
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>