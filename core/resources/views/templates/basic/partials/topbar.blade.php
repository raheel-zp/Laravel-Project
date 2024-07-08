@php
    $contacElement = getContent('contact_us.element', false, 2, true);
    $socialElement = getContent('social_icon.element', orderById: true);
@endphp
<div class="header-top">
    <div class="container">
        <div
            class="header__top__wrapper d-flex flex-wrap justify-content-center justify-content-lg-between align-items-center">
            <div class="header__top__wrapper-left">
                <ul class="contacts  d-flex flex-wrap justify-content-center m-0">
                    @foreach ($contacElement as $contact)
                        <li>
                            <a href="{{ @$contact->data_values->attribute }}{{ $contact->data_values->content }}">
                                @php echo $contact->data_values->icon @endphp
                                {{ __($contact->data_values->content) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="header__top__wrapper-right d-flex align-items-center">
                <ul class="social-links m-0 me-3">
                    @foreach ($socialElement as $social)
                        <li>
                            <a href="{{ @$social->data_values->url }}" target="__blank">
                                @php echo @$social->data_values->icon @endphp
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if ($general->multi_language)
                    <select class="language langSel nice-select">
                        @foreach ($language as $item)
                            <option value="{{ $item->code }}" @selected(session('lang') == $item->code)>
                                {{ __($item->name) }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
    </div>
</div>
