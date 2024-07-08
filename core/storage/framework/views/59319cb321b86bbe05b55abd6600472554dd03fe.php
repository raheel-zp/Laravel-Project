<?php $__env->startSection('panel'); ?>
<div class="row mb-none-30">
    <div class="col-lg-12">
        <div class="card">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label><?php echo app('translator')->get('Status'); ?></label>
                        <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="<?php echo app('translator')->get('Enable'); ?>" data-off="<?php echo app('translator')->get('Disabled'); ?>" <?php if(@$cookie->data_values->status): ?> checked <?php endif; ?> name="status">
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                      <label><?php echo app('translator')->get('Short Description'); ?></label>
                        <textarea class="form-control" rows="5" required name="short_desc"><?php echo e(__(@$cookie->data_values->short_desc)); ?></textarea>
                    </div>
                    <div class="form-group">
                      <label><?php echo app('translator')->get('Description'); ?></label>
                        <textarea class="form-control nicEdit" rows="10" name="description"><?php echo @$cookie->data_values->description ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/setting/cookie.blade.php ENDPATH**/ ?>