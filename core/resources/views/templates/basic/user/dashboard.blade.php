@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content">
        @php $kyc = getContent('kyc_content.content', true); @endphp
        @if (auth()->user()->kv == 0)
            <div class="alert alert-danger mb-3" role="alert">
                <h6 class="text--danger">@lang('KYC Verification')</h6>
                <p class="py-2">
                    {{ __(@$kyc->data_values->pending_content) }}
                    <a href="{{ route('user.kyc.form') }}" class="text--base">@lang('Click here to verify')</a>
                </p>
            </div>
        @endif
        @if (auth()->user()->kv == 2)
            <div class="alert alert-warning mb-3" role="alert">
                <h6 class="alert-heading text--dark">@lang('KYC Verification Pending')</h6>
                <p class="py-2">
                    {{ __(@$kyc->data_values->pending_content) }}
                    <a href="{{ route('user.kyc.data') }}" class="text--base">@lang('See KYC Data')</a>
                </p>
            </div>
        @endif
        @include($activeTemplate . 'partials.user_history')
        <div class="job__completed card custom--card contact__form__wrapper">
            <div class="job__completed-header d-flex align-items-center justify-content-between">
                <h5>@lang('Jobs Completed')</h5>
            </div>
            <div class="job__completed-body">
                <div id="chartprofile"></div>
            </div>
        </div>
        <div class="finished__jobs__wrapper mt-5">
            <div class="finished__jobs__header d-flex flex-wrap justify-content-between align-items-center mb-2">
                <h4 class="pe-4 mb-2">@lang('Recent Earnings Jobs')</h4>
                <a href="{{ route('user.job.finished') }}" class="btn btn--sm btn--base mb-2">@lang('View All')</a>
            </div>
            <table class="table transection__table">
                <thead>
                    <tr>
                        <th>@lang('Job Code')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Date')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>
                                <span class="invoice-id">{{ $job->job->job_code }}</span>
                            </td>
                            <td>
                                <span class="amount">
                                    {{ $general->cur_sym }}{{ showAmount($job->job->rate) }}
                                </span>
                            </td>
                            <td>
                                @if ($job->status == Status::JOB_PROVE_PENDING)
                                    <span class="badge badge--warning">@lang('Pending')</span>
                                @elseif($job->status == Status::JOB_PROVE_APPROVE)
                                    <span class="badge badge--success">@lang('Approved')</span>
                                @else
                                    <span class="badge badge--danger">@lang('Rejected')</span>
                                @endif
                            </td>
                            <td>
                                <span class="time">{{ showDateTime($job->created_at, 'd-m-Y H:i:s') }}</span>
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
    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/global/js/apexcharts.min.js') }}"></script>
@endpush
@push('script')
    <script>
        $(document).ready(function() {
            var color = "{{ $general->base_color }}";
            var options = {
                series: [{
                    name: "Jobs Completed",
                    data: [
                        @foreach ($jobArr as $job)
                            @json($job['count']),
                        @endforeach
                    ]
                }],
                chart: {
                    height: 360,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: true,

                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#" + color],
                stroke: {
                    curve: 'straight',
                    width: [1]
                },
                markers: {
                    size: 5,
                    colors: ["#" + color],
                    strokeColors: "#" + color,
                    strokeWidth: 1,
                    hover: {
                        size: 6,
                    }
                },
                grid: {
                    position: 'front',
                    borderColor: '#ddd',
                    strokeDashArray: 7,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                xaxis: {
                    categories: [
                        @foreach ($jobArr as $job)
                            @json($job['month']),
                        @endforeach
                    ],
                    lines: {
                        show: true,
                    }
                },
                yaxis: {
                    lines: {
                        show: true,
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartprofile"), options);
            chart.render();

        });
    </script>
@endpush
