<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form action="<?php echo e(route('admin.gateway.manual.update', $method->code)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-body">

                                <div class="row mt-4">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Gateway Name'); ?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo e($method->name); ?>" required/>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Currency'); ?></label>
                                            <input type="text" name="currency" class="form-control border-radius-5" value="<?php echo e(@$method->singleCurrency->currency); ?>" required/>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-md-12">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Rate'); ?></label>
                                            <div class="input-group">
                                                <div class="input-group-text">1 <?php echo e(__($general->cur_text)); ?>=</div>
                                                <input type="number" step="any" class="form-control" name="rate" value="<?php echo e(getAmount(@$method->singleCurrency->rate)); ?>" required/>
                                                <span class="currency_symbol input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="card border--primary mt-3">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control" name="min_limit" value="<?php echo e(getAmount(@$method->singleCurrency->min_amount)); ?>" required/>
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control" name="max_limit" value="<?php echo e(getAmount(@$method->singleCurrency->max_amount)); ?>" required/>
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border--primary mt-3">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Fixed Charge'); ?></label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control" name="fixed_charge" value="<?php echo e(getAmount(@$method->singleCurrency->fixed_charge)); ?>" required/>
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Percent Charge'); ?></label>
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control" name="percent_charge" value="<?php echo e(getAmount(@$method->singleCurrency->percent_charge)); ?>" required>
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--primary mt-3">

                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Deposit Instruction'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="8" class="form-control border-radius-5 nicEdit" name="instruction"><?php echo e(__(@$method->description)); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--primary mt-3">
                                            <div class="card-header bg--primary d-flex justify-content-between">
                                                <h5 class="text-white"><?php echo app('translator')->get('User Data'); ?></h5>
                                                <button type="button" class="btn btn-sm btn-outline-light float-end form-generate-btn"> <i class="la la-fw la-plus"></i><?php echo app('translator')->get('Add New'); ?></button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row addedField">
                                                    <?php if($form): ?>
                                                        <?php $__currentLoopData = $form->form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-4">
                                                                <div class="card border mb-3" id="<?php echo e($loop->index); ?>">
                                                                    <input type="hidden" name="form_generator[is_required][]" value="<?php echo e($formData->is_required); ?>">
                                                                    <input type="hidden" name="form_generator[extensions][]" value="<?php echo e($formData->extensions); ?>">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
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



<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.gateway.manual.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.gateway.manual.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>

        (function ($) {
            "use strict";

            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.currency_symbol').text($('input[name=currency]').val());

            <?php if(old('currency')): ?>
            $('input[name=currency]').trigger('input');
            <?php endif; ?>
        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/gateways/manual/edit.blade.php ENDPATH**/ ?>