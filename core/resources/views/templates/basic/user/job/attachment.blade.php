@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="row gy-5">
        <div class="col-lg-7 col-xl-8 col-md-12">
            <div class="announcement__details">
                <h3 class="blog-title">{{ __($prove->job->title) }}</h3>
                <ul class="announcement__meta d-flex flex-wrap mt-2 mb-3 align-items-center">
                    <li><i class="far fa-calendar"></i>
                        {{ showDateTime($prove->job->created_at, 'd-m-Y H:i:s') }}
                    </li>
                </ul>
                <div class="announcement__details__content">
                    <h6 class="mb-2">@lang('Details') :</h6>
                    <p>{{ $prove->detail }}</p>
                </div>
                @if ($prove->attachment != null)
                    <div class="announcement__details__content">
                        <h6 class="my-2">@lang('Attachment :')</h6>
                        <a href="{{ route('user.job.download.attachment', encrypt($prove->id)) }}" class="mr-3 text--base"><i class="las la-file"></i>
                            @lang('Attachment')
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-12 sidebar-right theiaStickySidebar">
            <div class="widget-box post-widget attachment-widget">
                <h4 class="pro-title">@lang('Job Request')</h4>
                <ul class="latest-posts m-0">
                    <li class="flex-wrap">
                        <div class="post-thumb">
                            @if (@$prove->user->image)
                                <img src="{{ getImage(getFilePath('userProfile') . '/' . $prove->user->image, getFileSize('userProfile')) }}" alt="@lang('User')">
                            @else
                                <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}" alt="@lang('User')">
                            @endif
                        </div>
                        <div class="post-info attachment-info">
                            <h6>{{ $prove->user->username }}</h6>
                            <p>@lang('Rate :'){{ $general->cur_sym }}{{ showAmount($prove->job->rate) }}</p>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex flex-wrap w-100" style="gap:7px">
                            @if ($prove->status == Status::JOB_PROVE_PENDING)
                                <button href="javascript:void(0)" class="btn btn--base btn--sm confirmationBtn" data-action="{{ route('user.job.approve', encrypt($prove->id)) }}" data-question="@lang('Are you sure to approve job?')">
                                    <i class="las la-check"></i>
                                    @lang('Approve')
                                </button>
                                <button href="javascript:void(0)" class="btn btn--danger btn--sm confirmationBtn" data-action="{{ route('user.job.rejected', encrypt($prove->id)) }}" data-question="@lang('Are you sure to rejected this job?')">
                                    <i class="las la-times"></i>
                                    @lang('Reject')
                                </button>
                            @elseif($prove->status == Status::JOB_PROVE_APPROVE)
                                <span class="badge badge--success">@lang('Approved')</span>
                            @else
                                <span class="badge badge--danger">@lang('Rejected')</span>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            let modal = $('#confirmationModal')
            modal.find('.modal-footer').find('button').addClass('btn--sm');
            modal.find('.modal-header').find('button').replaceWith(
                '<span class="las la-times" data-bs-dismiss="modal"><span>');
        })(jQuery);
    </script>
@endpush
