<?php $__env->startSection('panel'); ?>

  <script src="https://cdn.tiny.cloud/1/m70dct3sqg9ewcnof4tw9mlvw6snnuy3rsqsex5pr233atsh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="dashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <form class="create__campaigns__form" action="<?php echo e(route('user.job.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="job-poster">
                            <div class="job-poster-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview w-100" id="previewImg" style="background-image: url(<?php echo e(getImage(getFilePath('jobPoster'), getFileSize('jobPoster'))); ?>)">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="attachment" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" />
                                        <label for="image" class="bg--base"><i class="la la-pencil text-light"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Category'); ?></label>
                            <select class="form-control form-select form--control h-50 w-100" name="category_id" id="category" required>
                                <option selected disabled value=""><?php echo app('translator')->get('Select One'); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" data-subcategories="<?php echo e($category->subcategory); ?>" <?php if(old('category_id') == $category->id): echo 'selected'; endif; ?>>
                                        <?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Subcategory'); ?></label>
                            <select class="form-control form-select form--control h-50 w-100 " name="subcategory_id" id="subcategory"></select>
                        </div>
                        <b>Nie posiadasz grafiki? Znajdziesz ją <a href="https://zlecenio.eu/blog/udostepniamy-grafiki-do-zlecen/117" target="_blank">tutaj</a></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label> <?php echo app('translator')->get('Job Title'); ?></label>
                            <input type="text" name="title" class="form-control form--control " value="<?php echo e(old('title')); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="country">
                        <?php echo app('translator')->get('Job Proof'); ?>
                    </label>
                    <select class="form-control form-select form--control h-50 w-100" name="job_proof" id="fileOption" required>
                        <option value="" selected disabled><?php echo app('translator')->get('Select Type'); ?></option>
                        <option value="1" <?php if(old('job_proof') == Status::JOB_PROVE_OPTIONAL): echo 'selected'; endif; ?>>
                            <?php echo app('translator')->get('Optional'); ?>
                        </option>
                        <option value="2" <?php if(old('job_proof') == Status::JOB_PROVE_REQUIRED): echo 'selected'; endif; ?>>
                            <?php echo app('translator')->get('Required'); ?></option>
                    </select>
                </div>
                <div class="row" id="choiceOption">
                    <label for="country">
                        <?php echo app('translator')->get('Select File Upload Option'); ?>
                    </label>
                    <div class="input-group">
                        <div class="form-group me-2">
                            <input type="checkbox" id="inlineRadio" value="all">
                            <label class="form-check-label" for="inlineRadio"><?php echo app('translator')->get('Select All'); ?></label>
                        </div>
                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group me-2 ">
                                <input type="checkbox" name="file_name[]" id="inlineRadio<?php echo e($file->id); ?>" value="<?php echo e($file->name); ?>">
                                <label class="form-check-label" for="inlineRadio<?php echo e($file->id); ?>"><?php echo e(__($file->name)); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label> <?php echo app('translator')->get('Quantity'); ?></label>
                            <input type="number" id="workers" name="quantity" class="form-control form--control workers" min="1" value="<?php echo e(old('quantity')); ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Worker will earn'); ?></label>
                            <div class="input-group">
                                <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="<?php echo e(old('rate')); ?>" required>
                                <div class="input-group-text bg--base text--white border-0"><?php echo e($general->cur_text); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Total Budget'); ?></label>
                            <div class="input-group">
                                <input type="text" name="total_budget" class="form-control form--control total" value="<?php echo e(old('total_budget')); ?>" readonly>
                                <div class="input-group-text bg--base text--white border-0"><?php echo e($general->cur_text); ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label><?php echo app('translator')->get('Job Description'); ?> </label>
                            <div class="input-group">
                          <textarea class="form-control form--control nicEdit" name="description"><?php echo e(old('description')); ?></textarea> _
                            <!--
                                <textarea class="form-control form--control" name="description"><?php echo e(old('description')); ?></textarea>
 

  <script>
    tinymce.init({
    language_url : 'https://zlecenio.eu/assets/edytor/jezyk/pl.js',
	language: 'pl',
	browser_spellcheck: true,
    contextmenu: false,
	menubar: false,
	link_target_list: false,
      selector: 'textarea',
      plugins: 'mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste autocorrect a11ychecker typography inlinecss',
      toolbar: 'blocks fontsize | bold italic underline strikethrough | image link media table mergetags | lineheight | numlist indent outdent | emoticons charmap | removeformat',
    });
  </script>   -->
                            </div>
                        </div>
                    </div>
                </div>
                <button class="cmn--btn btn--md w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        *:focus {
            outline: none;
        }

        .form--control {
            padding-right: 2px !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            var oldSubcategory = "<?php echo e(old('subcategory_id')); ?>";

            $("#choiceOption").css('display', 'none');
            $("#fileOption").on('change', function() {
                $("#choiceOption").css('display', 'none');
                var value = $(this).val();
                if (value == 2) {
                    $("#choiceOption").css('display', 'block');
                }
            });


            $("#inlineRadio").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'))
            });

            $('#category').on('change', function() {
                let subcategories = $(this).find('option:selected').data('subcategories');

                let subcategory = `<option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>`;
                $.each(subcategories, function(index, value) {
                    subcategory += `<option value="${value.id}" ${oldSubcategory ==value.id ? 'selected' : ''}>${value.name}</option>`;
                });
                $('[name=subcategory_id]').html(subcategory)
            }).change();

            $(".workers").on('change input', function() {
                var worker = $(this).val();
                var rate = $('.rate').val();
                var total = rate * worker;
                $('.total').val(total);
            });

            $(".rate").on('change input', function() {
                var rate = $(this).val();
                var worker = $('.workers').val();
                var total = rate * worker;
                $('.total').val(total);
            });

            $('.profilePicUpload').on('change', function() {
                previewFile($(this))

            })
        })(jQuery);

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").css("background-image", "url(" + reader.result + ")");
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
<?php $__env->stopPush(); ?>






<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/user/job/create.blade.php ENDPATH**/ ?>