@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Job')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Total')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Hidden')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                    <tr>
                                        <td> <strong>{{ __($job->job_code) }}</strong> <br> {{ strLimit($job->title,50) }}</td>
                                        <td>
                                            <span class="fw-bold">{{ @$job->user->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $job->user_id) }}"><span>@</span>{{ @$job->user->username }}</a>
                                            </span>
                                        </td>
                                        <td> {{ $job->category->name }}</td>
                                        <td> {{ $job->quantity }}</td>
                                        <td>{{ $general->cur_sym }}{{ showAmount($job->rate) }}</td>
                                        <td>{{ $general->cur_sym }}{{ showAmount($job->total) }}</td>
                                        <td> @php echo $job->statusJob; @endphp </td>
                                        <td> @php echo $job->hiddenJob; @endphp </td>
                                        <td>
                                            <span class="d-block"> {{ showDateTime($job->created_at) }}</span>
                                            {{ diffForHumans($job->created_at) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                <a href="{{ route('admin.jobs.view', $job->id) }}" class="btn btn-sm btn-outline--success">
                                                    <i class="las la-eye "></i>@lang('view')
                                                </a>
                                                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-outline--success">
                                                <i class="las la-edit "></i>@lang('Edit')
                                                </a>
                                                <a href="{{ route('admin.jobs.details', $job->id) }}" class="btn btn-sm btn-outline--primary">
                                                    <i class="las la-desktop"></i>@lang('Details')
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($jobs->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($jobs) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Seach here..." />
@endpush
