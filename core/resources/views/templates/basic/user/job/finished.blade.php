@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content ">
        <table class="table transection__table">
            <thead>
                <tr>
                    <th>@lang('Job Code')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Rate')</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as  $job)
                    @php
                        $ratings = $job->job->getAllRatings($job->id, 'desc');

                        //print_r($job->job->id);

                        $comment_form_display = true;
                        if ($ratings && sizeof ($ratings) > 0) {
                            foreach ( $ratings as $rating) {
                                if ( $rating->author_id == @$job->job->user_id) {
                                    $comment_form_display = false;
                                }
                            }
                        }
                    @endphp
                    <tr>
                        <td>
                            <span class="invoice-id">{{ __(@$job->job->job_code) }}</span>
                        </td>
                        <td>
                            <span class="amount">
                                {{ $general->cur_sym }}{{ showAmount(@$job->job->rate) }}
                            </span>
                        </td>
                        <td>
                            @if ($job->status == Status::JOB_PROVE_PENDING)
                                <span class="badge badge--warning">@lang('Pending')</span>
                            @elseif($job->status == Status::JOB_PROVE_APPROVE)
                                <span class="badge badge--success">@lang('Approved')</span>
                            @else
                                <span class="badge badge--danger">@lang('Rejected')</span>
                                <a href="{{ route('dispute.index', $job->id) }}" class="cmn--btn btn--sm"><span class="invoice-id">@lang('Dispute')</span></a>
                            @endif
                        </td>
                        <td>
                            <span class="time">{{ showDateTime($job->created_at, 'd-m-Y H:i:s') }}</span>
                        </td>
                        <td>
                            @if ($comment_form_display == true)
                            <a href="{{ route('user.job.rating', encrypt($job->id)) }}" class="cmn--btn btn--sm"><span class="invoice-id">@lang('Add')</span></a>
                            @else
                            <a href="{{ route('user.job.rating', encrypt($job->id)) }}" class="cmn--btn btn--sm"><span class="invoice-id">@lang('Reply')</span></a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="justify-content-center text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($jobs->hasPages($jobs))
        {{ paginateLinks($jobs) }}
    @endif
@endsection
