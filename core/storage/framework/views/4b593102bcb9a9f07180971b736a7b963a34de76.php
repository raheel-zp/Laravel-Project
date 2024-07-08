
<?php $__env->startSection('panel'); ?>
    <div class="ashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <div class="">
                <form class="create__campaigns__form" action="<?php echo e(route('admin.jobs.update', $job->id)); ?>"  method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label><?php echo app('translator')->get('Job Title'); ?>

                                </label>
                                <input type="text" name="title" class="form-control form--control" value="<?php echo e($job->title); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label><?php echo app('translator')->get('Category'); ?></label>
                                <select class="form-control form-select form--control h-50 w-100" name="category_id" id="category" required>
                                    <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php if($job->category_id == $category->id): echo 'selected'; endif; ?> data-subcategories="<?php echo e($category->subcategory); ?>" data-subcategory="<?php echo e($job->subcategory_id); ?>">
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Subcategory'); ?></label>
                                <select class="form-control form-select form--control h-50 w-100" name="subcategory_id" id="subcategory">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">
                                    <?php echo app('translator')->get('Job Block Status'); ?>
                                </label>
                                <select class="form-control form-select form--control h-50 w-100" name="job_block_status" id="JobBlockStatus" required>
                                    <option value="" selected disabled><?php echo app('translator')->get('Select Type'); ?></option>
                                    <option value="0" <?php if($job->job_block_status == Status::JOB_UNBLOCK): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Unblock'); ?>
                                    </option>
                                    <option value="1" <?php if($job->job_block_status == Status::JOB_BLOCK): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Block'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">
                                    <?php echo app('translator')->get('Job Hide for Un-Authorized Users'); ?>
                                </label>
                                <select class="form-control form-select form--control h-50 w-100" name="is_hidden" id="JobIsHidden" required>
                                    <option value="" selected disabled><?php echo app('translator')->get('Select Type'); ?></option>
                                    <option value="1" <?php if($job->is_hidden == Status::YES): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Hide'); ?>
                                    </option>
                                    <option value="0" <?php if($job->is_hidden == Status::NO): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Show'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        *:focus {
            outline: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('#category').change(function() {
                let subcategories = $(this).find('option:selected').data('subcategories');
                let subCat = $(this).find('option:selected').data('subcategory');
                let subcategory = `<option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>`;
                $.each(subcategories, function(index, value) {
                    subcategory +=
                        `<option value="${value.id}" ${value.id == subCat ? 'selected' : ''} >${value.name}</option>`;
                });
                $('[name=subcategory_id]').html(subcategory)
            }).change();
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/admin/jobs/edit.blade.php ENDPATH**/ ?>