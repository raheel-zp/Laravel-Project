<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card b-radius--10 ">
              <div class="card-body p-0">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('PHP Version'); ?></span>
                        <span><?php echo e($currentPHP); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Software'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_SOFTWARE']); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server IP Address'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_ADDR']); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Protocol'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_PROTOCOL']); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('HTTP Host'); ?></span>
                        <span><?php echo e(@$serverDetails['HTTP_HOST']); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span><?php echo app('translator')->get('Server Port'); ?></span>
                        <span><?php echo e(@$serverDetails['SERVER_PORT']); ?></span>
                    </li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                </ul>
              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style>
  .list-group-item span{
    font-size: 22px !important;
    padding: 8px 0px
  }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/system/server.blade.php ENDPATH**/ ?>