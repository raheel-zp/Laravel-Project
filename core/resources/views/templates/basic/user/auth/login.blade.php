@extends($activeTemplate . 'layouts.app')
@php
    $loginContent = getContent('login.content', true);
@endphp
@section('app')
    <section class="account-section">
        <div class="account-left">
            <div class="account__header">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ getImage('assets/images/logoIcon/logo.png') }}" alt="@lang('logo')">
                </a>
                <h2 class="account__header-title">{{ __($loginContent->data_values->heading) }}</h2>
                <p>{{ __($loginContent->data_values->subheading) }}</p>
            </div>
            <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha account-form">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">@lang('Username or Email')</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control form--control" required>
                </div>

                <div class="form-group">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <label for="password" class="form-label mb-0">@lang('Password')</label>
                        <a class="fw-bold forgot-pass text--base" href="{{ route('user.password.request') }}">
                            @lang('Forgot your password?')
                        </a>
                    </div>
                    <input id="password" type="password" class="form-control form--control" name="password" required>
                </div>

                <x-captcha />
                <div class="form-group  ">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        @lang('Remember Me')
                    </label>
                </div>

                <div class="  mb-3">
                    <button type="submit" id="recaptcha" class="btn btn--base w-100">
                        @lang('Login')
                    </button>
                </div>
                <p class="mb-0">@lang('Don\'t have any account?')
                    <a href="{{ route('user.register') }}" class="text--base">@lang('Register')</a>
                </p>
            </form>
        </div>
        <div class="account__right bg_img" style="background: url({{ getImage('assets/images/frontend/login/' . $loginContent->data_values->image, '1920x1080') }})">
        </div>
    </section>
@endsection
