<?php $__env->startSection('panel'); ?>
<script src="https://cdn.tiny.cloud/1/m70dct3sqg9ewcnof4tw9mlvw6snnuy3rsqsex5pr233atsh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="ashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <div class="">
                <form class="create__campaigns__form" action="<?php echo e(route('user.job.update', $job->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-xl-3 col-lg-5 col-md-5">
                            <div class="job-poster">
                                <div class="job-poster-header">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview w-100" id="previewImg" style="background-image: url(<?php echo e(getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster'))); ?>)">
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="attachment" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" onchange="previewFile(this);" />
                                            <label for="image" class="bg--base"><i class="la la-pencil text-light"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-lg-7 col-md-7">
  
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

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label><?php echo app('translator')->get('Job Title'); ?>

                                </label>
                                <input type="text" name="title" class="form-control form--control" value="<?php echo e($job->title); ?>" required>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group ">
                                <label><?php echo app('translator')->get('Job Proof'); ?>

                                </label>
                                <select class="form-contro form-select form--control h-50 w-100" name="job_proof" id="fileOption" required>
                                    <option value="" selected disabled><?php echo app('translator')->get('Select Job Proof'); ?>
                                    </option>
                                    <option value="1" <?php if($job->job_proof == Status::JOB_PROVE_OPTIONAL): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Optional'); ?>
                                    </option>
                                    <option value="2" <?php if($job->job_proof == Status::JOB_PROVE_REQUIRED): echo 'selected'; endif; ?>>
                                        <?php echo app('translator')->get('Required'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="choiceOption">
                        <label><?php echo app('translator')->get('Select File Upload Option'); ?>

                        </label>
                        <div class="input-group">
                            <div class="form-group me-2">
                                <input type="checkbox" id="inlineRadio" value="all">
                                <label class="form-check-label" for="inlineRadio"><?php echo app('translator')->get('Select All'); ?></label>
                            </div>
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group me-2">
                                    <input type="checkbox" name="file_name[]" id="inlineRadio<?php echo e($file->id); ?>" value="<?php echo e($file->name); ?>">
                                    <label class="form-check-label" for="inlineRadio<?php echo e($file->id); ?>"><?php echo e($file->name); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="workers" class="form--label">
                                    <?php echo app('translator')->get('Quantity'); ?>
                                </label>
                                <div class="input-group">
                                    <input type="number" id="workers" name="quantity" class="form-control form--control workers" min="1" value="<?php echo e($job->quantity); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>
                                    <?php echo app('translator')->get('Worker will earn'); ?>
                                </label>
                                <div class="input-group">
                                    <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="<?php echo e(getAmount($job->rate)); ?>">
                                    <div class="input-group-text bg--base text--white"><?php echo e($general->cur_text); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label><?php echo app('translator')->get('Total Budget'); ?></label>
                                <div class="input-group">
                                    <input type="text" name="total_budget" class="form-control form--control total" value="<?php echo e(getAmount($job->total)); ?>" readonly>
                                    <div class="input-group-text bg--base text--white"><?php echo e($general->cur_text); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="input-group">
								<textarea class="form-control form--control nicEdit" name="description" required><?php echo e($job->description); ?></textarea>
								<!--
                                <textarea class="form-control form--control" name="description" required><?php echo e($job->description); ?></textarea>
 

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
  </script>         -->                 
                            </div>
                        </div>
                    </div>
                    <button class="cmn--btn btn--md w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
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
            var fileName = '<?php echo e($job->file_name); ?>';
            var files = fileName.split(",");
            var i;
            var j;
            var inputs = $("input[type=checkbox]");
            for (i = 0; i < files.length; i++) {
                var file = files[i];
                for (j = 0; j < inputs.length; j++) {
                    var checkboxVal = $(inputs[j]).val();
                    if (checkboxVal == file) {
                        $(inputs[j]).attr('checked', true);
                    }
                }
            }
            $("#inlineRadio").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'))
            });

            if (fileName) {
                $("#choiceOption").css('display', 'block');
            } else {
                $("#choiceOption").css('display', 'none');
            }

            $("#fileOption").change(function() {
                $("#choiceOption").css('display', 'none');
                var value = $(this).val();
                if (value == 2) {
                    $("#choiceOption").css('display', 'block');
                }
            });

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

            $(".workers").on('change input', function() {

                var worker = $(this).val();
                var rate = $('.rate').val();
                var total = rate * worker;
                $('.total').val(parseFloat(total).toFixed(3));
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

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/job/edit.blade.php ENDPATH**/ ?>