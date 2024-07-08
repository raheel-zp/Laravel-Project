<?php $__env->startSection('panel'); ?>
<div class="row">
	<div class="col-md-12">
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive table-responsive--sm">
                    <table class=" table align-items-center table--light">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Short Code'); ?> </th>
                            <th><?php echo app('translator')->get('Description'); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <tr>
                            <td><span class="short-codes">{{fullname}}</span></td>
                            <td><?php echo app('translator')->get('Full Name of User'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="short-codes">{{username}}</span></td>
                            <td><?php echo app('translator')->get('Username of User'); ?></td>
                        </tr>
                        <tr>
                            <td><span class="short-codes">{{message}}</span></td>
                            <td><?php echo app('translator')->get('Message'); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h6 class="mt-4 mb-2"><?php echo app('translator')->get('Global Short Codes'); ?></h6>
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive table-responsive--sm">
                    <table class=" table align-items-center table--light">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('Short Code'); ?> </th>
                            <th><?php echo app('translator')->get('Description'); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__currentLoopData = $general->global_shortcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortCode => $codeDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="short-codes">{{<?php echo $shortCode ?>}}</span></td>
                            <td><?php echo e(__($codeDetails)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-body">
                <form action="<?php echo e(route('admin.setting.notification.global.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Email Sent From'); ?> </label>
                                <input type="text" class="form-control " placeholder="<?php echo app('translator')->get('Email address'); ?>" name="email_from" value="<?php echo e($general->email_from); ?>" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Email Body'); ?> </label>
                                <textarea name="email_template" rows="10" class="form-control  nicEdit" placeholder="<?php echo app('translator')->get('Your email template'); ?>"><?php echo e($general->email_template); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('SMS Sent From'); ?> </label>
                                <input class="form-control" placeholder="<?php echo app('translator')->get('SMS Sent From'); ?>" name="sms_from" value="<?php echo e($general->sms_from); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('SMS Body'); ?> </label>
                                <textarea class="form-control" rows="4" placeholder="<?php echo app('translator')->get('SMS Body'); ?>" name="sms_body" required><?php echo e($general->sms_body); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 btn--primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
            </div>
        </div><!-- card end -->
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/notification/global_template.blade.php ENDPATH**/ ?>