<?php $__env->startSection('content'); ?>

<!-- uwaga i tlumaczenie -->
<div class="container">
    <div class="job__details__wrapper">
<center>
	<div class="styl-uwagi">
		<p><h2><?php echo app('translator')->get('UWAGA !!!'); ?></h2></p>
		<p><?php echo app('translator')->get('Zlecenie można wykonać tylko jeden raz.'); ?><br>
			<?php echo app('translator')->get('Jeśli zlecenie zostanie odrzucone, ponownie go nie wykonasz.'); ?></p><hr>
		<p><b><?php echo app('translator')->get('Przeczytaj uważnie treść zlecenia.'); ?></b></p><hr>
		<p><?php echo app('translator')->get('Jeśli zlecenioDawca odrzuci zlecenie, a Ty uważasz, że wykonano go prawidłowo skontaktuj się z nami.'); ?></p>
	</div>
</center>	 


<hr><center>
  <div class="form-group">
  <label><h3><?php echo app('translator')->get('Przetłumacz szczegóły zlecenia na Twój język'); ?></h3></label>


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


</div> 
</div> 

<style type="text/css">
	.styl-uwagi {
    padding: 60px;
    margin: 20px;
    border-radius: 8px;
    background: #247fe1;
}

    .styl-uwagi p,
    .styl-uwagi h2 {
    color: #FFF;
}

    .styl-uwagi .btn.color2 {
    border: 1px solid #fff;
}
</style>	

