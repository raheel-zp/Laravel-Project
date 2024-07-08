@extends($activeTemplate . 'layouts.master')
@section('panel')
    <div class="dashboard__content contact__form__wrapper">
        <div class="profile__edit__wrapper">
            <div class="profile__edit__form">
                <form class="register" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile__thumb__edit text-center">
                                <div class="thumb">
                                    <img id="previewImg" src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="freelancer">
                                </div>
                                <div class="profile__info">
                                    <h4 class="name">{{ $user->fullname }}</h4>
                                    <p class="username">{{ $user->username }}</p>
                                    <input type="file" class="form-control d-none" class="userProfileUpload" name="image" id="image" onchange="previewFile(this);">
                                    <label class="btn btn--base btn--md mt-3 mb-3" for="image">
                                        @lang('Update Profile Picture')
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form-control form--control" name="firstname" value="{{ $user->firstname }}" required>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form-control form--control" name="lastname" value="{{ $user->lastname }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('E-mail Address')</label>
                                    <input class="form-control form--control" value="{{ $user->email }}" disabled>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('Mobile Number')</label>
                                    <input class="form-control form--control" value="{{ $user->mobile }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control" name="address" value="{{ @$user->address->address }}">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form-control form--control" name="state" value="{{ @$user->address->state }}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group  col-sm-4">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control" name="zip" value="{{ @$user->address->zip }}">
                                </div>

                                <div class="form-group  col-sm-4">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form-control form--control" name="city" value="{{ @$user->address->city }}">
                                </div>

                                <div class="form-group  col-sm-4">
                                    <label class="form-label">@lang('Country')</label>
                                    <input class="form-control form--control" value="{{ @$user->address->country }}" disabled>
                                </div>

                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
