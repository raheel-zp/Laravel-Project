<?php
    $jobPostConent = getContent('job_post.content', true);
    $jobs = App\Models\JobPost::active()
        ->orderBy('id', 'desc')
        ->take(8)
        ->get();
?>

 <!-- NIEZALOGOWANY -->
<?php if(auth()->guard()->guest()): ?>
<?php else: ?>
<!-- NIEZALOGOWANY -->
<!-- ZALOGOWANY -->



<section class="job-section padding-top padding-bottom section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title"><?php echo e(__($jobPostConent->data_values->heading)); ?></h2>
                    <p><?php echo e(__($jobPostConent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        
<!-- tlumacz -->
<hr><center>
  <div class="form-group">
  <label><h3><?php echo app('translator')->get('Przetłumacz treść na Twój język'); ?></h3></label>


  <div id="google_translate_element"></div>
    <script type="text/javascript">
      function googleTranslateElementInit() {
          new google.translate.TranslateElement({
          pageLanguage: 'pl', 
          autoDisplay: true,
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE, 
          }, 'google_translate_element');
      }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  </div>  
</center>
<hr><br>
<!-- tlumacz -->         
        
        <div class="row g-3 justify-content-center">
            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="job__item">
                        <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                            <div class="job__item-thumb">
                                <img src="<?php echo e(getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster'))); ?>" alt="<?php echo app('translator')->get('job'); ?>">
                            </div>
                        </a>
                        <div class="job__item-content">
                            <div class="wrapper d-flex justify-content-between align-items-center">
                                <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>" class="tag btn btn--sm">
                                    <i class="las la-tag"></i>
                                    <?php echo app('translator')->get('Vacancy Available'); ?>
                                </a>
                                <a class="job-author text--primary tag btn btn--sm" href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                                    <?php echo e($job->vacancy_available); ?>

                                </a>
                            </div>
                            <h5 class="title">
                                <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>">
                                    <?php echo e(__($job->title)); ?>

                                </a>
                            </h5>
                            <ul class="job__info">
                                <li>
                                    <h6 class="job__info-title"><?php echo app('translator')->get('published'); ?></h6>
                                    <span class="text--primary">
                                        <?php echo e(showDateTime($job->created_at, 'j F Y')); ?>

                                    </span>
                                </li>
                            </ul>
                            <div class="content__footer d-flex align-items-center justify-content-between">
                                <h3 class="price"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?></h3>
                                <a href="<?php echo e(route('job.details', [$job->id, slug($job->title)])); ?>" class="btn btn--base btn--sm"><?php echo app('translator')->get('APPLY'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 mt-4">
                <div class="section__header text-center">
                    <a href="<?php echo e(route('job.list')); ?>" class="btn btn--base"><?php echo app('translator')->get('View all'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- ZALOGOWANY -->
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/sections/job_post.blade.php ENDPATH**/ ?>