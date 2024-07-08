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
                                    <th>@lang('Dispute ID')</th>
                                    <th>@lang('Disputer Name')</th>
                                    <th>@lang('Job Poster Name')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($disputes as $dispute)
                                    <tr>
                                        <td> <strong>{{ __($dispute->id) }}</strong></td>
                                        <td>
                                            <span class="fw-bold">{{ \App\Models\User::find($dispute->disputer_id)->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $dispute->disputer_id) }}"><span>@</span>{{ \App\Models\User::find($dispute["disputer_id"])->fullname }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ \App\Models\User::find($dispute->job_poster_id)->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $dispute->job_poster_id) }}"><span>@</span>{{ \App\Models\User::find($dispute["job_poster_id"])->fullname }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-block"> {{ showDateTime($dispute->created_at) }}</span>
                                            {{ diffForHumans($dispute->created_at) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                <a href="{{ route('admin.disputes.details', $dispute->id) }}" class="btn btn-sm btn-outline--success">
                                                    <i class="las la-eye "></i>@lang('view')
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
                @if ($disputes->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($disputes) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Seach here..." />
@endpush
