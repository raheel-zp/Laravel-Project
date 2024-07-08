@extends($activeTemplate . 'layouts.master')
@section('panel')
<section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job__details__wrapper">

                        <h3 class="job__details__wrapper-title">
                            {{ __($prove[0]["title"]) }}
                        </h3>
                        <div class="job__details__widget">
                            <h4 class="job__details__widget-title">@lang('Job Description :')</h4>
                            @php
                                echo $prove[0]["description"];
                            @endphp
                        </div>

                            <div class="job__details__widget">
                                            <form class="job__reviewed__form" action="{{ route('dispute.addMessage') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group">
                                                <input type="hidden" id="dispute_id" name="dispute_id" value="{{ $dispute_id }}">
                                                <label class="form-label">@lang('Message')</label>
                                                    <textarea name="message" class="form--control w-100"></textarea>
                                                </div>

                                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                                    @lang('Submit')
                                                </button>
                                            </form>


                                            @if ($user_id == $disputer_id)
                                            <form class="job__reviewed__form" action="{{ route('dispute.adminHelp') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group">
                                                <input type="hidden" id="dispute_id" name="dispute_id" value="{{ $dispute_id }}">
                                                <input type="hidden" id="job_prove_id" name="job_prove_id" value="{{ $job_prove_id }}">
                                                </div>

                                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                                    @lang('Request Admin to Resolve Dispute')
                                                </button>

                                            </form>

                                            @endif

                                            @if ($user_id == $prove[0]["user_id"])
                                            <form class="job__reviewed__form" action="{{ route('dispute.resolve') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group">
                                                <input type="hidden" id="dispute_id" name="dispute_id" value="{{ $dispute_id }}">
                                                <input type="hidden" id="job_prove_id" name="job_prove_id" value="{{ $job_prove_id }}">
                                                </div>

                                                <button type="submit" class="cmn--btn btn--md mt-4  w-100">
                                                    @lang('Accept Resolution')
                                                </button>

                                            </form>
                                            @endif

                                    <h2>Messages:</h2>
                                    <ul>
                                        @foreach ($disputeDetails as $disputeDetail)
                                        @if($disputeDetail["from_user"] == 0)
                                            <li>Admin : {{ $disputeDetail["message"] }}
                                            </li>
                                        @else
                                            <li>{{ \App\Models\User::find($disputeDetail["from_user"])->fullname }} : {{ $disputeDetail["message"] }}
                                            </li>
                                        @endif
                                        @endforeach
                                    </ul>
                            </div>

                    </div>

                </div>

            </div>
        </div>

    </section>

    </section>




@endsection
