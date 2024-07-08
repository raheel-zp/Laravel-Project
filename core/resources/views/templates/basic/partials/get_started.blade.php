@php
    $startedContent = getContent('get_started.content', true);
@endphp
<div class="@if (request()->routeIs('home')) section-bg @endif">
    <div class="container">
        <div class="get-started d-flex flex-wrap align-items-center justify-content-between">
            <div class="section__header m-0">
                <h3 class="section__header-title">{{ __(@$startedContent->data_values->heading) }}</h3>
                <p>{{ __(@$startedContent->data_values->subheading) }}</p>
            </div>
            <a href="{{ url('/') }}/{{ @$startedContent->data_values->button_link }}" class="cmn--btn">{{ __(@$startedContent->data_values->button_text) }}</a>
        </div>
    </div>
</div>
