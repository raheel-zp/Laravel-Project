<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Sms Send Method'); ?></label>
                            <select name="sms_method" class="form-control">
                                <option value="clickatell" <?php if(@$general->sms_config->name == 'clickatell'): ?> selected <?php endif; ?>>
                                    <?php echo app('translator')->get('Clickatell'); ?></option>
                                <option value="infobip" <?php if(@$general->sms_config->name == 'infobip'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Infobip'); ?>
                                </option>
                                <option value="messageBird" <?php if(@$general->sms_config->name == 'messageBird'): ?> selected <?php endif; ?>>
                                    <?php echo app('translator')->get('Message Bird'); ?></option>
                                <option value="nexmo" <?php if(@$general->sms_config->name == 'nexmo'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Nexmo'); ?>
                                </option>
                                <option value="smsBroadcast" <?php if(@$general->sms_config->name == 'smsBroadcast'): ?> selected <?php endif; ?>>
                                    <?php echo app('translator')->get('Sms Broadcast'); ?></option>
                                <option value="twilio" <?php if(@$general->sms_config->name == 'twilio'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Twilio'); ?>
                                </option>
                                <option value="textMagic" <?php if(@$general->sms_config->name == 'textMagic'): ?> selected <?php endif; ?>>
                                    <?php echo app('translator')->get('Text Magic'); ?></option>
                                <option value="custom" <?php if(@$general->sms_config->name == 'custom'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Custom API'); ?>
                                </option>
                            </select>
                        </div>
                        <div class="row mt-4 d-none configForm" id="clickatell">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Clickatell Configuration'); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API Key'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('API Key'); ?>"
                                        name="clickatell_api_key"
                                        value="<?php echo e(@$general->sms_config->clickatell->api_key); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="infobip">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Infobip Configuration'); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Username'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Username'); ?>"
                                        name="infobip_username" value="<?php echo e(@$general->sms_config->infobip->username); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Password'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Password'); ?>"
                                        name="infobip_password" value="<?php echo e(@$general->sms_config->infobip->password); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="messageBird">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Message Bird Configuration'); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API Key'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('API Key'); ?>"
                                        name="message_bird_api_key"
                                        value="<?php echo e(@$general->sms_config->message_bird->api_key); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="nexmo">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Nexmo Configuration'); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API Key'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('API Key'); ?>"
                                        name="nexmo_api_key" value="<?php echo e(@$general->sms_config->nexmo->api_key); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API Secret'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('API Secret'); ?>"
                                        name="nexmo_api_secret" value="<?php echo e(@$general->sms_config->nexmo->api_secret); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="smsBroadcast">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Sms Broadcast Configuration'); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Username'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Username'); ?>"
                                        name="sms_broadcast_username"
                                        value="<?php echo e(@$general->sms_config->sms_broadcast->username); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Password'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Password'); ?>"
                                        name="sms_broadcast_password"
                                        value="<?php echo e(@$general->sms_config->sms_broadcast->password); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="twilio">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Twilio Configuration'); ?></h6>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Account SID'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Account SID'); ?>"
                                        name="account_sid" value="<?php echo e(@$general->sms_config->twilio->account_sid); ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Auth Token'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Auth Token'); ?>"
                                        name="auth_token" value="<?php echo e(@$general->sms_config->twilio->auth_token); ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('From Number'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('From Number'); ?>"
                                        name="from" value="<?php echo e(@$general->sms_config->twilio->from); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="textMagic">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Text Magic Configuration'); ?></h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Username'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Username'); ?>"
                                        name="text_magic_username"
                                        value="<?php echo e(@$general->sms_config->text_magic->username); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Apiv2 Key'); ?> </label>
                                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('Apiv2 Key'); ?>"
                                        name="apiv2_key" value="<?php echo e(@$general->sms_config->text_magic->apiv2_key); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 d-none configForm" id="custom">
                            <div class="col-md-12">
                                <h6 class="mb-2"><?php echo app('translator')->get('Custom API'); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('API URL'); ?> </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <select name="custom_api_method" class="method-select">
                                                <option value="get"><?php echo app('translator')->get('GET'); ?></option>
                                                <option value="post"><?php echo app('translator')->get('POST'); ?></option>
                                            </select>
                                        </span>
                                        <input type="text" class="form-control" name="custom_api_url"
                                            value="<?php echo e(@$general->sms_config->custom->url); ?>"
                                            placeholder="<?php echo app('translator')->get('API URL'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-responsive--sm mb-3">
                                        <table class=" table align-items-center table--light">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('Short Code'); ?> </th>
                                                    <th><?php echo app('translator')->get('Description'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <tr>
                                                    <td><span class="short-codes">{{ message }}</span></td>
                                                    <td><?php echo app('translator')->get('Message'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="short-codes">{{ number }}</span></td>
                                                    <td><?php echo app('translator')->get('Number'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border--dark mb-3">
                                        <div class="card-header bg--dark d-flex justify-content-between">
                                            <h5 class="text-white"><?php echo app('translator')->get('Headers'); ?></h5>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-light float-right addHeader"><i
                                                    class="la la-fw la-plus"></i><?php echo app('translator')->get('Add'); ?> </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="headerFields">
                                                <?php for($i = 0; $i < count($general->sms_config->custom->headers->name); $i++): ?>
                                                    <div class="row mt-3">
                                                        <div class="col-md-5">
                                                            <input type="text" name="custom_header_name[]"
                                                                class="form-control"
                                                                value="<?php echo e(@$general->sms_config->custom->headers->name[$i]); ?>"
                                                                placeholder="<?php echo app('translator')->get('Headers Name'); ?>">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" name="custom_header_value[]"
                                                                class="form-control"
                                                                value="<?php echo e(@$general->sms_config->custom->headers->value[$i]); ?>"
                                                                placeholder="<?php echo app('translator')->get('Headers Value'); ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button"
                                                                class="btn btn--danger btn-block removeHeader h-100"><i
                                                                    class="las la-times"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border--dark mb-3">
                                        <div class="card-header bg--dark d-flex justify-content-between">
                                            <h5 class="text-white"><?php echo app('translator')->get('Body'); ?></h5>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-light float-right addBody"><i
                                                    class="la la-fw la-plus"></i><?php echo app('translator')->get('Add'); ?> </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="bodyFields">
                                                <?php for($i = 0; $i < count($general->sms_config->custom->body->name); $i++): ?>
                                                    <div class="row mt-3">
                                                        <div class="col-md-5">
                                                            <input type="text" name="custom_body_name[]"
                                                                class="form-control"
                                                                value="<?php echo e(@$general->sms_config->custom->body->name[$i]); ?>"
                                                                placeholder="<?php echo app('translator')->get('Body Name'); ?>">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" name="custom_body_value[]"
                                                                value="<?php echo e(@$general->sms_config->custom->body->value[$i]); ?>"
                                                                class="form-control" placeholder="<?php echo app('translator')->get('Body Value'); ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button"
                                                                class="btn btn--danger btn-block removeBody h-100"><i
                                                                    class="las la-times"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn w-100 h-45 btn--primary"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>


    </div>


    
    <div id="testSMSModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Test SMS Setup'); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.setting.notification.sms.test')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Sent to'); ?> </label>
                                    <input type="text" name="mobile" class="form-control"
                                        placeholder="<?php echo app('translator')->get('Mobile'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="button" data-bs-target="#testSMSModal" data-bs-toggle="modal"
        class="btn btn-outline--primary btn-sm"> <i class="las la-paper-plane"></i> <?php echo app('translator')->get('Send Test SMS'); ?></button>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        .method-select {
            padding: 2px 7px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var method = '<?php echo e(@$general->sms_config->name); ?>';

            if (!method) {
                method = 'clickatell';
            }

            smsMethod(method);
            $('select[name=sms_method]').on('change', function() {
                var method = $(this).val();
                smsMethod(method);
            });

            function smsMethod(method) {
                $('.configForm').addClass('d-none');
                if (method != 'php') {
                    $(`#${method}`).removeClass('d-none');
                }
            }

            $('.addHeader').click(function() {
                var html = `
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <input type="text" name="custom_header_name[]" class="form-control" placeholder="<?php echo app('translator')->get('Headers Name'); ?>">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="custom_header_value[]" class="form-control" placeholder="<?php echo app('translator')->get('Headers Value'); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn--danger btn-block removeHeader h-100"><i class="las la-times"></i></button>
                        </div>
                    </div>
                `;
                $('.headerFields').append(html);

            })
            $(document).on('click', '.removeHeader', function() {
                $(this).closest('.row').remove();
            })

            $('.addBody').click(function() {
                var html = `
                    <div class="row mt-3">
                        <div class="col-md-5">
                            <input type="text" name="custom_body_name[]" class="form-control" placeholder="<?php echo app('translator')->get('Body Name'); ?>">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="custom_body_value[]" class="form-control" placeholder="<?php echo app('translator')->get('Body Value'); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn--danger btn-block removeBody h-100"><i class="las la-times"></i></button>
                        </div>
                    </div>
                `;
                $('.bodyFields').append(html);

            })
            $(document).on('click', '.removeBody', function() {
                $(this).closest('.row').remove();
            })

            $('select[name=custom_api_method]').val('<?php echo e(@$general->sms_config->custom->method); ?>');

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/notification/sms_setting.blade.php ENDPATH**/ ?>