@extends($activeTemplate . 'layouts.app')
@section('app')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-7 col-xl-5">
               <div class="text-center">
                <h3 class=" text--danger mb-3">@lang('You are banned')</h3>
                <img class="img-fluid mx-auto mb-3" src="{{ getImage($activeTemplateTrue . 'images/ban.png') }}" alt="@lang('image')">
                <p class="fw-bold mb-1">@lang('Reason'):</p>
                <p>{{ $user->ban_reason }}</p>
                <a href="{{ route('home') }}" class="btn btn--sm btn--base mt-3">
                    <i class="las la-undo"></i>
                    @lang('Home')
                </a>
               </div>
            </div>
        </div>
    </div>
@endsection