<!-- uwaga i tlumaczenie -->

    <section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job__details__wrapper">
					
                        <h3 class="job__details__wrapper-title">
                            <?php echo e(__($job->title)); ?>

                        </h3>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title"><?php echo app('translator')->get('Job Description :'); ?></h4>
                            <?php
                                echo $job->description;
                            ?>
                        </div>

                        <?php
                            $ratings = $job->getAllRatings($job->id, 'desc');
                        ?>

                        <?php if(@$job->proves->where('user_id', auth()->id())->count() < 1): ?>
                            <?php if($job->user_id != auth()->id()): ?>
                                <div class="job__details__widget">
                                    <h4 class="job__details__widget-title">
                                        <?php echo app('translator')->get('Enter The Required Proof Of Job Finished:'); ?>
                                    </h4>
                                    <form class="job__finished__form" action="<?php echo e(route('user.job.prove', $job->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="input-group">
                                            <textarea name="detail" class="form--control w-100"><?php echo e(old('detail')); ?></textarea>
                                        </div>
                                        <?php if($job->job_proof == 2): ?>
                                            <div class="input-group mt-3">
                                                <input type="file" name="attachment" class="form-control form--control w-100" <?php if($job->job_proof == 2): echo 'required'; endif; ?>>
                                                <span class="info fs--14 mt-2">
                                                    <?php echo app('translator')->get('Allowed File Extensions:'); ?> <?php echo e(__($job->file_name)); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                            <?php echo app('translator')->get('Request for Complete'); ?>
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="job__details__widget">
                                <h4 class="job__details__widget-title text-center text--base">
                                    <?php echo app('translator')->get('You are already submitted job prove please wait until review complete'); ?>
                                </h4>

                                <?php
                                    $comment_form_display = true;
                                    if ($ratings && sizeof ($ratings) > 0) {
                                        foreach ( $ratings as $rating) {
                                            if ( $rating->author_id == auth()->id()) {
                                                $comment_form_display = false;
                                            }
                                        }
                                    }
                                ?>

                                
                                 <?php if($job->status == Status::JOB_COMPLETED || $job->status == Status::JOB_REJECTED): ?>
                                 
                                    <?php if(@$job->proves->where('user_id', auth()->id())->count() >= 1 || $job->user_id == auth()->id()): ?>
                                        <?php if($comment_form_display): ?>
                                            <form class="job__reviewed__form" action="<?php echo e(route('user.job.review.store', $job->id)); ?>" method="POST" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="input-group">
                                                    <label class="form-label"><?php echo app('translator')->get('Rating:'); ?></label>
                                                    <input type="hidden" id="user_rating" name="user_rating" value="<?php echo e(old('user_ratings')); ?>">
                                                    <section class='rating-widget'>
                                                        <!-- Rating Stars Box -->
                                                        <div class='rating-stars text-center'>
                                                            <ul id='stars'>
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                    </section>
                                                </div>    
                                                <div class="input-group">
                                                <label class="form-label"><?php echo app('translator')->get('Review'); ?></label>
                                                    <textarea name="review" class="form--control w-100"><?php echo e(old('review')); ?></textarea>
                                                </div>
                                                
                                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                                    <?php echo app('translator')->get('Submit'); ?>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <h2>Reviews:</h2>
                                    <ul>
                                        <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($review->user); ?>: <?php echo e($review->body); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                <?php endif; ?>
                            </div>

                            
                        <?php endif; ?>
                    </div>
                    
                    <!-- Komentarz -->
                    <center>
                    <hr> <b><?php echo app('translator')->get('Podziel się opinią na temat zlecenioDawcy:'); ?> <?php echo e(__(@$job->user->fullname)); ?></b> <hr><br>
                        </center>
                        
                    <div id="disqus_thread"></div>
                    <script>
                        /**
                        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://zlecenio.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                    <!-- Komentarz -->
                </div>

                <div class="col-lg-4">
                    <div class="job__details__sidebar">
                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title"><?php echo app('translator')->get('Job Information'); ?></h5>
                            <div class="info__wrapper">
                                <div class="info__item">
                                    <div class="icon">
                                        <img src="<?php echo e(getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster'))); ?>" alt="<?php echo app('translator')->get('freelancer'); ?>" class="img-fluid">
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><?php echo app('translator')->get('Job ID :'); ?> <?php echo e(__(@$job->job_code)); ?></h6>
                                        <p><?php echo app('translator')->get('Job posted by'); ?> <?php echo e(__(@$job->user->fullname)); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-money-bill-wave-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(showAmount($job->rate)); ?> <?php echo e($general->cur_sym); ?></h4>
                                        <p><?php echo app('translator')->get('You will Earn in this job'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-calendar"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?></h4>
                                        <p><?php echo app('translator')->get('Published Date'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-users"></i>
                                    </div>
                                    <div class="content">
                                        <?php echo app('translator')->get('Limit dla'); ?> <h4 class="title"><?php echo e(__($job->quantity)); ?></h4>
                                        <p><?php echo app('translator')->get('zlecenioBiorców'); ?></p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-user"></i>
                                    </div>
                                    <div class="content">
                                        <?php echo app('translator')->get('Jeszcze'); ?> <h4 class="title"><?php echo e(__($job->vacancy_available)); ?></h4>
                                        <p><?php echo app('translator')->get('Available Job Vacancy'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title"><?php echo app('translator')->get('User Information'); ?></h5>
                            <div class="info__wrapper">

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($job->averageRating(2, true)); ?></h4>
                                        <p><?php echo app('translator')->get('Average Rating'); ?></p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['jobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Jobs Posted'); ?></p>
                                    </div>
                                </div>


                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['approvedJobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Active Jobs'); ?></p>
                                    </div>
                                </div>
                               
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['completedJobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Completed Jobs'); ?></p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                    <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['pendingJobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Pending Jobs'); ?></p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['rejectedJobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Rejected Jobs'); ?></p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($userData['pauseJobsCount']); ?></h4>
                                        <p><?php echo app('translator')->get('Total Pause Jobs'); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title"><?php echo app('translator')->get('Share this Post on:'); ?></h5>
                            <ul class="social-links">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo e(__($job->title)); ?>&amp;url=<?php echo e(urlencode(url()->current())); ?>">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                                <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo e(urlencode(url()->current())); ?>&description=<?php echo e(__($job->title)); ?>&media=<?php echo e(getImage('assets/admin/images/job/' . $job->attachment)); ?>">
                                        <i class="lab la-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(urlencode(url()->current())); ?>&amp;title=<?php echo e(__($job->title)); ?>&amp;summary=dit is de linkedin summary">
                                        <i class="lab la-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<!-- maskowanie linków zahacz.eu -->  

<script type="text/javascript">
var key = "94794402e2f64e09fac5ab5c14fa7d83";
var domain = "https://link.zlecenio.eu";
var exclude = ["zlecenio.eu","link.zlecenio.eu", "zahacz.eu", "facebook.com", "pinterest.com", "twitter.com", "linkedin.com"];
</script>
<script type="text/javascript" src="https://zahacz.eu/script.js"></script>

<!-- maskowanie linków zahacz.eu -->        
        
    </section>
    <?php $__env->startPush('script'); ?>
    <script>
    (function($) {
  
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
        
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
            });
            
        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
            });
        });
        
        
        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            
            for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
            }
            
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

            $("#user_rating").val(ratingValue);

            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);
            
        });
        
        
    })(jQuery);


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);  
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
    </script>
    <?php $__env->stopPush(); ?>
    

    <style>
    /* Rating Star Widgets Style */
        .rating-stars ul {
        list-style-type:none;
        padding:0;
        
        -moz-user-select:none;
        -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
        display:inline-block;
        
        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
        font-size:2.5em; /* Change the size of the stars */
        color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
        color:#FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
        color:#FF912C;
        }

    </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/job/details.blade.php ENDPATH**/ ?>