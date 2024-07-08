<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.gateway.automatic.update', $gateway->code)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="alias" value="<?php echo e($gateway->alias); ?>">
                    <input type="hidden" name="description" value="<?php echo e($gateway->description); ?>">


                    <div class="card-body">
                        <div class="payment-method-item block-item">
                            <div class="payment-method-header">

                                <div class="content ps-0 w-100">
                                    <?php if(count($supportedCurrencies) > 0): ?>
                                    <div class="d-flex justify-content-between">
                                        <h3><?php echo e(__($gateway->name)); ?></h3>
                                        <div class="input-group d-flex flex-wrap justify-content-end width-375">
                                            <select class="newCurrencyVal ">
                                                <option value=""><?php echo app('translator')->get('Select currency'); ?></option>
                                                <?php $__empty_1 = true; $__currentLoopData = $supportedCurrencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <option value="<?php echo e($currency); ?>" data-symbol="<?php echo e($symbol); ?>"><?php echo e(__($currency)); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <option value=""><?php echo app('translator')->get('No available currency support'); ?></option>
                                                <?php endif; ?>

                                            </select>
                                            <button type="button" class="btn btn--primary input-group-text newCurrencyBtn" data-crypto="<?php echo e($gateway->crypto); ?>" data-name="<?php echo e($gateway->name); ?>"><?php echo app('translator')->get('Add new'); ?></button>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <p><?php echo e(__($gateway->description)); ?></p>
                                </div>
                            </div>

                            <?php if($gateway->code < 1000 && $gateway->extra): ?>
                                <div class="payment-method-body mt-2">
                                    <h4 class="mb-3"><?php echo app('translator')->get('Configurations'); ?></h4>
                                    <div class="row">
                                        <?php $__currentLoopData = $gateway->extra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group col-lg-6">
                                                <label><?php echo e(__(@$param->title)); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="<?php echo e(route($param->value)); ?>" readonly/>
                                                    <button type="button" class="copyInput input-group-text" title="<?php echo app('translator')->get('Copy'); ?>"><i class="fa fa-copy"></i></button>
                                                </div>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="payment-method-body mt-2">
                                <h4 class="mb-3"><?php echo app('translator')->get('Global Setting for'); ?> <?php echo e(__($gateway->name)); ?></h4>
                                <div class="row">
                                    <?php $__currentLoopData = $parameters->where('global', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group col-lg-6">
                                            <label><?php echo e(__(@$param->title)); ?></label>
                                            <input type="text" class="form-control" name="global[<?php echo e($key); ?>]" value="<?php echo e(@$param->value); ?>" required/>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- payment-method-item start -->

                        <?php if(isset($gateway->currencies)): ?>
                            <?php $__currentLoopData = $gateway->currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gatewayCurrency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="currency[<?php echo e($currencyIndex); ?>][symbol]"
                                       value="<?php echo e($gatewayCurrency->symbol); ?>">
                                <div class="payment-method-item block-item child--item">
                                    <div class="payment-method-header">
                                        <div class="content w-100 ps-0">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-group">
                                                    <h4 class="mb-3"><?php echo e(__($gateway->name)); ?> - <?php echo e(__($gatewayCurrency->currency)); ?></h4>
                                                    <input type="text" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][name]" value="<?php echo e($gatewayCurrency->name); ?>" required/>
                                                </div>
                                                <div class="remove-btn">
                                                    <button type="button" class="btn btn--danger confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to delete this gateway currency?'); ?>" data-action="<?php echo e(route('admin.gateway.automatic.remove',$gatewayCurrency->id)); ?>">
                                                        <i class="la la-trash-o me-2"></i><?php echo app('translator')->get('Remove'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="payment-method-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][min_amount]" value="<?php echo e(getAmount($gatewayCurrency->min_amount)); ?>" required/>
                                                                <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][max_amount]" value="<?php echo e(getAmount($gatewayCurrency->max_amount)); ?>" required/>
                                                                <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Fixed Charge'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][fixed_charge]" value="<?php echo e(getAmount($gatewayCurrency->fixed_charge)); ?>" required/>
                                                                <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Percent Charge'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][percent_charge]" value="<?php echo e(getAmount($gatewayCurrency->percent_charge)); ?>" required/>
                                                                <div class="input-group-text">%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                <div class="card border--primary mt-2">
                                                    <h5 class="card-header bg--primary"><?php echo app('translator')->get('Currency'); ?></h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><?php echo app('translator')->get('Currency'); ?></label>
                                                                    <input type="text" name="currency[<?php echo e($currencyIndex); ?>][currency]" class="form-control border-radius-5 " value="<?php echo e($gatewayCurrency->currency); ?>" readonly/>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><?php echo app('translator')->get('Symbol'); ?></label>
                                                                    <input type="text" name="currency[<?php echo e($currencyIndex); ?>][symbol]" class="form-control border-radius-5 symbl" value="<?php echo e($gatewayCurrency->symbol); ?>" data-crypto="<?php echo e($gateway->crypto); ?>" required/>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Rate'); ?></label>
                                                            <div class="input-group">
                                                                <div class="input-group-text">1 <?php echo e(__($general->cur_text)); ?> =</div>
                                                                <input type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][rate]" value="<?php echo e(getAmount($gatewayCurrency->rate)); ?>" required/>
                                                                <div class="input-group-text"><span class="currency_symbol"><?php echo e(__($gatewayCurrency->baseSymbol())); ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php if($parameters->where('global', false)->count()  != 0 ): ?>
                                                <?php
                                                    $globalParameters = json_decode($gatewayCurrency->gateway_parameter);
                                                ?>
                                                <div class="col-lg-12">
                                                    <div class="card border--primary mt-4">
                                                        <h5 class="card-header bg--dark"><?php echo app('translator')->get('Configuration'); ?></h5>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <?php $__currentLoopData = $parameters->where('global', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label><?php echo e(__($param->title)); ?></label>
                                                                            <input type="text" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][param][<?php echo e($key); ?>]" value="<?php echo e($globalParameters->$key); ?>" required/>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $currencyIndex++ ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    <!-- payment-method-item end -->


                        <!-- **new payment-method-item start -->
                        <div class="payment-method-item child--item newMethodCurrency d-none">
                            <input disabled type="hidden" name="currency[<?php echo e($currencyIndex); ?>][symbol]"
                                   class="currencySymbol">
                            <div class="payment-method-header">

                                <div class="content w-100 ps-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <h4 class="mb-3" id="payment_currency_name"><?php echo app('translator')->get('Name'); ?></h4>
                                            <input disabled type="text" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][name]" required/>
                                        </div>
                                        <div class="remove-btn">
                                            <button type="button" class="btn btn-danger newCurrencyRemove">
                                                <i class="la la-trash-o me-2"></i><?php echo app('translator')->get('Remove'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Range'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Minimum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                        <input disabled type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][min_amount]" required/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Maximum Amount'); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                        <input disabled type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][max_amount]" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Charge'); ?></h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Fixed Charge'); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text"><?php echo e(__($general->cur_text)); ?></div>
                                                        <input disabled type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][fixed_charge]" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Percent Charge'); ?></label>
                                                    <div class="input-group">
                                                        <div class="input-group-text">%</div>
                                                        <input disabled type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][percent_charge]" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card border--primary mt-2">
                                            <h5 class="card-header bg--primary"><?php echo app('translator')->get('Currency'); ?></h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Currency'); ?></label>
                                                            <input disabled type="step" class="form-control currencyText border-radius-5" name="currency[<?php echo e($currencyIndex); ?>][currency]" readonly/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo app('translator')->get('Symbol'); ?></label>
                                                            <input disabled type="text" name="currency[<?php echo e($currencyIndex); ?>][symbol]" class="form-control border-radius-5 symbl" ata-crypto="<?php echo e($gateway->crypto); ?>" disabled/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Rate'); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <b>1 </b>&nbsp; <?php echo e(__($general->cur_text)); ?>&nbsp; =
                                                        </span>
                                                        <input disabled type="number" step="any" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][rate]" required/>
                                                        <div class="input-group-text"><span class="currency_symbol"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($parameters->where('global', false)->count()  != 0 ): ?>
                                        <div class="col-lg-12">
                                            <div class="card border--primary mt-4">
                                                <h5 class="card-header bg--dark"><?php echo app('translator')->get('Configuration'); ?></h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <?php $__currentLoopData = $parameters->where('global', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><?php echo e(__($param->title)); ?></label>
                                                                    <input disabled type="text" class="form-control" name="currency[<?php echo e($currencyIndex); ?>][param][<?php echo e($key); ?>]" required/>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <!-- **new payment-method-item end -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">
                            <?php echo app('translator')->get('Submit'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>





<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.gateway.automatic.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.gateway.automatic.index')).'']); ?>
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

            $('.newCurrencyBtn').on('click', function () {
                var form = $('.newMethodCurrency');
                var getCurrencySelected = $('.newCurrencyVal').find(':selected').val();
                var currency = $(this).data('crypto') == 1 ? 'USD' : `${getCurrencySelected}`;
                if (!getCurrencySelected) return;
                form.find('input').removeAttr('disabled');
                var symbol = $('.newCurrencyVal').find(':selected').data('symbol');
                form.find('.currencyText').val(getCurrencySelected);
                form.find('.currency_symbol').text(currency);
                $('#payment_currency_name').text(`${$(this).data('name')} - ${getCurrencySelected}`);
                form.removeClass('d-none');
                $('html, body').animate({scrollTop: $('html, body').height()}, 'slow');

                $('.newCurrencyRemove').on('click', function () {
                    form.find('input').val('');
                    form.remove();
                });
            });

            $('.symbl').on('input', function () {
                var curText = $(this).data('crypto') == 1 ? 'USD' : $(this).val();
                $(this).parents('.payment-method-body').find('.currency_symbol').text(curText);
            });

            $('.copyInput').on('click', function (e) {
                var copybtn = $(this);
                var input = copybtn.closest('.input-group').find('input');
                if (input && input.select) {
                    input.select();
                    try {
                        document.execCommand('SelectAll')
                        document.execCommand('Copy', false, null);
                        input.blur();
                        notify('success',`Copied: ${copybtn.closest('.input-group').find('input').val()}`);
                    } catch (err) {
                        alert('Please press Ctrl/Cmd + C to copy');
                    }
                }
            });

        })(jQuery);

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/gateways/automatic/edit.blade.php ENDPATH**/ ?>