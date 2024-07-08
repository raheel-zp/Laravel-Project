@extends('admin.layouts.app')
@section('panel')
<section class="job-details padding-top padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job__details__wrapper">
                        <div>
                            <span class="job__details__widget-title">@lang('Job Title :')</span>
                            <span class="job__details__wrapper-title">
                                {{ __($prove[0]["title"]) }}
                            </span>
                        </div>
                        <div class="job__details__widget">
                            <span class="job__details__widget-title">@lang('Job Description :')</span>
                            @php
                                echo $prove[0]["description"];
                            @endphp
                        </div>

                            <div class="job__details__widget">
                                    <form class="job__reviewed__form" action="{{ route('admin.disputes.disputeMessage') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                        <input type="hidden" id="dispute_id" name="dispute_id" value="{{ $dispute_id }}">
                                        <input type="hidden" id="job_prove_id" name="job_prove_id" value="{{ $job_prove_id }}">
                                        <label class="form-label">@lang('Message')</label>
                                            <textarea name="message" class="form--control w-100"></textarea>
                                        </div>
                                        <div style="margin-top:5px;">
                                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Send Message')</button>
                                        </div>
                                    </form>
                                    <form class="job__reviewed__form" action="{{ route('admin.disputes.resolve') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div style="margin-top:5px;">
                                        <input type="hidden" id="dispute_id" name="dispute_id" value="{{ $dispute_id }}">
                                        <input type="hidden" id="job_prove_id" name="job_prove_id" value="{{ $job_prove_id }}">
                                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Resolve Dispute')</button>
                                        </div>
                                    </form>
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
