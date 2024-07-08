@extends($activeTemplate . 'layouts.frontend')

@section('content')

<!-- uwaga i tlumaczenie -->
<div class="container">
    <div class="job__details__wrapper">
<center>
	<div class="styl-uwagi">
		<p><h2>@lang('UWAGA !!!')</h2></p>
		<p>@lang('Zlecenie można wykonać tylko jeden raz.')<br>
			@lang('Jeśli zlecenie zostanie odrzucone, ponownie go nie wykonasz.')</p><hr>
		<p><b>@lang('Przeczytaj uważnie treść zlecenia.')</b></p><hr>
		<p>@lang('Jeśli zlecenioDawca odrzuci zlecenie, a Ty uważasz, że wykonano go prawidłowo skontaktuj się z nami.')</p>
	</div>
</center>	 


<hr><center>
  <div class="form-group">
  <label><h3>@lang('Przetłumacz szczegóły zlecenia na Twój język')</h3></label>


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
                            {{ __($job->title) }}
                        </h3>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title">@lang('Job Description :')</h4>
                            @php
                                echo $job->description;
                            @endphp
                        </div>

                        @php
                            $ratings = $job->getAllRatings($job->id, 'desc');
                        @endphp

                        @if (@$job->proves->where('user_id', auth()->id())->count() < 1)
                            @if ($job->user_id != auth()->id())
                                <div class="job__details__widget">
                                    <h4 class="job__details__widget-title">
                                        @lang('Enter The Required Proof Of Job Finished:')
                                    </h4>
                                    <form class="job__finished__form" action="{{ route('user.job.prove', $job->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <textarea name="detail" class="form--control w-100">{{ old('detail') }}</textarea>
                                        </div>
                                        @if ($job->job_proof == 2)
                                            <div class="input-group mt-3">
                                                <input type="file" name="attachment" class="form-control form--control w-100" @required($job->job_proof == 2)>
                                                <span class="info fs--14 mt-2">
                                                    @lang('Allowed File Extensions:') {{ __($job->file_name) }}
                                                </span>
                                            </div>
                                        @endif
                                        <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                            @lang('Request for Complete')
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div class="job__details__widget">
                                <h4 class="job__details__widget-title text-center text--base">
                                    @lang('You are already submitted job prove please wait until review complete')
                                </h4>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Komentarz -->
                    <center>
                    <hr> <b>@lang('Podziel się opinią na temat zlecenioDawcy:') {{ __(@$job->user->fullname) }}</b> <hr><br>
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
                            <h5 class="sidebar__widget-title">@lang('Job Information')</h5>
                            <div class="info__wrapper">
                                <div class="info__item">
                                    <div class="icon">
                                        <img src="{{ getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster')) }}" alt="@lang('freelancer')" class="img-fluid">
                                    </div>
                                    <div class="content">
                                        <h6 class="title">@lang('Job ID :') {{ __(@$job->job_code) }}</h6>
                                        <p>@lang('Job posted by') {{ __(@$job->user->fullname) }}</p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-money-bill-wave-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ showAmount($job->rate) }} {{ $general->cur_sym }}</h4>
                                        <p>@lang('You will Earn in this job')</p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-calendar"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ showDateTime($job->created_at, 'd-m-Y H:i:s') }}</h4>
                                        <p>@lang('Published Date')</p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-users"></i>
                                    </div>
                                    <div class="content">
                                        @lang('Limit dla') <h4 class="title">{{ __($job->quantity) }}</h4>
                                        <p>@lang('zlecenioBiorców')</p>
                                    </div>
                                </div>
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-user"></i>
                                    </div>
                                    <div class="content">
                                        @lang('Jeszcze') <h4 class="title">{{ __($job->vacancy_available) }}</h4>
                                        <p>@lang('Available Job Vacancy')</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title">@lang('User Information')</h5>
                            <div class="info__wrapper">

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><i data-star="{{ @$job->averageRating(2, true) }}"></i> <a href="{{ route('profile.details', [$job->user_id, slug($job->user->fullname)]) }}">@lang('(Read reviews)')</a></h4>
                                        
                                        <p>@lang('Average Rating')</p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['jobsCount'] }}</h4>
                                        <p>@lang('Total Jobs Posted')</p>
                                    </div>
                                </div>


                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['approvedJobsCount'] }}</h4>
                                        <p>@lang('Total Active Jobs')</p>
                                    </div>
                                </div>
                               
                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['completedJobsCount'] }}</h4>
                                        <p>@lang('Total Completed Jobs')</p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                    <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['pendingJobsCount'] }}</h4>
                                        <p>@lang('Total Pending Jobs')</p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['rejectedJobsCount'] }}</h4>
                                        <p>@lang('Total Rejected Jobs')</p>
                                    </div>
                                </div>

                                <div class="info__item">
                                    <div class="icon">
                                        <i class="las la-vihara la-ban"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $userData['pauseJobsCount'] }}</h4>
                                        <p>@lang('Total Pause Jobs')</p>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="sidebar__widget">
                            <h5 class="sidebar__widget-title">@lang('Share this Post on:')</h5>
                            <ul class="social-links">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?text={{ __($job->title) }}&amp;url={{ urlencode(url()->current()) }}">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                                <li><a href="http://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __($job->title) }}&media={{ getImage('assets/admin/images/job/' . $job->attachment) }}">
                                        <i class="lab la-pinterest-p"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __($job->title) }}&amp;summary=dit is de linkedin summary">
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
    @push('script')
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
    @endpush
    
