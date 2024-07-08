@extends($activeTemplate . 'layouts.master')

@section('panel')
    <div class="dashboard__content contact__form__wrapper">
        <h3>@lang('Payment Preview')</h3>
        <hr>
        <h4 class="my-2"> @lang('PLEASE SEND EXACTLY') <span class="text--success"> {{ $data->amount }}</span>
            {{ __($data->currency) }}</h4>
        <h5 class="mb-2">@lang('TO') <span class="text--success"> {{ $data->sendto }}</span></h5>
        <img src="{{ $data->img }}" alt="@lang('Image')">
        <h4 class="text-white bold my-4">@lang('SCAN TO SEND')</h4>
    </div>
@endsection
