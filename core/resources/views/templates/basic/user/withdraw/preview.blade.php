@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content contact__form__wrapper">
        <h5>@lang('Withdraw Via') {{ $withdraw->method->name }}</h5>
        <hr>
        <form action="{{ route('user.withdraw.submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                @php
                    echo $withdraw->method->description;
                @endphp
            </div>
            <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
            @if (auth()->user()->ts)
                <div class="form-group  ">
                    <label>@lang('Google Authenticator Code')</label>
                    <input type="text" name="authenticator_code" class="form-control form--control" required>
                </div>
            @endif
            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
        </form>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            $('div').find('.form-group').addClass('mb-3')
        })(jQuery);
    </script>
@endpush
