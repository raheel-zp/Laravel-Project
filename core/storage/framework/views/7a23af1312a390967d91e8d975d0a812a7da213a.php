<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content contact__form__wrapper">
        <div class="profile__edit__wrapper">
            <div class="profile__edit__form">
                <form class="register" action="" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile__thumb__edit text-center">
                                <div class="thumb">
                                    <img id="previewImg" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'))); ?>" alt="freelancer">
                                </div>
                                <div class="profile__info">
                                    <h4 class="name"><?php echo e($user->fullname); ?></h4>
                                    <p class="username"><?php echo e($user->username); ?></p>
                                    <input type="file" class="form-control d-none" class="userProfileUpload" name="image" id="image" onchange="previewFile(this);">
                                    <label class="btn btn--base btn--md mt-3 mb-3" for="image">
                                        <?php echo app('translator')->get('Update Profile Picture'); ?>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('First Name'); ?></label>
                                    <input type="text" class="form-control form--control" name="firstname" value="<?php echo e($user->firstname); ?>" required>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Last Name'); ?></label>
                                    <input type="text" class="form-control form--control" name="lastname" value="<?php echo e($user->lastname); ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('E-mail Address'); ?></label>
                                    <input class="form-control form--control" value="<?php echo e($user->email); ?>" disabled>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Mobile Number'); ?></label>
                                    <input class="form-control form--control" value="<?php echo e($user->mobile); ?>" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('Address'); ?></label>
                                    <input type="text" class="form-control form--control" name="address" value="<?php echo e(@$user->address->address); ?>">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label"><?php echo app('translator')->get('State'); ?></label>
                                    <input type="text" class="form-control form--control" name="state" value="<?php echo e(@$user->address->state); ?>">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group  col-sm-4">
                                    <label class="form-label"><?php echo app('translator')->get('Zip Code'); ?></label>
                                    <input type="text" class="form-control form--control" name="zip" value="<?php echo e(@$user->address->zip); ?>">
                                </div>

                                <div class="form-group  col-sm-4">
                                    <label class="form-label"><?php echo app('translator')->get('City'); ?></label>
                                    <input type="text" class="form-control form--control" name="city" value="<?php echo e(@$user->address->city); ?>">
                                </div>

                                <div class="form-group  col-sm-4">
                                    <label class="form-label"><?php echo app('translator')->get('Country'); ?></label>
                                    <input class="form-control form--control" value="<?php echo e(@$user->address->country); ?>" disabled>
                                </div>

                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn--base w-100"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/profile_setting.blade.php ENDPATH**/ ?>