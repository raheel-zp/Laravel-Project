@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="campaigns__wrapper">
        <div class="row">
                <div class="col-md-12">
                    <div class="card custom--card contact__form__wrapper">
                        <div class="card-header">
                            <h5 class="card-title">
                                @lang('Referral Link')
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">
                                @lang('Use the referral link to send to users and get reward on that.')
                            </h6>
                            <div class="form-group">
                                <label class="form-label">@lang('Link')</label>
                                <div class="input-group">
                                    <input type="text" name="key" value="{{$refLink}}"
                                        class="form-control form--control referralURL" readonly id="oldkey">
                                    <button type="button" class="input-group-text bg--base border-0 text--white copytext"
                                        id="copyBoard">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                                <form id="updateForm">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        @if($oldReferralCode =='')
                                        <label class="form-label">@lang('Change Referral Link') <span id="msg"></span></label>
                                        <div class="input-group">
                                            <input type="text" name="referral_code" id="referral_code" value="{{$referralCode}}"
                                                class="form-control form--control changeReferralURL">
                                            <button type="button" class="input-group-text bg--base border-0 text--white"
                                                id="changeReferralLink">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </div>
                                        @else
                                        <label class="form-label">@lang('You have already changed Referral Link Once from') {{$oldReferralCode}} @lang('to') {{$referralCode}}</label>
                                        @endif
                                    </div>
                                </form>

                            <label><i class="fa fa-info-circle"></i> <a href="https://zlecenio.eu/policy/zasady-i-regulamin-dla-polecajacych/121">@lang('Help')</a></label>

                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="dashboard__content ">

        <table class="table transection__table">
            <thead>
                <tr>
                    <th>@lang('Date of registration')</th>
                    <th>@lang('Full Name')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Reference Site')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($referrals as $referral)
                    <tr>
                        <td class="transacted">
                            <div class="text--end">
                                <span class="d-block">
									{{ showDateTime($referral->created_at, 'd-m-Y H:i:s') }}
                                </span>
                                {{ diffForHumans($referral->created_at) }}
                            </div>
                        </td>

                        <td>
                            <strong><p>{{ \App\Models\User::find($referral->user_id)->fullname }}</p></strong>
                        </td>
                        <td>
                            <strong><p>{{ \App\Models\User::find($referral->user_id)->status }}</p></strong>
                        </td>
                        <td>
                            <strong>{{ $referral->http_referrer }}</strong>
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
@endsection
@push('style')
    <style>
      .copied::after {
        background-color: #{{ $general->base_color }};
    }
    </style>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $('#copyBoard').click(function(){
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });

             $('#changeReferralLink').click(function(e){
                e.preventDefault();

                var referral_code = $('#referral_code').val();

                $.ajax({
                    url: '/update-reference-link',
                    method: 'POST',
                    data: {
                        referral_code: referral_code,
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response){
                        if(response.success){
                            $('#msg').removeClass('alert alert-danger');
                            $('#msg').addClass('alert alert-success');
                            $('#msg').html(response.message);
                            $('#oldkey').val(window.location.origin+'/affiliation/'+referral_code);
                        }
                        else{
                            $('#msg').removeClass('alert alert-success');
                            $('#msg').addClass('alert alert-danger');
                            $('#msg').html(response.message);
                        }
                    }
                });
            });

        })(jQuery);
    </script>
@endpush

