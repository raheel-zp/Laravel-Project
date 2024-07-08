@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content">
        <div class="finished__jobs__wrapper">
            <div class="finished__jobs__header d-flex flex-wrap justify-content-between align-items-center mb-2">
                <h4 class="pe-4 mb-2">
                    @lang('Job ID :') {{ __($job->job_code) }}
                </h4>
                <h4 class="pe-4 mb-2">
                    @lang('Budget :') {{ $general->cur_sym }}{{ showAmount($job->total) }}
                </h4>
                <h4 class="pe-4 mb-2">
                    {{--@lang('Workers :') {{ __($job->workers) }}--}}
                </h4>
                <a href="{{ route('user.job.history') }}" class="btn btn--sm btn--base mb-2">
                    @lang('Go Back')
                </a>
            </div>
            @forelse ($job->proves->sortByDesc('created_at') as $prove)
                <div class="finished__job__item ">
                    <div class="row w-100 justify-content-between g-0 gy-3">
                        <div class="col-md-6 col-lg-12 col-xl-6">
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
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class=" job__body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="employer__wrapper d-inline-flex flex-wrap align-items-center">
                                    <div class="employer__thumb me-3">
                                        @if (@$prove->user->image)
                                            <img src="{{ getImage(getFilePath('userProfile') . '/' . $prove->user->image, getFileSize('userProfile')) }}" alt="@lang('User')">
                                        @else
                                            <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}" alt="@lang('User')">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h6 class="employer__name">{{ $prove->user->username }}</h6>
                                        <p>
                                        @php
                                            $ratings = $job->getAllRatings($prove->id, 'desc');
                                            $dispute = App\Models\Dispute::where('job_prove_id', $prove->id)->get()->toArray();
                                        @endphp

                                        @foreach ($ratings as $review)
                                            @if ($review->author_id == auth()->id())
                                                <div style="font-size: 8px;" class="rating-stars text-center">
                                                    <ul id="stars">
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
                                                
                                            @endif
                                        @endforeach
                                        <a href="{{ route('profile.details', [$prove->user_id, slug($prove->user->username)]) }}">@lang('(Read reviews)')</a>
                                        
                                        </p>
                                        @if ($prove->status == Status::JOB_PROVE_PENDING)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($prove->status == Status::JOB_PROVE_APPROVE)
                                            <span class="badge badge--success">@lang('Approved')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                            @if (isset($dispute[0]["job_prove_id"]))
                                                <a href="{{ route('dispute.index', $prove->id) }}" class="cmn--btn btn--sm"><span class="invoice-id">@lang('Dispute')</span></a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="job__footer">
                                    <a href="{{ route('user.job.attachment', encrypt($prove->id)) }}" class="cmn--btn btn--sm">@lang('Detail')</a>
                                    @if ($prove->status == Status::JOB_PROVE_APPROVE || $prove->status == Status::JOB_PROVE_REJECT)
                                    <a href="{{ route('user.job.rating', encrypt($prove->id)) }}" class="cmn--btn btn--sm">@lang('Rate') {{ $prove->user->username }}</a>
                                    @endif
                                    <p class="take-on">@lang('Project take on')</p>
                                    <p class="take-on-date">{{ showDateTime($prove->created_at, 'd-m-Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="finished__job__item">
                    <div class="row w-100 justify-content-between g-0 gy-3">
                        <h3 class="text--base text-center">{{ __($emptyMessage) }}</h3>
                    </div>
                </div>
            @endforelse
        </div>
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
