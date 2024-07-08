<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg--primary d-flex justify-content-between">
                    <h5 class="text-white"><?php echo app('translator')->get('KYC Form for User'); ?></h5>
                    <button type="button" class="btn btn-sm btn-outline-light float-end form-generate-btn"> <i class="la la-fw la-plus"></i><?php echo app('translator')->get('Add New'); ?></button>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row addedField">
                            <?php if($form): ?>
                                <?php $__currentLoopData = $form->form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="card border mb-3" id="<?php echo e($loop->index); ?>">
                                            <input type="hidden" name="form_generator[is_required][]" value="<?php echo e($formData->is_required); ?>">
                                            $user->kv = $general->kv ? Status::NO : Status::YES;                             <input type="hidden" name="form_generator[extensions][]" value="<?php echo e($formData->extensions); ?>">
                                            <input type="hidden" name="form_generator[options][]" value="<?php echo e(implode(',',$formData->options)); ?>">

                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Label'); ?></label>
                                                    <input type="text" name="form_generator[form_label][]" class="form-control" value="<?php echo e($formData->name); ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Type'); ?></label>
                                                    <input type="text" name="form_generator[form_type][]" class="form-control" value="<?php echo e($formData->type); ?>" readonly>
                                                </div>
                                                <?php
                                                    $jsonData = json_encode([
                                                        'type'=>$formData->type,
                                                        'is_required'=>$formData->is_required,
                                                        'label'=>$formData->name,
                                                        'extensions'=>explode(',',$formData->extensions) ?? 'null',
                                                        'options'=>$formData->options,
                                                        'old_id'=>'',
                                                    ]);
                                                ?>
                                                <div class="btn-group w-100">
                                                    <button type="button" class="btn btn--primary editFormData" data-form_item="<?php echo e($jsonData); ?>" data-update_id="<?php echo e($loop->index); ?>"><i class="las la-pen"></i></button>
                                                    <button type="button" class="btn btn--danger removeFormData"><i class="las la-times"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe = $component; } ?>
<?php $component = App\View\Components\FormGenerator::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-generator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FormGenerator::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe)): ?>
<?php $component = $__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe; ?>
<?php unset($__componentOriginalc2e85c5a6f46a6358a3b68e5bf9789587ca94cfe); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script>
        "use strict"
        var formGenerator = new FormGenerator();
        formGenerator.totalField = <?php echo e($form ? count((array) $form->form_data) : 0); ?>

    </script>

    <script src="<?php echo e(asset('assets/global/js/form_actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/kyc/setting.blade.php ENDPATH**/ ?>