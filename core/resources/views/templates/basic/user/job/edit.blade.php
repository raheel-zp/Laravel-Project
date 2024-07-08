@extends($activeTemplate . 'layouts.master')
@section('panel')
<script src="https://cdn.tiny.cloud/1/m70dct3sqg9ewcnof4tw9mlvw6snnuy3rsqsex5pr233atsh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="ashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <div class="">
                <form class="create__campaigns__form" action="{{ route('user.job.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-3 col-lg-5 col-md-5">
                            <div class="job-poster">
                                <div class="job-poster-header">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview w-100" id="previewImg" style="background-image: url({{ getImage(getFilePath('jobPoster') . '/' . @$job->attachment, getFileSize('jobPoster')) }})">
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="attachment" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" onchange="previewFile(this);" />
                                            <label for="image" class="bg--base"><i class="la la-pencil text-light"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-9 col-lg-7 col-md-7">
  
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

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label>@lang('Job Title')

                                </label>
                                <input type="text" name="title" class="form-control form--control" value="{{ $job->title }}" required>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group ">
                                <label>@lang('Job Proof')

                                </label>
                                <select class="form-contro form-select form--control h-50 w-100" name="job_proof" id="fileOption" required>
                                    <option value="" selected disabled>@lang('Select Job Proof')
                                    </option>
                                    <option value="1" @selected($job->job_proof == Status::JOB_PROVE_OPTIONAL)>
                                        @lang('Optional')
                                    </option>
                                    <option value="2" @selected($job->job_proof == Status::JOB_PROVE_REQUIRED)>
                                        @lang('Required')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="choiceOption">
                        <label>@lang('Select File Upload Option')

                        </label>
                        <div class="input-group">
                            <div class="form-group me-2">
                                <input type="checkbox" id="inlineRadio" value="all">
                                <label class="form-check-label" for="inlineRadio">@lang('Select All')</label>
                            </div>
                            @foreach ($files as $file)
                                <div class="form-group me-2">
                                    <input type="checkbox" name="file_name[]" id="inlineRadio{{ $file->id }}" value="{{ $file->name }}">
                                    <label class="form-check-label" for="inlineRadio{{ $file->id }}">{{ $file->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="workers" class="form--label">
                                    @lang('Quantity')
                                </label>
                                <div class="input-group">
                                    <input type="number" id="workers" name="quantity" class="form-control form--control workers" min="1" value="{{ $job->quantity }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>
                                    @lang('Worker will earn')
                                </label>
                                <div class="input-group">
                                    <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="{{ getAmount($job->rate) }}">
                                    <div class="input-group-text bg--base text--white">{{ $general->cur_text }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>@lang('Total Budget')</label>
                                <div class="input-group">
                                    <input type="text" name="total_budget" class="form-control form--control total" value="{{ getAmount($job->total) }}" readonly>
                                    <div class="input-group-text bg--base text--white">{{ $general->cur_text }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="input-group">
								<textarea class="form-control form--control nicEdit" name="description" required>{{ $job->description }}</textarea>
								<!--
                                <textarea class="form-control form--control" name="description" required>{{ $job->description }}</textarea>
 

  <script>
    tinymce.init({
    language_url : 'https://zlecenio.eu/assets/edytor/jezyk/pl.js',
	language: 'pl',
	browser_spellcheck: true,
    contextmenu: false,
	menubar: false,
	link_target_list: false,
      selector: 'textarea',
      plugins: 'mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste autocorrect a11ychecker typography inlinecss',
      toolbar: 'blocks fontsize | bold italic underline strikethrough | image link media table mergetags | lineheight | numlist indent outdent | emoticons charmap | removeformat',
    });
  </script>         -->                 
                            </div>
                        </div>
                    </div>
                    <button class="cmn--btn btn--md w-100" type="submit">@lang('Submit')</button>
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
            var fileName = '{{ $job->file_name }}';
            var files = fileName.split(",");
            var i;
            var j;
            var inputs = $("input[type=checkbox]");
            for (i = 0; i < files.length; i++) {
                var file = files[i];
                for (j = 0; j < inputs.length; j++) {
                    var checkboxVal = $(inputs[j]).val();
                    if (checkboxVal == file) {
                        $(inputs[j]).attr('checked', true);
                    }
                }
            }
            $("#inlineRadio").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'))
            });

            if (fileName) {
                $("#choiceOption").css('display', 'block');
            } else {
                $("#choiceOption").css('display', 'none');
            }

            $("#fileOption").change(function() {
                $("#choiceOption").css('display', 'none');
                var value = $(this).val();
                if (value == 2) {
                    $("#choiceOption").css('display', 'block');
                }
            });

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

            $(".workers").on('change input', function() {

                var worker = $(this).val();
                var rate = $('.rate').val();
                var total = rate * worker;
                $('.total').val(parseFloat(total).toFixed(3));
            });

            $(".rate").on('change input', function() {

                var rate = $(this).val();
                var worker = $('.workers').val();
                var total = rate * worker;
                $('.total').val(total);

            });

            $('.profilePicUpload').on('change', function() {
                previewFile($(this))

            })

        })(jQuery);

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").css("background-image", "url(" + reader.result + ")");
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    
    

@endpush
