@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content ">
        <br>
        <h3>Earning from Referrals Purchase of ZDB Currency</h3>
        <br>
        <table class="table custom--table">
            <thead>
                <tr>
                    <th>@lang('Date of Salary Received')</th>
                    <th class="text-center">@lang('User Name')</th>
                    <th class="text-center">@lang('Salary')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactionsPurchase as $transaction)
                    @foreach($transaction as $trans)
                    <tr>
                        <td class="transacted">
                            <div class="text--end">
                                <span class="d-block">
                                    {{ showDateTime($trans["created_at"], 'd-m-Y H:i:s') }}
                                </span>
                                {{ diffForHumans($trans["created_at"]) }}
                            </div>
                        </td>

                        <td>
                            <strong><p>{{ \App\Models\User::find($trans["user_id"])->fullname }}</p></strong>
                        </td>
                        <td>
                            <strong><p>{{ (($trans["amount"]/100) * ($currency_percentage)) }}</p></strong>
                        </td>

                    </tr>
                    @endforeach
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>
   <div class="dashboard__content ">
    <br>
    <h3>Earning from Referrals Completed Jobs</h3>
    <br>
    <table class="table custom--table">
        <thead>
            <tr>
                <th>@lang('Date of Salary Received')</th>
                <th class="text-center">@lang('User Name')</th>
                <th class="text-center">@lang('Remuneration')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactionsJob as $transaction)
                @foreach($transaction as $trans)
                <tr>
                    <td class="transacted">
                        <div class="text--end">
                            <span class="d-block">
                                {{ showDateTime($trans["created_at"], 'd-m-Y H:i:s') }}
                            </span>
                            {{ diffForHumans($trans["created_at"]) }}
                        </div>
                    </td>

                    <td>
                        <strong><p>{{ \App\Models\User::find($trans["user_id"])->fullname }}</p></strong>
                    </td>
                    <td>
                        <strong><p>{{ (($trans["amount"]/100) * ($job_percentage)) }}</p></strong>
                    </td>

                </tr>
                @endforeach
            @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    {{-- APPROVE MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group userData mb-2 list-group-flush">
                    </ul>
                    <div class="feedback"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict";

            let width = $(window).width()
            $('.detailBtn').on('click', function() {

                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
