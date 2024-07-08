@extends($activeTemplate . 'layouts.master')
@section('panel')

  <script src="https://cdn.tiny.cloud/1/m70dct3sqg9ewcnof4tw9mlvw6snnuy3rsqsex5pr233atsh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="dashboard__content contact__form__wrapper">
        <div class="campaigns__wrapper">
            <form class="create__campaigns__form" action="{{ route('user.job.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-3">
                        <div class="job-poster">
                            <div class="job-poster-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview w-100" id="previewImg" style="background-image: url({{ getImage(getFilePath('jobPoster'), getFileSize('jobPoster')) }})">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="attachment" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" />
                                        <label for="image" class="bg--base"><i class="la la-pencil text-light"></i></label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">

                        <div class="form-group">
                            <label>@lang('OR paste image URL')</label>
                            <input class="form-control form--control w-100 " type="text" id="uploadImageByUrl" name="uploadImageByUrl" />
                        </div>

                        <div class="form-group">
                            <label>@lang('Category')</label>
                            <select class="form-control form-select form--control h-50 w-100" name="category_id" id="category" required>
                                <option selected disabled value="">@lang('Select One')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" data-subcategories="{{ $category->subcategory }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Subcategory')</label>
                            <select class="form-control form-select form--control h-50 w-100 " name="subcategory_id" id="subcategory"></select>
                        </div>
                        <b>Nie posiadasz grafiki? Znajdziesz ją <a href="https://zlecenio.eu/blog/udostepniamy-grafiki-do-zlecen/117" target="_blank">tutaj</a></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label> @lang('Job Title')</label>
                            <input type="text" name="title" class="form-control form--control " value="{{ old('title') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="country">
                        @lang('Job Proof')
                    </label>
                    <select class="form-control form-select form--control h-50 w-100" name="job_proof" id="fileOption" required>
                        <option value="" selected disabled>@lang('Select Type')</option>
                        <option value="1" @selected(old('job_proof') == Status::JOB_PROVE_OPTIONAL)>
                            @lang('Optional')
                        </option>
                        <option value="2" @selected(old('job_proof') == Status::JOB_PROVE_REQUIRED)>
                            @lang('Required')</option>
                    </select>
                </div>
                <div class="row" id="choiceOption">
                    <label for="country">
                        @lang('Select File Upload Option')
                    </label>
                    <div class="input-group">
                        <div class="form-group me-2">
                            <input type="checkbox" id="inlineRadio" value="all">
                            <label class="form-check-label" for="inlineRadio">@lang('Select All')</label>
                        </div>
                        @foreach ($files as $file)
                            <div class="form-group me-2 ">
                                <input type="checkbox" name="file_name[]" id="inlineRadio{{ $file->id }}" value="{{ $file->name }}">
                                <label class="form-check-label" for="inlineRadio{{ $file->id }}">{{ __($file->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label> @lang('Quantity')</label>
                            <input type="number" id="workers" name="quantity" class="form-control form--control workers" min="1" value="{{ old('quantity') }}" required>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label>@lang('Worker will earn')</label>
                            <div class="input-group">
                                <input type="number" step="any" name="rate" class="form-control form--control rate" min="0" value="{{ old('rate') }}" required>
                                <div class="input-group-text bg--base text--white border-0">{{ $general->cur_text }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label>@lang('Total Budget')</label>
                            <div class="input-group">
                                <input type="text" name="total_budget" class="form-control form--control total" value="{{ old('total_budget') }}" readonly>
                                <div class="input-group-text bg--base text--white border-0">{{ $general->cur_text }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label>@lang('Job Description') </label>
                            <div class="input-group">
                          <textarea class="form-control form--control nicEdit" name="description">{{ old('description') }}</textarea> _
                            <!--
                                <textarea class="form-control form--control" name="description">{{ old('description') }}</textarea>
 

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
  </script>   -->
                            </div>
                        </div>
                    </div>
                </div>
                <button class="cmn--btn btn--md w-100" type="submit">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        *:focus {
            outline: none;
        }

        .form--control {
            padding-right: 2px !important;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            var oldSubcategory = "{{ old('subcategory_id') }}";

            $("#choiceOption").css('display', 'none');
            $("#fileOption").on('change', function() {
                $("#choiceOption").css('display', 'none');
                var value = $(this).val();
                if (value == 2) {
                    $("#choiceOption").css('display', 'block');
                }
            });


            $("#inlineRadio").click(function() {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'))
            });

            $('#category').on('change', function() {
                let subcategories = $(this).find('option:selected').data('subcategories');

                let subcategory = `<option value="" selected disabled>@lang('Select One')</option>`;
                $.each(subcategories, function(index, value) {
                    subcategory += `<option value="${value.id}" ${oldSubcategory ==value.id ? 'selected' : ''}>${value.name}</option>`;
                });
                $('[name=subcategory_id]').html(subcategory)
            }).change();

            $(".workers").on('change input', function() {
                var worker = $(this).val();
                var rate = $('.rate').val();
                var total = rate * worker;
                $('.total').val(total);
            });

            $(".rate").on('change input', function() {
                var rate = $(this).val();
                var worker = $('.workers').val();
                var total = rate * worker;
                $('.total').val(total);
            });

            $('.profilePicUpload').on('change', function() {
                previewFile($(this))

            });


            dataURLtoBlob


            // Load image into canvas and convert to file object
            $('#imagePreview').on('load', function() {
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.width = this.width;
                canvas.height = this.height;
                context.drawImage(this, 0, 0, this.width, this.height);
                
                canvasToFile(canvas, 'image.jpg', 'image/jpeg').then(blob => {
                    // Use the file object here
                    console.log(blob);
                    // You can also assign it to a file input if needed
                    // $('#fileInput').prop('files', [blob]);
                });
            });

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

        // Function to convert dataURL to Blob object
        function dataURLtoBlob(dataURL) {
            var arr = dataURL.split(','),
                mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]),
                n = bstr.length,
                u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], { type: mime });
        }

        // Function to convert canvas content to Blob object
        function canvasToFile(canvas, filename, mimeType) {
            return new Promise((resolve, reject) => {
                canvas.toBlob(blob => {
                    blob.name = filename;
                    resolve(blob);
                }, mimeType);
            });
        }

    </script>
@endpush





