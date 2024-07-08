@php
    $breadcrumbContent = getContent('breadcrumb.content', true);
@endphp
<div class="banner-inner bg_img" style="background: url({{ asset($activeTemplateTrue . 'images/bg/banner.png') }});">
    <div class="container">
        <div class="banner__inner__content">
            <h2 class="banner__inner__content-title">{{ __($pageTitle) }}</h2>
            <ul class="breadcums d-flex justify-content-center">
                <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                <li>/</li>
                <li>{{ __($pageTitle) }}</li>
            </ul>
        </div>
    </div>
    <div class="shapes">
        <img src="{{ getImage('assets/images/frontend/breadcrumb/' . $breadcrumbContent->data_values->image, '1920x1080') }}"
            alt="@lang('overview')" class="shape1">
    </div>
      
</div>




