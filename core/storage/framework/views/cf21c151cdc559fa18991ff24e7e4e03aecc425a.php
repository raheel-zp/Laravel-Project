<?php $__env->startSection('content'); ?>
    <section class="job-category padding-top padding-bottom ">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-end mb-3 mb-sm-4">
                <div class="search">
                    <select class="nice-select sortPrice">
                        <option value="" selected disabled><?php echo app('translator')->get('Sort By Rate'); ?></option>
                        <option value="asc"><?php echo app('translator')->get('Low to High'); ?></option>
                        <option value="desc"><?php echo app('translator')->get('High to Low'); ?></option>
                    </select>
                </div>
                <div class="search ms-3">
                    <select class="nice-select dateSort">
                        <option value=""><?php echo app('translator')->get('Filter By'); ?></option>
                        <option value="today"><?php echo app('translator')->get('Today'); ?></option>
                        <option value="weekly"><?php echo app('translator')->get('Weekly'); ?></option>
                        <option value="monthly"><?php echo app('translator')->get('Monthly'); ?></option>
                    </select>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">
                    <div class="widget-box post-widget">
                        <h4 class="pro-title"><?php echo app('translator')->get('Job Categories'); ?></h4>
                        <ul class="latest-posts m-0">
                            <li>
                                <div class="post-thumb-category">
                                    <input type="checkbox" id="check" name="category_id" value="all" class="categoryFilter">
                                </div>
                                <div class="post-info-category">
                                    <label for="check"><?php echo app('translator')->get('All Category'); ?></label>
                                </div>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="post-thumb-category">
                                        <input type="checkbox" id="check<?php echo e($category->id); ?>" name="category_id" value="<?php echo e($category->id); ?>" class="categoryFilter" <?php if($category->id == request()->id): echo 'checked'; endif; ?>>
                                    </div>
                                    <div class="post-info-category">
                                        <label for="check<?php echo e($category->id); ?>"><?php echo e(__($category->name)); ?></label>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="post-info-category">
                                    <h6><a href="<?php echo e(route('category.list')); ?>" class="text--base"><?php echo app('translator')->get('View all category'); ?></a>
                                    </h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="announcement__details position-relative   border-0" id="jobs">
                        <div class="position-relative">
                            <div id="overlay">
                                <div class="cv-spinner">
                                    <span class="spinner"></span>
                                </div>
                            </div>
                            <div class="overlay-2" id="overlay2"></div>
                            <?php echo $__env->make($activeTemplate . 'partials.jobs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            $("#overlay, #overlay2").css('display', 'none');

            $('.categoryFilter').on('change', function() {
                if ($('#check').is(':checked')) {
                    $("input[type='checkbox'][name='category_id']").not(this).prop('checked', false);
                }
                filterJob()
            });

            $('.sortPrice').on('change', function() {
                filterJob()
            });

            $('.dateSort').on('change', function() {
                filterJob()
            });

            function filterJob() {
                $("#overlay, #overlay2").fadeIn(300);
                let date = $('.dateSort').val();
                let sort = $('.sortPrice').val();
                let category_id = [];
                $.each($("input[name='category_id']:checked"), function() {
                    category_id.push($(this).val());
                });

                let url = "<?php echo e(route('job.sort')); ?>";
                $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        'date': date,
                        'sort': sort,
                        'category_id': category_id
                    },
                    success: function(response) {

                        $('#jobs').html(response);
                    }
                }).done(function() {
                    setTimeout(() => {
                        $("#overlay, #overlay2").fadeOut(300);
                    }, 500);
                });
            }


            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                let date = $('.dateSort').val();
                let sort = $('.sortPrice').val();

                fetchData(page, date, sort);
            });

            function fetchData(page, date, sort) {

                var date = date;
                var sort = sort;
                var category_id = [];
                $.each($("input[name='category_id']:checked"), function() {
                    category_id.push($(this).val());
                });

                $.ajax({
                    url: "<?php echo e(url('job/pagination/?page=')); ?>" + page,
                    data: {
                        'date': date,
                        'sort': sort,
                        'category_id': category_id
                    },
                    beforeSend:function(){
                        $(".preloader").show();
                    },
                    success: function(response) {
                        $('#jobs').html(response);
                        $(".preloader").hide();
                    }
                });
            }
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/job/index.blade.php ENDPATH**/ ?>