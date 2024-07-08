@php
    $faqElement = getContent('faq.element', false, null, false);
@endphp
<section class="faq-section padding-top padding-bottom">
    <div class="container">
        <div class="faq-content">
            <div class="custom--accordion accordion" id="accordionExample">
                @foreach ($faqElement as $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne-{{ $loop->index }}">
                            <button class="accordion-button {{ $loop->index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="{{ $loop->index == 0 ? 'true' : 'false' }}" aria-controls="collapseOne">
                                {{ __(@$faq->data_values->question) }}
                            </button>
                        </h3>
                        <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}" aria-labelledby="headingOne-{{ $loop->index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @php echo @$faq->data_values->answer @endphp
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
