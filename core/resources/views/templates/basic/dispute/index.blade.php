@extends($activeTemplate . 'layouts.master')
@section('panel')

<section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job__details__wrapper">
                        <div class="job__details__widget">

                            <form class="job__reviewed__form" action="{{ route('dispute.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                <input type="hidden" id="job_prove_id" name="job_prove_id" value="{{ $prove_id }}">
                                <label class="form-label">@lang('Provide Description')</label>
                                    <textarea name="message" class="form--control w-100"></textarea>
                                </div>

                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                    @lang('Submit')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
