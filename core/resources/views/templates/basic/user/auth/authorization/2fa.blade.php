@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="d-flex justify-content-center">
                    <div class="verification-code-wrapper ">
                        <div class="verification-area">
                            <form action="{{ route('user.go2fa.verify') }}" method="POST" class="submit-form">
                                @csrf
                                @include($activeTemplate . 'partials.verification_code')
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
