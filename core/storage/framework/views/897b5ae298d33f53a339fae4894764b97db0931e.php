<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.withdraw.method.update', $method->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Name'); ?></label>
                                <input type="text" class="form-control" name="name" value="<?php echo e($method->name); ?>" required/>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Currency'); ?></label>
                                        <div class="input-group">
                                            <input type="text" name="currency" class="form-control border-radius-5" value="<?php echo e($method->currency); ?>" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Rate'); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-text">1 <?php echo e(__($general->cur_text)); ?>

                                                =
                                            </span>
                                            <input type="text" class="form-control" name="rate" value="<?php echo e(getAmount($method->rate)); ?>" required/>
                                            <span class="currency_symbol input-group-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border--primary mb-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="min_limit" value="<?php echo e(getAmount($method->min_limit)); ?>" required/>
                                                        <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="max_limit" value="<?php echo e(getAmount($method->max_limit)); ?>" required/>
                                                        <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Fixed Charge'); ?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="fixed_charge" value="<?php echo e(getAmount($method->fixed_charge)); ?>" required/>
                                                        <span class="input-group-text"> <?php echo e(__($general->cur_text)); ?> </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Percent Charge'); ?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="percent_charge" value="<?php echo e(getAmount($method->percent_charge)); ?>" required>
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark my-2">
                                            <h5 class="card-header bg--dark"><?php echo app('translator')->get('Withdraw Instruction'); ?> </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction"><?php echo e($method->description); ?></textarea>
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
            </div><!-- card end -->
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.withdraw.method.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.withdraw.method.index')).'']); ?>
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

            $('.addUserData').on('click', function () {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" required>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control" required>
                                    <option value="text" > <?php echo app('translator')->get('Input Text'); ?> </option>
                                    <option value="textarea" > <?php echo app('translator')->get('Textarea'); ?> </option>
                                    <option value="file"> <?php echo app('translator')->get('File'); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control" required>
                                    <option value="required"> <?php echo app('translator')->get('Required'); ?> </option>
                                    <option value="nullable">  <?php echo app('translator')->get('Optional'); ?> </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-end">
                                <span class="input-group-btn">
                                    <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            <?php if(old('currency')): ?>
            $('input[name=currency]').trigger('input');
            <?php endif; ?>
        })(jQuery);


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/withdraw/edit.blade.php ENDPATH**/ ?>