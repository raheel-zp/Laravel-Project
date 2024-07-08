@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30" style="margin-bottom:10px;">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="row"> <h5>Contest For Referral</h5></div>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <input type="hidden" name="contest_type" value="{{ $contest[0]['contest_type'] }}">
                                    <label> @lang('Contest Name')</label>
                                    <input class="form-control" type="text" name="contest_name" required
                                        value="{{ $contest[0]['contest_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Month')</label>
                                    <input class="form-control" type="text" name="contest_month" required
                                        value="{{ $contest[0]['contest_month'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Prize')</label>
                                    <input class="form-control" type="text" name="contest_prize" required
                                        value="{{ $contest[0]['contest_prize'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Friend Tasks completed by others')</label>
                                    <input class="form-control" type="text" name="friend_task_added" required
                                        value="{{ $contest[0]['friend_task_added'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Tasks completed by Friend')</label>
                                    <input class="form-control" type="text" name="friend_task_completed" required
                                        value="{{ $contest[0]['friend_task_completed'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest ON / OFF ( 0 / 1 )')</label>
                                    <input class="form-control" type="text" name="contest_state" required
                                        value="{{ $contest[0]['contest_state'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Rules')</label>
                                    <textarea name="rules" id="rules">
                                    {{ $contest[0]['rules'] }}
                                    </textarea>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
                    <div class="row mb-none-30" style="margin-bottom:10px;">
                        <div class="col-lg-12 col-md-12 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row"> <h5>Contest For Adding Jobs</h5></div>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <input type="hidden" name="contest_type" value="{{ $contest2[0]['contest_type'] }}">
                                    <input class="form-control" type="hidden" name="friend_task_added" required
                                        value="{{ $contest2[0]['friend_task_added'] }}">
                                    <input class="form-control" type="hidden" name="friend_task_completed" required
                                        value="{{ $contest2[0]['friend_task_completed'] }}">
                                    <label> @lang('Contest Name')</label>
                                    <input class="form-control" type="text" name="contest_name" required
                                        value="{{ $contest2[0]['contest_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Month')</label>
                                    <input class="form-control" type="text" name="contest_month" required
                                        value="{{ $contest2[0]['contest_month'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Prize')</label>
                                    <input class="form-control" type="text" name="contest_prize" required
                                        value="{{ $contest2[0]['contest_prize'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest ON / OFF ( 0 / 1 )')</label>
                                    <input class="form-control" type="text" name="contest_state" required
                                        value="{{ $contest2[0]['contest_state'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Rules')</label>
                                    <textarea name="rules" id="rules">
                                    {{ $contest2[0]['rules'] }}
                                    </textarea>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
                    <div class="row mb-none-30">
                        <div class="col-lg-12 col-md-12 mb-30">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row"> <h5>Contest For Making Jobs</h5></div>
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <input type="hidden" name="contest_type" value="{{ $contest3[0]['contest_type'] }}">
                                    <input class="form-control" type="hidden" name="friend_task_added" required
                                        value="{{ $contest3[0]['friend_task_added'] }}">
                                    <input class="form-control" type="hidden" name="friend_task_completed" required
                                        value="{{ $contest3[0]['friend_task_completed'] }}">
                                    <label> @lang('Contest Name')</label>
                                    <input class="form-control" type="text" name="contest_name" required
                                        value="{{ $contest3[0]['contest_name'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Month')</label>
                                    <input class="form-control" type="text" name="contest_month" required
                                        value="{{ $contest3[0]['contest_month'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest Prize')</label>
                                    <input class="form-control" type="text" name="contest_prize" required
                                        value="{{ $contest3[0]['contest_prize'] }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Contest ON / OFF ( 0 / 1 )')</label>
                                    <input class="form-control" type="text" name="contest_state" required
                                        value="{{ $contest3[0]['contest_state'] }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Rules')</label>
                                    <textarea name="rules" id="rules">
                                    {{ $contest3[0]['rules'] }}
                                    </textarea>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.card-body')
            });
        })(jQuery);
    </script>
@endpush
