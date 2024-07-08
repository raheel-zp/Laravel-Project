@extends($activeTemplate . 'layouts.master')
@section('panel')

<div class="row">
                <div class="col-lg-12">
                    @foreach($jobs as $job)
                    <div class="job__details__widget">

                        <div class="job__header me-3">
                            <h5 class="job__header-title">
                                <a href="{{ route('job.details', [$job->id, slug($job->title)]) }}">
                                    {{ __($job->title) }}
                                </a>
                            </h5>
                            <p class="job-post-date">
                                {{ showDateTime($job->created_at, 'd-m-Y H:i:s') }}
                            </p>
                            <h3 class="job__price d-inline-block">
                                <sub>{{ $general->cur_sym }}</sub>
                                {{ showAmount($job->rate) }}
                            </h3>
                        </div>
                        <div class="icon">
                            <img src="{{ getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster')) }}" alt="@lang('freelancer')" class="img-fluid">
                        </div>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title">@lang('Rating and Reviews:')</h4>
                            @foreach ($job->proves as $prove)
                                @php 
                                   $ratings = $job->getAllRatings($prove->id, 'desc'); 
                                @endphp

                                @foreach ($ratings as $review)
                                    @if ($review->author_id != auth()->id())
                                    <ul>
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
                                    </ul>
                                    @endif
                                @endforeach

                            @endforeach
                        </div>
                    </div>
                    
                    @endforeach
                </div>
                @if ($jobs->hasPages($jobs))
                    {{ paginateLinks($jobs) }}
                @endif

            </div>

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
