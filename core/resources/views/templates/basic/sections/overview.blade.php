@php
    $overviewContent = getContent('overview.content', true);
@endphp
<section class="overview-section bg_img overflow-hidden" style="background: url({{ getImage('assets/images/frontend/overview/' . $overviewContent->data_values->background_image, '750x600') }});">
    <div class="row">
        <div class="col-lg-6 p-0">
            <div class="overview__content__wrapper bg_img" style="background: url({{ getImage('assets/images/frontend/overview/' . $overviewContent->data_values->overview_image, '500x265') }});">
                <div class="container">
                    <div class="overview__content ms-lg-auto padding-top padding-bottom">
                        <div class="section__header mb-0 color-white">
                            <h2 class="section__header-title">{{ __(@$overviewContent->data_values->heading_left) }}</h2>
                            <p>{{ __(@$overviewContent->data_values->subheading_left) }}</p>
                            <a href="{{ @$overviewContent->data_values->left_button_link }}" class="btn">{{ __(@$overviewContent->data_values->left_button_text) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 p-0">
            <div class="overview__content__wrapper right-bg bg_img">
                <div class="container">
                    <div class="overview__content ps-lg-4 ps-xxl-5 padding-top padding-bottom">
                        <div class="section__header mb-0">
                            <h2 class="section__header-title">{{ __(@$overviewContent->data_values->heading_right) }}</h2>
                            <p>{{ __(@$overviewContent->data_values->subheading_right) }}</p>
                            <a href="{{ @$overviewContent->data_values->right_button_link }}" class="btn">{{ __(@$overviewContent->data_values->right_button_text) }}</a>
                        </div>
                    </div>
                </div>
                <img src="{{ getImage('assets/images/frontend/overview/' . $overviewContent->data_values->overview_image, '500x265') }}" alt="overview" class="shape1">
            </div>
        </div>
    </div>
</section>
