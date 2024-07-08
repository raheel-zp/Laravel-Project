@extends($activeTemplate . 'layouts.master')
@section('panel')



<section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job__details__wrapper">
					
                        <h3 class="job__details__wrapper-title">
                            {{ __($prove->job->title) }}
                        </h3>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title">@lang('Job Description :')</h4>
                            @php
                                echo $prove->job->description;
                            @endphp
                        </div>

                        @php
                            $jobId = $prove->job->id;
                            $proveId = $prove->id;

                            $ratings = $prove->job->getAllRatings($prove->id, 'desc');
                            
                        @endphp

                        
                            <div class="job__details__widget">
                                @php
                                    $comment_form_display = true;
                                    if ($ratings && sizeof ($ratings) > 0) {
                                        foreach ( $ratings as $rating) {
                                            if ( $rating->author_id == auth()->id()) {
                                                $comment_form_display = false;
                                            }
                                        }
                                    }
                                @endphp

                                 @if ($prove->status == Status::JOB_PROVE_APPROVE || $prove->status == Status::JOB_PROVE_REJECT)
                                 
                                        @if ($comment_form_display)
                                            <form class="job__reviewed__form" action="{{ route('user.job.review.store', $prove->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group">
                                                    <label class="form-label">@lang('Rating:')</label>
                                                    <input type="hidden" id="user_rating" name="user_rating" value="{{ old('user_ratings') }}">
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
                                                <label class="form-label">@lang('Review')</label>
                                                    <textarea name="review" class="form--control w-100">{{ old('review') }}</textarea>
                                                </div>
                                                
                                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                                    @lang('Submit')
                                                </button>
                                            </form>
                                        @endif

                                    <h2>Reviews:</h2>
                                    <ul>
                                        @foreach ($ratings as $review)
                                            <li>{{ \App\Models\User::find($review->author_id)->fullname }}: {{ $review->body }} 
                                                    <div style="font-size: 8px; float:right; text-align:right;" class="rating-stars text-center">
                                                        <ul id="star-review-display">
                                                        <li class="star @if ($review->rating >= 1) selected @endif" title="Poor">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star @if ($review->rating >= 2) selected @endif" title="Fair">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star @if ($review->rating >= 3) selected @endif" title="Good">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star @if ($review->rating >= 4) selected @endif" title="Excellent">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        <li class="star @if ($review->rating >= 5) selected @endif" title="WOW!!!">
                                                            <i class="fa fa-star fa-fw"></i>
                                                        </li>
                                                        </ul>
                                                    </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                @endif
                            </div>

                    </div>
                    
                </div>

            </div>
        </div>

    </section>
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

@endsection