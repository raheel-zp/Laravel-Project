@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-12">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.report.transaction') }}?user_id={{ $user->id }}"
                        icon="las la-money-bill-wave-alt f-size--56" title="Balance"
                        value="{{ $general->cur_sym }}{{ showAmount($user->balance) }}" bg="primary" />
                </div>
                <!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.deposit.list') }}?user_id={{ $user->id }}"
                        icon="las la-wallet f-size--56" title="Deposits"
                        value="{{ $general->cur_sym }}{{ showAmount($totalDeposit) }}" bg="19" />
                </div>
                <!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.withdraw.log') }}?user_id={{ $user->id }}"
                        icon="las la-university f-size--56" title="Withdrawals"
                        value="{{ $general->cur_sym }}{{ showAmount($totalWithdrawals) }}" bg="green" />
                </div>
                <!-- dashboard-w1 end -->

                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.report.transaction') }}?user_id={{ $user->id }}"
                        icon="las la-exchange-alt f-size--56" title="Transactions" value="{{ $totalTransaction }}"
                        bg="17" />
                </div>
                <!-- dashboard-w1 end -->

            </div>
            <div class="row gy-4 mt-2">
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.jobs.index') }}?user_id={{ $user->id }}"
                        icon="las la-briefcase f-size--56" title="Total Jobs" value="{{ $job['total_job'] }}"
                        bg="19" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.jobs.pending') }}?user_id={{ $user->id }}"
                        icon="las la-spinner f-size--56" title="Pending Jobs" value="{{ $job['pending_job'] }}"
                        bg="warning" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.jobs.complete') }}?user_id={{ $user->id }}"
                        icon="las la-check-circle f-size--56" title="Completed Jobs" value="{{ $job['complete_job'] }}"
                        bg="green" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="3" link="{{ route('admin.jobs.rejected') }}?user_id={{ $user->id }}"
                        icon="las la-ban f-size--56" title="Rejected Jobs" value="{{ $job['cancel_job'] }}"
                        bg="16" />
                </div><!-- dashboard-w1 end -->
            </div><!-- row end-->
            <div class="row gy-4 mt-2">
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="2" link="{{ route('admin.jobs.index') }}?user_id={{ $user->id }}"
                        icon_style="false" icon="las la-file-invoice-dollar" title="Total Jobs Amount"
                        value="{{ $general->cur_sym }}{{ showAmount($job['total_job_amount']) }}" color="primary" />

                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="2" link="{{ route('admin.jobs.pending') }}?user_id={{ $user->id }}"
                        icon_style="false" icon="fas fa-spinner" title="Pending Jobs Amount"
                        value="{{ $general->cur_sym }}{{ showAmount($job['pending_job_amount']) }}" color="warning" />

                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="2" link="{{ route('admin.jobs.complete') }}?user_id={{ $user->id }}"
                        icon_style="false" icon="las la-check-double" title="Completed Jobs Amount"
                        value="{{ $general->cur_sym }}{{ showAmount($job['complete_job_amount']) }}" color="success" />

                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-3 col-sm-6">
                    <x-widget style="2" link="{{ route('admin.jobs.rejected') }}?user_id={{ $user->id }}"
                        icon_style="false" icon="las la-ban" title="Rejected Jobs Amount"
                        value="{{ $general->cur_sym }}{{ showAmount($job['cancel_job_amount']) }}" color="danger" />
                </div><!-- dashboard-w1 end -->
            </div><!-- row end-->

            <div class="d-flex flex-wrap gap-3 mt-4">
                <div class="flex-fill">
                    <button data-bs-toggle="modal" data-bs-target="#addSubModal"
                        class="btn btn--success btn--shadow w-100 btn-lg bal-btn" data-act="add">
                        <i class="las la-plus-circle"></i> @lang('Balance')
                    </button>
                </div>

                <div class="flex-fill">
                    <button data-bs-toggle="modal" data-bs-target="#addSubModal"
                        class="btn btn--danger btn--shadow w-100 btn-lg bal-btn" data-act="sub">
                        <i class="las la-minus-circle"></i> @lang('Balance')
                    </button>
                </div>

                <div class="flex-fill">
                    <a href="{{ route('admin.report.login.history') }}?search={{ $user->username }}"
                        class="btn btn--primary btn--shadow w-100 btn-lg">
                        <i class="las la-list-alt"></i>@lang('Logins')
                    </a>
                </div>

                <div class="flex-fill">
                    <a href="{{ route('admin.users.notification.log', $user->id) }}"
                        class="btn btn--secondary btn--shadow w-100 btn-lg">
                        <i class="las la-bell"></i>@lang('Notifications')
                    </a>
                </div>

                <div class="flex-fill">
                    <a href="{{ route('admin.users.login', $user->id) }}" target="_blank"
                        class="btn btn--primary btn--gradi btn--shadow w-100 btn-lg">
                        <i class="las la-sign-in-alt"></i>@lang('Login as User')
                    </a>
                </div>


                <div class="flex-fill">
                    @if ($user->status == Status::USER_ACTIVE)
                        <button type="button" class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-ban"></i>@lang('Ban User')
                        </button>
                    @else
                        <button type="button" class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-undo"></i>@lang('Unban User')
                        </button>
                    @endif
                </div>

                <div class="flex-fill">
                    @if ($user->block_status == 0 || $user->block_status == "")
                        <button type="button" class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userBlockStatus"
                            data-bs-toggle="modal" data-bs-target="#userBlockStatusModal">
                            <i class="las la-ban"></i>@lang('Block User')
                        </button>
                    @else
                        <button type="button" class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userBlockStatus"
                            data-bs-toggle="modal" data-bs-target="#userBlockStatusModal">
                            <i class="las la-undo"></i>@lang('Unblock User')
                        </button>
                    @endif
                </div>

                <div class="flex-fill">
                    @if ($user->block_execution_status == 0 || $user->block_execution_status == "")
                        <button type="button" class="btn btn--warning btn--gradi btn--shadow w-100 btn-lg userBlockExecutionStatus"
                            data-bs-toggle="modal" data-bs-target="#userBlockExecutionStatusModal">
                            <i class="las la-ban"></i>@lang('Block user execution of tasks.')
                        </button>
                    @else
                        <button type="button" class="btn btn--success btn--gradi btn--shadow w-100 btn-lg userBlockExecutionStatus"
                            data-bs-toggle="modal" data-bs-target="#userBlockExecutionStatusModal">
                            <i class="las la-undo"></i>@lang('Unblock user execution of tasks.')
                        </button>
                    @endif
                </div>

                

                @if($user->kyc_data)
                <div class="flex-fill">
                    <a href="{{ route('admin.users.kyc.details', $user->id) }}" target="_blank" class="btn btn--dark btn--shadow w-100 btn-lg">
                        <i class="las la-user-check"></i>@lang('KYC Data')
                    </a>
                </div>
                @endif
            </div>


            <div class="card mt-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('Information of') {{ $user->fullname }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('First Name')</label>
                                    <input class="form-control" type="text" name="firstname" required
                                        value="{{ $user->firstname }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">@lang('Last Name')</label>
                                    <input class="form-control" type="text" name="lastname" required
                                        value="{{ $user->lastname }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Email') </label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Mobile Number') </label>
                                    <div class="input-group ">
                                        <span class="input-group-text mobile-code"></span>
                                        <input type="number" name="mobile" value="{{ old('mobile') }}" id="mobile"
                                            class="form-control checkUser" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>@lang('Address')</label>
                                    <input class="form-control" type="text" name="address"
                                        value="{{ @$user->address->address }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label>@lang('City')</label>
                                    <input class="form-control" type="text" name="city"
                                        value="{{ @$user->address->city }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('State')</label>
                                    <input class="form-control" type="text" name="state"
                                        value="{{ @$user->address->state }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Zip/Postal')</label>
                                    <input class="form-control" type="text" name="zip"
                                        value="{{ @$user->address->zip }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Country')</label>
                                    <select name="country" class="form-control">
                                        @foreach ($countries as $key => $country)
                                            <option data-mobile_code="{{ $country->dial_code }}"
                                                value="{{ $key }}">{{ __($country->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xl-3 col-md- col-12">
                                <label>@lang('Email Verification')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                    name="ev" @if ($user->ev) checked @endif>

                            </div>

                            <div class="form-group col-xl-3 col-md- col-12">
                                <label>@lang('Mobile Verification')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                    name="sv" @if ($user->sv) checked @endif>

                            </div>
                            <div class="form-group col-xl-3 col-md- col-12">
                                <label>@lang('2FA Verification') </label>
                                <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                                    data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Enable')"
                                    data-off="@lang('Disable')" name="ts"
                                    @if ($user->ts) checked @endif>
                            </div>
                            <div class="form-group col-xl-3 col-md- col-12">
                                <label>@lang('KYC') </label>
                                <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="kv" @if($user->kv == 1) checked @endif>
                            </div>

                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Balance')</span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.add.sub.balance', $user->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="act">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Amount')</label>
                            <div class="input-group">
                                <input type="number" step="any" name="amount" class="form-control"
                                    placeholder="@lang('Please provide positive amount')" required>
                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('Remark')</label>
                            <textarea class="form-control" placeholder="@lang('Remark')" name="remark" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="userStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($user->status == Status::USER_ACTIVE)
                            <span>@lang('Ban User')</span>
                        @else
                            <span>@lang('Unban User')</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($user->status == Status::USER_ACTIVE)
                            <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                            </div>
                        @else
                            <p><span>@lang('Ban reason was'):</span></p>
                            <p>{{ $user->ban_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unban this user?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($user->status == Status::USER_ACTIVE)
                            <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                        @else
                            <button type="button" class="btn btn--dark"
                                data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="userBlockStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($user->block_status == 0)
                            <span>@lang('Block User')</span>
                        @else
                            <span>@lang('Unblock User')</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.block.status', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($user->block_status == 0  || $user->block_status == "")
                            <h6 class="mb-2">@lang('If you ulbock this user he/she won\'t able to post job his/her dashboard.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                            </div>
                        @else
                            <p><span>@lang('Block reason was'):</span></p>
                            <p>{{ $user->block_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unblock this user?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($user->block_status == 0 || $user->block_status == "")
                            <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                        @else
                            <button type="button" class="btn btn--dark"
                                data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="userBlockExecutionStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($user->block_execution_status == 0)
                            <span>@lang('Block User execution of tasks.')</span>
                        @else
                            <span>@lang('Unblock User execution of tasks.')</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.block.execution.status', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($user->block_execution_status == 0  || $user->block_execution_status == "")
                            <h6 class="mb-2">@lang('If you unbock this user he/she won\'t able to execution of tasks.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="block_execution_reason" rows="4" required></textarea>
                            </div>
                        @else
                            <p><span>@lang('Block reason was'):</span></p>
                            <p>{{ $user->block_execution_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unblock this user?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($user->block_execution_status == 0 || $user->block_execution_status == "")
                            <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                        @else
                            <button type="button" class="btn btn--dark"
                                data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict"
            $('.bal-btn').click(function() {
                var act = $(this).data('act');
                $('#addSubModal').find('input[name=act]').val(act);
                if (act == 'add') {
                    $('.type').text('Add');
                } else {
                    $('.type').text('Subtract');
                }
            });
            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });

            $('select[name=country]').val('{{ @$user->country_code }}');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user->mobile }}`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);

        })(jQuery);
    </script>
@endpush
