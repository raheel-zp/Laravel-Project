@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.subcategory.store', @$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('subcategory') . '/' . @$subcategory->image, getFileSize('subcategory')) }})">
                                                    <button type="button" class="remove-image">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into ' . getFileSize('subcategory') . 'px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">

                                <div id="phpCategoryId" data-variable="{{ @$subcategory->category_id }}"></div>
                                <div id="phpSubCategoryId" data-variable="{{ @$subcategory->id }}"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> @lang('Name')</label>
                                            <input type="text" name="name" class="form-control" value="{{old('name',@$subcategory->name)}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Category')</label>
                                            <select class=" form-control" name="category_id"  id="category" required>
                                                <option selected disabled>@lang('Select One')</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(@$subcategory->category_id == $category->id) data-subcategories="{{ $category->subcategory }}" data-subcategory="{{ @$subcategory->id }}">
                                                    {{ __($category->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('Subcategory')</label>
                                            <select class="form-control form-select form--control h-50 w-100" name="sub_parent_id" id="subcategory">
                                                <option selected disabled>@lang('Select One')</option>
                                                @if($categories)
                                                    @foreach($subCategories as $subCategory)
                                                        <?php $dash=''; ?>
                                                        <option class='parent-{{ $subCategory->category_id }} subcategory' value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                        @if(count($subCategory->parentSubcategory))
                                                            @include('admin.subcategory.childoptions',['parentsubcategories' => $subCategory->parentSubcategory])
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label> @lang('Description')</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10" required>{{ old('description',@$subcategory->description) }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subcategory.index') }}" />
@endpush

@push('style')
    <style>
        .profilePicUpload {
            margin-top: -20px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            /*$('#category').change(function() {
                let subcategories = $(this).find('option:selected').data('subcategories');
                let subCat = $(this).find('option:selected').data('subcategory');
                let subcategory = `<option value="" selected disabled>@lang('Select One')</option>`;

                console.log(subcategories);

                $.each(subcategories, function(index, value) {
                    subcategory +=
                        `<option value="${value.id}" ${value.id == subCat ? 'selected' : ''} >${value.name}</option>`;
                });
                $('[name=sub_parent_id]').html(subcategory)
            }).change();*/

            $('#category').on('change', function () {
                
                $("#subcategory").attr('disabled', false); //enable subcategory select
                $("#subcategory").val("");
                $(".subcategory").attr('disabled', true); //disable all category option
                $(".subcategory").hide(); //hide all subcategory option
                $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
                $(".parent-" + $(this).val()).show(); 
            });

            var phpDataElement = document.getElementById('phpCategoryId');
            var jsVariable = phpDataElement.getAttribute('data-variable');

            if (jsVariable && jsVariable > 0) {

                $("#subcategory").attr('disabled', false); //enable subcategory select
                $("#subcategory").val("");
                $(".subcategory").attr('disabled', true); //disable all category option
                $(".subcategory").hide(); //hide all subcategory option
                $(".parent-" + jsVariable).attr('disabled', false); //enable subcategory of selected category/parent
                $(".parent-" + jsVariable).show(); 

                var phpSubcategoryDataElement = document.getElementById('phpSubCategoryId');
                var subCategorySelected = phpSubcategoryDataElement.getAttribute('data-variable');

                $("#subcategory").val(subCategorySelected);

            }


        })(jQuery);
    </script>
@endpush

