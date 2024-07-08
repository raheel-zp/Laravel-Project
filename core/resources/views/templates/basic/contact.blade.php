@extends($activeTemplate . 'layouts.frontend')
@php
    $contactContent = getContent('contact_us.content', true);
    $contactElement = getContent('contact_us.element', false, null, true);
@endphp
@section('content')
    <section class="contact-section padding-top padding-bottom">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="contact__info__wrapper">
                        <h3 class="contact__info__wrapper-title">{{ __($contactContent->data_values->title) }}</h3>
                        <p>{{ __($contactContent->data_values->details) }}</p>
                        @foreach ($contactElement as $contact)
                            <h4 class="title">@php echo $contact->data_values->icon @endphp {{ __($contact->data_values->title) }}</h4>
                            <ul class="contacts">
                                <li>{{ __($contact->data_values->content) }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact__form__wrapper">
                        <h3 class="contact__form__wrapper-title">@lang("Let's Talk")</h3>
                        <form method="post" action="{{ route('contact') }}" class="verify-gcaptcha">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input name="name" type="text" class="form-control form--control" value="{{ auth()->user() ? auth()->user()->fullname : old('name') }}" @if (auth()->user()) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Email')</label>
                                <input name="email" type="email" class="form-control form--control" value="{{ auth()->user() ? auth()->user()->email : old('email') }}" @if (auth()->user()) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Subject')</label>
                                <input name="subject" type="text" class="form-control form--control" value="{{ old('subject') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Message')</label>
                                <textarea name="message" wrap="off" class="form-control form--control" required>{{ old('message') }}</textarea>
                            </div>
                            <x-captcha />
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