@endsection

@push('style')
<style>
/* START FROM HERE */

[data-star] {
  text-align:left;
  font-style:normal;
  display:inline-block;
  position: relative;
  unicode-bidi: bidi-override;
}
[data-star]::before { 
  display:block;
  content: '★★★★★';
  color: #eee;
}
[data-star]::after {
  white-space:nowrap;
  position:absolute;
  top:0;
  left:0;
  content: '★★★★★';
  width: 0;
  color: #ff8c00;
  overflow:hidden;
  height:100%;
}

[data-star^="0.1"]::after{width:2%}
[data-star^="0.2"]::after{width:4%}
[data-star^="0.3"]::after{width:6%}
[data-star^="0.4"]::after{width:8%}
[data-star^="0.5"]::after{width:10%}
[data-star^="0.6"]::after{width:12%}
[data-star^="0.7"]::after{width:14%}
[data-star^="0.8"]::after{width:16%}
[data-star^="0.9"]::after{width:18%}
[data-star^="1"]::after{width:20%}
[data-star^="1.1"]::after{width:22%}
[data-star^="1.2"]::after{width:24%}
[data-star^="1.3"]::after{width:26%}
[data-star^="1.4"]::after{width:28%}
[data-star^="1.5"]::after{width:30%}
[data-star^="1.6"]::after{width:32%}
[data-star^="1.7"]::after{width:34%}
[data-star^="1.8"]::after{width:36%}
[data-star^="1.9"]::after{width:38%}
[data-star^="2"]::after{width:40%}
[data-star^="2.1"]::after{width:42%}
[data-star^="2.2"]::after{width:44%}
[data-star^="2.3"]::after{width:46%}
[data-star^="2.4"]::after{width:48%}
[data-star^="2.5"]::after{width:50%}
[data-star^="2.6"]::after{width:52%}
[data-star^="2.7"]::after{width:54%}
[data-star^="2.8"]::after{width:56%}
[data-star^="2.9"]::after{width:58%}
[data-star^="3"]::after{width:60%}
[data-star^="3.1"]::after{width:62%}
[data-star^="3.2"]::after{width:64%}
[data-star^="3.3"]::after{width:66%}
[data-star^="3.4"]::after{width:68%}
[data-star^="3.5"]::after{width:70%}
[data-star^="3.6"]::after{width:72%}
[data-star^="3.7"]::after{width:74%}
[data-star^="3.8"]::after{width:76%}
[data-star^="3.9"]::after{width:78%}
[data-star^="4"]::after{width:80%}
[data-star^="4.1"]::after{width:82%}
[data-star^="4.2"]::after{width:84%}
[data-star^="4.3"]::after{width:86%}
[data-star^="4.4"]::after{width:88%}
[data-star^="4.5"]::after{width:90%}
[data-star^="4.6"]::after{width:92%}
[data-star^="4.7"]::after{width:94%}
[data-star^="4.8"]::after{width:96%}
[data-star^="4.9"]::after{width:98%}
[data-star^="5"]::after{width:100%}
</style>
@endpush
