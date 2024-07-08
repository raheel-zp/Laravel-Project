<div class="input-group w-auto flex-fill">
    <input name="date" type="search" data-range="true" data-multiple-dates-separator=" - " data-language="en" data-format="Y-m-d" class="datepicker-here form-control bg--white pe-2" data-position='bottom right' placeholder="<?php echo app('translator')->get('Start Date - End Date'); ?>" autocomplete="off" value="<?php echo e(request()->date); ?>">
    <button class="btn btn--primary input-group-text"><i class="la la-search"></i></button>
</div>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/components/search-date-field.blade.php ENDPATH**/ ?>