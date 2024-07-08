@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content ">
        <form action="" class="mb-3">
            <div class="d-flex flex-wrap gap-4">
                <div class="flex-grow-1">
                    <label>@lang('Transaction Number')</label>
                    <input type="text" name="search" value="{{ request()->search }}" class="form-control form--control">
                </div>
                <div class="flex-grow-1">
                    <label>@lang('Type')</label>
                    <select name="trx_type" class="form-select form--control">
                        <option value="">@lang('All')</option>
                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label>@lang('Remark')</label>
                    <select class="form-select form--control" name="remark">
                        <option value="">@lang('Any')</option>
                        @foreach ($remarks as $remark)
                            <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                {{ __(keyToTitle($remark->remark)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-grow-1 align-self-end">
                    <button class="btn btn--base  w-100"><i class="las la-filter"></i>
                        @lang('Filter')
                    </button>
                </div>
            </div>
        </form>

        <table class="table transection__table">
            <thead>
                <tr>
                    <th>@lang('Trx')</th>
                    <th>@lang('Transacted')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Post Balance')</th>
                    <th>@lang('Detail')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                    <tr>
                        <td>
                            <strong>{{ $trx->trx }}</strong>
                        </td>

                        <td class="transacted">
                            <div class="text--end">
                                <span class="d-block">
									{{ showDateTime($trx->created_at, 'd-m-Y H:i:s') }}
                                </span>
                                {{ diffForHumans($trx->created_at) }}
                            </div>
                        </td>

                        <td class="budget">
                            <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                {{ $general->cur_text }}
                            </span>
                        </td>
                        <td class="budget">
                            {{ showAmount($trx->post_balance) }} {{ __($general->cur_text) }}
                        </td>
                        <td>
                            <div class="text--end">
                                {{ $trx->details }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        @if ($transactions->hasPages())
            <div class="justify-content-center">
                {{ $transactions->links() }}
            </div>
        @endif

    </div>
@endsection

@push('style')
    <style>
        .break_line {
            white-space: initial !important;
        }
    </style>
@endpush
