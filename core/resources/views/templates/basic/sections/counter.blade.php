@php
    $counterElement = getContent('counter.element', orderById: true);
@endphp
<section class="counter-section padding-top padding-bottom">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($counterElement as $counter)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="counter__item">
                        <div class="counter__item-icon">
                            @php echo @$counter->data_values->icon @endphp
                        </div>
                        <div class="counter__item-content">
                            <h2 class="title"><span class="odometer" data-odometer-final="{{@$counter->data_values->digit }}"></span>{{ @$counter->data_values->digit_postfix }}
                            </h2>
                            <p class="info">{{ __(@$counter->data_values->title) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
