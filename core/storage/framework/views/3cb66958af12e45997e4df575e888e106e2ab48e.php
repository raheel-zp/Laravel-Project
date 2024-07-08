<?php
    $contactContent = getContent('contact_us.content', true);
    $contactElement = getContent('contact_us.element', false, null, true);
?>
<?php $__env->startSection('content'); ?>
    <section class="contact-section padding-top padding-bottom">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="contact__info__wrapper">
                        <h3 class="contact__info__wrapper-title"><?php echo e(__($contactContent->data_values->title)); ?></h3>
                        <p><?php echo e(__($contactContent->data_values->details)); ?></p>
                        <?php $__currentLoopData = $contactElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4 class="title"><?php echo $contact->data_values->icon ?> <?php echo e(__($contact->data_values->title)); ?></h4>
                            <ul class="contacts">
                                <li><?php echo e(__($contact->data_values->content)); ?></li>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact__form__wrapper">
                        <h3 class="contact__form__wrapper-title"><?php echo app('translator')->get("Let's Talk"); ?></h3>
                        <form method="post" action="<?php echo e(route('contact')); ?>" class="verify-gcaptcha">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Name'); ?></label>
                                <input name="name" type="text" class="form-control form--control" value="<?php echo e(auth()->user() ? auth()->user()->fullname : old('name')); ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Email'); ?></label>
                                <input name="email" type="email" class="form-control form--control" value="<?php echo e(auth()->user() ? auth()->user()->email : old('email')); ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Subject'); ?></label>
                                <input name="subject" type="text" class="form-control form--control" value="<?php echo e(old('subject')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo app('translator')->get('Message'); ?></label>
                                <textarea name="message" wrap="off" class="form-control form--control" required><?php echo e(old('message')); ?></textarea>
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
                            <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>