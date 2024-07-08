@extends($activeTemplate . 'layouts.app')
@section('app')
    @include($activeTemplate . 'partials.topbar')
    @include($activeTemplate . 'partials.header')
    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif
    @yield('content')
    @if (!request()->routeIs('user.*'))
        @include($activeTemplate . 'partials.get_started')
    @endif
    @include($activeTemplate . 'partials.footer')
@endsection
