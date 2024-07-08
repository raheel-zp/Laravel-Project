@extends($activeTemplate.'layouts.master')
@section('panel')
<div class="dashboard__content contact__form__wrapper">
    <div class="campaigns__wrapper">
        <form action="{{route('user.kyc.submit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <x-viser-form identifier="act" identifierValue="kyc" />
            <div class="form-group">
                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
            </div>
        </form>
    </div>
</div>

@endsection
