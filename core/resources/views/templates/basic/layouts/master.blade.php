@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="dashboard-section padding-top padding-bottom">
        <div class="container">
            <div class="row">
                @include($activeTemplate . 'partials.sidebar')
                <div class="col-lg-8 col-xl-9">
                    @include($activeTemplate . 'partials.responsive_header')
                    @yield('panel')
                </div>
            </div>
        </div>
    </section>
@endsection
