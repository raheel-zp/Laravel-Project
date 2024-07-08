@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card custom--card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Job posted by')
                        {{ __(@$job->user->fullname) }}
                    </h5>
                    <div class="p-3 bg--white">
                        <div class="side_Image text-center">
                            @if ($job->user->image)
                                <img src="{{ getImage(getFilePath('userProfile') . '/' . $job->user->image, getFileSize('userProfile')) }}" alt="@lang('Image')" class="b-radius--10 withdraw-detailImage">
                            @else
                                <img src="{{ getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile')) }}" alt="@lang('User')" class="w-50 h-50">
                            @endif
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Job Code')
                            <span class="fw-bold">{{ $job->job_code }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Username')
                            <span class="fw-bold">
                                <a href="{{ route('admin.users.detail', $job->user->id) }}">{{ @$job->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Quantity')
                            <span class="fw-bold">{{ __($job->quantity) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Amount')
                            <span class="fw-bold">{{ showAmount($job->rate) }} {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Total Amount')
                            <span class="fw-bold">{{ showAmount($job->total) }}  {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Status')
                            @php echo $job->statusJob; @endphp
                        </li>
                        <li class="list-group-item d-flex justify-content-between pt-2 pb-2 ">
                            @lang('Date')
                            <span class="fw-bold">{{ showDateTime($job->created_at) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 mb-30">
            <div class="card custom--card  overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('Job More Information')</h5>
                    <div class="row gy-3">
                        <div class="col-md-8">
                            <h6>@lang('Job Title')</h6>
                            <p>{{ __($job->title) }}</p>
                        </div>
                        <div class="col-md-8">
                            <h6>@lang('Job Description')</h6>
                            <p> @php echo $job->description; @endphp</p>
                        </div>
                        <div class="col-md-8">
                            <h6>@lang('Job Attachment')</h6>
                            <img src="{{ getImage(getFilePath('jobPoster') . '/' . $job->attachment, getFileSize('jobPoster')) }}" class="w-50">
                        </div>
                        @if ($job->status == Status::JOB_PENDING)
                            <div class="col-md-12">
                                <button class="btn btn-outline--success ms-1 confirmationBtn" data-question="@lang('Are you sure to approve this job?')" data-action="{{ route('admin.jobs.approve', $job->id) }}">
                                    <i class="fas la-check"></i> @lang('Approve')
                                </button>
                                <button class="btn btn-outline--danger ms-1 confirmationBtn" data-question="@lang('Are you sure to rejected this job?')" data-action="{{ route('admin.jobs.reject', $job->id) }}">
                                    <i class="fas la-times-circle"></i> @lang('Reject')
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection
