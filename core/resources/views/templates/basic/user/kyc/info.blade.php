@extends($activeTemplate.'layouts.master')
@section('panel')
<div class="dashboard__content contact__form__wrapper">
    <div class="campaigns__wrapper">
        @if($user->kyc_data)
            <ul class="list-group list-group-flush text-center">
                @foreach($user->kyc_data as $val)
                    @continue(!$val->value)
                    <li class="list-group-item d-flex justify-content-between px-0">
                        {{ __($val->name) }}
                        <span>
                            @if($val->type == 'checkbox')
                                {{ implode(',',$val->value) }}
                            @elseif($val->type == 'file')
                                <a href="{{ route('user.attachment.download',encrypt(getFilePath('verify').'/'.$val->value)) }}"
                                    class="me-3"><i class="fa fa-file"></i> @lang('Attachment') </a>
                            @else
                                <p>{{ __($val->value) }}</p>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            <h5 class="text-center">@lang('KYC data not found')</h5>
        @endif
    </div>
</div>
</div>

@endsection
