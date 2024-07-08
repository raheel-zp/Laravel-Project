@extends($activeTemplate . 'layouts.frontend')

@section('content')

<!-- uwaga i tlumaczenie -->
<div class="container">
    <div class="job__details__wrapper">
    <center>
        <div class="styl-uwagi">
            <p><h2>{{ $user->fullname }}'s Profile</h2></p>
            <p>Email: {{ $user->email }}<br>
        </div>
    </center>
    <hr>

</div>
</div>
<section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dashboard__content contact__form__wrapper">
                        <div class="campaigns__wrapper">
                            <form class="create__campaigns__form" action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="star_rating">Star Rating:</label>
                                            <select class="form-control form-select form--control h-50 w-100 " name="rating_filter" id="rating_filter">
                                                <option {{ $ratingFilter == "" ? 'selected' : '' }} value="">Any</option>
                                                <option {{ $ratingFilter == 1 ? 'selected' : '' }} value="1">1 Star</option>
                                                <option {{ $ratingFilter == 2 ? 'selected' : '' }} value="2">2 Stars</option>
                                                <option {{ $ratingFilter == 3 ? 'selected' : '' }} value="3">3 Stars</option>
                                                <option {{ $ratingFilter == 4 ? 'selected' : '' }} value="4">4 Stars</option>
                                                <option {{ $ratingFilter == 5 ? 'selected' : '' }} value="5">5 Stars</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label>@lang('Show Rating')</label>
                                            <select class="form-control form-select form--control h-50 w-100 " name="reviews_filter" id="reviews_filter">
                                                <option {{ $reviewsFilter == "" ? 'selected' : '' }} value="">All</option>
                                                <option {{ $reviewsFilter == 1 ? 'selected' : '' }} value="1">Reviews for completed task</option>
                                                <option {{ $reviewsFilter == 2 ? 'selected' : '' }} value="2">Reviews for the added task</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               <button class="cmn--btn btn--md w-100" type="submit">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>

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
                   
                    <div class="job__details__widget">
                        <h4 class="job__details__widget-title">@lang('Rating and Reviews:')</h4>
                        @foreach ($job->proves as $prove)
                                @php
                                    $ratings = $job->getAllRatings($prove->id, 'desc'); 
                                @endphp
                                @foreach ($ratings as $review)
                                <ul>
                                    <li>{{ \App\Models\User::find($review->author_id)->fullname }}: {{ $review->body }} 
                                        <div style="float:right; text-align:right;" class="rating-stars text-center">
                                            <i data-star="{{@$review->rating}}"></i>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                        @endforeach
                    </div>
                </div>
                @endforeach

                @if ($jobs->hasPages($jobs))
                    {{ paginateLinks($jobs) }}
                @endif

                </div>

            </div>

        </div>
</section>
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
