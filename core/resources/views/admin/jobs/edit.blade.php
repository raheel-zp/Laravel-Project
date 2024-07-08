@extends('admin.layouts.app')
@section('panel')
    <div class="ashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <div class="">
                <form class="create__campaigns__form" action="{{ route('admin.jobs.update', $job->id) }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label>@lang('Job Title')

                                </label>
                                <input type="text" name="title" class="form-control form--control" value="{{ $job->title }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label>@lang('Category')</label>
                                <select class="form-control form-select form--control h-50 w-100" name="category_id" id="category" required>
                                    <option value="" selected disabled>@lang('Select One')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($job->category_id == $category->id) data-subcategories="{{ $category->subcategory }}" data-subcategory="{{ $job->subcategory_id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('Subcategory')</label>
                                <select class="form-control form-select form--control h-50 w-100" name="subcategory_id" id="subcategory">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">
                                    @lang('Job Block Status')
                                </label>
                                <select class="form-control form-select form--control h-50 w-100" name="job_block_status" id="JobBlockStatus" required>
                                    <option value="" selected disabled>@lang('Select Type')</option>
                                    <option value="0" @selected($job->job_block_status == Status::JOB_UNBLOCK)>
                                        @lang('Unblock')
                                    </option>
                                    <option value="1" @selected($job->job_block_status == Status::JOB_BLOCK)>
                                        @lang('Block')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">
                                    @lang('Job Hide for Un-Authorized Users')
                                </label>
                                <select class="form-control form-select form--control h-50 w-100" name="is_hidden" id="JobIsHidden" required>
                                    <option value="" selected disabled>@lang('Select Type')</option>
                                    <option value="1" @selected($job->is_hidden == Status::YES)>
                                        @lang('Hide')
                                    </option>
                                    <option value="0" @selected($job->is_hidden == Status::NO)>
                                        @lang('Show')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        *:focus {
            outline: none;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('#category').change(function() {
                let subcategories = $(this).find('option:selected').data('subcategories');
                let subCat = $(this).find('option:selected').data('subcategory');
                let subcategory = `<option value="" selected disabled>@lang('Select One')</option>`;
                $.each(subcategories, function(index, value) {
                    subcategory +=
                        `<option value="${value.id}" ${value.id == subCat ? 'selected' : ''} >${value.name}</option>`;
                });
                $('[name=subcategory_id]').html(subcategory)
            }).change();
        })(jQuery);
    </script>
@endpush
