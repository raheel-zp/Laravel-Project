@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content  ">
        <div class="text-end">
            <a href="{{ route('ticket.open') }}" class="btn btn--sm btn--base mb-2"> <i class="fa fa-plus"></i>
                @lang('New Ticket')</a>
        </div>
        <div class="table-responsive">
            <table class="table custom--table">
                <thead>
                    <tr>
                        <th>@lang('Subject')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Priority')</th>
                        <th>@lang('Last Reply')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supports as $support)
                        <tr>
                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold">
                                    [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a>
                            </td>
                            <td>
                                @php echo $support->statusBadge; @endphp
                            </td>
                            <td>
                                @if ($support->priority == Status::PRIORITY_LOW)
                                    <span class="badge badge--dark">@lang('Low')</span>
                                @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                    <span class="badge  badge--warning">@lang('Medium')</span>
                                @elseif($support->priority == Status::PRIORITY_HIGH)
                                    <span class="badge badge--danger">@lang('High')</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <span class="d-block">{{ showDateTime($support->last_reply, 'd-m-Y H:i:s') }}</span>
                                    <span>{{ diffForHumans($support->last_reply)}}</span>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn--base btn--sm">
                                    <i class="fa fa-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $supports->links() }}

    </div>
@endsection
