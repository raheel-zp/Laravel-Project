<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content contact__form__wrapper">
        <h5><?php echo app('translator')->get('Withdraw Via'); ?> <?php echo e($withdraw->method->name); ?></h5>
        <hr>
        <form action="<?php echo e(route('user.withdraw.submit')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-2">
                <?php
                    echo $withdraw->method->description;
                ?>
            </div>
            <?php if (isset($component)) { $__componentOriginale40beaa5cbfa24869bd0b7ba4d9f41184a3f12f0 = $component; } ?>
<?php $component = App\View\Components\ViserForm::resolve(['identifier' => 'id','identifierValue' => ''.e($withdraw->method->form_id).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('viser-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ViserForm::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale40beaa5cbfa24869bd0b7ba4d9f41184a3f12f0)): ?>
<?php $component = $__componentOriginale40beaa5cbfa24869bd0b7ba4d9f41184a3f12f0; ?>
<?php unset($__componentOriginale40beaa5cbfa24869bd0b7ba4d9f41184a3f12f0); ?>
<?php endif; ?>
            <?php if(auth()->user()->ts): ?>
                <div class="form-group  ">
                    <label><?php echo app('translator')->get('Google Authenticator Code'); ?></label>
                    <input type="text" name="authenticator_code" class="form-control form--control" required>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            $('div').find('.form-group').addClass('mb-3')
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/user/withdraw/preview.blade.php ENDPATH**/ ?>