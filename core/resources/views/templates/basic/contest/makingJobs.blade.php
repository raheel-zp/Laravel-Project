@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content ">
        @if(!empty($activeContest[0]))
        <br>
        <h3>Rules of the contest</h3>
        <br>
        <div style="width:100%;">
        <p>{{$activeContest[0]["rules"]}}</p>
        </div>

        <div style="width:100%;float:left;">
            <div style="float:left;"><img src="{{ asset('assets/images/contest/cupImage.png') }}" width="72"></div>
            <div style="float:left; text-align:center;margin-left:10px;padding:20px;"><h5>Your are at # {{ $userPosition }}</h5></div>
        </div>

        <div style="width:100%;float:left;">
        <h3>Leader Board for Contest</h3>
        </div>
        <br>
        <table class="table custom--table">
            <thead>
                <tr>
                    <th>@lang('User Name')</th>
                    <th class="text-center">@lang('Accepted Jobs')</th>
                    <th class="text-center">@lang('Position')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaderBoard as $leader)
                    <tr>
                        <td>
                            <strong><p>{{ \App\Models\User::find($leader["user_id"])->fullname }}</p></strong>
                        </td>
                        <td class="transacted">
                            <div class="text--end">
                                <span class="d-block">
                                    {{ $leader["jobsDone"] }}
                                </span>
                            </div>
                        </td>


                        <td>
                            <strong><p>{{ $leader["Position"] }}</p></strong>
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
        @else
        <div style="width:100%;float:left;">
            <h3>No Active Contest Available</h3>
        </div>
        @endif

    </div>
   <div class="dashboard__content ">
    <br>
    <h3>Previous Months Winners</h3>
    <br>
    <table class="table custom--table">
        <thead>
            <tr>
                <th>@lang('Month')</th>
                <th class="text-center">@lang('User Name')</th>
                <th class="text-center">@lang('Prize Won')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contestHistory as $contest)
                <tr>
                    <td class="transacted">
                        <div class="text--end">
                            <span class="d-block">
                                {{ $contest["Month"] }}
                            </span>
                        </div>
                    </td>

                    <td>
                        <strong><p>{{ \App\Models\User::find($contest["user_id"])->fullname }}</p></strong>
                    </td>
                    <td>
                        <strong><p>{{ $contest["Prize"] }}</p></strong>
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
